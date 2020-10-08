<?php


namespace AppBundle\Entity;


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
    private $id;

    /**
     * @ORM\Column(type="string", nullable=true)
     */
    private $groups; // TODO NEEDS TO BE REVAMPED and improved ofc

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

        $this->groups = new ArrayCollection();
    }
}