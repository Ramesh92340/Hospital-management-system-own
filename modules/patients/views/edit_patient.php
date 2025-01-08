<?php
ob_start(); // Start output buffering
?>

<div id="wrapper">
    <?php
    include '../../../includes/sidebar.php';
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
                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    $name = htmlspecialchars($_POST['name']);
                    $age = htmlspecialchars($_POST['age']);
                    $gender = htmlspecialchars($_POST['gender']);
                    $contact = htmlspecialchars($_POST['contact']);
                    $address = htmlspecialchars($_POST['address']);
                    $doctor = htmlspecialchars($_POST['doctor']);
                    $medical_history = htmlspecialchars($_POST['medical_history']);
                    $admission_type = htmlspecialchars($_POST['admission_type']);

                    // Handle file uploads
                    $uploaded_files = [];
                    if (!empty($_FILES['documents']['name'][0])) {
                        $upload_dir = '../../../assets/uploads/patient_documents/';
                        foreach ($_FILES['documents']['name'] as $key => $file_name) {
                            $target_path = $upload_dir . basename($file_name);
                            if (move_uploaded_file($_FILES['documents']['tmp_name'][$key], $target_path)) {
                                $uploaded_files[] = $file_name;
                            }
                        }
                    }

                    // Convert file names to JSON for storage
                    $documents_json = !empty($uploaded_files) ? json_encode($uploaded_files) : $patient['documents'];

                    // Update database
                    $stmt = $pdo->prepare("
                        UPDATE patients_opd 
                        SET 
                            name = :name,
                            age = :age,
                            gender = :gender,
                            contact = :contact,
                            address = :address,
                            doctor = :doctor,
                            medical_history = :medical_history,
                            admission_type = :admission_type,
                            documents = :documents,
                            updated_at = NOW()
                        WHERE id = :id
                    ");
                    $stmt->execute([
                        ':name' => $name,
                        ':age' => $age,
                        ':gender' => $gender,
                        ':contact' => $contact,
                        ':address' => $address,
                        ':doctor' => $doctor,
                        ':medical_history' => $medical_history,
                        ':admission_type' => $admission_type,
                        ':documents' => $documents_json,
                        ':id' => $patient_id
                    ]);

                    echo "<div class='alert alert-success text-center'>Patient details updated successfully!</div>";

                    // Redirect based on admission type
                    if ($admission_type === 'Casualty') {
                        header("Location: causality.php");
                        exit;
                    } elseif ($admission_type === 'OPD') {
                        header("Location: opd.php");
                        exit;
                    }
                }
    ?>


                <h1 class="text-center mb-5"><strong>Edit Patient Details</strong></h1>
                <div class="container">
                    <div id="adddoctorTable" class="table-container ul_border px-4 active">
                        <form method="POST" class="" enctype="multipart/form-data" action="">
                            <div class="form-group">
                                <div class="row">
                                    <div class="col-md-4 mt-5">
                                        <label for="name" class="control-label mb-2 field_txt">Name</label>
                                        <input type="text" name="name" id="name" class="form-control field_input_bg" value="<?php echo htmlspecialchars($patient['name']); ?>" required>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="age" class="control-label mb-2 field_txt">Age</label>
                                        <input type="number" name="age" id="age" class="form-control field_input_bg" value="<?php echo htmlspecialchars($patient['age']); ?>" required>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="gender" class="control-label mb-2 field_txt">Gender</label>
                                        <select name="gender" id="gender" class="form-control field_input_bg" required>
                                            <option value="Male" <?php echo $patient['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                            <option value="Female" <?php echo $patient['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                                            <option value="Other" <?php echo $patient['gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="contact" class="control-label mb-2 field_txt">Phone</label>
                                        <input type="text" name="contact" id="contact" class="form-control field_input_bg" value="<?php echo htmlspecialchars($patient['contact']); ?>" required>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="admission_type" class="control-label mb-2 field_txt">Admission Type</label>
                                        <select name="admission_type" id="admission_type" class="form-control field_input_bg" required>
                                            <option value="Casualty" <?php echo $patient['admission_type'] === 'Casualty' ? 'selected' : ''; ?>>Casualty</option>
                                            <option value="OPD" <?php echo $patient['admission_type'] === 'OPD' ? 'selected' : ''; ?>>OPD</option>
                                        </select>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="documents" class="control-label mb-2 field_txt">Upload Documents</label>
                                        <input type="file" name="documents[]" id="documents" class="form-control field_input_bg" multiple>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="doctor" class="control-label mb-2 field_txt">Doctor</label>
                                        <input type="text" name="doctor" id="doctor" class="form-control field_input_bg" value="<?php echo htmlspecialchars($patient['doctor']); ?>" required>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="address" class="control-label mb-2 field_txt">Address</label>
                                        <textarea name="address" id="address" class="form-control field_input_bg" rows="3" required><?php echo htmlspecialchars($patient['address']); ?></textarea>
                                    </div>
                                    <div class="col-md-4 mt-5">
                                        <label for="medical_history" class="control-label mb-2 field_txt">Medical History</label>
                                        <textarea name="medical_history" id="medical_history" class="form-control field_input_bg" rows="3"><?php echo htmlspecialchars($patient['medical_history']); ?></textarea>
                                    </div>
                                </div>
                                 <button type="submit" class="btn btn-primary mt-3">Update</button> 
                                <a href="javascript:history.back()" class="btn btn-secondary mt-3">Cancel</a>
                            </div>
                        </form>
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
    ob_end_flush();
    ?>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
    <?php include "../../../includes/footer.php"; ?>
</div>
