var $collectionProjetPresentes;

// setup an "add a auteur/realisateur" button
var $addProjetPresenteButton = $('<button type="button" id="ajoutProjetPresentes" class="btn btn-primary my-4" >Ajouter un autre projet</button>');
var $newLinkDivProjetPresente = $('<div class=""></div>').append($addProjetPresenteButton);

jQuery(document).ready(function() {

    // Get the div that holds the collection of contacts
    $collectionProjetPresentes = $('div#projetPresentes');

    // add the "add a contact" anchor and div to the tags ul
    $collectionProjetPresentes.append($newLinkDivProjetPresente);
    
    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionProjetPresentes.data('index', $collectionProjetPresentes.find(':input').length);

    $addProjetPresenteButton.on('click', function(e) {
        addProjetPresente($collectionProjetPresentes, $newLinkDivProjetPresente);
    });

    // simuler l'ajout de trois ProjetPresentes
    if($('div#projetPresentes .form-group').length == 0 && $('.prototypeProjetPresente').is(':visible')){
        $addProjetPresenteButton.click();
        $addProjetPresenteButton.click();
        $addProjetPresenteButton.click();
    }
    // handle the removal, just for this example
    $('.remove-projetPresentes').click(function(e) {
        e.preventDefault();

        $('#ajoutProjetPresentes').show();
        //$('#widget-counter-documentAudioVisuels').val($count-1);

        $(this).parent().parent().parent().remove();

        return false;
    });
   
    verifieNonSelectionne('#registration_genre_0','.precisionAutre');

    function verifieNonSelectionne(selecteurVoir,selecteurCache)
    {
      if($(selecteurVoir).is(':checked')){
         cacher(selecteurCache);  
      }
    }
});

function addProjetPresente($collectionProjetPresentes, $newLinkDiv) {
    // Get the data-prototype explained earlier
    var prototypeProjetPresente = $collectionProjetPresentes.data('prototype');

    var arr = prototypeProjetPresente.split('<div class="form-group">');

    // get the new index
    var index = $collectionProjetPresentes.data('index');

    var newFormProjetPresente = prototypeProjetPresente;

    newFormProjetPresente = newFormProjetPresente.replace(/__name__/g, index);
    newFormProjetPresente = newFormProjetPresente.replace(/<label/g, '<label style="color:#000;"');

    // increase the index with one for the next item
    $collectionProjetPresentes.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var $newFormDivProjetPresente = $('<div class="projetPresentes"></div>').append(newFormProjetPresente);

    $newLinkDiv.before($newFormDivProjetPresente);

    // handle the removal, just for this example
    $('.remove-projetPresentes').click(function (e) {
        e.preventDefault();

        $('#ajoutProjetPresentes').show();

        $(this).parent().parent().parent().parent().remove();

        return false;
    });
    
    }
    function controlPreciser(e) {
        var v = $("#"+e.id).val();
        var id = e.id.substring(0,30);
        if( v === 'autre'){
            $("#"+id+"_precision").show();
        }else{
            $("#"+id+"_precision").hide();
        }
    }


