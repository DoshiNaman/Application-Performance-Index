<?php

    //session 
    session_start();

    //database connection related var
    $server="localhost";
    $user="root";
    $pass="";
    $db="API";

    //create database connection
    $conn=mysqli_connect($server,$user,$pass,$db);

?>