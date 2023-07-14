<?php

    include "db_conn.php";

    $dep_id = $_POST['dep_id'];
    $query = "SELECT * FROM `doctors` where doc_dep_id=$dep_id";
    $result = mysqli_query($connect, $query);
    
    //echo "<select>";
    echo "<option value=''>-Select Doctor-</option>";
    while($row = mysqli_fetch_assoc($result)){
        $option .= "<option value='$row[doc_id]'>" . $row['doc_name'] . "</option>";
    }    
    echo $option;

?>
