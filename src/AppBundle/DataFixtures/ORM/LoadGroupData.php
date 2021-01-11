<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Group;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\Persistence\ObjectManager;

class LoadGroupData extends Fixture
{
    public function load(ObjectManager $manager)
    {
        $group = new Group();
        $group->setName('Dev Groep');
        $group->setDescription('Het geweldige dev team');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('Leraar Groep');
        $group->setDescription('De leraren...');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('Locatie: Wijnhaven 99');
        $group->setDescription('Locatie: Wijnhaven 99');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('Locatie: Wijnhaven 107');
        $group->setDescription('Locatie: Wijnhaven 107');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('Locatie: Amsterdam');
        $group->setDescription('Locatie: Amsterdam');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('Locatie: Berlijn');
        $group->setDescription('Locatie: Berlijn');
        $manager->persist($group);
        $manager->flush();
    }
}