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
        // Admin
        $user = new User();
        $user->setEmail('admin@email.com');
        $user->setPlainPassword('Hoeruh');
        $user->setRoles(['ROLE_ADMIN']);
        $user->setEnabled(true);
        $manager->persist($user);
        $manager->flush();

        // Clead / manager
        $user = new User();
        $user->setEmail('sven@email.com');
        $user->setPlainPassword('sven99');
        $user->setRoles(['ROLE_MANAGER']);
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Dev Groep'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Amsterdam'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('ruudt@email.com');
        $user->setPlainPassword('ruudt');
        $user->setRoles(['ROLE_MANAGER']);
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Leraar Groep'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('natnaelt@email.com');
        $user->setPlainPassword('natnael');
        $user->setRoles(['ROLE_COURSELEADER']);
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Leraar Groep'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Amsterdam'])));
        $manager->persist($user);
        $manager->flush();

        // Employee
        $user = new User();
        $user->setEmail('roby@email.com');
        $user->setPlainPassword('roby');
        $user->setRoles(['ROLE_EMPLOYEE']);
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Dev Groep'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('tobias@email.com');
        $user->setPlainPassword('tobias');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Dev Groep'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Amsterdam'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('tayfun@email.com');
        $user->setPlainPassword('tayfun');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Dev Groep'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Amsterdam'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('HenderikBolder@email.com');
        $user->setPlainPassword('Acks1936');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('HenderikBolder@armyspy.com');
        $user->setPlainPassword('Uuko3eevaeR');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 99'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Berlijn'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('MelisBudel@rhyta.com');
        $user->setPlainPassword('eenoPha3');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 99'])));
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('SijtseGunduz@armyspy.com');
        $user->setPlainPassword('Unrarken');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('EllieVerhoef@rhyta.com');
        $user->setPlainPassword('Knect1984');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 107'])));
        $manager->persist($user);
        $manager->flush();

        $user = new User();
        $user->setEmail('LucaFikkert@armyspy.com');
        $user->setPlainPassword('Hoodiam');
        $user->addRole('ROLE_EMPLOYEE');
        $user->setEnabled(true);
        $user->addGroupsInUserAssociation(new GroupsInUserAssociation($user, $manager->getRepository(Group::class)->findOneBy(['name'=>'Locatie: Wijnhaven 99'])));
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