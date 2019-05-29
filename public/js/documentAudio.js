
   $('#ajoutDocumentAudioVisuels').click(function(){
    var countAudio = counterForm('#widget-counter-documentAudioVisuels');
    //traitementEvenClicks('#documentAudioVisuels','#widget-counter-documentAudioVisuels','#ajoutDocumentAudioVisuels');
    traitementEvenClicksDocumetAudio('#documentAudioVisuels',countAudio,'#ajoutDocumentAudioVisuels');
    
    // j'effectue la suppressesion du formulaire auteur réalisateur 
     supFormAuteurDocumentAudio('button[data-action="delete-documentAudioVisuels"]');
   // counterForm('#documentAudioVisuels div.form-group','#widget-counter-documentAudioVisuels');
 });

 
/**
  * 
  * @param {boolean} isAuteurRealisateur 
  * @param {Integer} counter 
  * @param {String} selecteurButton 
  */
 function traitementEvenClicksDocumetAudio(selecteurDiv,counter,selecteurButton){
    // je remplace tous les __name__ par ce numero
    const templates = $(selecteurDiv).data('prototype').replace(/__name__/g,counter);
    // j'injecte ce code au sein de la div 
    $(selecteurDiv).append(templates);
    let count = +$('#documentAudioVisuels div.form-group').length;
    if(count >= 2)
    {
       $(selecteurButton).hide();
    }
    $('#widget-counter-documentAudioVisuels').val(counter+1);
 }

 /**
  * supprime le formulaire auteur documentAudio
  * 
  * @param {String} boutton 
  */
 function supFormAuteurDocumentAudio(boutton) {
    $(boutton).click(function(){
       const target = this.dataset.target;
       $(target).remove();
       // je rend le button ajout visible à chaque suppression
       $('#ajoutDocumentAudioVisuels').show(); 
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

 function miseAjourCounter(selectDivForm, widget){
    const count = +$(selectDivForm).length;
    $(widget).val(count);
 }

 
 miseAjourCounter('#documentAudioVisuels div.form-group','#widget-counter-documentAudioVisuels');
 supFormAuteurDocumentAudio('button[data-action="delete-documentAudioVisuels"]');
 