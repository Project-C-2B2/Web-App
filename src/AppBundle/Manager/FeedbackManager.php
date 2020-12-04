<?php


namespace AppBundle\Manager;


use AppBundle\Entity\Feedback;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
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

    public function getFeedbackByUserAndMeeting(User $user,Meeting $meeting){
        return $this->em->getRepository(Feedback::class)->findOneBy(array('user'=>$user, 'meeting'=>$meeting));
    }

    public function getFeedbackByUser(User $user){
        return $this->em->getRepository(Feedback::class)->findBy(array('user'=>$user));
    }

    public function getAllFeedbacks(){
        return $this->em->getRepository(Feedback::class)->findAll();
    }
}