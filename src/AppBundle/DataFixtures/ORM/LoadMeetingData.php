<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadMeetingData extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $meeting = new Meeting();
        $meeting->setName('meeting1Hour');
        $meeting->setDescription('This meeting starts in a hour from creation');
        $dateTime = new \DateTime(date('Y-m-d H:i:s',strtotime('+1 hour',strtotime(date("Y-m-d H:i:s")))));
        $meeting->setDateTime($dateTime);
        $meeting->setLocation('Online');
        $meeting->setGroup($manager->getRepository(Group::class)->findOneByName("testFrontend"));
        $meeting->addAttendee($manager->getRepository(User::class)->findOneByEmail("frontend@email.com"));
        $meeting->addAttendee($manager->getRepository(User::class)->findOneByEmail("frontend2@email.com"));
        $meeting->addAttendee($manager->getRepository(User::class)->findOneByEmail("frontend4@email.com"));
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