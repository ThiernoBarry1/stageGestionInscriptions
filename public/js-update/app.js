$(document).ready(function()
{     
    
  calculDevisPrevisionnel('.ht input','.input-totalHtTotalGeneral');
  calculDevisPrevisionnel('.htNormandie input','.input-totalHtNormandieTotalGeneral');
  calculDevisPrevisionnel('.depenseFrance input','.input-totalGeneralFrance');
  /**
   * permet d'effectue le calcul de devis prévisionnel 
   * cette méthode traite le cas montant Ht et dont rn région Normandie
   * @param {String} selecteurInput 
   * @param {String} selecteurInputTotal 
   */
   function calculDevisPrevisionnel(selecteurInput,selecteurInputTotal){
      $(selecteurInput).on('change',function(){
         if(isNaN($(this).val())) {
            $(this).css('background-color','#f11');
            alert('Vous ne devez saisir que des valeurs réelles');
            $(this).css('background-color','#FFFFFF');
         }else{
            var TOTAL = 0;
            calculMontantTotal(TOTAL,selecteurInput,selecteurInputTotal);
         }
      });
   }
   
   
   /**
    * permet de calculer le montant total à chaque fois qu'on saisie une 
    * valeur dans un champ input.
    * 
    * @param {integer} Total 
    * @param {string} selecteurInputs 
    * @param {sting} selecteurInputMontantTotal 
    */
   function calculMontantTotal(Total,selecteurInputs,selecteurInputMontantTotal){
      $('.row').find(selecteurInputs).each(function(){
         var valeur_saisie = $(this).val();
         Total = Total + +valeur_saisie;
     });
     $(selecteurInputMontantTotal).val(Total);
   }

   /**
    * permet de gérer la saisie de la virgule dans les inputs
    * 
    * @param {String} selecteurInput 
    */ 
 function traitementVirgule(selecteurInput){
    $(selecteurInput).keypress(function(e){
     var inp_val = $(this).val();
     if (inp_val.indexOf(',') != -1) {
       var cut = inp_val.split(",");
       $(this).val(cut.join('.'));
     }
    });
 }

   traitementVirgule('.ht input');
   traitementVirgule('.htNormandie input');
   traitementVirgule('.depenseFrance input');
// traitement boutton radio partie genre
verifieNonSelectionne('#registration_genre_0','.genrePrecisionAutre');
verifieNonSelectionne('#registration_genre_1','.genrePrecisionAutre');
verifieNonSelectionne('#registration_genre_2','.genrePrecisionAutre');

 $('#registration_genre_0,#registration_genre_1,#registration_genre_2').click( function()
  {
   cacher('.genrePrecisionAutre'); 
   effacerDonneeInput('.genrePrecisionAutre input','#registration_genre_3'); 
  });                 
 $('#registration_genre_3').click(function(){
   voir('.genrePrecisionAutre');
 });
 
 // traitement boutton radio partie adaptationOeuvre
 verifieSelectionne('#registration_adaptationOeuvre_0','.adaptationOeuvrePrecision');

 $('#registration_adaptationOeuvre_1').click(function(){
   cacher('.adaptationOeuvrePrecision');
   effacerDonneeInput('.adaptationOeuvrePrecision input','#registration_adaptationOeuvre_0');
 });
 $('#registration_adaptationOeuvre_0').click(function(){
   voir('.adaptationOeuvrePrecision');
 });
 // traitement projet déposé par 
 
verifieSelectionneProjetDepose('#registration_deposant_0','.production');
verifierSelectionnePorjetDeposeMbudget('#registration_deposant_0','.montant-budget');

 $('#registration_deposant_0').click(function(){
   voir('.production');
   voir('.montant-budget');
 });
 $('#registration_deposant_1').click(function(){
   cacher('.production');
   effacerDonneeInput('.production input','#registration_deposant_0');
   voir('.auteurRealisateurs');
   // il faut cacher le champ montant budget pour le cas de auteur/realisateur
   cacher('.montant-budget');

 });
 // traitement financement acquis
 verifieSelectionne('#registration_financementAcquis_0','.financementAcquisPrecision');

 $('#registration_financementAcquis_0').click(function(){
   voir('.financementAcquisPrecision');
 });
 $('#registration_financementAcquis_1').click(function(){
   cacher('.financementAcquisPrecision');
   effacerDonneeInput('.financementAcquisPrecision input','#registration_financementAcquis_0');
 });

 // traiement dépôt collectivité 
 verifieSelectionne('#registration_depotProjetCollectivite_0','.depotProjetCollectivitePrecision');

 $('#registration_depotProjetCollectivite_0').click(function(){
   voir('.depotProjetCollectivitePrecision');
 });
 $('#registration_depotProjetCollectivite_1').click(function(){
   cacher('.depotProjetCollectivitePrecision');
   effacerDonneeInput('.depotProjetCollectivitePrecision input','#registration_depotProjetCollectivite_0');
 });
 
// traitement Projet Déjà presenté au fonds d'aide
verifieSelectionne('#registration_projetDejaPresenteFondsAide_0','.projetDejaPresenteFondsAidePrecision');

 $('#registration_projetDejaPresenteFondsAide_0').click(function(){
   voir('.projetDejaPresenteFondsAidePrecision');
 });
 $('#registration_projetDejaPresenteFondsAide_1').click(function(){
   cacher('.projetDejaPresenteFondsAidePrecision');
   effacerDonneeInput('.projetDejaPresenteFondsAidePrecision input','#registration_projetDejaPresenteFondsAide_0');
 });

// traitement autorisationtype d'aide développement
$('#registration_typeAideDoc_1').click(function(){
   if($('#registration_deposant_1').is(':checked')){
      alert('uniquement les producteurs peuvent déposer en développement');
   }
});

/**
 * Partie concerne uniquement projet Deposer par :
 *  verifie si le seclecteurVoir est coché et affhicher la div correspondante
 *  
 * @param {String} selecteurVoir 
 * @param {String} selecteurCache 
 */
 function verifieSelectionneProjetDepose(selecteurVoir,selecteurCache)
 {
   if($(selecteurVoir).is(':checked')){
      voir(selecteurCache);
   }else{
      if(!$(selecteurVoir).is(':visible')) {
         voir(selecteurCache);
      }else {
         cacher(selecteurCache);  
         voir('.auteurRealisateurs');
      }
   }
 }
 function effacerDonneeInput(selecteur,selecteuChecked)
 {
    $(selecteur).each(function(){  
         if( $(this).val() != ''){
            if( confirm(" En pousuivant votre action les données que vous avez saisie seront perdues, êtes vous sûr de vouloir continuer?"))
            {
               $(selecteur).val('');
            }else{
               $(selecteuChecked).click();
               //voir(selecteurVoir);
            }
            return false;
         }
       
      });
 }
 /**
  * Partie concerne tous les traitement où un clique sur le checkbox "oui" permet
  * d'afficher la div
  * 
  * @param {String} selecteurVoir 
  * @param {String} selecteurCache 
  */
 function verifieSelectionne(selecteurVoir,selecteurCache)
 {
   if($(selecteurVoir).is(':checked')){
      voir(selecteurCache);  
   }else{
      cacher(selecteurCache);  
   }
 }
 /**
  * Partie concerne tous les traitement où un clique sur le checkbox "oui" permet
  * de cacher la div
  * @param {String} selecteurVoir 
  * @param {String} selecteurCache 
  */
 function verifieNonSelectionne(selecteurVoir,selecteurCache)
 {
   if($(selecteurVoir).is(':checked')){
      cacher(selecteurCache);  
   }
 }
 /**
  *  permet de masquer 
  * @param {String} selecteur 
  */
 function  cacher(selecteur)
 {   
     $(selecteur).hide();  
 }
 /**
  * permet de demasque
  * @param {String} selecteur 
  */
function voir(selecteur)
{
   if(!$(selecteur).is(':visible')){
      $(selecteur).show();  
   }
}
// partie traitment de durée envisage pour le projet
if ($('#registration_typeFilm_0').is(':checked') )
{
   $('.dureeEnvisagee').html('Durée envisagée');
   cacher('.col-dureeEpisode');
}else if($('#registration_typeFilm_1').is(':checked')){
   $('.dureeEnvisagee').html('Nombre d\'épisodes');
   $('.dureeEpisode').html('Durée par épisode');
}


if(!$('.typeFilm').is(':visible')){
$('.dureeEnvisagee').html('Durée envisagée');
  cacher('.col-dureeEpisode');
}
// pour les cliks
$('#registration_typeFilm_0').click(function(){
   $('.dureeEnvisagee').html('Durée envisagée');
   cacher('.col-dureeEpisode');
})
$('#registration_typeFilm_1').click(function(){
   voir('.col-dureeEpisode');
   $('.dureeEnvisagee').html('Nombre d\épisodes');
   $('.dureeEpisode').html('Durée par épisode');
   
})

// gestion checkbox listeLiensEligibilite  pour n'afficher que les 3 prémiers

if($('.liensEligibiliteReste').is(':visible')){
   $('#registration_liensEligibilite_3').hide();
   $('label[for="registration_liensEligibilite_3"]').hide();
   $('#registration_liensEligibilite_4').hide();
   $('label[for="registration_liensEligibilite_4"]').hide();
}
/**
 * gestion des affichages champs montant du budget avec le boutton projet déposé 
 */
function verifierSelectionnePorjetDeposeMbudget()
{
   if($('#registration_deposant_0').is(':checked')){
      voir('.montant-budget');
   }else if($('#registration_deposant_1').is(':checked')){
      cacher('.montant-budget')
   }
}
// gestion des affichage du label montant du budget
if($('#registration_typeAideLm_0').is(':checked') || $('#registration_typeAideDoc_0').is(':checked'))
{
   $('label[for="montant-budget"]').html('montant du budget écriture HT');
}else
if($('#registration_typeAideLm_1').is(':checked')){
   $('label[for="montant-budget"]').html('montant du budget réécriture HT');
}else
if($('#registration_typeAideDoc_1').is(':checked')){
   $('label[for="montant-budget"]').html('montant du budget développement HT');
}else
{
   $('label[for="montant-budget"]').html('montant du budget HT');
}
// pour les clicks
 $('#registration_typeAideLm_0').click(function(){
   $('label[for="montant-budget"]').html('montant du budget écriture HT');
})
$('#registration_typeAideLm_1',).click(function(){
   $('label[for="montant-budget"]').html('montant du budget réécriture HT');
});

$('#registration_typeAideDoc_0').click(function(){
   $('label[for="montant-budget"]').html('montant du budget écriture HT');
});
$('#registration_typeAideDoc_1').click(function(){
   $('label[for="montant-budget"]').html('montant du budget développement HT');
});

// gestion nombre de caractère synopsis

$('#registration_synopsis').keypress(function(){
      longMax(this,600);
})
function longMax(element, max){
	var value = element.value;
	var max = parseInt(max);
	if(value.length > max){
      element.value = value.substr(0, max);
      $('label[for="synopsis"]').css('color','red');
	}
}

});


