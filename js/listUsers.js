
$(document).ready(function() {
    $('.deleteUser').click(function(){
        let userId = $(this).attr('id').split('_').pop();
        let message = $(this).attr('tooltip');
        OpenConfirmDelete(message, "deleteUser.php?id=" + userId);
    })
})