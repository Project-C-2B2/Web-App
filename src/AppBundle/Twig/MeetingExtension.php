<?php

namespace AppBundle\Twig;

use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Manager\FeedbackManager;
use AppBundle\Manager\MeetingManager;
use Twig\TwigFunction;
use Twig\Extension\AbstractExtension;

class MeetingExtension extends AbstractExtension
{
    private $meetingManager;
    private $feedbackManager;

    public function __construct(MeetingManager $meetingManager, FeedbackManager $feedbackManager)
    {
        $this->meetingManager = $meetingManager;
        $this->feedbackManager = $feedbackManager;
    }

    public function getFunctions()
    {
        return array(
            new TwigFunction('getMeetingState', array($this, 'getMeetingState')),
            new TwigFunction('getFeedbackByUserMeeting', array($this, 'getFeedbackByUserMeeting')),
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

    public function getFeedbackByUserMeeting(User $user, Meeting $meeting) {
        return $this->feedbackManager->getFeedbackByUserAndMeeting($user, $meeting);
    }
}