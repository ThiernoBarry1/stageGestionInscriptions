<?php

namespace App\Controller;

use DateTime;
use App\Repository\ProjetRepository;
use App\Repository\SessionRepository;
use Symfony\Component\HttpFoundation\Request;
use Doctrine\Common\Persistence\ObjectManager;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;
use Symfony\Component\Security\Http\Authentication\AuthenticationUtils;

class ConnectControlController extends AbstractController
{
    /**
     * permet de simuler une connection d'un candidat.
     * @Route("/fonds-d-aide-connection/",name="applicant_connect")
     * @return Response
     */
     public function connect(ProjetRepository $projetRepo,Request $request, SessionRepository $sessionRepo)
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
             $dateNow  = new DateTime();
             $timeNow = $dateNow->getTimesTamp() ;
             $diff =  $timeNow-$token_date;
             $dateSecond = $diff/60;
             $mail =  $projet->getMailUtilisateur();
             $token_bd = $projet->getMotpassehass();
             if ( $mail === $mail && $token === $token_bd && $dateSecond <= 10)
             {
                 $token_date = $projet->getTokenDate();
                 return $this->redirectToRoute('all_fields_form',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]);
             }else{
                 if($dateSecond > 10) {
                     $DATE_ERROR = true;
                 } else {
                     $DATE_ERROR = false;
                 }
                 return  $this->render('information/displayError.html.twig',
                            [
                                'date_error'=> $DATE_ERROR
                            ]
                );
             }
        }
        
    }
    /**
     * permet d'envoyer un nouveau mail
     * 
     *@Route("/fonds-d-aide-new_message/",name="new_mail")
     *
     * @return void
     */
    public function newMessage(ProjetRepository $projetRepo,Request $request, \Swift_Mailer $mailer, ObjectManager $manager)
    {
        $mail = $request->get('mail');
        $token = $request->get('token');
        $dateNow = new DateTime();
        $token_date = $dateNow->getTimesTamp();
        $projet = $projetRepo->findOneByMailToken($mail,$token);
        if($projet == null) 
        {
            return  $this->render('information/displayError.html.twig',
                                                                      [
                                                                          'date_error'=> false
                                                                      ]
                                 );
        }else
         {
            $projet->setTokenDate($token_date);
            $manager->persist($projet);
            $manager->flush();
            $message = (new \Swift_Message("lien de retour au formulaire d'inscription"))
                        ->setFrom('thiernobarrykankalabe@gmail.com')
                        ->setTo($mail)
                        ->setBody($this->renderView('emails/registration_new.html.twig',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]),'text/html');
            $mailer->send($message);
            return $this->redirectToRoute('information_save',['mail'=>$mail,'token'=>$token,'token_date'=>$token_date]);
        }
    }
     
}
