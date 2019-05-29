 // simuler l'ajout d'un auteursRealisateur
   
 var count = counterForm('#widget-counter');
 if( count == 0 ) {
    traitementEvenClicksAuteurRealisateur('#auteurRealisateurs',count,'#ajoutAuteur-realisateur');
    // j'effectue la suppressesion du formulaire auteur réalisateur 
    supFormAuteurRealisateur('button[data-action="delete"]');
 }

  
 // gerer l'ajout d'un auteur ou/et d'un réalisateur lors qu'on clique sur le button
 $('#ajoutAuteur-realisateur').click(function()
 { 
    var count = counterForm('#widget-counter');

    //traitementEvenClicks('#auteurRealisateurs','#widget-counter','#ajoutAuteur-realisateur');
    traitementEvenClicksAuteurRealisateur('#auteurRealisateurs',count);
    // j'effectue la suppressesion du formulaire auteur réalisateur 
    supFormAuteurRealisateur('button[data-action="delete"]');
    //counterForm('#auteurRealisateurs div.form-group','#widget-counter');
     
 });

 /**
    * 
    * @param {String} selecteurDiv 
    *  @param {String} counter
    */
   function traitementEvenClicksAuteurRealisateur(selecteurDiv,counter){
    // je recupère le numero des forms !, je le met en comment pour tester avec counter
   // let index  = +$(widget_counter).val();
    // je remplace tous les __name__ par ce numero
    const str = '<div class="row my-3" id="blockPourcentage_registration_auteurRealisateurs___name__"><div class="col"><p id="para_registration_auteurRealisateurs___name__"></p></div><div class="col"><div class="row"><div><input type="text" id="registration_auteurRealisateurs___name___pourcentageAuteurRealisateur" name="registration[auteurRealisateurs][__name__][pourcentageAuteurRealisateur]" class="form-control-sm w-100" /></div><span>%</span></div></div></div>';
    const templates = $(selecteurDiv).data('prototype').replace(str,'').replace(/__name__/g,counter);
    const newStr = str.replace(/__name__/g,counter);
    // j'injecte ce code au sein de la div 
    $(selecteurDiv).append(templates);
    $('.pourcentageAuteurRealisateur').append(newStr);
    $('#widget-counter').val(counter+1);

    // gestion des labels pourcentage auteurs réalisateur
    $('.prenom').on('change',function(){
       // je récupère le nombre correspondant à l'id dans ce input
      var valAttId = $(this).attr('id').match(/\d+/g).join('');
      var scan = $(this).val()+"   "+$('.nom').val()+" a";
       $('.pourcentageAuteurRealisateur p').each(function(){
          var valAttIdPourc = $(this).attr('id').match(/\d+/g).join('');
          if( valAttId == valAttIdPourc )
          {
             $(this).html(scan);
             // quant on arrive ici pas besoin de continuer à chercher 
             return false;
          }
       });
   });

   $('.nom').on('change',function(){
      // je récupère le nombre correspondant à l'id dans ce input
     var valAttId = $(this).attr('id').match(/\d+/g).join('');
     var scan = $('.prenom').val() +"   "+$(this).val().toUpperCase()+"  a ";
    $('.pourcentageAuteurRealisateur p').each(function(){
       var valAttIdPourc = $(this).attr('id').match(/\d+/g).join('');
       if( valAttId == valAttIdPourc )
       {
          $(this).html(scan);
          return false;
       }
    });
});
 }

 /**
    * compte le nombre de fois qu'on a ajouté un formulaire 
    * 
    * @param {String} widget_counter 
    */
   function counterForm(widget_counter)
   {  
      var estimeDiv = +$(widget_counter).val();
      return estimeDiv;
   }
   /**
    * supprime le formulaire auteur réalisateur
    * 
    * @param {String} boutton 
    */
   function supFormAuteurRealisateur(boutton) {
    $(boutton).click(function(){
    const target = this.dataset.target;
    $(target).remove();
    });
 }
/**
 * Permet de mettre à jour le compteur
 * @param {String} selectDivForm 
 * @param {String} widget 
 */
   function miseAjourCounter(selectDivForm, widget){
      const count = +$(selectDivForm).length;
      $(widget).val(count);
   }
 miseAjourCounter('#auteurRealisateurs div.form-group','#widget-counter');
 supFormAuteurRealisateur('button[data-action="delete"]');