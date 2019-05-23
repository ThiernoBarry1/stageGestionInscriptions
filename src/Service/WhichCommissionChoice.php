<?php
namespace App\Service;

use App\Entity\Projet;
use App\Entity\FondsAide;
use App\Repository\FondsAideRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class WhichCommissionChoice 
{   
    private $id;
    private $fondsAideRepo;

    public function __construct(FondsAideRepository $fondsAideRepo){
        $this->fondsAideRepo = $fondsAideRepo;
    }
    public function  getId(){
        return $this->id;
    }
    public function setId($id){
        $this->id = $id;

        return $this;
    }
    public function getFondsAideRepo()
    {
       return $this->fondsAideRepo;
    }

    public function setFondsAideRepo($fondsAideRepo)
    {
       $this->fondsAideRepo = $fondsAideRepo;

       return $this;
    }
    
    public function getInstanceProjet(){
       return new Projet();
    }
    public function getFondsAide(){
        return $this->fondsAideRepo->find($this->id);
    }
    /**
     * permet à partir d'un fonds d'aide de retrouver une la date de fin de session 
     *
     * @param string $fondsAide
     * @return DateTime
     */
    public function getDateFin($fondsAide,$idSession)
    {
      return $fondsAide->getSessions()->filter(
         function($session) use ($idSession) {
         return $session->getId() == $idSession;
        })->get(0)->getDateFin();
    }
   /**
    * permet de retourne un entier selon la commision choisie
    *
    *  /!\  Attention:  le nommage des differentes commisions est important, il faut faire gaff 
    * à ne pas nommer deux commissions avec le même nom.
    *
    * @return Integer
    */

   
    public function getCorrectIdCommision(){
         $fondsAide = $this->getFondsAide();

         if($fondsAide->getNom() === "Écriture et réecriture long métrage cinéma"){
            $TYPEFOND  = 1 ;
         }else if($fondsAide->getNom() === "Écriture et développement documentaire"){
            $TYPEFOND  = 2 ;
         } else if ($fondsAide->getNom() === "Création Images differentes et nouveaux médias"){
            $TYPEFOND  = 3 ;
         }else if($fondsAide->getNom() === "Production court métrage fiction et d'animation"){
            $TYPEFOND = 4;
         }else if($fondsAide->getNom() === "Musique originale film pour le court (fonds SACEM)"){
            $TYPEFOND = 5;
         }else if($fondsAide->getNom() === "Production long métrage cinéma"){
            $TYPEFOND = 6;
         }else if($fondsAide->getNom() === "Production documentaire audiovisuel et court métrage documentaire"){
            $TYPEFOND = 7;
         }else if($fondsAide->getNom() === "Production fiction audiovisuelle"){
            $TYPEFOND = 8;
         }else if($fondsAide->getNom() === "Programme de développement des structures de production"){
            $TYPEFOND = 9;
         }else if($fondsAide->getNom() === "Production court métrage documentaire"){
           $TYPEFOND = 10;
         }else{
            throw new Exception("Aucun type d'aide ne corresponds à ce choix", 1); 
         }
         return $TYPEFOND;
    }
}
