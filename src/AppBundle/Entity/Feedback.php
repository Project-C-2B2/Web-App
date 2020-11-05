<?php


namespace AppBundle\Entity;


use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Feedback
{
    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", length=25, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $attending;

    /**
     * @ORM\Column(type="string", length=255, nullable=false)
     */
    private $feedback;

    /**
     * @ORM\Column(type="integer", length=255, nullable=false)
     */
    private $rating;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="user_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $user;

    /**
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="meeting_id", referencedColumnName="id", onDelete="SET NULL")
     */
    private $meeting;

    public function __construct()
    {
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
    public function getAttending()
    {
        return $this->attending;
    }

    /**
     * @param mixed $attending
     */
    public function setAttending($attending)
    {
        $this->attending = $attending;
    }

    /**
     * @return mixed
     */
    public function getFeedback()
    {
        return $this->feedback;
    }

    /**
     * @param mixed $feedback
     */
    public function setFeedback($feedback)
    {
        $this->feedback = $feedback;
    }

    /**
     * @return mixed
     */
    public function getRating()
    {
        return $this->rating;
    }

    /**
     * @param mixed $rating
     */
    public function setRating($rating)
    {
        $this->rating = $rating;
    }

    /**
     * @return mixed
     */
    public function getUser()
    {
        return $this->user;
    }

    /**
     * @param mixed $user
     */
    public function setUser($user): void
    {
        $this->user = $user;
    }

    /**
     * @return mixed
     */
    public function getMeeting()
    {
        return $this->meeting;
    }

    /**
     * @param mixed $meeting
     */
    public function setMeeting($meeting): void
    {
        $this->meeting = $meeting;
    }


}