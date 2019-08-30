<?php
namespace App\Service;
use Fpdf\Fpdf;
use App\Entity\Projet;
use App\Entity\FondsAide;
use App\Repository\FondsAideRepository;
use App\Repository\ProjetRepository;
use Symfony\Component\Config\Definition\Exception\Exception;

class GenerePdf extends FPDF
{   
   
    public function getPdf(Projet $projet,$token,$fondsAide)
    {
       
      $pdf = new FPDF();

      $pdf->AddPage();
      $pdf->SetFont('Arial','',11);
      
      $pdf->setTextColor(0,0,128);
      $pdf->cell(0,5,mb_convert_encoding("FONDS D’AIDE A LA CREATION ET A LA PRODUCTION ", "Windows-1252", "UTF-8"),0,1,"C");
      $pdf->cell(0,5,utf8_decode("CINEMA, AUDIOVISUEL ET MULTIMEDIA"),0,1,"C");
      $pdf->cell(0,5,utf8_decode("en association avec Normandie Images"),0,1,"C");
      $pdf->ln();
      $pdf->cell(0,5,mb_convert_encoding($fondsAide->getNom(),"Windows-1252", "UTF-8"),1,1,"C");
      $pdf->ln();
      $pdf->SetFont('Arial','B',10);
      $pdf->Cell(0,5,mb_convert_encoding($projet->getTitre(),"Windows-1252", "UTF-8"),0,1);
      // Enlève le gras
      $pdf->SetFont('Arial','',10);
      $auteurs = '';
      $realisateur = '';
      $scenaristes = '';
      foreach($projet->getAuteurRealisateurs() as $auteurRealisateur){
          if($auteurRealisateur->getTypePersonne() === 'Réalisateur'){
              $realisateur .= $auteurRealisateur->getPrenom().' '.$auteurRealisateur->getNom().' ; ';
          }else if($auteurRealisateur->getTypePersonne() === 'Auteur réalisateur'){
             $auteurs .= $auteurRealisateur->getPrenom().' '.$auteurRealisateur->getNom().' ; ';
         }else{
             // à voir ...
             $scenaristes .= $auteurRealisateur->getPrenom().' '.$auteurRealisateur->getNom().' ; ';
         }
      }
      $producteurs = '';
      $dossierSuiviPar = '';
      foreach($projet->getProducteurs() as $producteur){
          $producteurs .= $producteur->getPrenomProducteur() .' '.$producteur->getNomProducteur(). ' '.$producteur->getNom().' ;';
          $dossierSuiviPar .= $producteur->getPrenomPersonneChargee().' '.$producteur->getNomPersonneChargee().' ;';
        }
      $pdf->setTextColor(0,0,0);
      if($auteurs !== '  ; ' && $auteurs !== '' ){
          $pdf->Cell(18,7,mb_convert_encoding('Auteur.s: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($auteurs, "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($realisateur !== '  ; ' && $realisateur !== ''){
        $pdf->Cell(24,7,mb_convert_encoding('Réalisateur.s: ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($realisateur, "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
      }
      if($scenaristes !== '  ; ' && $scenaristes !== ''){
        $pdf->Cell(24,7,mb_convert_encoding('Scénariste.s: ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($scenaristes, "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
      }
      if($producteurs !== '   ;'){
          $pdf->Cell(23,7,mb_convert_encoding('Produit par: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($producteurs, "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($dossierSuiviPar !== '  ;')
      {
        $pdf->Cell(30,7,mb_convert_encoding('Dossier suivi par: ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($dossierSuiviPar, "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
      }
      $pdf->ln();
      if($projet->getDuree() != null){
          $pdf->Cell(30,7,mb_convert_encoding('Durée envisagée: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getDuree().' minutes', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getGenre() != null ){
          $pdf->Cell(15,7,mb_convert_encoding('Genre: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getGenre(), "Windows-1252", "UTF-8"),0,1);
          $y = $pdf->GetY();
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getFormatTournage() != null ){
          $pdf->Cell(25,7,mb_convert_encoding('Format tournage: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getFormatTournage(), "Windows-1252", "UTF-8"),1,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getPremierFilm() != null ){
        $pdf->Cell(25,7,mb_convert_encoding('Premier film: ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding(json_decode($projet->getPremierFilm()), "Windows-1252", "UTF-8"),1,1);
        $pdf->setTextColor(0,0,0);
    }
      $pdf->Ln();
      if($projet->getSynopsis() != null){
          $pdf->Cell(20,7,mb_convert_encoding('Synopsis: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getSynopsis(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      $pdf->ln();

      if($projet->getAdaptationOeuvre() !== "non" && $projet->getAdaptationOeuvreDfc() != null ){
          $pdf->Cell(20,7,mb_convert_encoding('Adaptation:  ',"Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,date_format($projet->getAdaptationOeuvreDfc(),'d-m-Y'),0,1);
          $pdf->setTextColor(0,0,0);
      }
      $pdf->ln();

     if(!$projet->getDocumentAudioVisuels()->isEmpty())
        $pdf->Cell(0,7,mb_convert_encoding('Documents audiovisuels joints: ', "Windows-1252", "UTF-8"),0,1);
      foreach($projet->getDocumentAudioVisuels() as $document)
      {
        $text = $document->getTitre(). '/'.$document->getRealisateur().'/'.$document->getGenre().'/'.$document->getLien().'/'.$document->getMotDePasse();
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($text, "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
      }
      $pdf->ln();
      if($projet->getTypeAideLm() != null){
          $pdf->Cell(33,7,mb_convert_encoding('Demande d\'aide: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding(''.$projet->getTypeAideLm(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getTypeAideDoc() != null){
          $pdf->Cell(33,7,mb_convert_encoding('Demande d\'aide: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getTypeAideDoc(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getDeposant() != null){
          $pdf->Cell(32,7,mb_convert_encoding('Projet déposé par: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getDeposant(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
     //$pdf->Cell(40,7,mb_convert_encoding('Lien.s d\éligibilité : '.$projet->getLiensEligibilite()),0,1);
     if($projet->getNombreJoursTournage() != null){
         $pdf->Cell(52,7,mb_convert_encoding('Nombre de jours de tournage sur le territoire: ', "Windows-1252", "UTF-8"),0,0);
         $pdf->setTextColor(0,0,128);
         $pdf->MultiCell(0,7,mb_convert_encoding(''.$projet->getNombreJoursTournage(), "Windows-1252", "UTF-8"),0,1);
         $pdf->setTextColor(0,0,0);
     }
      if($projet->getNombreJoursTotal() != null){
          $pdf->Cell(43,7,mb_convert_encoding('Nombre total de jours de tournage: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MutliCell(0,7,mb_convert_encoding(''.$projet->getNombreJoursTotal(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getCastingEnvisage() != null){
          $pdf->Cell(25,7,mb_convert_encoding('Casting envisagés: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getCastingEnvisage(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
     
      if($projet->getLieuxTournage() != null){
          $pdf->Cell(33,7,mb_convert_encoding('Lieux de tournage envisagés: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MutlitCell(0,7,mb_convert_encoding($projet->getLieuxTournage(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }

      $pdf->ln();

      if($projet->getMtBudget() != null){
          $pdf->Cell(45,7,mb_convert_encoding('Montant total du budget: ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getMtBudget().' euros', "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }else{
          if( $projet->getTotalGeneralCoutDefinitif() != null)
          {
            $pdf->Cell(43,7,mb_convert_encoding('Montant total du budget: ', "Windows-1252", "UTF-8"),0,0);
            $pdf->setTextColor(0,0,128);
            $pdf->MultiCell(0,7,mb_convert_encoding($projet->getTotalGeneralCoutDefinitif().' euros', "Windows-1252", "UTF-8"),0,1);
            $pdf->setTextColor(0,0,0);
          }
      }
      if($projet->getTotalGeneralTotalHtNormandie() != null){
        $pdf->Cell(65,7,mb_convert_encoding('Montant des depenses sur le territoire: ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($projet->getTotalGeneralTotalHtNormandie().' euros', "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
      }

      if($projet->getFinancementAcquisPrecision() != null){
          $pdf->Cell(38,7,mb_convert_encoding('Financement acquis : ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getFinancementAcquisPrecision(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getMontantSollicite() != null){
        $pdf->Cell(35,7,mb_convert_encoding('Montant sollicité : ', "Windows-1252", "UTF-8"),0,0);
        $pdf->setTextColor(0,0,128);
        $pdf->MultiCell(0,7,mb_convert_encoding($projet->getMontantSollicite(), "Windows-1252", "UTF-8"),0,1);
        $pdf->setTextColor(0,0,0);
    }
      $pdf->ln();
      if($projet->getDepotProjetCollectivite() !== "non" ){
          $pdf->Cell(95,7,mb_convert_encoding('Projet déposé auprès d\'autre collectivités territoriales : ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getDepotProjetCollectivitePrecision(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }
      if($projet->getProjetDejaPresenteFondsAide() !== "non"){
          $pdf->Cell(68,7,mb_convert_encoding('Projet déjà présenté à la Normandie : ', "Windows-1252", "UTF-8"),0,0);
          $pdf->setTextColor(0,0,128);
          $pdf->MultiCell(0,7,mb_convert_encoding($projet->getProjetDejaPresenteFondsAideTypeAide().'/'.$projet->getProjetDejaPresenteFondsAideDate(), "Windows-1252", "UTF-8"),0,1);
          $pdf->setTextColor(0,0,0);
      }

    
     
    $pdf->Output('F','pdf/'.$token.'.pdf');
 
    }
   
}
