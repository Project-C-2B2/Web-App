<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\MeetingType;
use AppBundle\Manager\MeetingManager;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends Controller
{
    private $meetingManager;

    public function __construct(MeetingManager $meetingManager)
    {
        $this->meetingManager = $meetingManager;
    }

    /**
     * @Route("/manager", name="manager-homepage")
     */
    public function indexAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/manager/meeting/view", name="manager-meeting-view")
     */
    public function meetingViewAction()
    {
        $this->meetingManager->getAllMeetings();

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/manager/meeting/create", name="manager-meeting-create")
     */
    public function meetingCreateAction()
    {
        $form = $this->createForm(MeetingType::class);

        // replace this example code with whatever you need
        return $this->render('manager/managerMeetingCreate.html.twig', [
            'form' => $form->createView()
        ]);
    }

    /**
     * @Route("/manager/meeting/{id}", name="manager-meeting-detail")
     */
    public function meetingDetailAction($id)
    {
        $meeting = $this->meetingManager->getMeetingById($id);

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'meeting' => $meeting
        ]);
    }

    /**
     * @Route("/manager/meeting/{id}/update", name="manager-meeting-update")
     */
    public function meetingUpdateAction()
    {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
        ]);
    }

    /**
     * @Route("/manager/meeting/{id}/delete", name="manager-meeting-delete")
     */
    public function meetingDeleteAction()
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
        ]);
    }
}
