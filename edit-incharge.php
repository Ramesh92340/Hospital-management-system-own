<div id="wrapper">
    <?php
    include "includes/sidebar.php";
    include "includes/header.php";
    include "config/db.php";   

    if (isset($_POST['edit_btn'])) {
        $prsn = mysqli_real_escape_string($db_con, $_POST['person']);
        $add = mysqli_real_escape_string($db_con, $_POST['address']);
        $age = mysqli_real_escape_string($db_con, $_POST['age']);
        $acnt = mysqli_real_escape_string($db_con, $_POST['account']);
        $phn = mysqli_real_escape_string($db_con, $_POST['phone']);
        $slry = mysqli_real_escape_string($db_con, $_POST['salary']);
        $brnch = mysqli_real_escape_string($db_con, $_POST['branch']);
        $jng = mysqli_real_escape_string($db_con, $_POST['joining']);
        $image = $_FILES['photo']['name'];
        $target_dir = "../assets/uploads/staff"; // Specify the target directory
        $target_file = $target_dir . basename($image);
        $imageFileType = strtolower(pathinfo($target_file, PATHINFO_EXTENSION));
        $getId = mysqli_real_escape_string($db_con, $_GET['id']);

        // Check if the file is a valid image
        $check = getimagesize($_FILES['photo']['tmp_name']);
        if ($check === false) {
            echo '<script>alert("File is not an image.")</script>';
            exit;
        }

        // Allow certain file formats
        if ($imageFileType != "jpg" && $imageFileType != "png" && $imageFileType != "jpeg" && $imageFileType != "gif") {
            echo '<script>alert("Sorry, only JPG, JPEG, PNG & GIF files are allowed.")</script>';
            exit;
        }

        // Move the uploaded file to the target directory
        if (!move_uploaded_file($_FILES['photo']['tmp_name'], $target_file)) {
            echo '<script>alert("Sorry, there was an error uploading your file.")</script>';
            exit;
        }

        // Update the database with the new data
        $staffQuery = mysqli_query($db_con, "UPDATE incharge SET PersonName='$prsn', Address='$add', Age='$age', AccountNo='$acnt', PhoneNo='$phn', Salary='$slry', FromBranch='$brnch', JoiningDate='$jng', UploadPhoto='$image', status=1 WHERE id='$getId'");

        if ($staffQuery) {
            echo '<script>alert("Data updated successfully")</script>';
            echo '<script>window.location.href="../staff.php"</script>';
        } else {
            echo '<script>alert("Failed to update")</script>';
        }
    }
    ?>

    <div class="container">
        <?php
        $getincharge = mysqli_query($db_con, "SELECT * FROM incharge WHERE id='" . $_GET['id'] . "' AND status=1");
        $result = mysqli_fetch_array($getincharge);
        ?>

        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Upload Photo</label>
                        <input type="file" class="form-control field_input_bg" name="photo">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Person Name</label>
                        <input value="<?php echo $result['PersonName']; ?>" type="text"
                            class="form-control field_input_bg" name="person">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Address</label>
                        <input value="<?php echo $result['Address']; ?>" type="text" class="form-control field_input_bg"
                            name="address">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Age</label>
                        <input value="<?php echo $result['Age']; ?>" type="number" class="form-control field_input_bg"
                            name="age">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Account No.</label>
                        <input value="<?php echo $result['AccountNo']; ?>" type="number"
                            class="form-control field_input_bg" name="account">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Phone No.</label>
                        <input value="<?php echo $result['PhoneNo']; ?>" type="phone"
                            class="form-control field_input_bg" name="phone">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Salary/Monthly</label>
                        <input value="<?php echo $result['Salary']; ?>" type="number"
                            class="form-control field_input_bg" name="salary">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">From Branch</label>
                        <input value="<?php echo $result['FromBranch']; ?>" type="text"
                            class="form-control field_input_bg" name="branch">
                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Joining Date</label>
                        <input value="<?php echo $result['JoiningDate']; ?>" type="date"
                            class="form-control field_input_bg" name="joining">
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="row last_back_submit d-flex flex-row justify-content-between px-3">
                            <button class="back_btn_staff">Back</button>
                            <button class="submit_btn_staff" name="edit_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>


    </div>

    <?php
    include " assets/includes/footer.php";
    ?>
</div>