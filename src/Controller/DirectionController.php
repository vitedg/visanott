<?php

namespace App\Controller;

use App\Entity\Direction;
use App\Form\DirectionType;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Component\HttpFoundation\Request;

class DirectionController extends AbstractController
{

  /**
     * @Route("/add/direction", name="add_direction")
     */
   public function addDirection(Request $request) {
        // 1) build the form
        $direction = new Direction();
        $form = $this->createForm(DirectionType::class, $direction);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($direction);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
        }
        return $this->render('direction/index.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter Direction']);
    }
}
