<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\Meetings\MeetingsInUserAssociation;
use AppBundle\Entity\User;
use AppBundle\Manager\MeetingManager;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMeetingData extends Fixture implements DependentFixtureInterface
{
    private $meetingManager;

    public function __construct(MeetingManager $meetingManager)
    {
        $this->meetingManager = $meetingManager;
    }

    public function load(ObjectManager $manager)
    {
        $meeting = new Meeting();
        $meeting->setName('Demonstratie Kennis Meeting');
        $meeting->setDescription('Deze meeting is voor de demonstratie');
        $dateTime = new \DateTime(date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date("Y-m-d H:i:s")))));
        $meeting->setDateTime($dateTime);
        $meeting->setLocation('Online');
        $meeting->setGroup($manager->getRepository(Group::class)->findOneByName("Locatie: Wijnhaven 99"));

        foreach ($this->meetingManager->getUsersByGroup($meeting->getGroup()) as $user) {
            $meetingInUserAssoc = new MeetingsInUserAssociation($user->getUser(), $meeting);
            $meeting->addMeetingsInUserAssociation($meetingInUserAssoc);
            $manager->persist($meetingInUserAssoc);
        }
        $manager->persist($meeting);
        $manager->flush();

        $meeting = new Meeting();
        $meeting->setName('Stressmanagement Meeting');
        $meeting->setDescription('Deze meeting is voor de stress');
        $dateTime = new \DateTime(date('Y-m-d H:i:s',strtotime('-8 hour',strtotime(date("Y-m-d H:i:s")))));
        $meeting->setDateTime($dateTime);
        $meeting->setLocation('Online');
        $meeting->setGroup($manager->getRepository(Group::class)->findOneByName("Locatie: Wijnhaven 107"));

        foreach ($this->meetingManager->getUsersByGroup($meeting->getGroup()) as $user) {
            $meetingInUserAssoc = new MeetingsInUserAssociation($user->getUser(), $meeting);
            $meeting->addMeetingsInUserAssociation($meetingInUserAssoc);
            $manager->persist($meetingInUserAssoc);
        }
        $manager->persist($meeting);
        $manager->flush();

        $meeting = new Meeting();
        $meeting->setName('Weekelijkse Meeting');
        $meeting->setDescription('Deze meeting is voor de stress');
        $dateTime = new \DateTime(date('Y-m-d H:i:s',strtotime('+2 day',strtotime(date("Y-m-d H:i:s")))));
        $meeting->setDateTime($dateTime);
        $meeting->setLocation('Online');
        $meeting->setGroup($manager->getRepository(Group::class)->findOneByName("Locatie: Berlijn"));

        foreach ($this->meetingManager->getUsersByGroup($meeting->getGroup()) as $user) {
            $meetingInUserAssoc = new MeetingsInUserAssociation($user->getUser(), $meeting);
            $meeting->addMeetingsInUserAssociation($meetingInUserAssoc);
            $manager->persist($meetingInUserAssoc);
        }
        $manager->persist($meeting);
        $manager->flush();

        $meeting = new Meeting();
        $meeting->setName('Maandelijkse Meeting');
        $meeting->setDescription('Deze meeting is voor de stress');
        $dateTime = new \DateTime(date('Y-m-d H:i:s',strtotime('+2 day',strtotime(date("Y-m-d H:i:s")))));
        $meeting->setDateTime($dateTime);
        $meeting->setLocation('Online');
        $meeting->setGroup($manager->getRepository(Group::class)->findOneByName("Locatie: Amsterdam"));

        foreach ($this->meetingManager->getUsersByGroup($meeting->getGroup()) as $user) {
            $meetingInUserAssoc = new MeetingsInUserAssociation($user->getUser(), $meeting);
            $meeting->addMeetingsInUserAssociation($meetingInUserAssoc);
            $manager->persist($meetingInUserAssoc);
        }
        $manager->persist($meeting);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LoadUserData::class,
            LoadGroupData::class
        ];
    }
}