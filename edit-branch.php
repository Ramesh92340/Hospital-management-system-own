<div id="wrapper">


    <?php
   include "includes/sidebar.php";
   include "includes/header.php";
   include "config/db.php";

    if (isset($_POST['edit_btn'])) {


        $bArea = mysqli_escape_string($db_con, $_POST['brancharea']);
        $getId = mysqli_real_escape_string($db_con, $_GET['id']);


        $query = mysqli_query($db_con, "UPDATE branch SET BranchArea	='" . $bArea . "',status=1 where id='" . $getId . "'");


        if ($query) {
            echo '<script>alert("Data updated Successfully")</script>';
            echo '<script>window.location.href="../branches.php"</script>';
        } else {
            echo '<script>alert("Failed To update")</script>';
        }
    }
    ?>
    <div class="container">
        <?php
        $getBranches = mysqli_query($db_con, "SELECT * FROM branch WHERE id= '" . $_GET['id'] . "' && status=1");
        $result = mysqli_fetch_array($getBranches);
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Branch Area</label>
                        <input value="<?php echo $result['BranchArea'] ?>" type="text"
                            class="form-control field_input_bg" name="brancharea">
                    </div>
                    <div class="col-md-6 mt-5">
                        <div class="row last_back_submit d-flex flex-row justify-content-between px-3">
                            <button class="back_btn_staff">Back</button>
                            <button type="submit" class="submit_btn_staff" name="edit_btn">Submit</button>
                        </div>
                    </div>
                </div>
            </div>
        </form>
    </div>


    <?php
    include "includes/footer.php";

    ?>
</div>