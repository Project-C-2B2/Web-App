<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use Doctrine\ORM\EntityManagerInterface;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class GuestController extends Controller
{
    private $em;

    public function __construct(EntityManagerInterface $em)
    {
        $this->em = $em;
    }

    /**
     * @Route("/home", name="guestPage")
     */
    public function indexAction(Request $request)
    {
        dump($this->em->getRepository(User::class)->findAll());
        dump($this->em->getRepository(Group::class)->findAll());
        dump($this->em->getRepository(Meeting::class)->findAll());

        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
        }
        /**
         * @Route("/guestpage", name="guestpage")
         */
        public function guestAction(Request $request)
        {
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'msg' => 'here'
        ]);
        }

}
