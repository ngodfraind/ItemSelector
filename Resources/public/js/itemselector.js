(function () {
    'use strict';

    //iframe fullpage
    $(".popout").on('click', function(){
        $(".fullframe").css({"position":"fixed","top":0,"left":0,"width":"100%","height":"100%","background-color":"#FFFFFF","z-index":1e4})
        $(this).hide();
        $(".popin").show();
    });
    $(".popin").on('click', function(){
        $(".fullframe").css({"position":"relative"})
        $(this).hide();
        $(".popout").show();
    });

    //tabs
    function selecttab(i){
        $(".dfasmcontent").hide();
        if ($("#text_content-"+i)) {
            $("#text_content-"+i).show();
            $(".dfasmtab").parent().removeClass("active");
            $("a[data-id="+i+"]").parent().addClass("active");
        }
    }
    selecttab(1);
    $("#dfasm .nav-tabs a").on('click', function(e){
        var id = $(this).attr("data-id");
        selecttab(id);
    });

    //Show exercises
    $('.show-exercices').on('click', function(){
        $('#dfasm').toggle();
        $('.show-exercices span').toggleClass('fa-eye-slash');
    });

    //maximize frame height
    $(".activity-iframe").load(function() {
        $(this).height( $(this).contents().find("html").height() );
    });

    var $collectionHolder = $('ul.isel-item');
    var $addItemLink = $('<a href="#" class="add_item_link btn btn-info"><span class="fa fa-plus"></span> Ajouter un item</a>');
    var $newLink = $('<li></li>').append($addItemLink);

    // add a delete link to all of the existing Item form li elements
    $collectionHolder.find('li.item').each(function() {
        addItemFormDeleteLink(this);
    });

    // add the "add an item" anchor and li to the tags ul
    $collectionHolder.append($newLink);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addItemLink.on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // add a new item form (see code block below)
        addItemForm($collectionHolder, $newLink);
    });
}());

function addItemForm($collectionHolder, $newLink) {
    // Get the data-prototype
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    // Replace '$$name$$' in the prototype's HTML to
    // instead be a number based on how many items we have
    var newForm = prototype.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add an Item" link li
    var $newFormLi = $('<li class="item"></li>').append(newForm);

    // also add a remove button, just for this example
    //$newFormLi.append('<a href="#" class="remove-item btn btn-danger">x</a>');

    $newLink.before($newFormLi);

    // add a delete link to the new form
    addItemFormDeleteLink($newFormLi);

    // handle the removal
    $('.remove-item').click(function(e) {
        e.preventDefault();
        $(this).parent().remove();
        return false;
    });
}

function addItemFormDeleteLink($itemFormLi) {
    var $removeFormA = $('<td><a href="#" class="remove-item btn btn-danger"><span class="fa fa-trash"></span></a></td>');
    $($itemFormLi).find("tr").append($removeFormA);

    $($removeFormA).find("a").on('click', function(e) {
        // prevent the link from creating a "#" on the URL
        e.preventDefault();

        // remove the li for the tag form
        $itemFormLi.remove();
    });
}