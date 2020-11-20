<?php
    include_once "DAL/users.php";
    include_once "DAL/photos.php";

    session_start();
    $EmailError = "";
    $PasswordError = "";
    $Email = "";
    $Password = "";
    $alert = "";

    if (isset($_SESSION['illegalAccessOccured']) &&
        $_SESSION['illegalAccessOccured'])
        $alert = "<br><span style='color:red'>Accès illégal. Reconnectez-vous.</span><br>";

    if (isset($_POST["Submit"])) {
        $Email = $_POST["Email"];
        $Password = $_POST["Password"];
        if (TableUsers()->emailExist($Email)){
            if (TableUsers()->userValid($Email, $Password)) {
                $_SESSION["validUser"] = true;
                $_SESSION["loggedUser"] = TableUsers()->findByEmail($Email);
                header('location:listPhotos.php'); 
                exit();
            } else 
                $PasswordError = "<span style='color:red'>Mot de passe incorrect</span><br>";
        } else
            $EmailError = "<span style='color:red'>Courriel inconnu</span><br>";
    }
    $viewTitle = "Connexion".$alert;
    $viewContent = <<<HTML
    <div class="smallFormContainer">
    <br>
        <form id="loginForm" method="post" class="form-group">
            <label  for="Email">Courriel</label>
            <input  type="text"     
                    id="Email"     
                    name="Email"
                    placeholder="Courriel" 
                    value="$Email"
                    class="form-control">      
            $EmailError
            <label  for="Password">Mot de passe</label>
            <input  type="password" 
                    id="Password"  
                    name="Password" 
                    placeholder="Mot de passe"
                    class="form-control"
                    autocomplete="on"
                    value="$Password"> 
            $PasswordError
            <br>
            <input  type="submit"   
                    name="Submit"   
                    class="btn btn-light btn-exit"  
                    value="Connexion...">
            <input  type="button"   
                    class="btn btn-secondary btn-exit"  
                    value="S'enregistrer..."
                    onclick = "window.location ='register.php'">
        </form>
        </div>
    HTML;
    $viewScript = "js/loginFormValidation.js";
    include "view/master.php";
?>