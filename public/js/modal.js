$(document).ready(function () {
    
    // BOOTSTRAP MODAL
    $('#deleteModal').on('shown.bs.modal', function (e) {

        var button = $(e.relatedTarget); // Button that triggered the modal

        // for deleting a game
        var urlDeleteGame = button.data('url-delete-game'); // Extract info from data-* attributes
        var gameName = button.data('game-name');

        // for deleting a member 
        var urlDeleteMember = button.data('url-delete-member')
        // for deleting a member by admin
        var urlDeleteMemberByAdmin = button.data('url-delete-member-by-admin')
        var memberName = button.data('member-name');

        // for deleting a comment
        var urlDeleteComment = button.data('url-delete-comment');
        var commentAuthor = button.data('member-author');

        // for deleting game's infos updated by member
        var urlDeleteUpdatedGame = button.data('url-delete-updated-game');
        var updatedGamename = button.data('updated-game-name'); 
 
        var modal = $(this);

        if (urlDeleteGame) {
            modal.find('.modal-text').text('le jeu : ' + gameName);
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteGame);
        } else if (urlDeleteMember) {
            modal.find('.modal-text').text('votre profil');
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteMember);
        } else if (urlDeleteMemberByAdmin) {
            modal.find('.modal-text').text('le compte de : ' + memberName);
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteMemberByAdmin);
        } else if (urlDeleteComment) {
            modal.find('.modal-text').text('le commentaire de : ' + commentAuthor);
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteComment);
        } else if (urlDeleteUpdatedGame) {
            modal.find('.modal-text').text('les informations modifiées pour le jeu : ' + updatedGamename);
            modal.find('#modalConfirmBtn').parent().attr('href', urlDeleteUpdatedGame);
        }

    })
});