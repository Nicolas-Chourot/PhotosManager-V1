<?php
    include_once "DAL/photos.php";
    include_once "accessCheck.php";
    include_once "utilities/form.php";
    $viewTitle = "Inscription";

    if (isset($_POST["Submit"])) {
        if (TablePhotos()->add($_POST)) {
            header('location:listPhotos.php'); exit();
        }
    }     
    $title = "";
    $description ="";
    $photoUploader = TablePhotos()->html_PhotoUploader();
    $viewContent = <<<HTML
    <div class="smallFormContainer">
    <br>
        <form id="addPhotoForm" method="post" class="form-group" enctype="multipart/form-data">
            <label  for="Title">Titre</label>
            <input  type="text"     
                    id="Title"      
                    name="Title" 
                    class="form-control" 
                    placeholder="Titre de la photo..."
                    value='$title'>
            <label for="Description">Description</label>
            <textarea   type="text"     
                        id="Description"     
                        name="Description"
                        class="form-control" 
                        rows="4" cols="50"
                        placeholder="Description de la photo...">$description</textarea>
            <br>
            <div>
                $photoUploader
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
    $viewScript = "js/addPhotoFormValidation.js";
    include "view/master.php";
?>