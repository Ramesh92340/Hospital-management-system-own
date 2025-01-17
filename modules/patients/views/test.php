<?php
ob_start(); // Start output buffering
?>

<div id="wrapper">
    <?php
    include '../../../includes/sidebar.php';
    include "../../../includes/header.php";
    include "../../../config/db.php";

    // Capture the referrer URL or fallback to dashboard
    $referrer = isset($_SERVER['HTTP_REFERER']) ? $_SERVER['HTTP_REFERER'] : '../../../dashboard.php';

    if (isset($_GET['id']) && !empty($_GET['id'])) {
        $patient_id = filter_input(INPUT_GET, 'id', FILTER_SANITIZE_STRING);

        // Validate the ID format (YYYYMMDD-XXXX)
        if (preg_match('/^\d{8}-\d{4}$/', $patient_id)) {
            try {
                // Fetch patient details
                $stmt = $pdo->prepare("SELECT * FROM patients_opd WHERE id = :id");
                $stmt->execute([':id' => $patient_id]);
                $patient = $stmt->fetch(PDO::FETCH_ASSOC);

                if (!$patient) {
                    echo "<div class='alert alert-danger text-center'>Patient not found!</div>";
                    exit;
                }

                if (isset($_GET['delete_report'])) {
                    $report_to_delete = filter_input(INPUT_GET, 'delete_report', FILTER_SANITIZE_STRING);
                    $existing_reports = $patient['reports'] ? explode(',', $patient['reports']) : [];

                    // Remove the specified report
                    $updated_reports = array_filter($existing_reports, fn($report) => $report !== $report_to_delete);

                    // Update the database
                    $stmt = $pdo->prepare("UPDATE patients_opd SET reports = :reports WHERE id = :id");
                    $stmt->execute([
                        ':reports' => implode(',', $updated_reports),
                        ':id' => $patient_id,
                    ]);

                    // Delete the file from the server
                    if (file_exists($report_to_delete)) {
                        unlink($report_to_delete);
                    }

                    header("Location: edit_patient.php?id=$patient_id");
                    exit();
                }

                if ($_SERVER['REQUEST_METHOD'] === 'POST') {
                    // Sanitize form inputs
                    $name = filter_input(INPUT_POST, 'name', FILTER_SANITIZE_STRING);
                    $age = filter_input(INPUT_POST, 'age', FILTER_VALIDATE_INT);
                    $gender = filter_input(INPUT_POST, 'gender', FILTER_SANITIZE_STRING);
                    $contact = filter_input(INPUT_POST, 'contact', FILTER_SANITIZE_NUMBER_INT);
                    $address = filter_input(INPUT_POST, 'address', FILTER_SANITIZE_STRING);
                    $doctor = filter_input(INPUT_POST, 'doctor', FILTER_SANITIZE_STRING);
                    $medical_history = filter_input(INPUT_POST, 'medical_history', FILTER_SANITIZE_STRING);
                    $admission_type = filter_input(INPUT_POST, 'admission_type', FILTER_SANITIZE_STRING);

                    // Handle file uploads
                    $uploaded_files = [];
                    if (!empty($_FILES['reports']['name'][0])) {
                        $upload_dir = '../../../assets/uploads/patient_reports/';
                        foreach ($_FILES['reports']['name'] as $key => $file_name) {
                            $target_path = $upload_dir . basename($file_name);
                            if (move_uploaded_file($_FILES['reports']['tmp_name'][$key], $target_path)) {
                                $uploaded_files[] = $target_path; // Save full file path
                            }
                        }
                    }

                    // Combine new and old documents
                    $existing_documents = $patient['reports'] ? explode(',', $patient['reports']) : [];
                    $all_documents = array_merge($existing_documents, $uploaded_files);
                    $documents_str = implode(',', $all_documents);

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
                            reports = :reports,
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
                        ':reports' => $documents_str,
                        ':id' => $patient_id,
                    ]);

                    // Redirect to the referring page
                    $redirect_url = filter_input(INPUT_POST, 'referrer', FILTER_SANITIZE_URL);
                    header("Location: " . $redirect_url);
                    exit();
                }
            } catch (PDOException $e) {
                echo "<div class='alert alert-danger text-center'>Error: " . htmlspecialchars($e->getMessage()) . "</div>";
            }
        } else {
            echo "<div class='alert alert-danger text-center'>Invalid patient ID format!</div>";
        }
    } else {
        echo "<div class='alert alert-danger text-center'>Patient ID is missing!</div>";
        exit;
    }
    ?>

    <div id="content-wrapper" class="d-flex flex-column bg-white">
        <div id="content">
            <h1 class="text-center"><strong>Edit Patient</strong></h1>
            <div class="container">
                <form method="post" enctype="multipart/form-data">
                    <input type="hidden" name="referrer" value="<?= htmlspecialchars($referrer) ?>">

                    <div class="form-group">
                        <div class="col-12 mt-5 d-flex flex-row justify-content-end">
                            <button type="submit" class="btn btn-primary">Update</button>
                        </div>

                        <div class="row">
                            <!-- Form fields for patient details -->
                            <div class="col-md-4 mt-5">
                                <label class="control-label mb-2">Patient Name</label>
                                <input type="text" class="form-control" name="name" value="<?= htmlspecialchars($patient['name']) ?>" required>
                            </div>
                            <!-- Other fields similar to the original -->
                        </div>
                        <!-- Patient Reports Section -->
                        <!-- Your existing code for handling and displaying reports -->
                    </div>
                </form>
            </div>
        </div>
    </div>

    <?php include "../../../includes/footer.php"; ?>
</div>
<?php ob_end_flush(); ?>
