<?php
namespace AppBundle\Entity\Groups;

use AppBundle\Entity\User;
use AppBundle\Entity\Group;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity
 */
class GroupsInUserAssociation
{
    /**
     * @ORM\Id
     * @ORM\GeneratedValue
     * @ORM\Column(type="integer")
     */
    private $id;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\Group", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="groups_id", referencedColumnName="id", onDelete="SET NULL")
     *
     */
    private $group;

    /**
     *
     * @ORM\ManyToOne(targetEntity="AppBundle\Entity\User", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;


    public function __construct(User $user, Group $group)
    {
        $this->user = $user;
        $this->group = $group;
    }


    public function getId(){
        return $this->id;
    }

    public function setId($id){
        $this->id = $id;
        return $this;
    }

    public function setGroup(Group $group = null)
    {
        $this->group = $group;
        return $this;
    }

    public function getGroup()
    {
        return $this->group;
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

    public function __toString()
    {
        return $this->group->getName();
    }
}
