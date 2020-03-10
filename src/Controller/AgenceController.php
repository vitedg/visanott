<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Agence;
use Symfony\Component\HttpFoundation\Request;
use App\Form\AgenceType;

class AgenceController extends AbstractController
{

  /**
     * @Route("/add/agence", name="add_agence")
     */
   public function addRole(Request $request) {
        // 1) build the form
        $agence = new Agence();
        $form = $this->createForm(AgenceType::class, $agence);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($agence);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
        }
        return $this->render('role/index.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter Role']);
    }

}
