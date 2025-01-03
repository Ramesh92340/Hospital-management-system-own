<?php
ob_start(); // Start output buffering



?>

<div id="wrapper">
    <?php


    include "../../../includes/sidebar.php";
    include "../../../includes/header.php";
    include "../../../config/db.php";

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $patient_id = filter_var($_GET['id'], FILTER_VALIDATE_INT);

        if ($patient_id) {
            // Fetch patient details
            $stmt = $pdo->prepare("SELECT * FROM patients_opd WHERE id = :id");
            $stmt->execute([':id' => $patient_id]);
            $patient = $stmt->fetch(PDO::FETCH_ASSOC);

            if ($patient) {
    ?>
                <div id="content-wrapper" class="d-flex flex-column bg-white">
                    <div id="content">
                        <h1 class="text-center mb-5"><strong>Patient Details</strong></h1>

                        <div class="d-flex justify-content-between px-5 mb-3">
                            <div>
                                <a href="javascript:history.back()" class=" viwe_btns viwe_btns_back mt-3"><i class="fa-solid fa-arrow-left"></i> Back</a>
                            </div>
                            <div>
                                <a href="edit_patient.php?id=<?php echo $patient['id']; ?>" class=" viwe_btns viwe_btns_edit mt-3"><i class="fa-solid fa-pen-to-square"></i> Edit</a>
                            </div>
                        </div>

                        <div class="container-fluid">
                            <div class="d-flex justify-content-between">
                                <!-- Patient Details Card -->
                                <div class="card flex-grow-1 me-2" style="border-radius: 10px;">
                                    <div class="card-header text-black   text-center"><h4>Patient Details</h4> </div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">ID</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>

                                            <div class="col-sm-8">#<?php echo htmlspecialchars($patient['id']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Name</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['name']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Age</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['age']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Gender</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['gender']); ?></div>
                                        </div>

                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Contact</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['contact']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Address</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['address']); ?></div>
                                        </div>
                                    </div>
                                </div>

                                <!-- Additional Details Card -->
                                <div class="card flex-grow-1" style="border-radius: 10px;">
                                    <div class="card-header text-black  text-center"><h4>Additional Details</h4></div>
                                    <div class="card-body">
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Doctor</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"><?php echo htmlspecialchars($patient['doctor']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Medical History</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"><?php echo htmlspecialchars($patient['medical_history']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Admission Type</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"><?php echo htmlspecialchars($patient['admission_type']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Documents</div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> 
                                                <?php
                                                if (!empty($patient['documents'])) {
                                                    $documents = explode(',', $patient['documents']);
                                                    foreach ($documents as $document) {
                                                        echo "<a href='" . htmlspecialchars($document) . "' download>Download Document</a><br>";
                                                    }
                                                } else {
                                                    echo "No Documents";
                                                }
                                                ?>
                                            </div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Created At </div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"><?php echo htmlspecialchars($patient['created_at']); ?></div>
                                        </div>
                                        <div class="row mb-3">
                                            <div class="col-sm-3 font-weight-bold">Updated At </div>
                                            <div class="col-sm-1 font-weight-bold"> :  </div>
                                            <div class="col-sm-8"> <?php echo htmlspecialchars($patient['updated_at']); ?></div>
                                        </div>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>




                </div>
</div>
<?php
            } else {
                echo "<div class='alert alert-danger text-center'>Patient not found.</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid Patient ID.</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Patient ID is required.</div>";
    }

?>
</div>

<?php
ob_end_flush(); // Flush the output buffer
?>