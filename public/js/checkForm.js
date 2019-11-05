$(document).ready(function () {
    
    // Regular expressions variables
    var mailRegexp = '^[a-z0-9._-]+@[a-z0-9._-]{2,}\.[a-z]{2,4}$';
    var passwordRegexp = '^[a-zA-Z0-9_-]{6,16}$';
    var nameGameRegexp = '^[a-zA-Z0-9 _-]+$';
    // var nickNameRegexp = '';
    var intRegexp = '^[0-9]+$';
    var dateRegexp = '^[0-9]{2}/[0-9]{2}/[0-9]{4}$';


    function checkInputForm(element, elementName = false, regexp) {

        if (element.val() == '') {

            if (!elementName) {
                element.parent().find('.redText').text('Vous devez renseigner tous les éléments composant la date de sortie d\'un jeu');
                element.parent().find('.redText').css('display', 'block');

                element.change(function(e) {
                    element.parent().find('.redText').css('display', 'none');
                });
            } else {
                element.next().text('Vous devez renseigner ' + elementName + '.');
                element.next().css('display', 'block');

                element.change(function(e) {
                    element.next().css('display', 'none');
                });
            }

            return false;

        } else if (!element.val().match(regexp)) {

            if (!elementName) {
                element.parent().find('.redText').text('La date de sortie du jeu n\'est pas valide.');
                element.parent().find('.redText').css('display', 'block');

                element.change(function(e) {
                    element.parent().find('.redText').css('display', 'none');
                });
            } else {
                // Replace the first letter of 'elementName'
                var elementName = elementName.replace(/^\w/, 'L');

                element.next().text(elementName + ' n\'est pas valide.');
                element.next().css('display', 'block');

                element.change(function(e) {
                    element.next().css('display', 'none');
                });
            }
            
            return false;
        } 

        return true;
    }


    function checkTextareaTinymceForm(elementName) {

        if (tinymce.activeEditor.getContent() == '') {

            $('.missContent').text('Vous devez renseigner ' + elementName + '.');
            $('.missContent').css('display', 'block');

            return false;
        } 

        return true;
    }


    // Check inputs in login form
    $('#loginForm').on('click', '.loginBtn', function(e) {

        if (!checkInputForm($('#identificationEmail'), 'l\'email', mailRegexp,)) {
            e.preventDefault();
        } 
        
        if (!checkInputForm($('#identificationPassword'), 'le mot de passe', passwordRegexp,)) {
            e.preventDefault();
        } 
    });

    // Check inputs in inscription form
    $('#inscriptionForm').on('click', '.inscriptionBtn', function(e) {

        if (!checkInputForm($('#inscriptionNickname'), 'le pseudo', nameGameRegexp,)) {
            e.preventDefault();
        }

        if (!checkInputForm($('#inscriptionEmail'), 'l\'email', mailRegexp,)) {
            e.preventDefault();
        } 
        
        if (!checkInputForm($('#inscriptionPassword'), 'le mot de passe', passwordRegexp,)) {
            e.preventDefault();
        } 

        if (!checkInputForm($('#confirmationPassword'), 'la confirmation de mot de passe', passwordRegexp,)) {
            e.preventDefault();
        }
    });

    // Check inputs for update member informations form
    $('#updateInfosMember').on('click', '.updateInfosMemberBtn', function(e) {

        if (!checkInputForm($('#memberNickname'), 'le pseudo', nameGameRegexp,)) {
            e.preventDefault();
        }

        if (!checkInputForm($('#memberEmail'), 'l\'email', mailRegexp,)) {
            e.preventDefault();
        } 
    });

    // Check inputs for update member password form
    $('#updatePasswordMember').on('click', '.updatePasswordMemberBtn', function(e) {

        if (!checkInputForm($('#updateMemberPassword'), 'le mot de passe', passwordRegexp,)) {
            e.preventDefault();
        } 

        if (!checkInputForm($('#updateConfirmationPassword'), 'la confirmation de mot de passe', passwordRegexp,)) {
            e.preventDefault();
        }
    });


    // Check inputs in Edit game form 
    $('form').on('click', '.editGameBtn', function(e) {

        if (!checkInputForm($('#name'), 'le titre du jeu', nameGameRegexp,)) {
            e.preventDefault();
        }
        
        if (!checkTextareaTinymceForm('la description du jeu')) {
            e.preventDefault();
        }
        
        // Check the cover only if it's for adding a game, not updating
        if ($(e.target).hasClass('addGame')) {
            if (!checkInputForm($('#cover'), 'l\'image du jeu')) {
                e.preventDefault();
            }
        }

        $('.developerList').each(function() {

            if (!checkInputForm($(this), 'le développeur du jeu', intRegexp)) {
                e.preventDefault();
            }
        });

        $('.genreList').each(function() {

            if (!checkInputForm($(this), 'le genre du jeu', intRegexp)) {
                e.preventDefault();
            }
        });

        $('.modeList').each(function() {

            if (!checkInputForm($(this), 'le mode du jeu', intRegexp)) {
                e.preventDefault();
            }
        });

        $('.platformList').each(function() {

            if (!checkInputForm($(this), false, intRegexp)) {
                e.preventDefault();
            }
        });

        $('.publisherList').each(function() {

            if (!checkInputForm($(this), false, intRegexp)) {
                e.preventDefault();
            }
        });

        $('.regionList').each(function() {

            if (!checkInputForm($(this), false, intRegexp)) {
                e.preventDefault();
            }
        });

        $('.date').each(function() {

            if (!checkInputForm($(this), false, dateRegexp)) {
                e.preventDefault();
            }
        });
    });
});