<?php

namespace App\Controller;

use FOS\UserBundle\Controller\RegistrationController as RgController;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Form\RegistrationAdminNationalFormType;
use App\Entity\User;
use Symfony\Component\HttpFoundation\Request;

class AdminNationalController extends AbstractController
{
  /**
     * @Route("/add/admin/national", name="add_admin/national")
     */
  public function registerAction(Request $request)
  {
      return $this->render('admin_national/index.html.twig', array(
          'form' => $form->createView(),
      ));
  }

    public function getParent()
   {
       return BaseRegistrationFormType::class;
   }
}
