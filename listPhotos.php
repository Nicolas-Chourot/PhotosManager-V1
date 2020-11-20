<?php
    include_once "DAL/photos.php";
    include_once "accessCheck.php";
    include_once "utilities/htmlHelper.php";

    function thumbNail($photo){
        $url = TablePhotos()->getPhotoUrl($photo["GUID"]);
        $title = $photo["Title"];
        $id = $photo["Id"];
        $thumbnail = html_fittedImage($url, "thumbnail");
        $html = <<< HTML
        <div class='thumbnailContainer' onclick='window.location="photoDetails.php?id=$id"'>
            <div class='thumbnailHeader ellipsis'>
                $title
                </div>
                $thumbnail
            </div>
        HTML;
        return $html;
    }
    $addPhotoCmd = "<div>".html_flashButtonLink('iconPlus','addPhoto.php', 'Ajouter une photo','right')."</div>";
    $viewTitle = "Liste des photos ".$addPhotoCmd;
    $viewContent = "<div class='thumbnailListContainer'>";
    foreach(TablePhotos()->list() as $photo) {
        $viewContent.= thumbNail($photo);
    }
    $viewContent.= "</div>";
    $viewScript = "js/listPhotos.js";
    include "view/master.php";
?>