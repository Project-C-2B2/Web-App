<?php

namespace AppBundle\Controller;

use AppBundle\Form\Type\FeedbackType;
use AppBundle\Form\Type\MeetingType;
use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class EmployeeController extends Controller
{
    /**
     * @Route("/User/Dashboard", name="employee")
     */
    public function indexAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/homepage.html.twig', [
        ]);
    }

    /**
 * @Route("/User/Meetings", name="employee-meetings")
 */
    public function meetingAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/meetings.html.twig', [
        ]);
    }

    /**
     * @Route("/User/Agenda", name="employee-agenda")
     */
    public function agendaAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/agenda.html.twig', [
        ]);
    }

    /**
     * @Route("/User/Groups", name="employee-groups")
     */
    public function groupsAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/groups.html.twig', [
        ]);
    }

    /**
     * @Route("/User/About", name="employee-about")
     */
    public function aboutAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/about.html.twig', [
        ]);
    }

    /**
     * @Route("/User/Contact", name="employee-contact")
     */
    public function contactAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        return $this->render('Employee/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/User/Feedback", name="employee-feedback")
     */
    public function feedbackAction(Request $request)
    {
        $form = $this->createForm(FeedbackType::class);

//        only handles data on POST
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            dump($form->getData());die;
        }


        return $this->render('Employee/feedback.html.twig', [
            'feedbackForm' => $form->createView(),
            'message' => "hallo"
        ]);
    }

    /**
     * @Route("/employee/login", name="employee_login")
     */
    public function employeeLoginAction(Request $request)
    {
        // replace this example code with whatever you need
        return $this->render('employeeLogin/login.html.twig', [
            'msg' => 'here'
        ]);
    }

    public function loginAction(AuthenticationUtils $authenticationUtils)
    {
        // get the login error if there is one
        $error = $authenticationUtils->getLastAuthenticationError();

        // last username entered by the user
        $lastUsername = $authenticationUtils->getLastUsername();

        return $this->render('security/login.html.twig', [
            'last_username' => $lastUsername,
            'error'         => $error,
        ]);
    }

    /**
     * @Route("/employee/login", name="employee_login")
     */
    public function newAction()
    {
        $form = $this->createForm(FeedbackType::class);

        return $this->render('feedback.html.twig', [
            'feedbackForm' => $form->createView()
        ]);
    }

}
