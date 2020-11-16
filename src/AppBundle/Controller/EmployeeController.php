<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Feedback;
use AppBundle\Form\Type\FeedbackType;
use AppBundle\Form\Type\MeetingType;
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
        return $this->render('employee/meetings.html.twig', [
            'meetings' => $this->meetingManager->getAllMeetings()
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/agenda", name="employee-agenda")
     */
    public function agendaAction(Request $request)
    {
        return $this->render('employee/agenda.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/groups", name="employee-groups")
     */
    public function groupsAction(Request $request)
    {
        return $this->render('employee/groups.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/about", name="employee-about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('employee/about.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_EMPLOYEE")
     * @Route("/employee/contact", name="employee-contact")
     */
    public function contactAction(Request $request)
    {
        return $this->render('employee/contact.html.twig', [
        ]);
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
            return $this->redirectToRoute('employee');
        }

        $feedback = new Feedback();

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
            return $this->redirectToRoute('employee');
        }


        return $this->render('employee/feedback.html.twig', [
            'feedbackForm' => $form->createView(),
            'message' => "hallo"
        ]);
    }
}
