<?php 

    include "db_conn.php"; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {


    $name = $_POST['name'];
    $gender = $_POST['gender'];
    $contact = $_POST['contact'];
    $department = $_POST['department'];
    $doctor = $_POST['doctor'];

    $query = "INSERT INTO patients(pat_id, pat_name, pat_gender, pat_contact, pat_dep_id, pat_doc_id) 
                VALUES (NULL,'$name','$gender','$contact','$department','$doctor')";
    
    $result = mysqli_query($connect, $query);

    if ($result) {
        header("Location: index.php?message=Record Created Successfully");
    }
}
?>