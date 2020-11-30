<?php


namespace AppBundle\Entity;


use AppBundle\Entity\Groups\GroupsInUserAssociation;
use AppBundle\Entity\Meetings\MeetingsInUserAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;
use FOS\UserBundle\Model\User as FosUser;

/**
 * @ORM\Entity()
 */
class User extends FosUser
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", length=25, nullable=false)
     */
    protected $id;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Groups\GroupsInUserAssociation", mappedBy="user", cascade={"persist"})
     */
    private $groupsInUserAssociation;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Meetings\MeetingsInUserAssociation", mappedBy="user", cascade={"persist"})
     */
    private $meetingsInUserAssociation;

    /**
     * @ORM\Column(type="datetime", nullable=true)
     */
    private $lastActivityDate;

    /**
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="lastcourse_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $lastCourseFollowed;


    public function __construct()
    {
        Parent::__construct();

        $this->groupsInUserAssociation = new ArrayCollection();
        $this->meetingsInUserAssociation = new ArrayCollection();
    }

    /**
     * @param string $email
     */
    public function setEmail($email)
    {
        $this->email = $email;
        $this->setUsername($email);
        $this->setUsernameCanonical($email);
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
     * @return string
     */
    public function getEmail()
    {
        return $this->email;
    }

    /**
     * @return mixed
     */
    public function getGroupsInUserAssociation()
    {
        return $this->groupsInUserAssociation;
    }

    /**
     * @param mixed $chars
     */
    public function setGroupsInUserAssociation($groupsInUserAssociations)
    {
        $this->groupsInUserAssociation = $groupsInUserAssociations;
    }

    public function addGroupsInUserAssociation(GroupsInUserAssociation $groupsInUserAssociation)
    {
        $this->groupsInUserAssociation->add($groupsInUserAssociation);
        return $this;
    }

    public function removeGroupsInUserAssociation(GroupsInUserAssociation $groupsInUserAssociation)
    {
        $this->groupsInUserAssociation->removeElement($groupsInUserAssociation);
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
    public function getLastActivityDate()
    {
        return $this->lastActivityDate;
    }

    /**
     * @param mixed $lastActivityDate
     */
    public function setLastActivityDate($lastActivityDate)
    {
        $this->lastActivityDate = $lastActivityDate;
    }

    /**
     * @return mixed
     */
    public function getLastCourseFollowed()
    {
        return $this->lastCourseFollowed;
    }

    /**
     * @param mixed $lastCourseFollowed
     */
    public function setLastCourseFollowed($lastCourseFollowed)
    {
        $this->lastCourseFollowed = $lastCourseFollowed;
    }

    public function __toString()
    {
        return $this->getUsername();
    }
}