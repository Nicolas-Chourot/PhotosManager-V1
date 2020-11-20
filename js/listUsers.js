
$(document).ready(function() {
    $('.deleteUser').click(function(){
        let userId = $(this).attr('id').split('_').pop();
        let message = $(this).attr('tooltip');
        OpenConfirmDeleteUser(userId, message);
    })
})

function OpenConfirmDeleteUser(userId, message) {
    $.confirm({
        title: "Retrait d'usager",
        content: message + '?',
        buttons: {
            confirmer: function () {
                document.location = "deleteUser.php?id=" + userId;
            },
            annuler: {},
        }
    });
}