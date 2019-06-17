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

    var count = $('.documentAudioVisuel').length;

    if(count >= 2)
    {
        $('#ajoutDocument').hide();
    }

    $addDocumentButton.on('click', function(e) {
        var count = $('.documentAudioVisuel').length;

        if(count < 2){
            addDocumentForm($collectionDocuments, $newLinkDivDoc);
        }
        if(count >= 1){
            $('#ajoutDocument').hide();
        }
    });

    // handle the removal, just for this example
    $('.remove-document').click(function(e) {
        e.preventDefault();

        $('#ajoutDocument').show();
        //$('#widget-counter-documentAudioVisuels').val($count-1);

        $(this).parent().parent().parent().remove();

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

    newForm = newForm.replace(/__name__/g, index);
    newForm = newForm.replace(/<label/g, '<label style="color:#000;"');

    // increase the index with one for the next item
    $collectionDocuments.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDivDoc = $('<div class="documentAudioVisuel"></div>').append(newForm);

    $newLinkDiv.before($newFormDivDoc);

    // handle the removal, just for this example
    $('.remove-document').click(function (e) {
        e.preventDefault();

        $('#ajoutDocument').show();

        $(this).parent().parent().parent().parent().remove();

        return false;
    });
}

