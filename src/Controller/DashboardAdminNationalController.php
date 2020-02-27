<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;

class DashboardAdminNationalController extends AbstractController
{
    /**
     * @Route("/dashboard/admin/national", name="dashboard_admin_national")
     */
    public function index()
    {
        return $this->render('dashboard_admin_national/index.html.twig', [
            'controller_name' => 'DashboardAdminNationalController',
        ]);
    }
}
