<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\MeetingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class CourseLeaderController extends Controller
{
//    /**
//     * @IsGranted("ROLE_COURSELEADER")
//     * @Route("/", name="homepage")
//     */
//    public function indexAction(Request $request)
//    {
//        // replace this example code with whatever you need
//        return $this->render('default/homepage.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
//    }
    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/manager", name="manager-homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('manager/homepage.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/manager/meeting/view", name="manager-meeting-view")
     */
    public function meetingViewAction()
    {
        return $this->render('manager/managerMeetingView.html.twig', [
            'meetings' => $this->meetingManager->getAllMeetings()
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/manager/meeting/create", name="manager-meeting-create")
     */
    public function meetingCreateAction(Request $request)
    {
        $form = $this->createForm(MeetingType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->meetingManager->updateMeeting($form->getData());
            return $this->redirectToRoute('manager-meeting-view');
        }

        return $this->render('manager/managerMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/manager/meeting/{id}", name="manager-meeting-detail")
     */
    public function meetingDetailAction($id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);

        // replace this example code with whatever you need
        return $this->render('manager/homepage.html.twig', [
            'meeting' => $meeting
        ]);
    }

    /**
     * @IsGranted("ROLE_COURSELEADER")
     * @Route("/manager/meeting/{id}/update", name="manager-meeting-update")
     */
    public function meetingUpdateAction(Request $request, $id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);
        $form = $this->createForm(MeetingType::class, $meeting);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $this->meetingManager->updateMeeting($meeting);
            return $this->redirectToRoute('manager-meeting-view');
        }

        return $this->render('manager/managerMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }
}
