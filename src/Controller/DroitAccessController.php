<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\DroitAccess;
use Symfony\Component\HttpFoundation\Request;
use App\Form\DroitAccessType;

class DroitAccessController extends AbstractController
{
	
	/**
     * @Route("/addd/droit_access", name="addd_droit_access")
     */
   public function addDroitAccess(Request $request) {
        // 1) build the form
        $droit_access = new DroitAccess();
        $form = $this->createForm(DroitAccessType::class, $droit_access);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($droit_access);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
        }
        return $this->render('droit_access/index.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter Droit_Access']);
    }
	
    /**
     * @Route("/droit/access", name="droit_access")
     */
    public function index()
    {
        return $this->render('droit_access/index.html.twig', [
            'controller_name' => 'DroitAccessController',
        ]);
    }
}
