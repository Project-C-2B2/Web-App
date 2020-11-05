<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Groups\GroupsInUserAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

class UserGroupsTransformer implements DataTransformerInterface
{
    private $em;
    private $user = null;

    public function __construct(EntityManagerInterface $entityManager)
    {
        $this->em = $entityManager;
    }

    public function transform($collection)
    {
        if (null === $collection) {
            return null;
        }

        if (!$collection instanceof ArrayCollection)
        $this->user = $collection->getOwner();

        $array = [];
        foreach ($collection as $group)
            $array[] = $group->getGroups();

        return $array;
    }

    public function reverseTransform($collection)
    {
        if (!$collection && !null === $collection) {
            return;
        }

        foreach (array_keys($collection) as $key) {
            $userGroup = $this->em->getRepository(GroupsInUserAssociation::class)->findOneBy(['user'=>$this->user,'group'=>$collection[$key]]);
            if (!$userGroup) {
                $collection[$key] = new GroupsInUserAssociation($this->user, $collection[$key]);
            } else {
                $collection[$key] = $userGroup;
            }
        }

        if ($this->user) {
            $userArray = $this->user->getGroupsInUserAssociation()->toArray();

            foreach ($userArray as $userGroup) {
                if (!in_array($userGroup, $collection)) {
                    $this->user->removeGroupsInUserAssociation($userGroup);
                    $this->em->remove($userGroup);
                }
            }

            foreach ($collection as $userGroup) {
                if (!in_array($userGroup, $userArray)) {
                    $this->user->addGroupsInUserAssociation($userGroup);
                }
            }
        }

        return $this->user->getGroupsInUserAssociation();
    }
}