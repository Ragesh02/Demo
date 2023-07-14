<?php require_once "db_conn.php"; ?>
<?php include "header.php"; ?>

<?php
    $pat_id = $_GET['pat_id'];
    $query = "SELECT * FROM `patients` where pat_id = $pat_id";
    $result = mysqli_query($connect, $query);
    $row = mysqli_fetch_assoc($result);
    $pat_dep_id = $row['pat_dep_id'];
    $pat_doc_id = $row['pat_doc_id'];
?>
<nav class="navbar justify-content-center mt-4 mb-4">
    <h1>Patients Information Update Form</h1>
</nav>

<nav class="navbar justify-content-center">
<?php
        if(isset($_GET['error'])){
            // echo "<div class='alert alert-warning alert-dismissible fade show'>";
            echo "<div class='alert alert-danger'>";
                echo $_GET['error'];
                echo '<button type="button" class="close" data-dismiss="alert" aria-label="Close">';
                echo '<span aria-hidden="true">&times;</span>';
            echo "</button>";
            echo "</div>";
        }
    ?>
</nav>

<div class="container" style="width: 500px;">
    <form action="update_patient.php" method="post">

        <div class="form-group">
            <label>Patient Name</label>
            <input type="hidden" name="pat_id" value="<?php echo $row['pat_id']; ?>" />
            <input type="text" name="name" class="form-control" value="<?php echo $row['pat_name']; ?>" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="gender" value="Male"
                <?php if($row['pat_gender'] == 'Male') echo "checked";  ?> required>
                <label class="form-check-label">Male</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="gender" value="Female" 
                <?php if($row['pat_gender'] == 'Female') echo "checked";  ?> required>
                <label class="form-check-label">Female</label>
            </div>
        </div>

        <div class="form-group">
            <label>Contact</label>
            <input type="number" name="contact" class="form-control" value="<?php echo $row['pat_contact']; ?>" required>
        </div>

        <div class="form-group">
            <label>Department</label>
            <select class="form-control" name="department" id="department" required>
                <option value="">-Select Department-</option>
                <?php                    
                    $query = "SELECT * FROM `departments`";  
                    $result = mysqli_query($connect, $query);                                
                    while ($row = mysqli_fetch_assoc($result)) {     
                        $selected = (trim($row['dep_id']) ==  trim($pat_dep_id)) ? 'selected' : '';                 
                        echo "<option value='$row[dep_id]' $selected>$row[dep_name]</option>";
                    }       
                ?>
            </select>
        </div>

        <div class="form-group">
            <label>Doctor</label>
            <select class="form-control" name="doctor" id="doctor" required>
                <option value="">-Select Doctor-</option>
                <?php

                    $query = "SELECT * FROM `doctors` WHERE doc_dep_id = '$pat_dep_id'"; 
                    $result = mysqli_query($connect, $query);
                    while ($row = mysqli_fetch_assoc($result)) {

                        $doc_selected = (trim($row['doc_id']) ==  trim($pat_doc_id)) ? 'selected' : '';
                        echo "<option value='$row[doc_id]' $doc_selected>$row[doc_name]</option>";
                    }
                ?>
            </select>
        </div>

        <button value="submit" class="btn btn-success">Update</button>
        <a href="index.php" class="btn btn-warning">Cancel</a>

    </form>
</div>

<?php include "footer.php"; ?>

<script>
    $(document).ready(function() {

        $('#department').change(function() {

            var dep_Id = $(this).val();

            $.ajax({
                url: 'get_doctors.php',
                type: 'POST',
                data: {
                    dep_id: dep_Id
                },
                success: function(data) {
                    // Populate the doctor options dynamically
                    $('#doctor').html(data);
                }
            });
        });
    });
</script>
