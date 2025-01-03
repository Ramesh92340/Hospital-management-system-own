<?php
ob_start(); // Start output buffering
?>

<div id="wrapper">

    <?php
    include '../../../includes/sidebar.php';
    include "../../../includes/header.php";
    include "../../../config/db.php";

    if ($_SERVER['REQUEST_METHOD'] == 'POST') {
        if (isset($_POST['submit_doc_btn'])) {

            // Sanitize and validate form inputs
            $name = filter_var($_POST['name'], FILTER_SANITIZE_STRING);
            $age = filter_var($_POST['age'], FILTER_VALIDATE_INT);
            $gender = filter_var($_POST['gender'], FILTER_SANITIZE_STRING);
            $contact = filter_var($_POST['contact'], FILTER_SANITIZE_NUMBER_INT);
            $address = filter_var($_POST['address'], FILTER_SANITIZE_STRING);
            $medical_history = filter_var($_POST['medical_history'], FILTER_SANITIZE_STRING);
            $admission_type = filter_var($_POST['admission_type'], FILTER_SANITIZE_STRING);
            $doctor = filter_var($_POST['doctor'], FILTER_SANITIZE_STRING); // New doctor field

            // Validate the sanitized inputs
            if (!$name || !$age || !$gender || !$contact || !$address || !$medical_history || !$admission_type || !$doctor) {
                echo '<script>alert("Please fill in all fields correctly.");</script>';
            } else {
                try {
                    // Handle document uploads
                    $documents = [];
                    if (!empty($_FILES['documents']['name'][0])) {
                        $target_dir = "../../../assets/uploads/patient_documents/";

                        // Loop through files if multiple files are uploaded
                        foreach ($_FILES['documents']['name'] as $index => $filename) {
                            $target_file = $target_dir . basename($filename);
                            if (move_uploaded_file($_FILES['documents']['tmp_name'][$index], $target_file)) {
                                $documents[] = $target_file;  // Store document file paths
                            }
                        }
                    }

                    $documents_str = implode(',', $documents);  // Combine file paths into a comma-separated string

                    // Use the $pdo connection to insert data
                    $stmt = $pdo->prepare(
                        "INSERT INTO patients_opd (name, age, gender,  doctor, contact, address, medical_history, admission_type, documents) 
                         VALUES (:name, :age, :gender, :doctor, :contact, :address, :medical_history, :admission_type, :documents)"
                    );
                    $stmt->execute([
                        ':name' => $name,
                        ':age' => $age,
                        ':gender' => $gender,
                        ':doctor' => $doctor,
                        ':contact' => $contact,
                        ':address' => $address,
                        ':medical_history' => $medical_history,
                        ':admission_type' => $admission_type,
                        ':documents' => $documents_str
                    ]);

                    echo '<script>alert("Patient data inserted successfully.");</script>';
                    header('Location: ' . $_SERVER['PHP_SELF']);
                    exit();
                } catch (PDOException $e) {
                    echo '<script>alert("Error: ' . htmlspecialchars($e->getMessage()) . '");</script>';
                }
            }
        }
    }

    ob_end_flush(); // Flush the output buffer
    ?>

    <div id="content-wrapper" class="d-flex flex-column bg-white">

        <div id="content">
            <h1 class="text-center"> <strong> Add Patient </strong></h1>
            <div class="container">

                <div id="adddoctorTable" class="table-container ul_border px-4 active">

                    <form method="post" enctype="multipart/form-data" onsubmit="return confirmSubmission()">
                        <div class="form-group">
                            <div class="row">

                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Patient Name</label>
                                    <input type="text" class="form-control field_input_bg" name="name" required>
                                </div>

                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Age</label>
                                    <input type="number" class="form-control field_input_bg" name="age" required>
                                </div>

                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Gender</label>
                                    <select name="gender" class="form-control field_input_bg" required>
                                        <option value="Male">Male</option>
                                        <option value="Female">Female</option>
                                        <option value="Other">Other</option>
                                    </select>
                                </div>


                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Phone</label>
                                    <input type="tel" class="form-control field_input_bg" name="contact" required>
                                </div>
                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Doctor</label>
                                    <input type="text" class="form-control field_input_bg" name="doctor" required>
                                </div>


                                <!-- New Admission Type -->
                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Admission Type</label>
                                    <select name="admission_type" class="form-control field_input_bg" required>
                                        <option value="Casualty">Casualty</option>
                                        <option value="OPD">OPD</option>
                                    </select>
                                </div>

                                <!-- Document Upload Section -->
                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Upload Documents</label>
                                    <input type="file" name="documents[]" class="form-control field_input_bg" multiple>
                                </div>

                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Address</label>
                                    <textarea class="form-control field_input_bg" name="address" rows="4" required></textarea>
                                </div>

                                <div class="col-md-4 mt-5">
                                    <label class="control-label mb-2 field_txt">Medical History</label>
                                    <textarea class="form-control field_input_bg" name="medical_history" rows="4" required></textarea>
                                </div>

                                <div class="col-md-4 mt-5">
                                    <div class="row last_back_submit d-flex flex-column align-items-center gap-4 px-3">
                                        <button type="button" class="back_btn_staff">Back</button>
                                        <button type="submit" class="submit_btn_staff" name="submit_doc_btn">Submit</button>
                                    </div>
                                </div>

                            </div>
                        </div>
                    </form>

                    <script>
                        function confirmSubmission() {
                            return confirm('Are you sure you want to submit the form?');
                        }
                    </script>
                </div>

            </div>

        </div>

    </div>

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>

    <?php
    include "../../../includes/footer.php";
    ?>

    <script src="https://cdn.datatables.net/1.13.7/js/jquery.dataTables.min.js"></script>
    <script>
        new DataTable('#example');
        new DataTable('#example1');
    </script>

</div>