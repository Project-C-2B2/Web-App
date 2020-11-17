<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/employee/dashboard", name="employee-dashboard")
     */
    public function indexAction(Request $request)
    {
        return $this->render('Employee/homepage.html.twig', [
        ]);
    }

    /**
 * @Route("/employee/meetings", name="employee-meetings")
 */
    public function meetingAction(Request $request)
    {
        return $this->render('employee/meetings.html.twig', [
        ]);
    }

    /**
     * @Route("/employee/agenda", name="employee-agenda")
     */
    public function agendaAction(Request $request)
    {
        return $this->render('employee/agenda.html.twig', [
        ]);
    }

    /**
     * @Route("/employee/groups", name="employee-groups")
     */
    public function groupsAction(Request $request)
    {
        return $this->render('employee/groups.html.twig', [
        ]);
    }

    /**
     * @Route("/employee/about", name="employee-about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('employee/about.html.twig', [
        ]);
    }

    /**
     * @Route("/employee/contact", name="employee-contact")
     */
    public function contactAction(Request $request)
    {
        return $this->render('employee/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/employee/feedback", name="employee-feedback")
     */
    public function feedbackAction(Request $request)
    {
        return $this->render('employee/feedback.html.twig', [
            'message' => "hallo"
        ]);
    }
}
