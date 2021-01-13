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
            new TwigFunction('checkMeetingAvailability', array($this, 'checkMeetingAvailability')),
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

    public function checkMeetingAvailability(Meeting $meeting)
    {
        $count = 0;
        foreach($this->meetingManager->getUsersByMeeting($meeting) as $meetingAss)
        {
            if($meetingAss->getState()==1)
            {
                $count += 1;
            }
        }
        if ($count>=$this->meetingManager->getUsersMaxCap($meeting))
        {
            return false;
        }
        return true;
    }

}