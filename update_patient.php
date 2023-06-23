<?php 

    include "db_conn.php"; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pat_id = $_POST['pat_id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $department = $_POST['department'];
        $doctor = $_POST['doctor'];

        $query = "UPDATE `patients` SET `pat_name`='$name',`pat_gender`='$gender',
                    `pat_contact`='$contact',`pat_dep_id`='$department',`pat_doc_id`='$doctor' WHERE pat_id = '$pat_id' ";
        
        $result = mysqli_query($connect, $query);

        if ($result) {
            header("Location: index.php?message=Record Updated Successfully");
        }
    }
?>