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
                    // Update patient details
                    $name = htmlspecialchars($_POST['name']);
                    $age = htmlspecialchars($_POST['age']);
                    $gender = htmlspecialchars($_POST['gender']);
                    $contact = htmlspecialchars($_POST['contact']);
                    $address = htmlspecialchars($_POST['address']);
                    $doctor = htmlspecialchars($_POST['doctor']);
                    $medical_history = htmlspecialchars($_POST['medical_history']);
                    $admission_type = htmlspecialchars($_POST['admission_type']);

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
                        ':id' => $patient_id
                    ]);

                    echo "<div class='alert alert-success text-center'>Patient details updated successfully!</div>";
                }
    ?>

                <div class="container">
                    <h1 class="text-center mb-5"><strong>Edit Patient Details</strong></h1>
                    <form method="POST" action="">
                        <div class="mb-3">
                            <label for="name" class="form-label">Name</label>
                            <input type="text" name="name" id="name" class="form-control" value="<?php echo htmlspecialchars($patient['name']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="age" class="form-label">Age</label>
                            <input type="number" name="age" id="age" class="form-control" value="<?php echo htmlspecialchars($patient['age']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="gender" class="form-label">Gender</label>
                            <select name="gender" id="gender" class="form-control" required>
                                <option value="Male" <?php echo $patient['gender'] === 'Male' ? 'selected' : ''; ?>>Male</option>
                                <option value="Female" <?php echo $patient['gender'] === 'Female' ? 'selected' : ''; ?>>Female</option>
                                <option value="Other" <?php echo $patient['gender'] === 'Other' ? 'selected' : ''; ?>>Other</option>
                            </select>
                        </div>
                        <div class="mb-3">
                            <label for="contact" class="form-label">Contact</label>
                            <input type="text" name="contact" id="contact" class="form-control" value="<?php echo htmlspecialchars($patient['contact']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="address" class="form-label">Address</label>
                            <textarea name="address" id="address" class="form-control" rows="3" required><?php echo htmlspecialchars($patient['address']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="doctor" class="form-label">Doctor</label>
                            <input type="text" name="doctor" id="doctor" class="form-control" value="<?php echo htmlspecialchars($patient['doctor']); ?>" required>
                        </div>
                        <div class="mb-3">
                            <label for="medical_history" class="form-label">Medical History</label>
                            <textarea name="medical_history" id="medical_history" class="form-control" rows="3"><?php echo htmlspecialchars($patient['medical_history']); ?></textarea>
                        </div>
                        <div class="mb-3">
                            <label for="admission_type" class="form-label">Admission Type</label>
                            <input type="text" name="admission_type" id="admission_type" class="form-control" value="<?php echo htmlspecialchars($patient['admission_type']); ?>" required>
                        </div>
                        <button type="submit" class="btn btn-primary">Update</button>
                        <a href="javascript:history.back()" class="btn btn-secondary">Cancel</a>
                    </form>
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