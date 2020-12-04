<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Manager\MeetingManager;
use AppBundle\Manager\NotificationManager;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class NotificationExtension extends AbstractExtension
{
    private $meetingManager;
    private $notificationManager;

    public function __construct(MeetingManager $meetingManager, NotificationManager $notificationManager)
    {
        $this->meetingManager = $meetingManager;
        $this->notificationManager = $notificationManager;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('getNotificationReadState', array($this, 'getNotificationReadState')),
        );
    }

    public function getNotificationReadState(User $user)
    {
        $notifications = $this->notificationManager->getNotificationsByUser($user);
        foreach ($notifications as $notification) {
            if (!$notification->getReadState()) {
                return true;
            }
            return false;
        }
    }
}