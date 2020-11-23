<?php


namespace AppBundle\Entity;

use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Meeting
{
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
     * @ORM\OneToMany(targetEntity="User", mappedBy="id", cascade={"persist"})
     */
    private $attendees;


    public function __construct()
    {
        $this->attendees = new ArrayCollection();
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
    public function getAttendees()
    {
        return $this->attendees;
    }

    /**
     * @param mixed $attendees
     */
    public function setAttendees($attendees)
    {
        $this->attendees = $attendees;
    }

    public function addAttendee(User $user) {
        $this->attendees->add($user);
    }

    public function removeAttendee(User $user) {
        $this->attendees->remove($user);
    }

    public function __toString()
    {
        return $this->getName();
    }
}