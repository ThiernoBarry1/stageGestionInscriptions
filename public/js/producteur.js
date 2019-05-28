var $collectionProducteurs;

var $newLinkDivProd = $('<div></div>');

jQuery(document).ready(function() {

    // Get the div that holds the collection of contacts
    $collectionProducteurs = $('div#producteurs');

    // add the "add a contact" anchor and div to the tags ul
    $collectionProducteurs.append($newLinkDivProd);

    addProducteurForm($collectionProducteurs, $newLinkDivProd);

});

function addProducteurForm($collectionProducteurs, $newLinkDivProd) {
    // Get the data-prototype explained earlier
    var prototype = $collectionProducteurs.data('prototype');

    var arr = prototype.split('<div class="form-group">');

    // get the new index
    var index = $collectionProducteurs.data('index');

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
    $collectionProducteurs.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDivProd = $('<div id="producteurs"></div>').append(newForm);

    $newLinkDivProd.before($newFormDivProd);
}

