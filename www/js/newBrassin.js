$( function() {

$("#brasseriebundle_brassin_date_brassage").datepicker($.datepicker.regional['fr']);
$("#brasseriebundle_brassin_date_ajoutLevure").datepicker($.datepicker.regional['fr']);
$("#brasseriebundle_brassin_date_miseAuFroid").datepicker($.datepicker.regional['fr']);
$("#brasseriebundle_brassin_date_embouteillage").datepicker($.datepicker.regional['fr']);

});


var $empatagesHolder;
var empatagesHtml;
var indexEmpatages = 0;
var $addEmpatagesLink = $('<a href="#" class="add_empatages_link">+ empatage</a>');
var $newLinkLiEmpatages = $('<div class="col-sm-12 addLinkCollections"></div>').append($addEmpatagesLink);


var $ebulitionsHolder;
var ebulitionsHtml;
var indexEbulitions = 0;
var $addEbulitionsLink = $('<a href="#" class="add_ebulitions_link">+ ébulition</a>');
var $newLinkLiEbulitions = $('<div class="col-sm-12 addLinkCollections"></div>').append($addEbulitionsLink);


jQuery(document).ready(function() {

    initEmpatages();

    initEbulitions();
});


function initEmpatages() {

    $empatagesHolder = $('.empatagesCollectionForm');
    empatagesHtml = $empatagesHolder.children(":first").prop('innerHTML');

    console.log("$empatagesHolder", $empatagesHolder);

    indexEmpatages = ($('.empatagesCollectionForm select').length / 2) - 1;

    //console.log("$empatagesHolder", $empatagesHolder.prop('innerHTML'));

    $empatagesHolder.after($newLinkLiEmpatages);

    $addEmpatagesLink.on('click', function(e) {
        e.preventDefault();
        addForm(empatagesHtml, "empatages", indexEmpatages, $empatagesHolder, "malt", "flocon");
    });

    for (var i = 0; i <= indexEmpatages; i++) {
        setDisabledAttribute(i, "empatages", "malt", "flocon");
    } 
}


function initEbulitions() {

    $ebulitionsHolder = $('.ebulitionsCollectionForm');
    ebulitionsHtml = $ebulitionsHolder.children(":first").prop('innerHTML');

    console.log("$ebulitionsHolder", $ebulitionsHolder);

    indexEbulitions = ($('.ebulitionsCollectionForm select').length / 2) - 1;

    //console.log("$empatagesHolder", $empatagesHolder.prop('innerHTML'));

    $ebulitionsHolder.after($newLinkLiEbulitions);

    $addEbulitionsLink.on('click', function(e) {
        e.preventDefault();
        addForm(ebulitionsHtml, "ebulitions", indexEbulitions, $ebulitionsHolder, "houblon", "epice");
    });

    for (var n = 0; n <= indexEbulitions; n++) {
        setDisabledAttribute(n, "ebulitions", "houblon", "epice");
    } 

}


function setDisabledAttribute(_index, _type, _select1, _select2) {

    console.log("newBrassin.js => setDisabledAttribute : index, _type ", _index, _type);

    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).change(function() {

        console.log("malt 1 val : ", $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).val());
        
        if ($("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).val() == "") {
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).attr('disabled', false);
        } else {
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).attr('disabled', true);
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).val("");
        }
        
    });
        
        
    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).change(function() {
    
        console.log("flocon 1 val : ", $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).val());
    
        if ($("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).val() == "") {
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).attr('disabled', false);
        } else {
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).attr('disabled', true);
            $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).val("");
        }
    
    });
}



function addForm(collectionHolder, type, index, holder, select1, select2) {

    var newForm = collectionHolder;

    newForm = newForm.replace(/0/g, ++index);

    if (type == "empatages") {
        indexEmpatages++;
    } else {
        indexEbulitions++;
    }

    console.log("newForm", newForm);

    holder.append('<div class="form-group col-sm-12">' + newForm + '</div>');

    //console.log("$empatagesHolder 2", $empatagesHolder.prop('innerHTML'));

    setDisabledAttribute(index, type, select1, select2);

    resetEmpatage(index, type, select1, select2);
}


function resetEmpatage(_index, _type, _select1, _select2)
{
    console.log("$resetEmpatage : _index", _index);

    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select1).val("");
    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_" + _select2).val("");
    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_quantite").val("");

    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_pourcentage").val("");
    $("#brasseriebundle_brassin_" + _type + "_" + _index + "_duree").val("");
}