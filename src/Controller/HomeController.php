<?php

namespace App\Controller;

use App\Repository\FondsAideRepository;
use Symfony\Component\Routing\Annotation\Route;
use Symfony\Bundle\FrameworkBundle\Controller\AbstractController;

class HomeController extends AbstractController
{
    /**
     * le point d'entrer du site, il permet d'afficher la liste des commissions,
     * chaque  type d'aide a en son sein plusieurs sessions avec des dates différentes 
     * un lien est visible pour chaque session permettant à un candidat de déposer sa démande
     * et ce lien n'est visible que pour la période concernée pour la session.
     *
     * @param FondsAideRepository $repoFondsAide
     * @return Resonse
     *  @Route("/", name="home")
     */
    public function index(FondsAideRepository $repoFondsAide)
    {
        $donneesFondsAide = $repoFondsAide->findAll();
        return $this->render('home/index.html.twig', [
            'data' => $donneesFondsAide,
        ]);
    }
}
