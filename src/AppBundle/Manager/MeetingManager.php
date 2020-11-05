<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
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

    public function getMeetingById($id) {
        return $this->em->getRepository(Meeting::class)->find($id);
    }

    public function getUsersByMeeting(Meeting $meeting) {
        return $meeting->getAttendees();
    }

    public function getMeetingById($id) {
        return $this->em->getRepository(Meeting::class)->find($id);
    }

    public function removeMeeting(Meeting $meeting) {
        $this->em->remove($meeting);
        $this->em->flush();
    }

    public function updateMeeting(Meeting $meeting) {
        $this->em->persist($meeting);
        $this->em->flush();
    }
}