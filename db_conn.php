<?php

    $hostname = "localhost";
    $user = "root";
    $password = "";
    $dbname = "hospital";

    $connect = mysqli_connect($hostname, $user, $password, $dbname);

    if (!$connect) {
        echo "DB is not connected";
    }
    else{
        // echo "DB is connected";
    }

?>