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
use Symfony\Component\Security\Core\Exception\BadCredentialsException;
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
        dump($this->em->getRepository(User::class)->findAll());
        dump($this->em->getRepository(Group::class)->findAll());
        dump($this->em->getRepository(Meeting::class)->findAll());

        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        // replace this example code with whatever you need

//        return $this->render('default/index.html.twig', [
//            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
//        ]);
        return $this->render('default/index.html.twig', [
            'msg' => 'here'
        ]);
    }
    /**
     * @Route("/create/account", name="create_account")
     */
    public function createAccountAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('createAccount/createAccount.html.twig', [
            'msg' => 'here'
        ]);
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
     * @Route("/redirect", name="register_redirect")
     */
    public function registerRedirect(Request $request)
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        // replace this example code with whatever you need
        return $this->render('guest/registerRedirect.html.twig', [
            'msg' => 'here'
        ]);
    }
    /**
     * @Route("/register", name="user_registration")
     */
    public function registerAction(Request $request)
    {
        $msg = null;
        // 1) build the form
        $user = new User();
        $form = $this->createForm(UserType::class, $user);

        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {

            // 3) Encode the password (you could also do this via Doctrine listener)

            $user->addRole('ROLE_EMPLOYEE');
            $user->setEnabled(false);

            if (!$this->userManager->getUserByEmail($form->getData()->getEmail())) {
                // 4) save the User!
                $entityManager = $this->getDoctrine()->getManager();
                $entityManager->persist($user);
                $entityManager->flush();

                return $this->redirectToRoute('register_redirect');
            } else {
                $msg = 'Account already in use';
            }
        }
        return $this->render(
            'guest/register.html.twig', [
                'form' => $form->createView(),
                'msg' => $msg
            ]
        );
    }
}
