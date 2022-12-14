<?php

session_start();

$helper = array_keys($_SESSION);
foreach ($helper as $key){
    unset($_SESSION[$key]);
}

echo'<script>
    location.href = "index.php";
    </script>';

?>