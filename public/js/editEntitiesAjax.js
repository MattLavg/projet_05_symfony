$(document).ready(function () {
    
    // ADD ENTITY AJAX
    $('#addEntity').click(function(e) {
        e.preventDefault();
        // get url to add entity 
        url = $(this).attr('data-url');   
        
        // Hide success message
        $('.entityMessageSuccess').css('display', 'none');
        $('.entityMessageSuccess .entityMessageText').html();

        // Hide error message
        $('.entityMessageError').css('display', 'none');
        $('.entityMessageError .entityMessageText').html();
        
        $.post(
            url,
            {
                name : $('#addEntityInput').val() // get value of input
            },
            function(data){
                if(data.success){

                    // create a row
                    var ligne = '<tr>' +
                                '<td class="entityName">' + data.name + '</td>'+
                                '<td><a href="' + data.urlUpdateEntity + '" class="updateEntity">Modifier</a></td>'+
                                '<td><a href="' + data.urlDeleteEntity + '" class="deleteEntity">Retirer</a></td>' + 
                                '</tr>';

                    // add the row in the body's table
                    $('#table-dev table tbody').prepend(ligne);

                    // allows to give the action for the new create link "modifier"
                    $('#table-dev tbody tr:first .updateEntity').click(updateAction);

                    // allows to give the action for the new created link "supprimer"
                    $('#table-dev tbody tr:first .deleteEntity').click(deleteAction);

                    // remove the value in the input
                    $('#addEntityInput').val('');

                    // show success message
                    $('.entityMessageSuccess').css('display', 'block');
                    $('.entityMessageSuccess .entityMessageText').html('Vous avez ajouté un élément.');
                }
                else{

                    if (data.emptyInput) {
                        // show error message
                        $('.entityMessageError').css('display', 'block');
                        $('.entityMessageError .entityMessageText').html('Le champs doit être renseigné.');
                    } else {
                        // show error message
                        $('.entityMessageError').css('display', 'block');
                        $('.entityMessageError .entityMessageText').html('L\'élément n\'a pu être ajouté.');
                    }
                }
            },
            'json'
        );
    });

    // put the update action in variable
    var updateAction = function(e) {
        e.preventDefault();
        // get the name of the entity on the row
        var value = $(this).parent().parent().find('.entityName').html();

        // get the update entity url
        var dataUrl = $(this).attr('href');
 
        var inlineForm = '<form class="form-inline">' +
                         '<div class="form-group mx-sm-3 mb-2">' +
                         '<input type="text" class="form-control" class="updateEntityInput" value="' + value + '">' +
                         '</div>' +
                         '<button type="submit" class="btn btn-primary mb-2 validUpdateEntity" ' + 
                         'data-url="' + dataUrl + '">Modifier</button>' +
                         '<button type="button" class="btn btn-secondary ml-1 mb-2 cancelUpdateEntity" data-default-value="' + value + '">Annuler</button>'+
                         '</form>';

        // add the inline form 
        $(this).parent().parent().find('.entityName').html(inlineForm);

        // get the form button "modifier" of the row
        var updateBtn = $(this).parent().parent().find('.validUpdateEntity');

        // get the form button "annuler" of the row
        var cancelBtn = $(updateBtn).parent().find('.cancelUpdateEntity');

        $(updateBtn).click(function(e) {
            e.preventDefault();

            // get the update entity url
            url = $(this).attr('data-url'); 

            // Hide success message
            $('.entityMessageSuccess').css('display', 'none');
            $('.entityMessageSuccess .entityMessageText').html();

            // Hide error message
            $('.entityMessageError').css('display', 'none');
            $('.entityMessageError .entityMessageText').html();
            
            $.post(
                url,
                {
                    name : $(this).parent().find('input').val() // get value of input
                },
                function(data){
                    if(data.success){
    
                        // add the modified name in the td
                        $(updateBtn).parent().parent().prepend(data.name);
        
                        // remove the add form
                        $(updateBtn).parent().remove();

                        // show success message
                        $('.entityMessageSuccess').css('display', 'block');
                        $('.entityMessageSuccess .entityMessageText').html('Vous avez modifié un élément.');
                    }
                    else{

                        if (data.emptyInput) {
                            // show error message
                            $('.entityMessageError').css('display', 'block');
                            $('.entityMessageError .entityMessageText').html('Le champs doit être renseigné.');
                        } else {
                            // show error message
                            $('.entityMessageError').css('display', 'block');
                            $('.entityMessageError .entityMessageText').html('Impossible de modifier l\'élément');
                        }
                    }
                },
                'json'
            );
        });

        $(cancelBtn).click(function(e) {

            // get the value of row'input
            var defaultValue = $(this).data('default-value');

            // hide the error message if it's on page
            $(this).closest('main').find('.entityMessageError').css('display', 'none');

            // put the original value in tr
            $(this).parent().parent().html(defaultValue);

            // remove the add form
            $(this).parent().remove();
        });
    };

    // UPDATE ENTITY AJAX
    $('.updateEntity').click(updateAction);

    // put the delete action in variable
    var deleteAction = function(e) {
        e.preventDefault();

        var res = confirm("Souhaitez-vous effacer la ligne ?")

        if (res) {
            // get the delete entity url
            url = $(this).attr('href');
            
            // Hide success message
            $('.entityMessageSuccess').css('display', 'none');
            $('.entityMessageSuccess .entityMessageText').html();

            // Hide error message
            $('.entityMessageError').css('display', 'none');
            $('.entityMessageError .entityMessageText').html();

            var deleteBtn = $(this);
            
            $.get(
                url,
                function(data){
                    if(data.success){

                        $(deleteBtn).parent().parent().remove();

                        // show success message
                        $('.entityMessageSuccess').css('display', 'block');
                        $('.entityMessageSuccess .entityMessageText').html('Vous avez supprimé un élément.');
                    }
                    else{
                        // show error message
                        $('.entityMessageError').css('display', 'block');
                        $('.entityMessageError .entityMessageText').html('Impossible de supprimer l\'élément');
                    }
                },
                'json'
            );
        }
    };

    // DELETE ENTITY AJAX
    $('.deleteEntity').click(deleteAction);

});