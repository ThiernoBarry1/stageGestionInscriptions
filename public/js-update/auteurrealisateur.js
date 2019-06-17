var $collectionAuteurRealisateur;

// setup an "add a auteur/realisateur" button
var $addAuteurButton = $('<button type="button" id="ajoutAuteur-realisateur" class="btn btn-primary my-4" >Ajouter un auteur réalisateur</button>');
var $newLinkDiv = $('<div class=""></div>').append($addAuteurButton);

var $newpourcentage;
var $str = '<div class="row my-3" id="blockPourcentage_registration_auteurRealisateurs___name__"><div class="col-auto"><p id="para_registration_auteurRealisateurs___name__"></p></div><div class="col"><div class="row"><div><input type="text" id="registration_auteurRealisateurs___name___pourcentageAuteurRealisateur" name="registration[auteurRealisateurs][__name__][pourcentageAuteurRealisateur]" class="form-control-sm" style="width:3rem" /></div><span>%</span></div></div></div>';


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
    });

    // handle the removal, just for this example
    $('.remove-auteur').click(function(e) {
        e.preventDefault();
        $(this).parent().parent().parent().remove();
        $($(this).attr('data-target')).remove();

        return false;
    });

});

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


    newForm = newForm.replace($str, '');

    newForm = newForm.replace(/__name__/g, index);

    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/<label/g, '<label style="color:#000;"');

    str = $str.replace(/__name__/g, index);
    var newFormPourcentage = $('<div class="pourcentageAuteurRealisateur"></div>').append(str);

    // increase the index with one for the next item
    $collectionAuteurRealisateur.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<div class="auteurRealisateur"></div>').append(newForm);

    $newLinkDiv.before($newFormDiv);

    $newpourcentage.before(newFormPourcentage);

    // handle the removal, just for this example
    $('.remove-auteur').click(function (e) {
        e.preventDefault();

        $(this).parent().parent().parent().remove();
        $($(this).attr('data-target')).remove();

        return false;
    });
}

function recupererauteur(e) {
    var id = (e.id).match(/\d+/g).join('');
    var prenom = '#registration_auteurRealisateurs_' + id +'_prenom';
    var nom = '#registration_auteurRealisateurs_' + id +'_nom';

    $('#para_registration_auteurRealisateurs_' + id).text($(prenom).val()+ ' ' + $(nom).val()) ;
}



