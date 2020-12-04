<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Manager\MeetingManager;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class MeetingExtension extends AbstractExtension
{
    private $meetingManager;

    public function __construct(MeetingManager $meetingManager)
    {
        $this->meetingManager = $meetingManager;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('getMeetingState', array($this, 'getMeetingState')),
        );
    }

    public function getMeetingState(Meeting $meeting, User $user)
    {
        $meetingAssoc = $this->meetingManager->getMeetingInUser($user, $meeting);
        if ($meetingAssoc) {
            if ($meetingAssoc->getState() == 0) {
                return null;
            }
            return $meetingAssoc->getState();
        } else {
            return null;
        }
    }
}