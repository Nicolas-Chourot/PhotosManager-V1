<?php
    include_once "DAL/photos.php";
    include_once "accessCheck.php";
    include_once "utilities/form.php";
    $viewTitle = "Modification de photo";
    $id = 0;

    if (isset($_GET["id"])){
        $id = $_GET["id"];
        $photo = TablePhotos()->get($id);
        if ($photo["UserId"] != $_SESSION["loggedUser"]["Id"] && $_SESSION["loggedUser"]["Admin"] == 0)
            illegalAccessRedirection();
    }  else
        illegalAccessRedirection();

    if (isset($_POST["Submit"])) {
        $title = $_POST["Title"];
        $description = $_POST["Description"];
        TablePhotos()->updatePhoto($_POST);            
        redirect('listPhotos.php');
    } else {
        $title =  $photo["Title"];
        $description = $photo["Description"];
        $creationDate = $photo["CreationDate"];
        $keywords = $photo["Keywords"];
        $shared = $photo["Shared"];
        $userId = $photo["UserId"];
        $GUID = $photo["GUID"];

        $photoUploader = TablePhotos()->html_PhotoUploader($GUID);
        $viewContent = <<<HTML
        <div class="smallFormContainer">
        <br>
            <form id="addPhotoForm" method="post" class="form-group" enctype="multipart/form-data">
                <input type='hidden' name='Id' value='$id'> 
                <input type='hidden' name='CreationDate' value='$creationDate'>
                <input type='hidden' name='Keywords' value='$keywords'>  
                <input type='hidden' name='Shared' value='$shared'>  
                <input type='hidden' name='GUID' value='$GUID'>  
                <input type='hidden' name='UserId' value='$userId'>  
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
    }
        
    $viewScript = "js/editPhotoFormValidation.js";
    include "view/master.php";
?>