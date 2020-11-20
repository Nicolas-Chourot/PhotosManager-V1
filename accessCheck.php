<?php 
    include_once 'utilities/sessionTimeOut.php';
    session_start();
    set_Session_Timeout(1800,'login.php');

    function illegalAccessRedirection() {
        $_SESSION['illegalAccessOccured'] = true;
        unset($_SESSION["loggedUser"]);
        redirect('login.php');
    }

    if (!$_SESSION["validUser"]) {
        illegalAccessRedirection();
    }
 
function redirect($url) {
    header('location:'.$url); exit();
}
?>