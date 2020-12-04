<?php


namespace AppBundle\Entity;
use Doctrine\ORM\Mapping as ORM;

/**
 * @ORM\Entity()
 */
class Notification
{
    const TYPE_INVITATION = 'invitation';
    const TYPE_REMINDER = 'reminder';
    const TYPE_UPDATED = 'updated';
    const TYPE_CANCELLED = 'cancelled';

    const MESSAGE_INVITATION = "There is a invitation waiting for you! \n For %1!";
    const MESSAGE_REMINDER = 'Meeting %1 will start next day!';
    const MESSAGE_UPDATED = 'Meeting %1 has been updated!';
    const MESSAGE_CANCELLED = 'Meeting %1 has been cancelled!';

    /**
     * @ORM\Id()
     * @ORM\GeneratedValue()
     * @ORM\Column(type="integer", length=25, nullable=false)
     */
    private $id;

    /**
     * @ORM\Column(type="text", nullable=false)
     */
    private $message;

    /**
     * @ORM\Column(type="datetime", nullable=false)
     */
    private $dateTime;

    /**
     * @ORM\Column(type="string", length=25, nullable=false)
     */
    private $notificationType;

    /**
     * @ORM\Column(type="boolean", nullable=false)
     */
    private $readState = false;

    /**
     * @ORM\ManyToOne(targetEntity="Meeting", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="meeting_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $meeting;

    /**
     * @ORM\ManyToOne(targetEntity="User", inversedBy="id", cascade={"persist"})
     * @ORM\JoinColumn(name="User_id", referencedColumnName="id", onDelete="SET NULL", nullable=true)
     */
    private $user;

    public function __construct()
    {
        $this->dateTime = new \DateTime(date('Y-m-d H:i:s'));
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
    public function setId($id): void
    {
        $this->id = $id;
    }

    /**
     * @return mixed
     */
    public function getMessage()
    {
        return $this->message;
    }

    /**
     * @param mixed $message
     */
    public function setMessage($message): void
    {
        $this->message = $message;
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
    public function setDateTime($dateTime): void
    {
        $this->dateTime = $dateTime;
    }

    /**
     * @return mixed
     */
    public function getNotificationType()
    {
        return $this->notificationType;
    }

    /**
     * @param mixed $notificationType
     */
    public function setNotificationType($notificationType): void
    {
        $this->notificationType = $notificationType;
    }

    /**
     * @return mixed
     */
    public function getReadState()
    {
        return $this->readState;
    }

    /**
     * @param mixed $readState
     */
    public function setReadState($readState): void
    {
        $this->readState = $readState;
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

    public function __toString()
    {
        return $this->getMessage();
    }

}