<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class EmployeeController extends Controller
{
    /**
     * @Route("/", name="homepage")
     */
    public function indexAction(Request $request)
    {
        if (!is_null($this->getUser())) {
            $this->addFlash(
                'notice',
                'User successfully logged in!'
            );
        }
        // replace this example code with whatever you need
        return $this->render('default/index.html.twig', [
            'msg' => 'here'
        ]);
    }

    /**
     * @Route("/logout", name="employee_logout")
     */
    public function logoutAction()
    {
        // Left empty intentionally because this will be handled by Symfony.
    }
}
