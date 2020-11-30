<?php
namespace AppBundle\Entity\Meetings;

use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class MeetingsInUserAssociation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Meeting", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="meetings_id", referencedColumnName="id", onDelete="SET NULL")
     *
     */
    private $meeting;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\Column(type="integer", length=10, nullable=false)
     */
    private $state = Meeting::MEETING_INVITED;


    public function __construct(User $user, Meeting $meeting)
    {
        $this->user = $user;
        $this->meeting = $meeting;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setMeetings(Meeting $meeting = null)
    {
        $this->meeting = $meeting;
        return $this;
    }

    public function getMeetings()
    {
        return $this->meeting;
    }

    public function setUser(User $user = null)
    {
        $this->user = $user;
        return $this;
    }

    public function getUser()
    {
        return $this->user;
    }

    /**
     * @return mixed
     */
    public function getState()
    {
        return $this->state;
    }

    /**
     * @param mixed $state
     */
    public function setState($state): void
    {
        $this->state = $state;
    }

    public function __toString()
    {
        return $this->meeting->getName();
    }
}
