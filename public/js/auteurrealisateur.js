var $collectionAuteurRealisateur;

// setup an "add a auteur/realisateur" button
var $addAuteurButton = $('<button type="button" id="ajoutAuteur-realisateur" class="btn btn-primary my-4" >Ajouter un auteur réalisateur</button>');
var $newLinkDiv = $('<div class=""></div>').append($addAuteurButton);

jQuery(document).ready(function() {

    // Get the div that holds the collection of contacts
    $collectionAuteurRealisateur = $('div#auteurRealisateurs');

    // add the "add a contact" anchor and div to the tags ul
    $collectionAuteurRealisateur.append($newLinkDiv);

    $addAuteurButton.on('click', function(e) {
        // add a new auteur/realisateur form (see next code block)
        addAuteurForm($collectionAuteurRealisateur, $newLinkDiv);
    });


    // handle the removal, just for this example
    $('.remove-auteur').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });

});

function addAuteurForm($collectionAuteurRealisateur, $newLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionAuteurRealisateur.data('prototype');

    var arr = prototype.split('<div class="form-group">');

    // get the new index
    var index = $collectionAuteurRealisateur.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have

    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/<label/g, '<label style="color:#000; font-weight: bold"');

    // increase the index with one for the next item
    $collectionAuteurRealisateur.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<div class="auteurRealisateurs"></div>').append(newForm);

    $newLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.remove-auteur').click(function (e) {
        e.preventDefault();

        $(this).parent().parent().parent().remove();

        return false;
    });
}

