<?php
namespace App\Controller;
use DateTime;
use App\Entity\Projet;
use App\Entity\Session;
use App\Entity\FondsAide;
use App\Entity\Producteur;
use App\Form\RegistrationType;
use App\Entity\AuteurRealisateur;
use App\Entity\DocumentAudioVisuels;
use App\Repository\ProjetRepository;
use App\Repository\SessionRepository;
use App\Service\WhichCommissionChoice;
use App\Repository\FondsAideRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;

class AllFieldsFormController extends AbstractController
{
    /**
     * permet d'afficher le formulaire de saisie selon la commission.
     * @Route("/fonds-d-aide/{idSession}/", name="all_fields_form_new")
     * @Route("/fonds-d-aide/{idSession}/{idProjet}", name="all_fields_form")
     *
     * @param  integer $idSession
     * @param  integer $idProjet
     * @param ObjectManager $manager
     * @return Response
     */
    public function registrationnew(ProjetRepository $projetRepo, SessionRepository $sessionRepo, $idSession, $idProjet = null, ObjectManager $manager, Request $request)
    {
        $session = $sessionRepo->findOneById($idSession);
        $projet = $projetRepo->findOneById($idProjet);
        if(empty($projet)){
            $projet  = new Projet();
        }

        $fondsAide = $session->getFondsAide();
        $whichChoice = $fondsAide->getId();
        $allFieldsForm =  $this->createForm(RegistrationType::class,$projet);
        $allFieldsForm->handleRequest($request);

        if($allFieldsForm->isSubmitted()) {
            $projet->setSession($session);
            $manager->persist($projet);
    
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
            $manager->flush();
            $idProjet = $projet->getId();
            return $this->redirectToRoute('information_save',['idProjet'=>$idProjet,'idSession'=>$idSession]);
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
     *@Route("/fonds-d-aide-messages/{idSession}/{idProjet}",name="information_save")
     *
     * @param WhichCommissionChoice $choice
     * @param Integer $idSession
     * @param Integer $idProjet
     *
     * @return Response
     */
    public function displayInformationSave(SessionRepository $sessionRepo, $idSession, $idProjet)
    {
        $session = $sessionRepo->findOneById($idSession);
        $titre = $session->getFondsAide()->getNom();
        $dateFinSession = $session->getDateFin();
        return $this->render('information/informationSave.html.twig',
            ['titre'=>$titre,
                'dateFin'=>$dateFinSession,
                'idSession'=>$idSession,
                'idProjet'=>$idProjet,
            ]);
    }
}