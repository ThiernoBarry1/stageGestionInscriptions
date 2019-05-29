// simuler l'ajout d'un producteur
if(!$('#producteur').is(':visible')) {
    const templates = $('#producteurs').data('prototype').replace(/__name__/g,0);
    // j'injecte ce code au sein de la div 
    $('#producteurs').append(templates);
 }