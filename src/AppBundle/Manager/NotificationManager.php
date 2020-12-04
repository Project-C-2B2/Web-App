<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Notification;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class NotificationManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function getAllNotifications() {
        return $this->em->getRepository(Notification::class)->findAll();
    }

    public function getNotificationsByUser(User $user) {
        return $this->em->getRepository(Notification::class)->findBy(['user'=>$user]);
    }

    public function redAllNotifications(User $user) {
        $notifications = $this->em->getRepository(Notification::class)->findBy(['user'=>$user]);
        foreach ($notifications as $notification) {
            if (!$notification->getReadState()) {
                $notification->setReadState(true);
                $this->em->persist($notification);
            }
        }
        $this->em->flush();
    }

    public function updateNotification(Notification $notification) {
        $this->em->persist($notification);
        $this->em->flush();
    }
}