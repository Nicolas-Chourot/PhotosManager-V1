<?php
    include_once "DAL/users.php";
    include_once "accessCheck.php";
    include_once "utilities/form.php";

    $EmailError = "";
    $userId = $_SESSION["loggedUser"]["Id"];
    $userName = $_SESSION["loggedUser"]["Name"];
    $userEmail = $_SESSION["loggedUser"]["Email"];
    $userAvatarGUID = $_SESSION["loggedUser"]["AvatarGUID"];
    $userPassword = "";
    $userConfirm = "";

    $antiForgeryToken = "";
    if (!isset($_SESSION["currentAntiForgeryToken"]))
        $_SESSION["currentAntiForgeryToken"] = getAntiForgeryToken();
    $antiForgeryToken = $_SESSION["currentAntiForgeryToken"];
    
    if (isset($_POST["Submit"])) {
        if (isFormLegit()){
                unset($_SESSION["currentAntiForgeryToken"]);
                $userName = $_POST["Name"];
                $userEmail = $_POST["Email"];
                $userPassword = $_POST["Password"];
                $userConfirm = $_POST["Confirm"];
                $userAvatarGUID = $_POST["AvatarGUID"];
                $updatedUser = TableUsers()->changeProfil($_POST);
                if ($updatedUser != null) {
                        $_SESSION["loggedUser"] = $updatedUser;
                        header('location:listPhotos.php'); exit();
                } else
                        $EmailError = "<span style='color:red'>Courriel en conflit avec celui d'un autre usager</span><br>";
        } else
                illegalAccessRedirection();
    }

    $avatarUploader = TableUsers()->html_AvatarUploader($userAvatarGUID);
    $viewTitle = "Modification du profil";
    $viewContent = <<<HTML
    <div class="smallFormContainer">
    <br>
        <form id="profilForm" method="post" class="form-group" enctype="multipart/form-data">
            $antiForgeryToken
            <input  type="hidden" 
                    id="Id"
                    name="Id"
                    value="$userId">
             <input  type="hidden" 
                    id="AvatarGUID"
                    name="AvatarGUID"
                    value="$userAvatarGUID">
            <label  for="name">Nom d'usager</label>
            <input  type="text"     
                    id="Name"      
                    name="Name" 
                    class="form-control" 
                    placeholder="Nom d'usager"
                    value='$userName'>
            <label for="Email">Courriel</label>
            <input  type="text"     
                    id="Email"     
                    name="Email"
                    class="form-control" 
                    placeholder="Courriel"
                    value='$userEmail'>
                    $EmailError
            <label  for="Password">Mot de passe</label>
            <input  type="password" 
                    id="Password"  
                    name="Password"
                    class="form-control" 
                    placeholder="Mot de passe"
                    autocomplete="on"
                    value='$userPassword'>
            <label  for="Confirm">Confirmation</label>
            <input  type="password" 
                    id="Confirm"   
                    name="Confirm"
                    class="form-control" 
                    placeHolder="Confirmation"
                    autocomplete="on"
                    value='$userConfirm'>
            <br>
            <div>
            $avatarUploader
            </div>
            <br>
            <input  type="submit"   
                    name="Submit"    
                    class="btn btn-light btn-exit" 
                    value="Enregistrer...">
            <input  type="button"   
                    class="btn btn-secondary btn-exit"  
                    value="Annuler..."
                    onclick = "window.location ='listPhotos.php'">
        </form>
    </div>
    HTML;
    $viewScript = "js/profilFormValidation.js";
    include "view/master.php";
?>