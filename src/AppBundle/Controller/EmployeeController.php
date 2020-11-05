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
     * @Route("/user/dashboard", name="employee")
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
        return $this->render('employee/homepage.html.twig', [
        ]);
    }

    /**
     * @Route("/user/meetings", name="employee-meetings")
     */
    public function meetingAction(Request $request)
    {
        return $this->render('employee/meetings.html.twig', [
        ]);
    }

    /**
     * @Route("/user/agenda", name="employee-agenda")
     */
    public function agendaAction(Request $request)
    {
        return $this->render('employee/agenda.html.twig', [
        ]);
    }

    /**
     * @Route("/user/groups", name="employee-groups")
     */
    public function groupsAction(Request $request)
    {
        return $this->render('employee/groups.html.twig', [
        ]);
    }

    /**
     * @Route("/user/about", name="employee-about")
     */
    public function aboutAction(Request $request)
    {
        return $this->render('employee/about.html.twig', [
        ]);
    }

    /**
     * @Route("/user/contact", name="employee-contact")
     */
    public function contactAction(Request $request)
    {
        return $this->render('employee/contact.html.twig', [
        ]);
    }

    /**
     * @Route("/user/feedback", name="employee-feedback")
     */
    public function feedbackAction(Request $request)
    {
        return $this->render('employee/feedback.html.twig', [
            'message' => "hallo"
        ]);
    }
}
