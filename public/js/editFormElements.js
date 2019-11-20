

jQuery(document).ready(function() {

    // add a new list form on click
    $('.addListButton').on('click', function(e) {
        
        var $collectionHolder = $(this).parent().find('.game_lists');

        // count the current form inputs we have (e.g. 2), use that as the new
        // index when inserting a new item (e.g. 2)
        $collectionHolder.data('index', $collectionHolder.find(':input').length);

        addTagForm($collectionHolder);
    });
});

function addTagForm($collectionHolder) {
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
    var $newFormDiv = $(div).append(newForm);

    var cross = '<a href="#" class="cross-cancel"><i class="fas fa-times-circle fa-2x cross-game-edit"></i></a>';

    // Add a remove button
    $newFormDiv.append(cross);

    $collectionHolder.append($newFormDiv);

    // handle the removal
    $('.cross-cancel').click(function(e) {
        e.preventDefault();
        
        $(this).parent().remove();
        
        return false;
    });
};