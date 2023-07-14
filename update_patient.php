<?php 

    require_once "db_conn.php"; 

    if ($_SERVER["REQUEST_METHOD"] == "POST") {
        $pat_id = $_POST['pat_id'];
        $name = $_POST['name'];
        $gender = $_POST['gender'];
        $contact = $_POST['contact'];
        $department = $_POST['department'];
        $doctor = $_POST['doctor'];

        $errors = array();

        // Perform validation for each field
        if (empty($name)) {
            $errors[] = "Name is required.";
        }

        if (empty($gender)) {
            $errors[] = "Patient type is required.";
        }

        if (empty($contact)) {
            $errors[] = "Phone number is required.";
        } elseif (!preg_match('/^\d{10}$/', $contact)) {
            $errors[] = "Invalid phone number format.";
        }

        if (empty($department)) {
            $errors[] = "Department is required.";
        }

        if (empty($doctor)) {
            $errors[] = "Doctor is required.";
        }

        // If there are any errors, redirect back to add_patient.php with error messages
        if (!empty($errors)) {
            $errorString = implode("<br>", $errors);
            header("Location: add_patient.php?error=$errorString");
            exit;
        }

        $query = "UPDATE `patients` SET `pat_name`='$name',`pat_gender`='$gender',
                    `pat_contact`='$contact',`pat_dep_id`='$department',`pat_doc_id`='$doctor' WHERE pat_id = '$pat_id' ";
        
        $result = mysqli_query($connect, $query);

        if ($result) {
            header("Location: index.php?message=Record Updated Successfully");
        }
    }
?>
