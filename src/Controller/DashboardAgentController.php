<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAgentController extends AbstractController
{
    /**
     * @Route("/dashboard/agent", name="dashboard_agent")
     */
    public function index()
    {
        return $this->render('dashboard_agent/index.html.twig', [
            'controller_name' => 'DashboardAgentController',
        ]);
    }
}
