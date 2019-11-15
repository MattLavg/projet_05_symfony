var $collectionHolder;

// setup an "add a tag" link
var $addTagButton = $('<button type="button" class="add_tag_link">Add a tag</button>');
var $newLinkLi = $('#game_developers').append($addTagButton);
var cross = '<a href="#" class="cross-cancel"><i class="fas fa-times-circle fa-2x cross-game-edit"></i></a>';

jQuery(document).ready(function() {
   
    // Get the ul that holds the collection of tags
    $collectionHolder = $('#game_developers');

    // add the "add a tag" anchor and li to the tags ul
    $collectionHolder.append($newLinkLi);

    // count the current form inputs we have (e.g. 2), use that as the new
    // index when inserting a new item (e.g. 2)
    $collectionHolder.data('index', $collectionHolder.find(':input').length);

    $addTagButton.on('click', function(e) {
        // add a new tag form (see next code block)
        addTagForm($collectionHolder, $newLinkLi);
    });
});

function addTagForm($collectionHolder, $newLinkLi) {
    // Get the data-prototype explained earlier
    var prototype = $collectionHolder.data('prototype');

    // get the new index
    var index = $collectionHolder.data('index');

    var newForm = prototype;
    // You need this only if you didn't set 'label' => false in your tags field in TaskType
    // Replace '__name__label__' in the prototype's HTML to
    // instead be a number based on how many items we have
    // newForm = newForm.replace(/__name__label__/g, index);

    // Replace '__name__' in the prototype's HTML to
    // instead be a number based on how many items we have
    newForm = newForm.replace(/__name__/g, index);

    // increase the index with one for the next item
    $collectionHolder.data('index', index + 1);

    // Display the form in the page in an li, before the "Add a tag" link li
    var div = '<div class="position-relative pl-5"></div>';
    var $newFormLi = $(div).append(newForm);
    // var $newFormLi = $('<div></div>').append(newForm);


    // also add a remove button, just for this example
    // $newFormLi.append('<a href="#" class="remove-tag">x</a>');
    $newFormLi.append(cross);

    // $newLinkLi.before($newFormLi);
    $('#game_developers button').before($newFormLi);

    // handle the removal, just for this example
    $('.cross-cancel').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
}