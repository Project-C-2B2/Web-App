<?php

namespace AppBundle\Controller;

use AppBundle\Manager\UserManager;
use Doctrine\ORM\EntityManagerInterface;
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
     * @Route("/", name="guestpage")
     */
    public function indexAction(Request $request)
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        return $this->render('guest/index.html.twig', [
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
            return $this->redirectToRoute('loginRedirect');
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
     * @Route("/login/redirect", name="loginRedirect")
     */
    public function loginRedirectAction(AuthenticationUtils $authenticationUtils)
    {
        if ($this->isGranted('ROLE_MANAGER')) {
            return $this->redirectToRoute('manager-homepage');
        }

        if ($this->isGranted('ROLE_EMPLOYEE')) {
            return $this->redirectToRoute('employee-dashboard');
        }

        if ($this->isGranted('ROLE_COURSELEADER')) {
            return $this->redirectToRoute('courseleader-homepage');
        }

        return $this->redirectToRoute('login');
    }

            if (!$this->userManager->getUserByEmail($form->getData()->getEmail())) {
                // 4) save the User!
                $this->userManager->updateUser($user);

                $this->addFlash(
                    'notice',
                    'Account is created, but the manager needs to enable the account, please wait'
                );
                return $this->redirectToRoute('login');
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
    /**
     * @Route("/logout", name="logout")
     */
    public function logoutAction()
    {
    }


}
