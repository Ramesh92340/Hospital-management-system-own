<div id="wrapper">


    <?php
    include "includes/sidebar.php";
    include "includes/header.php";
    include "config/db.php";


    if (isset($_POST['edit_btn'])) {



        $iname = mysqli_escape_string($db_con, $_POST['Item']);
        $kggs = mysqli_escape_string($db_con, $_POST['Kg']);
        $amnt = mysqli_escape_string($db_con, $_POST['amount']);
        $disc = mysqli_escape_string($db_con, $_POST['discount']);
        $incName = mysqli_escape_string($db_con, $_POST['incharge']);
        $brnch = mysqli_real_escape_string($db_con, $_POST['branch']);
        $dat = mysqli_real_escape_string($db_con, $_POST['date']);
        $getId = mysqli_real_escape_string($db_con, $_GET['id']);


        $query = mysqli_query($db_con, "UPDATE items SET ItemName='" . $iname . "',Kgs ='" . $kggs . "',Amount='" . $amnt . "',Discount='" . $disc . "',InchargeName='" . $incName . "',Branch='" . $brnch . "',Date ='" . $dat . "',status=1 where id='" . $getId . "'");


        if ($query) {
            echo '<script>alert("Data updated Successfully")</script>';
            echo '<script>window.location.href="../billings.php"</script>';
        } else {
            echo '<script>alert("Failed To update")</script>';
        }
    }
    ?>




    <div class="container">
        <?php
        $getBilling = mysqli_query($db_con, "SELECT * FROM items WHERE id= '" . $_GET['id'] . "' && status=1");
        $result = mysqli_fetch_array($getBilling);
        ?>

        <form method="post" enctype="multipart/form-data">




            <div class="form-group">
                <div class="row">




                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Item Name</label>
                        <input value="<?php echo $result['ItemName'] ?>" type="text" class="form-control field_input_bg"
                            name="Item">

                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Kg's</label>
                        <input value="<?php echo $result['Kgs'] ?>" type="text" class="form-control field_input_bg"
                            name="Kg">
                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Amount</label>
                        <input value="<?php echo $result['Amount'] ?>" type="number" class="form-control field_input_bg"
                            name="amount">


                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Discount</label>
                        <input value="<?php echo $result['Discount'] ?>" type="number"
                            class="form-control field_input_bg" name="discount">


                    </div>
                    <div class="col-md-6 mt-5">
                        <label class="control-label mb-2 field_txt">Incharge Name</label>
                        <input value="<?php echo $result['InchargeName'] ?>" type="text"
                            class="form-control field_input_bg" name="incharge">

                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Branch</label>
                        <input value="<?php echo $result['Branch'] ?>" type="text" class="form-control field_input_bg"
                            name="branch">
                    </div>
                    <div class="col-md-6  mt-5">
                        <label class="control-label mb-2 field_txt">Date</label>
                        <input value="<?php echo $result['Date'] ?>" type="Date" class="form-control field_input_bg"
                            name="date">
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