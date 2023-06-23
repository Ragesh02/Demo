<?php include "db_conn.php"; ?>
<?php include "header.php"; ?>

<nav class="navbar justify-content-center mt-4">
    <h1>Patients Information Table</h1>
</nav>

<div class="container">

    <?php
        if(isset($_GET['message'])){
            echo "<div class='alert alert-warning'>";
                echo $_GET['message'];
            echo "</div>";
        }
    ?>

    <a href="add_patient.php" class="btn btn-success mt-3 mb-4">Add New Patient</a>

    <table class="table table-hover mt-3">
        <thead>
            <tr>
                <th>SNO</th>
                <th>Name</th>
                <th>Gender</th>
                <th>Contact</th>
                <th>Department</th>
                <th>Doctor</th>
                <th>Action</th>
            </tr>
        </thead>

        <tbody>

            <?php
                $query = "SELECT * FROM patients
                            LEFT JOIN departments 
                            ON departments.dep_id = patients.pat_dep_id 
                            LEFT JOIN doctors 
                            ON doctors.doc_id = patients.pat_doc_id";
                $result = mysqli_query($connect, $query);
                $count = 1;
                while ($row = mysqli_fetch_assoc($result)) {
            ?>

            <tr>
                <td><?php echo $count++; ?></td>
                <td><?php echo $row['pat_name']; ?></td>
                <td><?php echo $row['pat_gender']; ?></td>
                <td><?php echo $row['pat_contact']; ?></td>
                <td><?php echo $row['dep_name']; ?></td>
                <td><?php echo $row['doc_name']; ?></td>
                <td>
                    <a href="edit_patient.php?pat_id=<?php echo $row['pat_id']; ?>">Edit</a> | 
                    <a href="delete_patient.php?pat_id=<?php echo $row['pat_id']; ?>">Delete</a>
                </td>
            </tr>
            <?php } ?>
        </tbody>
    </table>
</div>

<?php include "footer.php"; ?>