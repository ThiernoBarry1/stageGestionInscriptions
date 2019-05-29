var $collectionDocuments;

// setup an "add a auteur/realisateur" button
var $addDocumentButton = $('<button type="button" id="ajoutDocument" class="btn btn-primary my-4" >Ajouter un document audiovisuel</button>');
var $newLinkDivDoc = $('<div class=""></div>').append($addDocumentButton);

jQuery(document).ready(function() {

    // Get the div that holds the collection of contacts
    $collectionDocuments = $('div#documentAudioVisuels');

    // add the "add a contact" anchor and div to the tags ul
    $collectionDocuments.append($newLinkDivDoc);
    
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionDocuments.data('index', $collectionDocuments.find(':input').length);

    $addDocumentButton.on('click', function(e) {
        // add a new contact form (see next code block)
        addDocumentForm($collectionDocuments, $newLinkDivDoc);
    });


    // handle the removal, just for this example
    $('.remove-document').click(function(e) {
        e.preventDefault();

        $(this).parent().remove();

        return false;
    });

});

function addDocumentForm($collectionDocuments, $newLinkDiv) {
    // Get the data-prototype explained earlier
    var prototype = $collectionDocuments.data('prototype');

    var arr = prototype.split('<div class="form-group">');

    // get the new index
    var index = $collectionDocuments.data('index');

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
    $collectionDocuments.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDiv = $('<div class="documentAudioVisuels"></div>').append(newForm);

    $newLinkDiv.before($newFormDiv);

    // handle the removal, just for this example
    $('.remove-document').click(function (e) {
        e.preventDefault();

        $(this).parent().parent().parent().remove();

        return false;
    });
}

