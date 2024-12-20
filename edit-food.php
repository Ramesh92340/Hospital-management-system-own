<div id="wrapper">


    <?php
    include "includes/sidebar.php";
    include "includes/header.php";
    include "config/db.php";





    if (isset($_POST['edit_btn'])) {

        $Area = mysqli_escape_string($db_con, $_POST['area']);
        $inc = mysqli_escape_string($db_con, $_POST['incharge']);
        $item = mysqli_escape_string($db_con, $_POST['items']);
        $phn = mysqli_escape_string($db_con, $_POST['phone']);
        $exp = mysqli_escape_string($db_con, $_POST['expenses']);
        $getId = mysqli_real_escape_string($db_con, $_GET['id']);


        $query = mysqli_query($db_con, "UPDATE stock SET BranchArea	='" . $Area . "',InchargeName='" . $inc . "',NoofItems='" . $item . "',PhoneNumber='" . $phn . "',Monthlyexpenses	='" . $exp . "',status=1 where id='" . $getId . "'");


        if ($query) {
            echo '<script>alert("Data updated Successfully")</script>';
            echo '<script>window.location.href="../food.php"</script>';
        } else {
            echo '<script>alert("Failed To update")</script>';
        }
    }
    ?>
    <div class="container">
        <?php
        $getBilling = mysqli_query($db_con, "SELECT * FROM stock WHERE id= '" . $_GET['id'] . "' && status=1");
        $result = mysqli_fetch_array($getBilling);
        ?>
        <form method="post" enctype="multipart/form-data">
            <div class="form-group">
                <div class="row">




                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Branch Area</label>
                        <input value="<?php echo $result['BranchArea'] ?>" type="text" class="form-control field_input_bg" name="area">

                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Incharge Name</label>
                        <input value="<?php echo $result['InchargeName'] ?>" type="text" class="form-control field_input_bg" name="incharge">
                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">No of Items</label>
                        <input value="<?php echo $result['NoofItems'] ?>" type="number" class="form-control field_input_bg" name="items">


                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Phone Number</label>
                        <input value="<?php echo $result['PhoneNumber'] ?>" type="number" class="form-control field_input_bg" name="phone">


                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Monthly expenses</label>
                        <input value="<?php echo $result['Monthlyexpenses'] ?>" type="number" class="form-control field_input_bg" name="expenses">


                    </div>



                    <div class="col-md-6 mt-5">


                        <div class="row last_back_submit  d-flex flex-row justify-content-between  px-3">
                            <button class="back_btn_staff">Back</button>
                            <button class="submit_btn_staff" name="edit_btn">Submit</button>

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