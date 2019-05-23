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
        dump($request);
        if($allFieldsForm->isSubmitted() && $allFieldsForm->isValid()) {
          $manager->persist($projet);
          $manager->flush();
          $this->redirectToRoute('home');
        }
        return $this->render('all_fields_form/displayAllFields.html.twig', [
            'allFieldsForm' => $allFieldsForm->createView(),
            'whichChoice' => $whichChoice,
            'fondsAide' => $fondsAide,
        ]);
    }
}
