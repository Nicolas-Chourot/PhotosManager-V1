<?php
    include_once "utilities/htmlHelper.php";
    include_once "DAL/users.php";
    $pageTitle = "Mon site Web";
    if (!isset($viewTitle)) $viewTitle = "";
    $username = "";
    $profilLink = "";
    $logoutLink = "";
    $avatarImage = "";
    if (isset($_SESSION["loggedUser"])) {
        $profilLink = '<a href="profil.php">'.$_SESSION["loggedUser"]["Name"].'</a>';
        $logoutLink = '<a href="logout.php"><img class="btn-icon" src="images/logout.png" title="Déconnexion" tooltip-position="bottom"></span></a>';
        $avatarImage = html_fittedImage(TableUsers()->getAvatarURL($_SESSION["loggedUser"]["AvatarGUID"]), "smallAvatar");
    }
    $viewHead = <<< HTML
    <div class='header'>
        <div class='headerContainer'>
            <img class='logo' src='images/camera.png' onclick="document.location = 'listPhotos.php'">
            <h1>$viewTitle</h1>
            <div class="headerConnection" style="margin-top:16px;">
                $avatarImage
                $profilLink
                <div style="text-align:right">
                $logoutLink
                </div>
            </div>
        </div>
    </div>
    HTML;
?>