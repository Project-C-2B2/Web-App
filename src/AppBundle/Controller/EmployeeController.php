<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

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
}
