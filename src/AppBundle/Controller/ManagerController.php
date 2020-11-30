<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use AppBundle\Form\Type\MeetingType;
use AppBundle\Manager\MeetingManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends Controller
{
    private $meetingManager;

    public function __construct(MeetingManager $meetingManager)
    {
        $this->meetingManager = $meetingManager;
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager", name="manager-homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('manager/homepage.html.twig', [
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/view", name="manager-meeting-view")
     */
    public function meetingViewAction()
    {
        foreach($this->meetingManager->getMeetingById(1)->getMeetingsInUserAssociation() as $userAssoc) {
            dump($userAssoc);
        }

        return $this->render('manager/managerMeetingView.html.twig', [
            'meetings' => $this->meetingManager->getAllMeetings()
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/create", name="manager-meeting-create")
     */
    public function meetingCreateAction(Request $request)
    {
        $form = $this->createForm(MeetingType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $meeting = $form->getData();
            $this->meetingManager->updateMeeting($meeting);
            return $this->redirectToRoute('manager-meeting-view');
        }

        return $this->render('manager/managerMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
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
     * @IsGranted("ROLE_MANAGER")
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

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/{id}/delete", name="manager-meeting-delete")
     */
    public function meetingDeleteAction($id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);
        $this->meetingManager->removeMeeting($meeting);

        $this->addFlash('notice', 'Meeting deleted');

        return $this->redirectToRoute('manager-meeting-view');
    }
}
