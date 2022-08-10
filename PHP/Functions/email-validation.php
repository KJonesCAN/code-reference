<?php
    function checkemail($str) {
        return (!preg_match("/^([a-z0-9\+_\-]+)(\.[a-z0-9\+_\-]+)*@([a-z0-9\-]+\.)+[a-z]{2,6}$/ix", $str)) ? FALSE : TRUE;
    }

    if (!checkemail("alex@tutorialspoint.com")) {
        echo "Invalid email address.";
    } else {
        echo "Valid email address.";
    }
?>