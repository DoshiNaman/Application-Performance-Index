<?php

    //session
    session_start();

    //remove session
    $helper = array_keys($_SESSION);
    foreach ($helper as $key){
        unset($_SESSION[$key]);
    }

    //change path
    echo'<script> location.href = "index.php"; </script>';

?>