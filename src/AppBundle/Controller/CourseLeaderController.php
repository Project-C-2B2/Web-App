<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\MeetingType;
use AppBundle\Manager\MeetingManager;
use AppBundle\Service\NotificationService;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use AppBundle\CourseLeader\MeetingCourseLeader;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use AppBundle\Entity\Meeting;



class CourseLeaderController extends Controller
{
    private $meetingManager;
    private $notificationService;

    public function __construct(MeetingManager $meetingManager, NotificationService $notificationService)
    {
        $this->meetingManager = $meetingManager;
        $this->notificationService = $notificationService;
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/clead", name="courseleader-homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('courseleader/homepage.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/clead/meeting/view", name="courseleader-meeting-view")
     */
    public function meetingViewAction()
    {
        return $this->render('courseleader/courseLeaderMeetingView.html.twig', [
            'meetings' => $this->meetingManager->getAllMeetings()
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/clead/meeting/create", name="courseleader-meeting-create")
     */
    public function meetingCreateAction(Request $request)
    {
        $form = $this->createForm(MeetingType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->meetingManager->updateMeeting($form->getData());
            $this->notificationService->sentInvitationNotification($form->getData());
            return $this->redirectToRoute('courseleader-meeting-view');
        }

        return $this->render('courseleader/courseLeaderMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/clead/meeting/{id}", name="courseleader-meeting-detail")
     */
    public function meetingDetailAction($id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);

        // replace this example code with whatever you need
        return $this->render('courseleader/homepage.html.twig', [
            'meeting' => $meeting
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/clead/meeting/{id}/update", name="courseleader-meeting-update")
     */
    public function meetingUpdateAction(Request $request, $id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);
        $form = $this->createForm(MeetingType::class, $meeting);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->meetingManager->updateMeeting($meeting);
            $this->notificationService->sentUpdateNotification($meeting);
            return $this->redirectToRoute('courseleader-meeting-view');
        }

        return $this->render('courseleader/courseLeaderMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
