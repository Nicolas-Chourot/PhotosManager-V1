<?php
include_once "sessionTimeOut.php";

function redirect($url) {
    header('location:'.$url); exit();
}

function illegalAccessRedirection() {
    delete_session();
    session_start();
    $_SESSION['illegalAccessOccured'] = true;
    redirect('loginForm.php');
}
?>