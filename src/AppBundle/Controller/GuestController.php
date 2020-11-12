<?php

namespace AppBundle\Controller;

use AppBundle\Entity\Group;
use AppBundle\Entity\Meeting;
use AppBundle\Entity\User;
use AppBundle\Form\UserType;
use AppBundle\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
use FOS\RestBundle\Controller\Annotations as Rest;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class GuestController extends Controller
{
    private $em;
    private $userManager;

    public function __construct(EntityManagerInterface $em, UserManager $userManager)
    {
        $this->em = $em;
        $this->userManager = $userManager;
    }

    /**
     * @Route("/home", name="guestpage")
     */
    public function indexAction(Request $request)
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        return $this->render('default/index.html.twig', [
            'msg' => 'here'
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
<<<<<<< HEAD

    }

    /**
     * @Route("/login", name="login")
     */
    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
            return $this->redirectToRoute('homepage');
        }
        $authenticationUtils = $this->get('security.authentication_utils');

        $error = $authenticationUtils->getLastAuthenticationError();
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render(
            'guest/login.html.twig',
            array(
                'last_username' => $lastUsername,
                'error' => $error,
            )
        );
    }

    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }
=======
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
>>>>>>> #27_guestPage

}
