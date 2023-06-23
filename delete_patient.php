<?php 

    include "db_conn.php"; 

    if(isset($_GET['pat_id'])){
        $pat_id = $_GET['pat_id'];
    }

    $query = "DELETE FROM `patients` WHERE pat_id = $pat_id";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: index.php?message=Record Deleted Successfully");
    }
?>
