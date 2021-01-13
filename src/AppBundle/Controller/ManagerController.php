<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Groups\GroupsInUserAssociation;
use AppBundle\Entity\Meeting;
use AppBundle\Form\Type\MeetingType;
use AppBundle\Form\Type\GroupType;
use AppBundle\Manager\MeetingManager;
use AppBundle\Manager\FeedbackManager;
use AppBundle\Service\NotificationService;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class ManagerController extends Controller
{
    private $meetingManager;
    private $notificationService;
    private $feedbackManager;

    public function __construct(MeetingManager $meetingManager, NotificationService $notificationService, FeedbackManager $feedbackManager)
    {
        $this->meetingManager = $meetingManager;
        $this->notificationService = $notificationService;
        $this->feedbackManager = $feedbackManager;
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/users/view/group/{groupid}", name="manager-users-view-group")
     */
    public function managerUsersViewInGroup($groupid)
    {
        $group = $this->meetingManager->getGroupId($groupid);
        $groups = $this->meetingManager->getGroupAssociationByGroup($group);

        return $this->render('manager/managerUsersViewInGroup.html.twig', [
            'groupsAssociations' => $groups,
        ]);
    }
    /**
    * @IsGranted("ROLE_MANAGER")
    * @Route("/manager/group/view", name="manager-group-view")
    */
    public function managerGroupView()
    {
        $groups = $this->meetingManager->getAllGroups();

        return $this->render('manager/managerGroupView.html.twig', [
            'groups' => $groups,
        ]);
    }

    /**
    * @IsGranted("ROLE_MANAGER")
    * @Route("/manager/meeting/{meetingId}/feedback/view/{user}", name="manager-feedback-view")
    */
    public function managerFeedbackView($meetingId, $user)
    {
        $user = $this->meetingManager->getUserId($user);
        $meeting = $this->meetingManager->getMeetingById($meetingId);
        $feedback = $this->feedbackManager->getFeedbackByUserAndMeeting($user, $meeting);

        return $this->render('manager/managerFeedbackView.html.twig', [
            'feedback' => $feedback,
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/group/create", name="manager-group-create")
     */
    public function groupCreateAction(Request $request)
    {
        $form = $this->createForm(GroupType::class);

        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()){
            $group = $form->getData();
            $this->meetingManager->updateGroup($group);
            return $this->redirectToRoute('manager-users-view');
        }
        return $this->render('manager/managerGroupCreate.html.twig', [
            'form' => $form->createView()
        ]);
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
            $this->notificationService->sentInvitationNotification($meeting);
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
            $this->notificationService->sentUpdateNotification($meeting);
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
        $this->notificationService->sentCancelledNotification($meeting);
        $this->meetingManager->removeMeeting($meeting);

        return $this->redirectToRoute('manager-meeting-view');
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/users/view", name="manager-users-view")
     */
    public function userManageAction()
    {
        $users = $this->meetingManager->getAllUsers();
        // replace this example code with whatever you need
        return $this->render('manager/managerUserManage.html.twig', [
            'users' => $users
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/user/enable/{id}", name="manager-user-enable")
     */
    public function userEnableAction($id)
    {
        $em = $this->getDoctrine()->getManager();
        $enable = $this->meetingManager->getUserId($id)->isEnabled();
        if ($enable) {
            $this->meetingManager->getUserId($id)->setEnabled(!$enable);
            $this->addFlash('succesDIS', 'You have Disabled the user');
        }
        else {
            $this->meetingManager->getUserId($id)->setEnabled(!$enable);
            $this->addFlash('succesEN','You have Enabled the user');
        }
        $em->flush();

        // replace this example code with whatever you need
        return $this->redirectToRoute('manager-users-view');
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/group/view/{id}", name="manager-group-action")
     */
    public function groupAction($id)
    {
        $groups = $this->meetingManager->getAllGroups();
        $user = $this->meetingManager->getUserId($id);
        $groupAssociation = $this->meetingManager->getGroupAssociationbyUser($user);


        return $this->render('manager/managerGroupManage.html.twig', [
            'groups' => $groups,
            'groupAss' => $groupAssociation,
            'user' => $user,
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/group/add/{userid}/{groupid}", name="manager-group-add")
     */
    public  function userAddGroupAction($groupid, $userid)
    {
        $em = $this->getDoctrine()->getManager();
        $group = $this->meetingManager->getGroupId($groupid);
        $user = $this->meetingManager->getUserId($userid);


        $groupAssociation = new GroupsInUserAssociation($user, $group);

        $this->addFlash('succes', 'You have add User: ' .$user. ' to Group: ' .$groupid);

        $em->persist($groupAssociation);
        $em->flush();
        return $this->redirectToRoute('manager-users-view');
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/{id}/attendance", name="manager-meeting-attendance")
     */
    public function meetingAttendaceAction($id){
        $meeting = $this->meetingManager->getMeetingById($id);
        $attendees = $this->meetingManager->getUsersByMeeting($meeting);

        return $this->render('manager/managerMeetingAttendance.html.twig', [
            'meeting' => $meeting,
            'attendees' => $attendees
        ]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/{id}/{userid}/accept", name="manager-meeting-accept")
     */
    public function managerMeetingAcceptAction($id, $userid)
    {
        $user = $this->meetingManager->getUserId($userid);
        $meeting = $this->meetingManager->getMeetingById($id);
        $meetingInUser = $this->meetingManager->getMeetingInUser($user, $meeting);
        $meetingInUser->setState(Meeting::MEETING_ACCEPTED);
        $this->meetingManager->updateMeetingInUser($meetingInUser);

        return $this->redirectToRoute('manager-meeting-attendance', ['id'=>$id]);
    }

    /**
     * @IsGranted("ROLE_MANAGER")
     * @Route("/manager/meeting/{id}/{userid}/decline", name="manager-meeting-decline")
     */
    public function managerMeetingDeclineAction($id, $userid)
    {
        $user = $this->meetingManager->getUserId($userid);
        $meeting = $this->meetingManager->getMeetingById($id);
        $meetingInUser = $this->meetingManager->getMeetingInUser($user, $meeting);
        $meetingInUser->setState(Meeting::MEETING_DECLINED);
        $this->meetingManager->updateMeetingInUser($meetingInUser);

        return $this->redirectToRoute('manager-meeting-attendance', ['id'=>$id]);
    }

}
