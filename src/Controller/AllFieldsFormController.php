<?php
namespace App\Controller;
use DateTime;
use Fpdf\Fpdf;
/*use Dompdf\Dompdf;
use Dompdf\Options;*/

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
    * @Route("/fonds-d-aide/{mail}/{token}/{token_date}", name="all_fields_form") 
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
            // s'il n'existe pas de projet mais il y a bien un mail, un token ou un token_date 
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
            //$mailer->send($message);

           // traitement génération du fichier pdf
           /*
            $pdf = new FPDF();

            $pdf->AddPage();
            $pdf->SetFont('Arial','',11);
            //$pdf->Image('/../img/normandie.png',10,10,-300);
            $pdf->setTextColor(0,0,128);
            $pdf->cell(0,5,mb_convert_encoding("FONDS D’AIDE A LA CREATION ET A LA PRODUCTION ", "Windows-1252", "UTF-8"),0,1,"C");
            $pdf->cell(0,5,utf8_decode("CINEMA, AUDIOVISUEL ET MULTIMEDIA"),0,1,"C");
            $pdf->cell(0,5,utf8_decode("en association avec Normandie Images"),0,1,"C");
            $pdf->cell(0,10,"",0,1);
            $pdf->Cell(40,7,mb_convert_encoding($projet->getTitre(),"Windows-1252", "UTF-8"),0,1);
            $auteurs = '';
            foreach($projet->getAuteurRealisateurs() as $auteurRealisateur){
                $auteurs .= $auteurRealisateur->getPrenom().' '.$auteurRealisateur->getNom().' ; ';
            }
            $producteurs = '';
            foreach($projet->getProducteurs() as $producteur){
                $producteurs .= $producteur->getNomProducteur() .' '.$producteur->getPrenomProducteur(). ' '.$producteur->getNom().' ;';
            }
            $pdf->setTextColor(0,0,0);
            if($auteurs !== '  ; '){
                $pdf->Cell(40,7,mb_convert_encoding('Auteur.s : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(0,7,mb_convert_encoding($auteurs, "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($producteurs !== '   ;'){
                $pdf->Cell(40,7,mb_convert_encoding('Produit par : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($producteurs, "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getDuree() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Durée envisagée : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getDuree().' minutes', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getGenre() != null ){
                $pdf->Cell(40,7,mb_convert_encoding('Genre ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getGenre(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getFormatTournage() != null ){
                $pdf->Cell(40,7,mb_convert_encoding('Format tournage : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getFormatTournage(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getSynopsis() != null){
                $arraySynopsis = str_split($projet->getSynopsis(),110);
                $pdf->Cell(0,7,mb_convert_encoding('Synopsis  : ', "Windows-1252", "UTF-8"),0,1);
                foreach($arraySynopsis as $synop){
                    $pdf->setTextColor(0,0,128);
                    $pdf->Cell(0,7,mb_convert_encoding($synop, "Windows-1252", "UTF-8"),0,1);
                }
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getAdaptationOeuvre()){
                $pdf->Cell(40,7,mb_convert_encoding('Adaptation : ',"Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getAdaptationOeuvreToa().'/'.$projet->getAdaptationOeuvreDacp(),"Windows-1252", "UTF-8").'/'.date_format($projet->getAdaptationOeuvreDfc(),'d-m-Y'),0,1);
                $pdf->setTextColor(0,0,0);
            }
            
           if($projet->getDocumentAudioVisuels() != null)
                $pdf->Cell(40,7,mb_convert_encoding('Documents audiovisuels joints : ', "Windows-1252", "UTF-8"),0,1);
            foreach($projet->getDocumentAudioVisuels() as $document)
            {
              $text = $document->getTitre(). '/'.$document->getRealisateur().'/'.$document->getGenre().'/'.$document->getMotDePasse();
              $pdf->setTextColor(0,0,128);
              $pdf->Cell(40,7,mb_convert_encoding($text, "Windows-1252", "UTF-8"),0,1,'L',false,$document->getLien());
              $pdf->setTextColor(0,0,0);
            }
            if($projet->getTypeAideLm() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Demande d\'aide : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding(''.$projet->getTypeAideLm(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getTypeAideDoc() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Demande d\'aide : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getTypeAideDoc(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getDeposant() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Projet déposé par : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getDeposant(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
           // $pdf->Cell(40,7,mb_convert_encoding('Lien.s d\éligibilité : '.$projet->getLiensEligibilite()),0,1);
           if($projet->getNombreJoursTournage() != null){
               $pdf->Cell(40,7,mb_convert_encoding('Nombre de jours de tournage sur le territoire : ', "Windows-1252", "UTF-8"),0,1);
               $pdf->setTextColor(0,0,128);
               $pdf->Cell(40,7,mb_convert_encoding(''.$projet->getNombreJoursTournage(), "Windows-1252", "UTF-8"),0,1);
               $pdf->setTextColor(0,0,0);
           }
            if($projet->getNombreJoursTotal() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Nombre total de jours de tournage: ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding(''.$projet->getNombreJoursTotal(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getCastingEnvisage() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Casting envisagé: ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding(''.$projet->getCastingEnvisage(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getLieuxTournage() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Lieux de tournage envisagés: ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getLieuxTournage(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getMtBudget() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Montant du budget  : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getMtBudget().' euros', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getFinancementAcquisPrecision() != null){
                $pdf->Cell(40,7,mb_convert_encoding('Financement acquis : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getFinancementAcquisPrecision(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getDepotProjetCollectivite()){
                $pdf->Cell(40,7,mb_convert_encoding('Projet déposé auprès d\'autre collectivités territoriales : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getDepotProjetCollectivitePrecision(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
            if($projet->getProjetDejaPresenteFondsAide()){
                $pdf->Cell(40,7,mb_convert_encoding('Projet déjà présenté à la Normandie : ', "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,128);
                $pdf->Cell(40,7,mb_convert_encoding($projet->getProjetDejaPresenteFondsAideTypeAide().'/'.$projet->getProjetDejaPresenteFondsAideDate(), "Windows-1252", "UTF-8"),0,1);
                $pdf->setTextColor(0,0,0);
            }
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
     * permet d'afficher un message de confirmation d'enregistement.
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