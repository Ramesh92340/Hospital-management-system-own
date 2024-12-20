<div id="wrapper">


    <?php
    include "includes/sidebar.php";
    include "includes/header.php";
    include "config/db.php";
  
 
    if (isset($_POST['submit-btn'])) {

        $iname = mysqli_real_escape_string($db_con, $_POST['Item']);
        $kggs = mysqli_real_escape_string($db_con, $_POST['Kg']);
        $amnt = mysqli_real_escape_string($db_con, $_POST['amount']);
        $disc = mysqli_real_escape_string($db_con, $_POST['discount']);
        $incName = mysqli_real_escape_string($db_con, $_POST['incharge']);
        $brnch = mysqli_real_escape_string($db_con, $_POST['branch']);
        $dat = mysqli_real_escape_string($db_con, $_POST['date']);

        $billingQuery = mysqli_query($db_con, "INSERT INTO items SET ItemName='" . $iname . "',Kgs='" . $kggs . "',Amount='" . $amnt . "',Discount='" . $disc . "',InchargeName	='" . $incName . "',Branch='" . $brnch . "',Date='" . $dat . "', status=1");
        if ($billingQuery) {
            echo '<script>alert("Data Inserted Successfully")</script>';
            echo '<script>window.location.href="#"</script>';
        } else {
            echo '<script>alert("Failed To Inserted")</script>';
        }
    }





    ?>


    <div id="content-wrapper" class="d-flex flex-column   bg-white">


        <div id="content">


            <section>
                <div class="container">
                    <div class="row ">
                        <div class="col-md-2 col-lg-2   table_adjustment">
                            <ul class="ul_style">
                                <li id="addReport" class="add_staff_list_detils open_table">+ Add Item</li>

                                <li id="totalBranch" class="staff_list_detils open_table active"> Items</li>

                            </ul>

                            <script>
                                const listItems = document.querySelectorAll('.open_table');
                                const tableContainers = document.querySelectorAll('.    ');

                                listItems.forEach(item => {
                                    item.addEventListener('click', function() {
                                        listItems.forEach(i => i.classList.remove('active'));
                                        this.classList.add('active');
                                        updateTable(this.id);
                                    });
                                });

                                function updateTable(id) {
                                    tableContainers.forEach(container => container.classList.remove('active'));
                                    document.querySelectorAll('.table-container').forEach(container => container
                                        .classList.remove('active'));
                                    document.getElementById(id + 'Table').classList.add('active');
                                }

                                // Initially show the details table
                                document.getElementById('detailsTable').classList.add('active');
                            </script>
                        </div>

                        <div class="col-md-10   col-lg-10   table_adjustment">


                            <div id="addReportTable" class="table-container  ">

                                <div class="container">
                                    <div class="row d-flex flex-row justify-content-between pt-4 pb-3">
                                        <div class="">
                                            <h6 class="staff_dtls">Add Item </h6>
                                        </div>
                                        <div class="">
                                            <h6 class="kkd_brnch">Kakinada Branch
                                                <svg class="kkdIcon ml-3" xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                                    <path d="M17.7178 4.96555L10 12.1861L2.28216 4.96555C1.67358 4.33767 1.06501 4.32459 0.456432 4.9263C-0.152144 5.52802 -0.152144 6.11665 0.456432 6.6922L9.08714 14.8546C9.30844 15.1162 9.61272 15.247 10 15.247C10.3873 15.247 10.6916 15.1162 10.9129 14.8546L19.5436 6.6922C20.1521 6.11665 20.1521 5.52802 19.5436 4.9263C18.935 4.32459 18.3264 4.33767 17.7178 4.96555Z" fill="#202224" />
                                                </svg>
                                            </h6>
                                        </div>
                                    </div>
                                </div>


                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">




                                            <div class="col-md-6 mt-5">
                                                <label class="control-label mb-2 field_txt">Item Name</label>
                                                <input type="text" class="form-control field_input_bg" name="Item">

                                            </div>
                                            <div class="col-md-6  mt-5">
                                                <label class="control-label mb-2 field_txt">Kg's</label>
                                                <input type="text" class="form-control field_input_bg" name="Kg">
                                            </div>
                                            <div class="col-md-6  mt-5">
                                                <label class="control-label mb-2 field_txt">Amount</label>
                                                <input type="number" class="form-control field_input_bg" name="amount">


                                            </div>
                                            <div class="col-md-6  mt-5">
                                                <label class="control-label mb-2 field_txt">Discount</label>
                                                <input type="number" class="form-control field_input_bg" name="discount">


                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <label class="control-label mb-2 field_txt">Incharge Name</label>
                                                <input type="text" class="form-control field_input_bg" name="incharge">

                                            </div>
                                            <div class="col-md-6  mt-5">
                                                <label class="control-label mb-2 field_txt">Branch</label>
                                                <input type="text" class="form-control field_input_bg" name="branch">
                                            </div>
                                            <div class="col-md-6  mt-5">
                                                <label class="control-label mb-2 field_txt">Date</label>
                                                <input type="Date" class="form-control field_input_bg" name="date">
                                            </div>

                                            <div class="col-md-6 mt-5">


                                                <div class="row last_back_submit  d-flex flex-row justify-content-between  px-3">
                                                    <button class="back_btn_staff">Back</button>
                                                    <button class="submit_btn_staff" name="submit-btn">Submit</button>

                                                </div>

                                            </div>



                                        </div>
                                    </div>
                                </form>
                            </div>

                            <!-- <div id="reportsTable" class="table-container active">


                                <div class="container">
                                    <div class="row d-flex flex-row justify-content-between pt-4 pb-3">
                                        <div class="">
                                            <h6 class="staff_dtls">Items Billing Managment</h6>
                                        </div>
                                        <div class="">
                                            <h6 class="kkd_brnch">Kakinada Branch
                                                <svg class="kkdIcon ml-3" xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                                    <path d="M17.7178 4.96555L10 12.1861L2.28216 4.96555C1.67358 4.33767 1.06501 4.32459 0.456432 4.9263C-0.152144 5.52802 -0.152144 6.11665 0.456432 6.6922L9.08714 14.8546C9.30844 15.1162 9.61272 15.247 10 15.247C10.3873 15.247 10.6916 15.1162 10.9129 14.8546L19.5436 6.6922C20.1521 6.11665 20.1521 5.52802 19.5436 4.9263C18.935 4.32459 18.3264 4.33767 17.7178 4.96555Z" fill="#202224" />
                                                </svg>
                                            </h6>
                                        </div>
                                    </div>
                                </div>

                                <table class="table_stf">
                                    <thead class="table_bg">
                                        <tr>
                                            <th class="th_names">S.No</th>
                                            <th class="th_names">Item</th>
                                            <th class="th_names">Kg's</th>
                                            <th class="th_names">Amount</th>
                                            <th class="th_names">Billing Date</th>
                                            <th class="th_names">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <tr class="tr_hover">
                                            <td class="td_id_num">1</td>
                                            <td class="td_id_mob">

                                                <img src="img/profile (1).png" alt="John Doe" class="td_profile_pic">
                                                Kaja
                                            </td>
                                            <td class="td_id_num">55 </td>


                                            <td class="td_id_mob">3000</td>
                                            <td class="td_id_num">14/08/2024</td>
                                            <td>
                                                <button class="edit_icon"><i class="fa-regular fa-pen-to-square"></i></button>
                                                <button class="dlt_icon"><i class="fa-regular fa-trash-can"></i></button>
                                            </td>
                                        </tr>
                                    </tbody>
                                </table>
                            </div> -->

                            <div id="totalBranchTable" class="table-container active ">


                                <!-- <div class="container">
                                    <div class="row d-flex flex-row justify-content-between pt-4 pb-3">
                                        <div class="">
                                            <h6 class="staff_dtls">Total Items</h6>
                                        </div>
                                        <div class="">
                                            <h6 class="kkd_brnch">Kakinada Branch
                                                <svg class="kkdIcon ml-3" xmlns="http://www.w3.org/2000/svg" width="20" height="19" viewBox="0 0 20 19" fill="none">
                                                    <path d="M17.7178 4.96555L10 12.1861L2.28216 4.96555C1.67358 4.33767 1.06501 4.32459 0.456432 4.9263C-0.152144 5.52802 -0.152144 6.11665 0.456432 6.6922L9.08714 14.8546C9.30844 15.1162 9.61272 15.247 10 15.247C10.3873 15.247 10.6916 15.1162 10.9129 14.8546L19.5436 6.6922C20.1521 6.11665 20.1521 5.52802 19.5436 4.9263C18.935 4.32459 18.3264 4.33767 17.7178 4.96555Z" fill="#202224" />
                                                </svg>
                                            </h6>
                                        </div>
                                    </div>
                                </div> -->





                                <!-- <h4 class="card-title mb-5 strip"></h4> -->
                                <h6 class="staff_dtls mt-5 mb-4">Total Items</h6>

                                <table id="example" class="display mb-4" style="width:100%">
                                    <thead>
                                        <tr>
                                            <th class="th_names">ID</th>
                                            <th class="th_names">Item Name</th>
                                            <th class="th_names">Kg's</th>
                                            <th class="th_names">Amount</th>
                                            <th class="th_names">Discount</th>
                                            <th class="th_names">Incharge Name</th>
                                            <th class="th_names">Branch</th>
                                            <th class="th_names">Date</th>
                                            <th class="th_names">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getQuery = mysqli_query($db_con, "SELECT * FROM items WHERE status = 1");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($getQuery)) {

                                        ?>
                                            <tr class="tr_hover">
                                                <td class="td_id_num"><?php echo $no ?></td>
                                                <td class="td_id_mob"><?php echo $data['ItemName'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Kgs'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Amount'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Discount'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['InchargeName'] ?>
                                                </td>
                                                <td class="td_id_mob"><?php echo $data['Branch'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Date'] ?></td>

                                                <td>
                                                    <div>

                                                        <a href="edit-billing.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Edit"> <button class="edit_icon"><i class="fa-regular fa-pen-to-square"></i></button></a>
                                                        <a href="delete-billing.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Delete"><button class="dlt_icon"><i class="fa-regular fa-trash-can"></i></button></a>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table>






                                <!-- <table id="example" class="display" style="width:100%">
                                    <thead class="table_bg">
                                        <tr>
                                            <th class="th_names">ID</th>
                                            <th class="th_names">Item Name</th>
                                            <th class="th_names">Kg's</th>
                                            <th class="th_names">Amount</th>
                                            <th class="th_names">Discount</th>
                                            <th class="th_names">Incharge Name</th>
                                            <th class="th_names">Branch</th>
                                            <th class="th_names">Date</th>
                                            <th class="th_names">Actions</th>

                                        </tr>
                                    </thead>
                                    <tbody>
                                        <?php
                                        $getQuery = mysqli_query($db_con, "SELECT * FROM items WHERE status = 1");
                                        $no = 1;
                                        while ($data = mysqli_fetch_array($getQuery)) {

                                        ?>
                                            <tr class="tr_hover">
                                                <td class="td_id_num"><?php echo $no ?></td>
                                                <td class="td_id_mob"><?php echo $data['ItemName'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Kgs'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Amount'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Discount'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['InchargeName'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Branch'] ?></td>
                                                <td class="td_id_mob"><?php echo $data['Date'] ?></td>

                                                <td>
                                                    <div>

                                                        <a href="edit-billing.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Edit"> <button class="edit_icon"><i class="fa-regular fa-pen-to-square"></i></button></a>
                                                        <a href="delete-billing.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Delete"><button class="dlt_icon"><i class="fa-regular fa-trash-can"></i></button></a>

                                                    </div>
                                                </td>
                                            </tr>
                                        <?php
                                            $no++;
                                        }
                                        ?>
                                    </tbody>
                                </table> -->
                                <!-- </div> -->

                            </div>
                        </div>
                    </div>
            </section>

        </div>


    </div>


    <?php
    include "includes/footer.php";
    ?>
    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
    </script>
</div>