<?php

namespace App\Controller;

use DateTime;
use App\Entity\Projet;
use App\Entity\FondsAide;
use App\Entity\Producteur;
use App\Form\RegistrationType;
use App\Entity\AuteurRealisateur;
use App\Entity\DocumentAudioVisuels;
use App\Service\WhichCommissionChoice;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AllFieldsFormController extends AbstractController
{
    /**
     * permet d'afficher le formulaire de saisie selon la commision.
     * la classe WhichCommissionChoice permet d'ameliorer la ligibilité du controller et d'aléger 
     * son rôle.
     * @Route("/fonds-d-aide/{id}", name="all_filds_form")
     *
     * @param WhichCommissionChoice $choice
     * @param [integer] $id
     * @param ObjectManager $manager
     * @return Response
     */
    public function registration(WhichCommissionChoice $choice,$id,ObjectManager $manager, Request $request)
    {
        
        $choice->setId($id);
        $whichChoice = $choice->getCorrectIdCommision();
        $projet  = $choice->getInstanceProjet();
        $fondsAide = $choice->getFondsAide();
        $allFieldsForm =  $this->createForm(RegistrationType::class,$projet);
        $allFieldsForm->handleRequest($request);
        $isSumited = $allFieldsForm->isSubmitted();
        dump($request);

        $isValid = $allFieldsForm->isValid();
        dump($isValid);
        $error = $allFieldsForm->getErrors();
        dump($error);
        if($isSumited && $isValid) {
          dump($request);
          foreach($projet->getProducteurs() as $producteur)
          {
              $producteur->setProjet($projet);
              $manager->persist($producteur);
          }
          foreach($projet->getAuteurRealisateurs() as $auteurRealisateurs)
          {
              $auteurRealisateurs->setProjet($projet);
              $manager->persist($auteurRealisateurs);
          }
          foreach($projet->getDocumentAudioVisuels() as $documentAudio)
          {
              $documentAudio->setProjet($projet);
              $manager->persist($documentAudio);
          }
          $manager->persist($projet);
          $manager->flush();
          $this->addFlash('success','les données que vous avez renseignées ont été enregistré avec succès,
           un mail vous a été envoyé vous pouvez cliquer sur le lien pour revenir et rééditer le formulaire');
          return $this->redirectToRoute('all_filds_form');
        }
        return $this->render('all_fields_form/displayAllFields.html.twig', [
            'allFieldsForm' => $allFieldsForm->createView(),
            'whichChoice' => $whichChoice,
            'fondsAide' => $fondsAide,
        ]);
    }
}
