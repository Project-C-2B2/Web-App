<?php


namespace AppBundle\Manager;


use AppBundle\Entity\User;

use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }

    public function getUserByEmail($email) {
        return $this->em->getRepository(User::class)->findOneBy(['email'=>$email]);
    }

    public function updateUser(User $user) {
        $this->em->persist($user);
        $this->em->flush();
    }
}