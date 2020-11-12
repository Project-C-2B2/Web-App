<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Group;
use AppBundle\Entity\Groups\GroupsInUserAssociation;
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

    public function getUsersByMeeting(Meeting $meeting) {
        return $meeting->getAttendees();
    }

    public function getAllUsers(){
        return $this->em->getRepository(User::class)->findAll();
    }

    public function getUserId($id){
        return $this->em->getRepository(User::class)->find($id);
    }

    public function getAllGroups(){
        return $this->em->getRepository(Group::class)->findAll();
    }

    public function getAllGroupAssociation(){
        return $this->em->getRepository(GroupsInUserAssociation::class)->findAll();
    }
}