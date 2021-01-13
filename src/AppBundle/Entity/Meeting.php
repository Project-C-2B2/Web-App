<?php


namespace AppBundle\Entity;

use AppBundle\Entity\Meetings\MeetingsInUserAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Symfony\Component\Validator\Constraints as Assert;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Meeting
{
    const MEETING_DECLINED = -1;
    const MEETING_INVITED = 0;
    const MEETING_ACCEPTED = 1;

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", length=25, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $name;

    /**
     * @ORM\Column(type="text", nullable=true)
     */
    private $description;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $location;

    /**
     * @ORM\ManyToOne(targetEntity="Group", inversedBy="id", cascade={"persist"})
     */
    private $group;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meetings\MeetingsInUserAssociation", mappedBy="meeting", cascade={"persist"})
     */
    private $meetingsInUserAssociation;

    /**
     * @ORM\Column(type="integer", nullable=true)
     */
    private $maxAttendees;

    public function __construct()
    {
        $this->meetingsInUserAssociation = new ArrayCollection();
    }

    /**
     * @return mixed
     */
    public function getId()
    {
        return $this->id;
    }

    /**
     * @param mixed $id
     */
    public function setId($id)
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getName()
    {
        return $this->name;
    }

    /**
     * @param mixed $name
     */
    public function setName($name)
    {
        $this->name = $name;
    }

    /**
     * @return mixed
     */
    public function getDescription()
    {
        return $this->description;
    }

    /**
     * @param mixed $description
     */
    public function setDescription($description)
    {
        $this->description = $description;
    }

    /**
     * @return mixed
     */
    public function getDateTime()
    {
        return $this->dateTime;
    }

    /**
     * @param mixed $dateTime
     */
    public function setDateTime($dateTime)
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getLocation()
    {
        return $this->location;
    }

    /**
     * @param mixed $location
     */
    public function setLocation($location)
    {
        $this->location = $location;
    }

    /**
     * @return mixed
     */
    public function getGroup()
    {
        return $this->group;
    }

    /**
     * @param mixed $group
     */
    public function setGroup($group): void
    {
        $this->group = $group;
    }

    /**
     * @return mixed
     */
    public function getMeetingsInUserAssociation()
    {
        return $this->meetingsInUserAssociation;
    }

    /**
     * @param mixed $meetingsInUserAssociation
     */
    public function setMeetingsInUserAssociation($meetingsInUserAssociation): void
    {
        $this->meetingsInUserAssociation = $meetingsInUserAssociation;
    }

    public function addMeetingsInUserAssociation(MeetingsInUserAssociation $meetingsInUserAssociation)
    {
        $this->meetingsInUserAssociation->add($meetingsInUserAssociation);
        return $this;
    }

    public function removeMeetingsInUserAssociation(MeetingsInUserAssociation $meetingsInUserAssociation)
    {
        $this->meetingsInUserAssociation->removeElement($meetingsInUserAssociation);
    }

    /**
     * @return mixed
     */
    public function getMaxAttendees()
    {
        return $this->maxAttendees;
    }

    /**
     * @param mixed $maxAttendees
     */
    public function setMaxAttendees($maxAttendees): void
    {
        $this->maxAttendees = $maxAttendees;
    }


    public function __toString()
    {
        return $this->getName();
    }
}