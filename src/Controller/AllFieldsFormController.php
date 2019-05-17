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
        $producteur = new Producteur();
        $producteur->setNom("BA")
                   ->setNature('entreprise')
                   ->setSiret('0000000000000000000000000000')
                   ->setNomGerant('BARRY')
                   ->setPrenomGerant('Thierno')
                   ->setNomProducteur('le nom producteur ')
                   ->setPrenomProducteur('le prenom producteur ')
                   ->setAdresse('10 rue lkddkdkk')
                   ->setCodePostal('14000')
                   ->setVille('caen')
                   ->setProjet($projet);
        $projet->addProducteur($producteur);
    
        $auteurRealisateurs = new AuteurRealisateur();
        $auteurRealisateurs->setNom('BARRY')
                           ->setPrenom('Abdoulaye')
                           ->setPseudonyme('eeeeeee')
                           ->setAdresse('dkkkkkkkk')
                           ->setVille('caen')
                           ->setCodePostal('14000')
                           ->setTelephoneMobile('0633333')
                           ->setTypePersonne('auteur')
                           ->setProjet($projet);
        $auteurRealisateurs2 = new AuteurRealisateur();
        $auteurRealisateurs2->setNom('BARRY')
                           ->setPrenom('Abdoulaye')
                           ->setPseudonyme('eeeeeee')
                           ->setAdresse('dkkkkkkkk')
                           ->setVille('caen')
                           ->setCodePostal('14000')
                           ->setTelephoneMobile('0633333')
                           ->setTypePersonne('auteur')
                           ->setProjet($projet);
        $projet->addAuteurRealisateur($auteurRealisateurs2);
        $documentAudioVisuels = new DocumentAudioVisuels();
        $documentAudioVisuels->setTitre('eeeeeeeeeeeee')
                             ->setRealisateur('dkkkkkkkkkkkdk')
                             ->setGenre('ekkkkkkkkkkkkkk')
                             ->setAnnee(2014)
                             ->setDuree(20)
                             ->setLien('http://127.0.0.1:8000/fonds-d-aide/51')
                             ->setMotDePasse("ddddddddddd");
        $projet->addDocumentAudioVisuel($documentAudioVisuels);
        $allFieldsForm =  $this->createForm(RegistrationType::class,$projet);
        $allFieldsForm->handleRequest($request);
        if($allFieldsForm->isSubmitted() && $allFieldsForm->isValid()) {
          $manager->persist($proje);
          $manager->flush();
        }
        return $this->render('all_fields_form/displayAllFields.html.twig', [
            'allFieldsForm' => $allFieldsForm->createView(),
            'whichChoice' => $whichChoice,
            'fondsAide' => $fondsAide,
        ]);
    }
}
