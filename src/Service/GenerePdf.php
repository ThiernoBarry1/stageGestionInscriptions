<?php
namespace App\Service;
use Fpdf\Fpdf;
use App\Entity\Projet;
use App\Entity\FondsAide;
use App\Repository\FondsAideRepository;
use App\Repository\ProjetRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class GenerePdf 
{   
   
    public function getPdf(Projet $projet,$token)
    {
       
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
          $pdf->Cell(40,7,mb_convert_encoding('Auteur.s  ', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(0,7,mb_convert_encoding($auteurs, "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($producteurs !== '   ;'){
          $pdf->Cell(40,7,mb_convert_encoding('Produit par  ', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(40,7,mb_convert_encoding($producteurs, "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getDuree() != null){
          $pdf->Cell(40,7,mb_convert_encoding('Durée envisagée  ', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(40,7,mb_convert_encoding($projet->getDuree().' minutes', "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getGenre() != null ){
          $pdf->Cell(40,7,mb_convert_encoding('Genre ', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(40,7,mb_convert_encoding($projet->getGenre(), "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getFormatTournage() != null ){
          $pdf->Cell(40,7,mb_convert_encoding('Format tournage  ', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(40,7,mb_convert_encoding($projet->getFormatTournage(), "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getSynopsis() != null){
          $arraySynopsis = str_split($projet->getSynopsis(),110);
          $pdf->Cell(0,7,mb_convert_encoding('Synopsis   ', "Windows-1252", "UTF-8"),0,1);
          foreach($arraySynopsis as $synop){
              $pdf->setTextColor(0,0,128);
              $pdf->Cell(0,7,mb_convert_encoding($synop, "Windows-1252", "UTF-8"),1,1);
          }
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getAdaptationOeuvre()){
          $pdf->Cell(40,7,mb_convert_encoding('Adaptation  ',"Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,128);
          $pdf->Cell(0,7,mb_convert_encoding($projet->getAdaptationOeuvreToa().'/'.$projet->getAdaptationOeuvreDacp(),"Windows-1252", "UTF-8").'/'.date_format($projet->getAdaptationOeuvreDfc(),'d-m-Y'),1,1);
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
    }
   
}
