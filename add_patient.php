<?php require_once "db_conn.php"; ?>
<?php include "header.php"; ?>

<nav class="navbar justify-content-center mt-4 mb-3">
    <h1>Patients Information Form</h1>
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
    <form action="save_patient.php" method="post">

        <div class="form-group">
            <label>Patient Name</label>
            <input type="text" name="name" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Gender</label>
            <div class="form-check">
                <input type="radio" class="form-check-input" name="gender" value="Male" required>
                <label class="form-check-label">Male</label>
            </div>

            <div class="form-check">
                <input type="radio" class="form-check-input" name="gender" value="Female" required>
                <label class="form-check-label">Female</label>
            </div>
        </div>

        <div class="form-group">
            <label>Contact</label>
            <input type="number" name="contact" class="form-control" required>
        </div>

        <div class="form-group">
            <label>Department</label>
            <select class="form-control" name="department" id="department" required>
                <option value="">-Select Department-</option>
                <?php                    
                    $query = "SELECT * FROM departments";  
                    $result = mysqli_query($connect, $query);                                
                    //var_dump($row);
                    while ($row = mysqli_fetch_assoc($result)) {                        
                ?>
                <option value="<?php echo $row['dep_id']; ?>"><?php echo $row['dep_name']; ?></option>
                <?php } ?>
            </select>
        </div>

        <div class="form-group">
            <label>Doctor</label>
            <select class="form-control" name="doctor" id="doctor" required>
                <option value="">-Select Doctor-</option>
            </select>
        </div>

        <button value="submit" class="btn btn-success">Save</button>
        <a href="index.php" class="btn btn-warning">Cancel</a>

    </form>
</div>

<?php include "footer.php"; ?>

<script>
    $(document).ready(function() {
        //alert("welcome");
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
