<?php


namespace AppBundle\Entity;


use AppBundle\Entity\Groups\GroupsInUserAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 * @ORM\Table(name="fos_groups")
 */
class Group
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
     * @ORM\Column(type="text", nullable=false)
     */
    private $description;

    /**
     * @ORM\OneToMany(targetEntity="AppBundle\Entity\Groups\GroupsInUserAssociation", mappedBy="group", cascade={"persist"})
     */
    private $groupsInUserAssociation;

    public function __construct()
    {
        $this->groupsInUserAssociation = new ArrayCollection();
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
    public function getGroupsInUserAssociation()
    {
        return $this->groupsInUserAssociation;
    }

    /**
     * @param mixed $chars
     */
    public function setGroupsInUserAssociation($groupsInUserAssociation)
    {
        $this->groupsInUserAssociation = $groupsInUserAssociation;
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

    public function __toString()
    {
        return $this->getName();
    }

}