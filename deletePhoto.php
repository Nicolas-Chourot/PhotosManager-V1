<?php

include_once "DAL/photos.php";
include_once "accessCheck.php";


if (isset($_GET["id"])){
    $id = $_GET["id"];
    $photo = TablePhotos()->get($id);
    if ($photo["UserId"] == $_SESSION["loggedUser"]["Id"] || $_SESSION["loggedUser"]["Admin"] == 1) {
       TablePhotos()->deletePhoto($id);
       redirect("listPhotos.php");
    }
}
illegalAccessRedirection();

?>