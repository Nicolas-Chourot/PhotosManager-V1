<?php
    include_once "DAL/users.php";
    include_once "accessCheck.php";
    include_once "utilities/htmlHelper.php";

    $viewTitle = "Liste des usagers";
    $viewContent = "<div class='userListContainer'>";
    $showDeleteButtons = $_SESSION["loggedUser"]["Admin"];

    foreach(TableUsers()->userList() as $user) {
        $id = $user["Id"];
        $name = $user["Name"];
        $email = $user["Email"];
        $creationDate = explode(' ', $user["CreationDate"])[0];
        $avatarImage = html_fittedImage(TableUsers()->getAvatarURL($user["AvatarGUID"]), "avatar");
        $deleteButton = "<div></div>";
        if ($showDeleteButtons) {
            if (!$user["Admin"])
                $deleteButton = html_flashButton("deleteUser iconDelete", "deleteUser_$id", "Effacer $name", $position = 'top');
        }
        $viewContent.= <<<HTML
        $avatarImage
        <div class="cell">$name</div>
        <div class="cell">$email</div>
        <div class="cell">$creationDate</div>
        $deleteButton
        HTML;
    }
    $viewContent.= "</div>";
    $viewScript = "js/listUsers.js";
    include "view/master.php";
?>