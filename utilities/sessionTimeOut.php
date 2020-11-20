<?php
// Par défaut l'expiration d'une session est de 1440 secondes
// http://php.net/session.gc-maxlifetime
//  

function set_Session_Timeout($timeout, $returnPage) {
    if(isset($_SESSION['timeout'])) {
        // Nombre de secondes depuis la dernière visite
        $duration = time() - (int)$_SESSION['timeout'];
        if($duration > $timeout) {
            delete_session();
            session_start();
            $_SESSION['timeoutOccured'] = true;
            $_SESSION['timeout'] = time();
            header("Location:$returnPage");
            // terminer abruptement le script
            exit();
        }
    } else {
        $_SESSION['timeout'] = time();
    }
}
function session_Timeout_Occured() {
    return isset($_SESSION['timeoutOccured']);
}
function release_Session_Timout() {
    unset($_SESSION['timeout']);
    unset($_SESSION['timeoutOccured']);
}
function delete_session() {
    // effacer le fichier ../wamp64/tmp/sess_PHPSESSID
    session_destroy();
}
?>