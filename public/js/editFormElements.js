$(document).ready(function () {
    
    // On update (game-edit) page with informations already set
    // get the first element and do not display delete cross
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').find('.cross-cancel-game-update').css('display', 'none');
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').removeClass('pl-5');

    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').find('.cross-cancel-release-game-update').css('display', 'none');
    $('.entity-group-game-edit').find('.bloc-entity-game-edit:first').removeClass('background-release-game-update');



    // put the delete entity list in variable
    var deleteEntityList = function(e) {
        e.preventDefault();
        $(this).parent().remove();
    };

    // DELETE DEVELOPER INPUT 
    $('.cross-cancel-game-update').click(deleteEntityList);

    // ADD and DELETE entity list INPUT IN FORM GAME EDIT
    var nbList = 0;

    $('.addEntityForm').click(function(e) {
        nbList++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');

        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);

        // Delete the error message in red
        $(this).parent().find('.bloc-entity-game-edit:last').find('.redText').css('display', 'none');

        // if cross with cross-cancel-game-update class exists
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update')) {
 
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update').css('display', 'block');
            // apply the delete function to the new cross icon on form game update
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-game-update').click(deleteEntityList);

        } 
        
        // if cross with cross-cancel class exists
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel')) {

            // display cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel').click(deleteEntityList);
        }
 
        // add the padding class
        $(this).parent().find('.bloc-entity-game-edit:last').addClass('pl-5');

        if ($(this).parent().find('select:last').hasClass('developerList')) {

            $(this).parent().find('select:last').attr('name', 'developer[' + nbList + ']');

        } else if ($(this).parent().find('select:last').hasClass('genreList')) {

            $(this).parent().find('select:last').attr('name', 'genre[' + nbList + ']');

        } else if ($(this).parent().find('select:last').hasClass('modeList')) {

            $(this).parent().find('select:last').attr('name', 'mode[' + nbList + ']');

        }
    });



    $('.date').each(function(index) {
        nbList++;

        $(this).datepicker($.extend({ 
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "1980:2023", 
            altFormat: 'yy-mm-dd',
            altField: $(this).next()
        },
        $.datepicker.regional[ "fr" ]));

        $(this).datepicker('option', 'altField', $(this).next());

        // apply the delete function to the cross icon available
        $(this).parent().find('.cross-cancel-release-game-update').click(deleteEntityList);

        if ($(this).parent().find('.platformList')) {
            $(this).parent().find('.platformList').attr('name', 'releaseDate[' + nbList + '][platform]');
        }

        if ($(this).parent().find('.publisherList')) {
            $(this).parent().find('.publisherList').attr('name', 'releaseDate[' + nbList + '][publisher]');
        }

        if ($(this).parent().find('.regionList')) {
            $(this).parent().find('.regionList').attr('name', 'releaseDate[' + nbList + '][region]');
        }

        if ($(this).parent().find('.altDate')) {
            $(this).parent().find('.altDate').attr('name', 'releaseDate[' + nbList + '][date]');
        }

    });




    $('#addReleaseDateForm').click(function(e) {
        nbList++;

        // get the bloc where list of entities are duplicated
        var blocEntityList = $(this).parent().find('.entity-group-game-edit');
        // clone the entity list
        $(this).parent().find('.bloc-entity-game-edit:first').clone().appendTo(blocEntityList);

        // Delete the error message in red
        $(this).parent().find('.bloc-entity-game-edit:last').find('.redText').css('display', 'none');

        // if delete cross 
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release')) {
            // display the first cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release').click(deleteEntityList);
        }

        // iff delete cross on update page
        if ($(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update')) {
            // display the first cross
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update').css('display', 'block');
            // apply the delete function to the new cross icon
            $(this).parent().find('.bloc-entity-game-edit:last').find('.cross-cancel-release-game-update').click(deleteEntityList);
        }

        
        // add a background color, border-radius and padding
        $(this).parent().find('.bloc-entity-game-edit:last').css({'background-color': '#F2F2F2', 'border-radius': '10px', 'padding': '10px'});
        // add the padding class
        $(this).parent().find('.bloc-entity-game-edit:last').addClass('pl-5');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.platformList').attr('name', 'releaseDate[' + nbList + '][platform]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.publisherList').attr('name', 'releaseDate[' + nbList + '][publisher]');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.regionList').attr('name', 'releaseDate[' + nbList + '][region]');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeAttr('id');
        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').removeClass('hasDatepicker');

        $(this).parent().find('.bloc-entity-game-edit:last').find('.altDate').attr('name', 'releaseDate[' + nbList + '][date]');
        

        $(this).parent().find('.bloc-entity-game-edit:last').find('.date').datepicker($.extend({ 
            changeMonth: true,
            changeYear: true,
            showButtonPanel: true,
            yearRange: "1980:2023", 
            altFormat: 'yy-mm-dd',
            altField: $(this).parent().find('.bloc-entity-game-edit:last').find('.date').next()
         },
        $.datepicker.regional[ "fr" ]));

    });
});