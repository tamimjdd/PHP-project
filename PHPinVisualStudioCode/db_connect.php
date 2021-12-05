<?php
    $user='root';
    $pass='';
    $db='login';
    $db= new mysqli('localhost', $user, $pass,$db) or die("unable to connect");

    echo "DB is connected";
?>