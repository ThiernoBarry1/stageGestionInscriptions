var $collectionAuteurRealisateur;

// setup an "add a auteur/realisateur" button
var $addAuteurButton = $('<button type="button" id="ajoutAuteur-realisateur" class="btn btn-primary my-4" >Ajouter un auteur réalisateur</button>');
var $newLinkDiv = $('<div class=""></div>').append($addAuteurButton);

var $newpourcentage;
//var $str = '<div class="row my-3" id="blockPourcentage_registration_auteurRealisateurs___name__"><div class="col-auto"><label id="para_registration_auteurRealisateurs___name__" style="color:#000;"></label></div><div class="col"><div class="row"><div><input type="text" id="registration_auteurRealisateurs___name___pourcentageAuteurRealisateur" name="registration[auteurRealisateurs][__name__][pourcentageAuteurRealisateur]" class="form-control-sm" style="width:3rem" /></div><span>%</span></div></div></div>';
var $str = '<div class="row my-3" id="blockPourcentage_registration_auteurRealisateurs___name__"><div class="col-auto"><label id="para_registration_auteurRealisateurs___name__"></label></div><div class="col"><div class="row"><div class="form-group"><input type="text" id="registration_auteurRealisateurs___name___pourcentageAuteurRealisateur" name="registration[auteurRealisateurs][__name__][pourcentageAuteurRealisateur]" class="form-control-sm form-control" style="width:3rem" /></div><span>%</span></div></div></div>';

jQuery(document).ready(function() {
    
    // Get the div that holds the collection of contacts
    $collectionAuteurRealisateur = $('div#auteurRealisateurs');
    
    // add the "add a contact" anchor and div to the tags ul
    $collectionAuteurRealisateur.append($newLinkDiv);
    
    $newpourcentage = $('div#test');
    
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionAuteurRealisateur.data('index', $collectionAuteurRealisateur.find(':input').length);
    
    $addAuteurButton.on('click', function(e) {
        
        // add a new auteur/realisateur form (see next code block)

        addAuteurForm($collectionAuteurRealisateur, $newLinkDiv, $newpourcentage, $str);
        displayPourcentage();
    });
   
   // simuler l'ajout d'un auteur/realisateur
    if($('div#auteurRealisateurs .form-group').length == 0 && $('.prototypeAuteurRealisateur').is(':visible')){
        $addAuteurButton.click();
    }
    
    //$('div#auteurRealisateurs .form-group:first-child').find('.remove-auteur:first-child').hide();
    
    // handle the removal, just for this example
    $('.remove-auteur').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().parent().remove();
        $($(this).attr('data-target')).remove();
        displayPourcentage();
        return false;
    });

    
/* permet de masquer ou afficher les champs pourcentage
le but c'est d'afficher les champs % si  et seulement si les deux condition sont remplies:
-le boutton "le producteur" est coché 
-il ya au moins deux auteur.s/realisateur.s 
*/
displayPourcentage();

if($('#registration_deposant_0').is(':checked'))
{
    $('.pourcentageAuteurRealisateur').hide();
}  
if( $('#registration_deposant_1').is(':checked'))
{  
    displayPourcentage();
}  
$('#registration_deposant_0').click(function(){
    $('.pourcentageAuteurRealisateur').hide();
}) 
$('#registration_deposant_1').click(function()
{
    displayPourcentage();
}) 





function displayPourcentage()
{
   const count = +$('.nombreAuteurRealisateurTheme').length + +$('.nombreAuteurRealisateurBoucle').length;
  
   if( count <= 1  || $('.production-fildset').is(':visible'))
    {
       $('.pourcentageAuteurRealisateur').hide();
    }else
    {
       $('.pourcentageAuteurRealisateur').show();
    }
}
});

// je déclare à nouveau la même fonction pour m'en servir dans la méthode addAuteurForm(), dans la partie remove
// sinon, cette dernière ne vas pas prendre en compte celle qui se trouve dans le block ready juste en dessus.

function displayPourcentage()
{
    const count = $('.nombreAuteurRealisateurTheme').length + $('.nombreAuteurRealisateurBoucle').length;
    if( count <= 1  || $('.production').is(':visible'))
    {
       $('.pourcentageAuteurRealisateur').hide();
    }else
    {
       $('.pourcentageAuteurRealisateur').show();
    }
}
function addAuteurForm($collectionAuteurRealisateur, $newLinkDiv, $newpourcentage, $str) {
    // Get the data-prototype explained earlier
    var prototype = $collectionAuteurRealisateur.data('prototype');

    // get the new index
    var index = $collectionAuteurRealisateur.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have

    console.log(newForm);
    newForm = newForm.replace($str, '');

    newForm = newForm.replace(/__name__/g, index);

    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/<label/g, '<label style="color:#000;"');
   //if(!$('#registration_deposant_0').is(':checked')) {
       str = $str.replace(/__name__/g, index);
       var newFormPourcentage = $('<div class="pourcentageAuteurRealisateur"></div>').append(str);
   //}

    // increase the index with one for the next item
    $collectionAuteurRealisateur.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<div class="auteurRealisateur"></div>').append(newForm);

    $newLinkDiv.before($newFormDiv);
    $newpourcentage.before(newFormPourcentage);
    
    // handle the removal, just for this example
    $('.remove-auteur').click(function (e) {
        e.preventDefault();

        $(this).parent().parent().parent().parent().remove();
        $($(this).attr('data-target')).remove();
        displayPourcentage();
        return false;
    });
}

    function recupererauteur(e) {
        var id = (e.id).match(/\d+/g).join('');
        var prenom = '#registration_auteurRealisateurs_' + id +'_prenom';
        var nom = '#registration_auteurRealisateurs_' + id +'_nom';
    
        $('#para_registration_auteurRealisateurs_' + id).text(' Part de  '+ $(prenom).val()+ ' ' + $(nom).val()) ;
    }
