<?php

    function toFrenchDate($date){ // yyyy-mm-dd hh:mm:ss
        $frenchMonths = array (
            "janvier",
            "février",
            "mars",
            "avril",
            "mai",
            "juin",
            "juillet",
            "août",
            "septembre",
            "octobre",
            "novembre",
            "décembre"
        );
        $dateParts = explode("-", $date);
        $year = $dateParts[0];
        $month = $frenchMonths[intval($dateParts[1])-1];
        $day = explode(" ", $dateParts[2])[0];
        return $day." ".$month." ".$year;
    }

?>