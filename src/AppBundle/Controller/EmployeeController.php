<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use AppBundle\Form\Type\FeedbackType;
use AppBundle\Manager\FeedbackManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use AppBundle\Manager\MeetingManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    private $feedbackManager;
    private $meetingManager;

    public function __construct(FeedbackManager $feedbackManager, MeetingManager $meetingManager)
    {
        $this->feedbackManager = $feedbackManager;
        $this->meetingManager = $meetingManager;

    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/dashboard", name="employee-dashboard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('Employee/homepage.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/meetings", name="employee-meetings")
     */
    public function meetingAction(Request $request)
    {
        $meetings = $this->meetingManager->getMeetingByUser($this->getUser());

        return $this->render('employee/meetings.html.twig', [
            'meetings' => $meetings,
            'feedbacks' => $this->feedbackManager->getFeedbackByUser($this->getUser())
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/meeting/{id}/accept", name="employee-meeting-accept")
     */
    public function meetingAcceptAction($id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);

        if (count($this->meetingManager->getUsersByMeeting($meeting))<$this->meetingManager->getUsersMaxCap($meeting))
        {
            $meetingInUser = $this->meetingManager->getMeetingInUser($this->getUser(), $meeting);
            $meetingInUser->setState(Meeting::MEETING_ACCEPTED);
            $this->meetingManager->updateMeetingInUser($meetingInUser);
        }
        return $this->redirectToRoute('employee-meetings');
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/meeting/{id}/decline", name="employee-meeting-decline")
     */
    public function meetingDeclineAction($id, Request $request)
    {
        $meeting = $this->meetingManager->getMeetingById($id);
        $meetingInUser = $this->meetingManager->getMeetingInUser($this->getUser(), $meeting);
        $meetingInUser->setState(Meeting::MEETING_DECLINED);
        $this->meetingManager->updateMeetingInUser($meetingInUser);

        return $this->redirectToRoute('employee-meetings');
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/user/meeting/{id}/feedback", name="employee-feedback")
     */
    public function feedbackAction($id, Request $request)
    {
        if (!$this->getUser())
            return $this->redirectToRoute('login');

        $meeting = $this->meetingManager->getMeetingById($id);

        if ($this->getUser() && $this->feedbackManager->getFeedbackByUserAndMeeting($this->getUser(), $meeting)){
            return $this->redirectToRoute('employee-dashboard');
        }

        $form = $this->createForm(FeedbackType::class);

//        only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            $feedback = $form->getData();
            $feedback->setMeeting($meeting);
            $feedback->setUser($this->getUser());

            $this->addFlash(
                'notice',
                'The form was saved!'
            );
            $this->feedbackManager->updateFeedback($feedback);
            return $this->redirectToRoute('employee-dashboard');
        }


        return $this->render('employee/feedbackForm.html.twig', [
            'feedbackForm' => $form->createView(),
        ]);
    }
}
