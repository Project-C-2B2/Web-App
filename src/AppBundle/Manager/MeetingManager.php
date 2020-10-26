<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Meeting;
use Doctrine\ORM\EntityManagerInterface;

class MeetingManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function getAllMeetings() {
        return $this->em->getRepository(Meeting::class)->findAll();
    }

    public function getUsersByMeeting(Meeting $meeting) {
        return $meeting->getAttendees();
    }
}