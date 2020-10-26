<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Meeting;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }
}