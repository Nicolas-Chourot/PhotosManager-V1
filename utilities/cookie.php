<?php

function minutes($n){ return 60 * $n; }
function hours($n){ return minutes(60) * $n; }
function days($n){ return hours(24) * $n; }
function years($n){ return days(365.25) * $n; }

function cookie_get($name, $default = null){
    if (isset($_COOKIE[$name]))
        return $_COOKIE[$name];
    return $default; 
}
function cookie_set($name, $value, $duration) {
    setcookie($name, $value, time() + $duration);
}
function cookie_update($name, $value, $duration) {
    setcookie($name, $value, time() + $duration);
}
function cookie_delete($name){
    if (isset($_COOKIE[$name]))
        cookie_set($name, null, -3600);
}
function cookie_deleteAll() {
    foreach($_COOKIE as $name => $value) {
        cookie_delete($name);
    }
}
?>