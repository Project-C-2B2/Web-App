<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Form\Type\MeetingType;
use AppBundle\Manager\MeetingManager;
use http\Env\Request;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Response;
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

    /**
     * @Route("/manager/users/view", name="manager-users-view")
     */
    public function userManageAction()
    {
        $users = $this->meetingManager->getAllUsers();
        // replace this example code with whatever you need
        return $this->render('ManagerAccept/managerUserManage.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @Route("/manager/user/enable/{id}", name="manager-user-enable")
     */
    public function userEnableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $enable = $this->meetingManager->getUserId($id)->isEnabled();
        if ($enable) {
            $this->meetingManager->getUserId($id)->setEnabled(!$enable);
            $this->addFlash('succes', 'You have Disabled the user');
        }
        else {
            $this->meetingManager->getUserId($id)->setEnabled(!$enable);
            $this->addFlash('succes','You have Enabled the user');
        }
        $em->flush();

        // replace this example code with whatever you need
        return $this->redirect($this->generateUrl('manager-users-view'));
    }



}
