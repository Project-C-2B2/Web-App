<?php


namespace AppBundle\Manager;


use Doctrine\ORM\EntityManagerInterface;

class UserManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em=$em;
    }


}