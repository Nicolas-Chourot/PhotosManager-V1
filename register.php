<?php
    include_once "DAL/users.php";
    $EmailError = "";
    $userName = "";
    $userEmail ="";
    $userPassword = "";
    $userConfirm = "";
    if (isset($_POST["Submit"])) {
        $userName = $_POST["Name"];
        $userEmail = $_POST["Email"];
        $userPassword = $_POST["Password"];
        $userConfirm = $_POST["Confirm"];
        if (TableUsers()->register($_POST)) {
            header('location:login.php'); exit();
        } else
            $EmailError = "<span style='color:red'>Ce courriel existe déjà</span><br>";
    } 
    $viewTitle = "Inscription";
    $avatarUploader = TableUsers()->html_AvatarUploader();
    $viewContent = <<<HTML
    <div class="smallFormContainer">
    <br>
        <form id="registerForm" method="post" class="form-group" enctype="multipart/form-data">
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
                    value="Se connecter..."
                    onclick = "window.location ='login.php'">
        </form>
    </div>
    HTML;
    $viewScript = "js/registerFormValidation.js";
    include "view/master.php";
?>