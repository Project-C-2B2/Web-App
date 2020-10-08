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
        $group->setName('testFrontend');
        $group->setDescription('Testing Frontend');
        $manager->persist($group);
        $manager->flush();

        $group = new Group();
        $group->setName('testDiffrentGroup');
        $group->setDescription('Testing another Frontend');
        $manager->persist($group);
        $manager->flush();
    }
}