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
     * @param  integer $idSession
     * @param  integer $idProjet
     * @param ObjectManager $manager
     * @return Response
     */
    public function registrationnew(ProjetRepository $projetRepo, SessionRepository $sessionRepo,$mail=null,$token=null,$token_date=null,$idSession=null,ObjectManager $manager, 
                                Request $request, \Swift_Mailer $mailer)
    {
        $projet = $projetRepo->findOneByCriteres($mail,$token,$token_date);   
        if(empty($projet)){
            // s'il n'existe pas de projet mais il y'a bien un mail, un token et un token_date 
            // j'affiche une page d'erreur.
            if( $mail != '' && $token != '' && $token_date != 0)
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
            $projet->setUpdatedAt($date);
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
            $manager->flush();
            $idProjet = $projet->getId();
            
            // gestion d'envoie de mail

            $mail =  $projet->getMailUtilisateur();
            $message = (new \Swift_Message("lien de retour au formulaire d'inscription"))
                    ->setFrom('thiernobarrykankalabe@gmail.com')
                    ->setTo($mail)
                    ->setBody($this->renderView('emails/registration.html.twig',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]),'text/html');
            $mailer->send($message);
           
            return $this->redirectToRoute('information_save',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]);
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
     *@Route("/fonds-d-aide-message/",name="information_save")
     *
     * @param WhichCommissionChoice $choice
     * @param Integer $idSession
     * @param Integer $idProjet
     *
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