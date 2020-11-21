$(document).ready(function() {
    $('.deletePhotoCmd').click(function(){
        let photoId = $(this).attr('id').split('_').pop();
        let message = $(this).attr('tooltip');
        OpenConfirmDelete(message, "deletePhoto.php?id=" + photoId);
    })
})