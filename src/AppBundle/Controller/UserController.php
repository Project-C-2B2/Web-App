<?php


namespace AppBundle\Controller;


use AppBundle\Manager\NotificationManager;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class UserController extends Controller
{
    private $notificationManager;

    public function __construct(NotificationManager $notificationManager)
    {
        $this->notificationManager = $notificationManager;
    }

    /**
     * @IsGranted("ROLE_USER")
     * @Route("/user/notifications", name="user-notifications")
     */
    public function notificationAction(Request $request)
    {
        $this->notificationManager->redAllNotifications($this->getUser());

        return $this->render('user/notification.html.twig', [
            'notifications' => $this->notificationManager->getNotificationsByUser($this->getUser())
        ]);
    }

}