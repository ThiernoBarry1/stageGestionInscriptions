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
use Symfony\Component\Security\Core\Security;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Sensio\Bundle\FrameworkExtraBundle\Configuration\ParamConverter;
use Symfony\Component\Security\Core\Encoder\UserPasswordEncoderInterface;

class AllFieldsFormController extends AbstractController
{

    /**
     * permet de verifier en amont les routers pour accèder au projet
     * 
     * @Route("/connexion/{idSession}/", name="connexion_new")
     * @Route("/connexion/{idSession}/{idProjet}/{pass}/", name="connexion_edit")

     * @param ProjetRepository $projetRepo
     * @param [type] $idProjet
     * @param SessionRepository $sessionRepo
     * @param [type] $idSession
     * @return void
     */
    public function verificationRouter(ProjetRepository $projetRepo,$idProjet=null, SessionRepository $sessionRepo,$idSession, $pass=null) 
    {
        $session = $sessionRepo->findOneById($idSession);
        $projet = $projetRepo->findOneById($idProjet);
        if(empty($projet))
        {
            return $this->redirectToRoute('all_fields_form_new',['idSession'=>$idSession]);
        }else
        {
            $mdpHass = $projet->getMotpassehass();
            $value = password_verify($pass,$mdpHass);
            if($value) {
                return $this->redirectToRoute('all_fields_form',['idSession'=>$idSession,'idProjet'=>$idProjet,'pass'=>$pass]);
            }else{
                return $this->render('information/routingError.html.twig');
            }
        }
    }

    /**
     * permet d'afficher le formulaire de saisie selon la commission.
     * @Route("/fonds-d-aide/{idSession}/", name="all_fields_form_new")
     * @Route("/fonds-d-aide/{idSession}/{idProjet}/{pass}/", name="all_fields_form")
     * @param  integer $idSession
     * @param  integer $idProjet
     * @param ObjectManager $manager
     * @return Response
     */
    public function registrationnew(ProjetRepository $projetRepo, SessionRepository $sessionRepo, $idSession, $idProjet = null,$pass=null ,ObjectManager $manager, 
                                Request $request, \Swift_Mailer $mailer)
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
            // generation de mot de pass
            //$mdp = uniqid('', $more_entropy=true);
           // $hash = $encoder->encodePassword($projet,$pass);
           $mdp = md5(uniqid());
           $hash = password_hash($mdp,PASSWORD_BCRYPT);
            $projet->setMotpassehass($hash);

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
            if(count($projet->getAuteurRealisateurs()) != 0) {
                $courrielAuteurRealisateur =  $projet->getAuteurRealisateurs()->first()->getCourriel();
                $message = (new \Swift_Message("lien de retour au formulaire d'inscription"))
                        ->setFrom('thiernobarrykankalabe@gmail.com')
                        ->setTo($courrielAuteurRealisateur)
                        ->setBody($this->renderView('emails/registration.html.twig',['idSession'=>$idSession,'idProjet'=>$idProjet,'pass'=>$mdp]),'text/html');
                $mailer->send($message);
           }
            return $this->redirectToRoute('information_save',['idProjet'=>$idProjet,'idSession'=>$idSession,'pass'=>$mdp]);
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
     *@Route("/fonds-d-aide-messages/{idSession}/{idProjet}/{pass}/",name="information_save")
     *
     * @param WhichCommissionChoice $choice
     * @param Integer $idSession
     * @param Integer $idProjet
     *
     * @return Response
     */
    public function displayInformationSave(SessionRepository $sessionRepo, $idSession, $idProjet,$pass)
    {
        $session = $sessionRepo->findOneById($idSession);
        $titre = $session->getFondsAide()->getNom();
        $dateFinSession = $session->getDateFin();
        return $this->render('information/informationSave.html.twig',
            ['titre'=>$titre,
                'dateFin'=>$dateFinSession,
                'idSession'=>$idSession,
                'idProjet'=>$idProjet,
                'pass'=>$pass
            ]);
    }
    /**
     * permet de simuler une connection d'un candidat.
     * @Route("/fonds-d-aide/connect",name="connect")
     * @return Response
     */
    public function connect()
    {
        return $this->render('user/connect.html.twig');
    }
}