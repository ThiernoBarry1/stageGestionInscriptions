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
     * @Route("/fonds-d-aide/{id}/{idSession}", name="all_filds_form")
     * 
     *
     * @param WhichCommissionChoice $choice
     * @param  integer $id
     * @param  integer $idSession
     * @param ObjectManager $manager
     * @return Response
     */
    public function registration(WhichCommissionChoice $choice,$id,$idSession,ObjectManager $manager, Request $request)
    {
        
        $choice->setId($id);
        $whichChoice = $choice->getCorrectIdCommision();
        $projet  = $choice->getInstanceProjet();
        $fondsAide = $choice->getFondsAide();
        $allFieldsForm =  $this->createForm(RegistrationType::class,$projet);
        $allFieldsForm->handleRequest($request);
        if($allFieldsForm->isSubmitted()) {
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
          return $this->redirectToRoute('information_save',['id'=>$id,'idSession'=>$idSession]);
        }
        return $this->render('all_fields_form/displayAllFields.html.twig', [
            'allFieldsForm' => $allFieldsForm->createView(),
            'whichChoice' => $whichChoice,
            'fondsAide' => $fondsAide,
        ]);
    }

    
    /**
     * permet d'afficher un message de confirmations d'enregistement des données
     * à partir d'un formulaire.
     * 
     *@Route("/fonds-d-aide-messages/{id}/{idSession}/",name="information_save")
     *
     * @param WhichCommissionChoice $choice
     * @param Integer $id
     * @param Integer $idSession
     * 
     * @return Response
     */
    public function displayInformationSave(WhichCommissionChoice $choice,$id,$idSession)
    {
        $choice->setId($id);
        $fondsAide = $choice->getFondsAide();
        $titre = $fondsAide->getNom();
        $dateFinSession = $choice->getDateFin($fondsAide,$idSession);
        return $this->render('information/informationSave.html.twig',
                                        ['titre'=>$titre,
                                          'id'=>$id,
                                          'dateFin'=>$dateFinSession,
                                          'idSession'=>$idSession,
                                        ]);
    }
}
