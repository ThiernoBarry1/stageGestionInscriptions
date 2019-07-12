<?php
namespace App\Controller;
use DateTime;
use Fpdf\Fpdf;
use Dompdf\Dompdf;
use Dompdf\Options;

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
use Sensio\Bundle\FrameworkExtraBundle\Configuration\Security;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\IsGranted;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AllFieldsFormController extends AbstractController
{
  
   /**
    * permet d'afficher le formulaire de saisie selon la commission.
    * 
    * @Route("/fonds-d-aide/{idSession}/", name="all_fields_form_new")
    * @Route("/fonds-d-aide/{mail}/{token}/{token_date}", name="all_fields_form") function
    *
    * @param ProjetRepository $projetRepo
    * @param SessionRepository $sessionRepo
    * @param string $mail
    * @param string $token
    * @param integer $token_date
    * @param integer $idSession
    * @param ObjectManager $manager
    * @param Request $request
    * @param \Swift_Mailer $mailer
    * @return void
    */
    public function registration(ProjetRepository $projetRepo, SessionRepository $sessionRepo,$mail='',$token='',$token_date=0,$idSession=null,ObjectManager $manager, 
                                Request $request, \Swift_Mailer $mailer)
    {
        $projet = $projetRepo->findOneByCriteres($mail,$token,$token_date);   
        if(empty($projet)){
            // s'il n'existe pas de projet mais il y'a bien un mail, un token ou un token_date 
            // j'affiche une page d'erreur.
            if( $mail != '' || $token != '' || $token_date != 0)
            {
                return  $this->render('information/displayError.html.twig',
                                                                      [
                                                                          'date_error'=> false
                                                                      ]
                                      );
            }else {
                //c'est ça prémière connection
                $projet  = new Projet();
            }
        }else {
            $idSession = $projet->getSession()->getId();
        }
        $session = $sessionRepo->findOneById($idSession);
        if( $session == null ){
            return  $this->render('information/displayError.html.twig',
                                                                      [
                                                                          'date_error'=> false
                                                                      ]
                                      );
        }
        $fondsAide = $session->getFondsAide();
        $whichChoice = $fondsAide->getId();
        $allFieldsForm =  $this->createForm(RegistrationType::class,$projet);
        $allFieldsForm->handleRequest($request);

        if($allFieldsForm->isSubmitted() && $allFieldsForm->isValid()) {
            $projet->setSession($session);
             // générer un  mot de pass 
            $token = md5(uniqid(true));
            $projet->setMotpassehass($token);
            $date = new DateTime();
            $projet->setModifiedAt($date);
            $token_date = $date->getTimestamp();
            $projet->setTokenDate($token_date);
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
            foreach($projet->getProjetPresentes() as $projetPresente)
            {
                $projetPresente->setProjet($projet);
                $manager->persist($projetPresente);
            }

            $manager->flush();
            $idProjet = $projet->getId();
            
            // gestion d'envoie de mail

            $mail =  $projet->getMailUtilisateur();
            $message = (new \Swift_Message("lien de retour au formulaire d'inscription"))
                    ->setFrom('thiernobarrykankalabe@gmail.com')
                    ->setTo($mail)
                    ->setBody($this->renderView('emails/registration.html.twig',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]),'text/html');
            /*$mailer->send($message);

           // traitement génération du fichier pdf
    
            $pdf = new FPDF();

            $pdf->AddPage();
            $pdf->SetFont('Arial','',11);
            $pdf->Cell(40,10,$projet->getTitre(),0,1);
            $auteurs = '';
            foreach($projet->getAuteurRealisateurs() as $auteurRealisateur){
               $auteurs .= $auteurRealisateur->getPrenom(). ' '. $auteurRealisateur->getNom().' ; ';
            }
            $producteurs = '';
            foreach($projet->getProducteurs() as $producteur){
                $producteurs .= $producteur->getNomProducteur() . ' '.$producteur->getPrenomProducteur(). ' /'.$producteur->getNom().'  ;';
            }
            $pdf->Cell(40,10,utf8_decode('Auteur.s : '.$auteurs),0,1);
            $pdf->Cell(40,10,utf8_decode('Produit par : '.$producteurs),0,1);
            $pdf->Cell(40,10,utf8_decode('Durée envisagée : '.$projet->getDuree().' minutes'),0,1);
            $pdf->Cell(40,10,utf8_decode('Genre  : '.$projet->getGenre()),0,1);
            $pdf->Cell(40,10,utf8_decode('Format tournage : '.$projet->getFormatTournage()),0,1);
            $pdf->Cell(40,10,utf8_decode('Synopsis  : '.$projet->getSynopsis()),0,1);
            if($projet->getAdaptationOeuvreDacp() != null ){
                 $pdf->Cell(40,10,utf8_decode('Adaptation : date cession '.$projet->getAdaptationOeuvreDacp()),0,1);
            }
            $pdf->Cell(40,10,utf8_decode('Documents audiovisuels joints : '),0,1);
            foreach($projet->getDocumentAudioVisuels() as $document)
            {
              $text = $document->getTitre(). '/'.$document->getRealisateur().'/'.$document->getGenre().'/'.$document->getMotDePasse();
              $pdf->Cell(40,10,utf8_decode($text),0,1,'L',false,$document->getLien());
            }
            $pdf->Cell(40,10,utf8_decode('Demande d\'aide : '.$projet->getTypeAideLm()),0,1);
            $pdf->Cell(40,10,utf8_decode('Demande d\'aide : '.$projet->getTypeAideDoc()),0,1);
            $pdf->Cell(40,10,utf8_decode('Projet déposé par : '.$projet->getDeposant()),0,1);
           // $pdf->Cell(40,10,utf8_decode('Lien.s d\éligibilité : '.$projet->getLiensEligibilite()),0,1);
            $pdf->Cell(40,10,utf8_decode('Nombre de jours de tournage sur le territoire : '.$projet->getNombreJoursTournage()),0,1);
            $pdf->Cell(40,10,utf8_decode('Nombre total de jours de tournage: '.$projet->getNombreJoursTotal()),0,1);
            $pdf->Cell(40,10,utf8_decode('Casting envisagé: '.$projet->getCastingEnvisage()),0,1);
            $pdf->Cell(40,10,utf8_decode('Lieux de tournage envisagés: '.$projet->getLieuxTournage()),0,1);
            $pdf->Cell(40,10,utf8_decode('Montant du budget  :'.$projet->getMtBudget().' euros'),0,1);
            if($projet->getFinancementAcquisPrecision() != null)
                $pdf->Cell(40,10,utf8_decode(' Financement acquis :'.$projet->getFinancementAcquisPrecision()),0,1);
            $pdf->Cell(40,10,utf8_decode('Projet déposé auprès d\'autre collectivités territoriales '.$projet->getDepotProjetCollectivitePrecision()),0,1);
            if($projet->getProjetDejaPresenteFondsAide())
                $pdf->Cell(40,10,utf8_decode('Projet déjà présenté à la Normandie '.$projet->getProjetDejaPresenteFondsAideDate().'/'.$projet->getProjetDejaPresenteFondsAideTypeAide()),0,1);

            $pdf->Output('F','pdf/'.$token.'.pdf');
            */
            return $this->redirectToRoute('information_save',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]);
        }
        
        
        return $this->render('all_fields_form/displayAllFields.html.twig', [
            'allFieldsForm' => $allFieldsForm->createView(),
            'whichChoice' => $whichChoice,
            'fondsAide' => $fondsAide,
        ]);
        
        
    }

    /**
     * permet d'afficher un message de confirmation d'enregistement des données
     * à partir d'un formulaire.
     *
     *@Route("/fonds-d-aide-message/",name="information_save")
     *
     * @param ProjetRepository $projetRepo
     * @param Request $request
     * @return Response
     */
    public function displayInformationSave(ProjetRepository $projetRepo, Request $request)
    {
        $mail = $request->get('mail');
        $token = $request->get('token');
        $token_date = $request->get('token_date');
        $projet = $projetRepo->findOneByCriteres($mail,$token,$token_date);
        if($projet == null) {
            return  $this->render('information/displayError.html.twig',
                                                                      [
                                                                          'date_error'=> false
                                                                      ]
                                 );
        }else {
            $session = $projet->getSession();
            $titre = $session->getFondsAide()->getNom();
            $dateFinSession = $session->getDateFin();
            return $this->render('information/informationSave.html.twig',
                [   'titre'=>$titre,
                    'dateFin'=>$dateFinSession,
                    'token'=>$token,
                    'mail'=>$mail,
                    'token_date'=>$token_date,
                ]);
       }
    }
    
}