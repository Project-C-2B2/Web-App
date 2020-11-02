<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Feedback;
use AppBundle\Entity\Meeting;
use Doctrine\ORM\EntityManagerInterface;

class FeedbackManager
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    public function updateFeedback(Feedback $feedback){
        $this->em->persist($feedback);
        $this->em->flush();
    }
}