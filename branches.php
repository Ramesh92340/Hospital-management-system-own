<div id="wrapper">


    <?php
    include "includes/sidebar.php";
    include "includes/header.php";
    include "config/db.php";
    if (isset($_POST['submit-btn'])) {

        $bArea = mysqli_real_escape_string($db_con, $_POST['brancharea']);



        $branchesQuery = mysqli_query($db_con, "INSERT INTO branch SET BranchArea	='" . $bArea . "',status=1");
        if ($branchesQuery) {
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
                <div class="container  branch_container      ">
                    
                        <div class=" p-2 branch_border">
                            <ul class="ul_style">
                                <li id="addReport" class="add_staff_list_detils open_table">+ Add Branch</li>
                                <li id="reports" class="staff_list_detils open_table active"> Branches</li>
                            </ul>

                            <script>
                                const listItems = document.querySelectorAll('.open_table');
                                const tableContainers = document.querySelectorAll('.table-container');

                                listItems.forEach(item => {
                                    item.addEventListener('click', function() {
                                        listItems.forEach(i => i.classList.remove('active'));
                                        this.classList.add('active');
                                        updateTable(this.id);
                                    });
                                });

                                function updateTable(id) {
                                    tableContainers.forEach(container => container.classList.remove('active'));
                                    document.querySelectorAll('.table-container').forEach(container => container.classList
                                        .remove('active'));
                                    document.getElementById(id + 'Table').classList.add('active');
                                }

                                // Initially show the details table
                                document.getElementById('reportsTable').classList.add('active');
                            </script>
                        </div>

                        <div class="p-2 branch_border">
                            <!-- 
                                <?php
                                include '..\..\db.connection\db_connection.php';

                                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                                    if (isset($_POST['branch_area']) && !empty($_POST['branch_area'])) {
                                        $branch_area = $_POST['branch_area'];

                                        $sql = "INSERT INTO branches (branch_area) VALUES (?)";
                                        $stmt = $conn->prepare($sql);
                                        $stmt->bind_param("s", $branch_area);

                                        if ($stmt->execute()) {
                                            echo "New branch added successfully";
                                            header("Location: branches.php");
                                            exit();
                                        } else {
                                            echo "Error: " . $sql . "<br>" . $conn->error;
                                        }

                                        $stmt->close();
                                    } else {
                                        echo "Branch area cannot be empty.";
                                    }
                                }

                                ?> -->

                            <div id="addReportTable" class="table-container">
                                <div class="container">
                                    <div class="row d-flex flex-row justify-content-between pt-4 pb-3">
                                        <div class="">
                                            <h6 class="staff_dtls">Add Branch</h6>
                                        </div>
                                    </div>
                                </div>

                                <form method="post" enctype="multipart/form-data">
                                    <div class="form-group">
                                        <div class="row">
                                            <div class="col-md-6 mt-5">
                                                <label class="control-label mb-2 field_txt">Branch Area</label>
                                                <input type="text" class="form-control field_input_bg" name="brancharea">
                                            </div>
                                            <div class="col-md-6 mt-5">
                                                <div class="row last_back_submit d-flex flex-row justify-content-between px-3">
                                                    <button class="back_btn_staff">Back</button>
                                                    <button type="submit" class="submit_btn_staff" name="submit-btn">Submit</button>
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                </form>
                            </div>



                            <h6 class="staff_dtls mt-5 mb-4">Total Branches</h6>

                            <table id="example" class="display mb-4" style="width:100%">
                                <thead class="table_bg">
                                    <tr>
                                        <th class="th_names">ID</th>
                                        <th class="th_names">Branch Area</th>
                                        <th class="th_names">Actions</th>
                                    </tr>
                                </thead>
                                <tbody>
                                    <?php
                                    $getQuery = mysqli_query($db_con, "SELECT * FROM branch WHERE status = 1");
                                    $no = 1;
                                    while ($data = mysqli_fetch_array($getQuery)) {

                                    ?>
                                        <tr class="tr_hover">
                                            <td class="td_id_num"><?php echo $no ?></td>
                                            <td class="td_id_num"><?php echo $data['BranchArea'] ?></td>


                                            <td>
                                                <a href="edit-branch.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Edit"> <button class="edit_icon"><i class="fa-regular fa-pen-to-square"></i></button></a>
                                                <a href="delete-branches.php?id=<?php echo $data['id'] ?>" data-toggle="tooltip" title="Delete"><button class="dlt_icon"><i class="fa-regular fa-trash-can"></i></button></a>

                                            </td>
                                        </tr>
                                    <?php
                                        $no++;
                                    }
                                    ?>
                                    <!-- Add more rows as needed -->
                                </tbody>
                            </table>

                        </div>
                   
                </div>

            </section>
        
        
        </div>


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