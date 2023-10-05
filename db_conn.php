<?php

    $host = "localhost";
    $user = "root";
    $pass = "";
    $db_name = "patients_information";

    $connect = mysqli_connect($host, $user, $pass, $db_name);

    if (!$connect) {
        echo "DB is not connected";
    }
    else{
        // echo "DB is connected";
    }

?>
