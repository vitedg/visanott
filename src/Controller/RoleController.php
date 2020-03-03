<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Role;
use Symfony\Component\HttpFoundation\Request;
use App\Form\RoleType;
use App\Entity\DroitAccess;

class RoleController extends AbstractController
{
	
	/**
     * @Route("/add/role", name="add_droit_access")
     */
   public function addRole(Request $request) {
        // 1) build the form
        $role = new Role();
        $form = $this->createForm(RoleType::class, $role);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($role);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
        }
        return $this->render('role/index.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter Role']);
    }
    /**
     * @Route("/role", name="role")
     */
    public function index()
    {
        return $this->render('role/index.html.twig', [
            'controller_name' => 'RoleController',
        ]);
    }
}
