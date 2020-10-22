<?php

namespace AppBundle\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\Controller;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\Routing\Annotation\Route;

class EmployeeController extends Controller
{
    /**
     * @Route("/User/Dashboard", name="User-Dashboard")
     */
    public function indexAction(Request $request)
    {
        dump(ini_get('memory_limit'));
        // replace this example code with whatever you need
        return $this->render('User-Dashboard/index.html.twig', [
            'base_dir' => realpath($this->getParameter('kernel.project_dir')).DIRECTORY_SEPARATOR,
        ]);
    }
}
