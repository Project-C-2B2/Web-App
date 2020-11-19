<?php


namespace AppBundle\Manager;


use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;

class UserCourseLeader
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function getUserByEmail($email) {
        return $this->em->getRepository(User::class)->findOneBy(['email'=>$email]);
    }
}