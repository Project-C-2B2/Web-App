<?php
namespace AppBundle\Form\DataTransformer;

use AppBundle\Entity\Groups\GroupsInUserAssociation;
use Doctrine\Common\Collections\ArrayCollection;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Component\Form\DataTransformerInterface;

class GroupsUserTransformer implements DataTransformerInterface
{
    private $em;
    private $group = null;

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
        $this->group = $collection->getOwner();

        $array = [];
        foreach ($collection as $user)
            $array[] = $user->getUser();

        return $array;
    }

    public function reverseTransform($collection)
    {
        if (!$collection && !null === $collection) {
            return;
        }

        foreach (array_keys($collection) as $key) {
            $groupUser = $this->em->getRepository(GroupsInUserAssociation::class)->findOneBy(['group'=>$this->group,'user'=>$collection[$key]]);
            if (!$groupUser) {
                $collection[$key] = new GroupsInUserAssociation($collection[$key], $this->group);
            } else {
                $collection[$key] = $groupUser;
            }
        }

        if ($this->group) {
            $groupArray = $this->group->getGroupsInUserAssociation()->toArray();

            foreach ($groupArray as $groupUser) {
                if (!in_array($groupUser, $collection)) {
                    $this->group->removeGroupsInUserAssociation($groupUser);
                    $this->em->remove($groupUser);
                }
            }

            foreach ($collection as $groupUser) {
                if (!in_array($groupUser, $groupArray)) {
                    $this->group->addGroupsInUserAssociation($groupUser);
                }
            }
        }

        return $this->group->getGroupsInUserAssociation();
    }
}