<?php

namespace AppBundle\DataFixtures\ORM;


use AppBundle\Entity\Group;
use AppBundle\Entity\Groups\GroupsInUserAssociation;
use AppBundle\Entity\User;
use Doctrine\Bundle\FixturesBundle\Fixture;
use Doctrine\Common\DataFixtures\DependentFixtureInterface;
use Doctrine\Common\Persistence\ObjectManager;

class LoadUserData extends Fixture implements DependentFixtureInterface
{
    public function load(ObjectManager $manager)
    {
        $user = new User();
        $user->setEmail('frontend@email.com');
        $user->setPassword('frontend');
        $user->setRoles(['ROLE_EMPLOYEE']);
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('frontend2@email.com');
        $user->setPassword('frontend2');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'testFrontend'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('frontend3@email.com');
        $user->setPassword('frontend3');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'testFrontend'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'testDiffrentGroup'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('frontend4@email.com');
        $user->setPassword('frontendOther');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'testFrontend'])));
        $manager->persist($user);
        $manager->flush();
    }

    public function getDependencies()
    {
        return [
            LoadGroupData::class
        ];
    }
}