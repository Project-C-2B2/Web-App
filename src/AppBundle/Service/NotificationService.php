<?php


namespace AppBundle\Service;


use AppBundle\Entity\Meeting;
use AppBundle\Entity\Notification;
use AppBundle\Manager\MeetingManager;
use AppBundle\Manager\NotificationManager;

class NotificationService
{
    private $notificationManager;
    private $meetingManager;

    public function __construct(NotificationManager $notificationManager, MeetingManager $meetingManager)
    {
        $this->notificationManager = $notificationManager;
        $this->meetingManager = $meetingManager;
    }

    public function sentInvitationNotification(Meeting $meeting) {
        $message = str_replace('%1', $meeting->getName(), Notification::MESSAGE_INVITATION);
        $attendees = $this->meetingManager->getUsersByMeeting($meeting);
        foreach ($attendees as $attendee) {
            $notification = new Notification();
            $notification->setMessage($message);
            $notification->setMeeting($meeting);
            $notification->setUser($attendee->getUser());
            $notification->setNotificationType(Notification::TYPE_INVITATION);
            $this->notificationManager->updateNotification($notification);
        }
    }

    public function sentReminderNotification(Meeting $meeting) {
        $message = str_replace('%1', $meeting->getName(), Notification::MESSAGE_REMINDER);
        $attendees = $this->meetingManager->getUsersByMeeting($meeting);
        foreach ($attendees as $attendee) {
            $notification = new Notification();
            $notification->setMessage($message);
            $notification->setMeeting($meeting);
            $notification->setUser($attendee->getUser());
            $notification->setNotificationType(Notification::TYPE_REMINDER);
            $this->notificationManager->updateNotification($notification);
        }
    }

    public function sentUpdateNotification(Meeting $meeting) {
        $message = str_replace('%1', $meeting->getName(), Notification::MESSAGE_UPDATED);
        $attendees = $this->meetingManager->getUsersByMeeting($meeting);
        foreach ($attendees as $attendee) {
            $notification = new Notification();
            $notification->setMessage($message);
            $notification->setMeeting($meeting);
            $notification->setUser($attendee->getUser());
            $notification->setNotificationType(Notification::TYPE_UPDATED);
            $this->notificationManager->updateNotification($notification);
        }
    }

    public function sentCancelledNotification(Meeting $meeting) {
        $message = str_replace('%1', $meeting->getName(), Notification::MESSAGE_CANCELLED);
        $attendees = $this->meetingManager->getUsersByMeeting($meeting);
        foreach ($attendees as $attendee) {
            $notification = new Notification();
            $notification->setMessage($message);
            $notification->setMeeting($meeting);
            $notification->setUser($attendee->getUser());
            $notification->setNotificationType(Notification::TYPE_CANCELLED);
            $this->notificationManager->updateNotification($notification);
        }
    }
}