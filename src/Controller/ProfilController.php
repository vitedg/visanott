<?php

namespace App\Controller;

use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Routing\Annotation\Route;
use App\Entity\Profil;
use Symfony\Component\HttpFoundation\Request;
use Symfony\Component\HttpFoundation\JsonResponse;
use App\Form\ProfilParentType;
use App\Form\ProfilType;

class ProfilController extends AbstractController
{
  /**
     * @Route("/add/profil/chef", name="add_profil_parent")
     */
   public function addRole(Request $request) {
        // 1) build the form
        $profil = new Profil();
        $form = $this->createForm(ProfilParentType::class, $profil);
        // 2) handle the submit (will only happen on POST)
        $form->handleRequest($request);
        if ($form->isSubmitted() && $form->isValid()) {
            // 4) save the User!
            $entityManager = $this->getDoctrine()->getManager();
            $entityManager->persist($profil);
            $entityManager->flush();
            // ... do any other work - like sending them an email, etc
            // maybe set a "flash" success message for the user
            $this->addFlash('success', 'Votre compte à bien été enregistré.');
            //return $this->redirectToRoute('login');
        }
        return $this->render('role/index.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter Role']);
    }

    /**
       * @Route("/add/profil/agent", name="add_profil_children")
       */
     public function addProfilChildren(Request $request) {
          // 1) build the form
          $profil = new Profil();
          $form = $this->createForm(ProfilType::class, $profil);
          // 2) handle the submit (will only happen on POST)
          $form->handleRequest($request);
          if ($form->isSubmitted() && $form->isValid()) {
              // 4) save the User!
              $data  = $form->getData();
              $agences  = $data->getAgences()->getValues();
              $entityManager = $this->getDoctrine()->getManager();
              foreach ($agences as $key => $agence) {
                $profil->addAgence($agence);
              }
              $entityManager->persist($profil);
              $entityManager->flush();
              $this->addFlash('success', 'Votre compte à bien été enregistré.');
              //return $this->redirectToRoute('login');
          }
          return $this->render('profil_agent/agent.html.twig', ['form' => $form->createView(), 'mainNavRegistration' => true, 'title' => 'Ajouter profil']);
      }

      /**
     *
     *@Route("/listagent", name="list_agent")
     * @param Request $request
     * @return JsonResponse
     */
    public function listAgentsAction(Request $request)
    {
        // Get Entity manager and repository
        $em = $this->getDoctrine()->getManager();
        $profilParentId = $request->query->get("profilParentid");
        $profilRepository = $em->getRepository(Profil::class);
        $profil =  $profilRepository->findOneBy(
          array(
            'id' => $profilParentId
          )
        );

        $agences = $profil->getAgences()->getValues();


        $responseArray = array();
        foreach($agences as $agence){
            $responseArray[] = array(
                "id" => $agence->getId(),
                "agence_lib" => $agence->getAgenceLib()
            );
        }

        return new JsonResponse($responseArray);
    }
}
