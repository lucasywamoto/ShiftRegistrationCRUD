<?php
include_once('database.php');

$name = $_POST['name'];
$employeeId = $_POST['employee-id'];
$branch = $_POST['branch'];
$date = $_POST['date'];
$timeIn = new DateTime($_POST['time-in']);
$timeOut = new DateTime($_POST['time-out']);
$duration = $timeIn->diff($timeOut)->format('%H:%I:%S');

$uploadSuccess = null;
$valid_file = true;

if (!empty($_FILES['avatar']['name'])) {
    // File details
    $filename = $_FILES['avatar']['name'];
    $target_file = './avatar/' . $filename;
    $file_extension = pathinfo($target_file, PATHINFO_EXTENSION);
    $file_extension = strtolower($file_extension);

    // Valid image extensions
    $valid_extension = array("png", "jpeg", "jpg", "pdf");

    if (in_array($file_extension, $valid_extension)) {
        // Upload file
        if (move_uploaded_file($_FILES['avatar']['tmp_name'], $target_file)) {
            $stmt = $conn->prepare("INSERT INTO timesheet (employee_name, employee_id, branch, shift_date, time_in, time_out, duration, avatar) VALUES (?, ?, ?, ?, ?, ?, ?, ?)");

            $stmt->bindParam(1, $name);
            $stmt->bindParam(2, $employeeId);
            $stmt->bindParam(3, $branch);
            $stmt->bindParam(4, $date);
            $stmt->bindParam(5, $timeIn->format('Y-m-d H:i:s'));
            $stmt->bindParam(6, $timeOut->format('Y-m-d H:i:s'));
            $stmt->bindParam(7, $duration);
            $stmt->bindParam(8, $filename);

            $result = $stmt->execute();

            if ($result) {
                header("Location: timesheet.php");
                exit();
            } else {
                echo "Error inserting data into the database.";
            }
        } else {
            $uploadSuccess = false;
        }
    } else {
        $valid_file = false;
    }
} else {
    // Handle insertion without file upload
    $stmt = $conn->prepare("INSERT INTO timesheet (employee_name, employee_id, branch, shift_date, time_in, time_out, duration) VALUES (?, ?, ?, ?, ?, ?, ?)");

    $stmt->bindParam(1, $name);
    $stmt->bindParam(2, $employeeId);
    $stmt->bindParam(3, $branch);
    $stmt->bindParam(4, $date);
    $stmt->bindParam(5, $timeIn->format('Y-m-d H:i:s'));
    $stmt->bindParam(6, $timeOut->format('Y-m-d H:i:s'));
    $stmt->bindParam(7, $duration);

    $result = $stmt->execute();

    if ($result) {
        header("Location: timesheet.php");
        exit();
    } else {
        echo "Error inserting data into the database.";
    }
}

if ($uploadSuccess === true) {
    header("Location: timesheet.php");
        exit();
} else if ($uploadSuccess === false) {
    echo "<p>Unsuccessful upload</p>";
}
if (!$valid_file) {
    echo "<p>Upload image files only</p>";
}
?>
