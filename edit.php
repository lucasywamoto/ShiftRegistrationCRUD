<?php
session_start();
require 'database.php';
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <title>Work Shifts Registration</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <link rel="icon" type="image/x-icon" href="images/logo@256x.png">
    <!-- Bootstrap CSS v5.2.1 -->
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-iYQeCzEYFbKjA/T2uDLTpkwGzCiq6soy8tYaI1GyVh/UjpbCx/TYkiZhlZB6+fzT" crossorigin="anonymous">
    <link rel="stylesheet" href="css/style.css">
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js" integrity="sha384-oBqDVmMz9ATKxIep9tiCxS/Z9fNfEXiDAYTujMAeBAsjFuCZSmKbSSUnQlmh/jp3" crossorigin="anonymous"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.2.1/dist/js/bootstrap.min.js" integrity="sha384-7VPbUDkoPSGFnVtYi0QogXtr74QeVeeIs99Qfg5YCF+TidwNdjvaKZX19NZ/e6oz" crossorigin="anonymous"></script>
</head>

<body>
    <header><?php
            include_once 'includes/header.php';
            ?></header>
    <main>
        <div class="shift-registration-main" style="padding-top: 64px;">
            <?php
            ini_set('display_errors', 1);
            error_reporting(E_ALL);
            if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
                if (session_status() === PHP_SESSION_ACTIVE) {
                    session_unset();
                    session_destroy();
                }
                echo "<p style='text-align: center;'>You're not logged in. Please <a href='signin.php' style='color: white;'>sign in</a>.</p>";
            } else {
                include_once 'database.php';
                if ($_SERVER['REQUEST_METHOD'] === 'POST' && isset($_POST['id'])) {
                    $id = $_POST['id'];
                    $employee_name = $_POST['employee_name'];
                    $employee_id = $_POST['employee_id'];
                    $branch = $_POST['branch'];
                    $shift_date = $_POST['shift_date'];
                    $timeIn = new DateTime($_POST['time-in']);
                    $timeOut = new DateTime($_POST['time-out']);
                    $duration = $timeIn->diff($timeOut)->format('%H:%I');
                    $time_in = date('H:i', strtotime($_POST['time-in']));
                    $time_out = date('H:i', strtotime($_POST['time-out']));
                    $query = "UPDATE timesheet SET employee_name=?, employee_id=?, branch=?, shift_date=?, time_in=?, time_out=?, duration=? WHERE workshift_id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$employee_name, $employee_id, $branch, $shift_date, $time_in, $time_out, $duration, $id]);
                    echo '<script>window.location.href = "timesheet.php";</script>';
                    exit();
                } elseif (isset($_GET['id']) && is_numeric($_GET['id'])) {
                    $id = $_GET['id'];
                    $query = "SELECT * FROM timesheet WHERE workshift_id=?";
                    $stmt = $conn->prepare($query);
                    $stmt->execute([$id]);
                    $record = $stmt->fetch(PDO::FETCH_ASSOC);
                    if ($record) {
                        $employee_name = $record['employee_name'];
                        $employee_id = $record['employee_id'];
                        $branch = $record['branch'];
                        $shift_date = $record['shift_date'];
                        $time_in = $record['time_in'];
                        $time_out = $record['time_out'];
                    }
                }
            ?><div class="form-container">
                    <h2>Edit Shift</h2>
                    <form method="post" action="edit.php">
                        <input type="hidden" name="id" value="<?= $id ?>">
                        <div class="input-container">
                            <div class="mb-3">
                                <label for="employee_name" class="form-label">Employee Name</label>
                                <input type="text" class="form-control" name="employee_name" id="employee_name" value="<?= $employee_name ?>">
                            </div>
                            <div class="mb-3">
                                <label for="employee_id" class="form-label">Employee ID</label>
                                <input type="text" class="form-control" name="employee_id" id="employee_id" value="<?= $employee_id ?>">
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="mb-3">
                                <label for="branch" class="form-label">Branch</label>
                                <select class="form-select form-select-lg" name="branch" id="branch" required>
                                    <option disabled>Select one</option>
                                    <option value="Toronto" <?= ($branch == 'Toronto') ? 'selected' : '' ?>>Toronto</option>
                                    <option value="Ottawa" <?= ($branch == 'Ottawa') ? 'selected' : '' ?>>Ottawa</option>
                                    <option value="Montreal" <?= ($branch == 'Montreal') ? 'selected' : '' ?>>Montreal</option>
                                    <option value="Calgary" <?= ($branch == 'Calgary') ? 'selected' : '' ?>>Calgary</option>
                                    <option value="Vancouver" <?= ($branch == 'Vancouver') ? 'selected' : '' ?>>Vancouver</option>
                                </select>
                            </div>
                            <div class="mb-3">
                                <label for="shift_date" class="form-label">Date</label>
                                <input type="date" class="form-control" id="shift_date" name="shift_date" value="<?= $shift_date ?>" required />
                            </div>
                        </div>
                        <div class="input-container">
                            <div class="mb-3">
                                <label for="time-in" class="form-label">Time in</label>
                                <input type="time" class="form-control" id="time-in" name="time-in" value="<?= $time_in ?>" required />
                            </div>
                            <div class="mb-3">
                                <label for="time-out" class="form-label">Time out</label>
                                <input type="time" class="form-control" id="time-out" name="time-out" value="<?= $time_out ?>" required />
                            </div>
                        </div>
                        <div class="input-container form-buttons">
                            <button type="submit" class="btn btn-primary" name="Submit">Save</button>
                        </div>
                    </form>
                </div>
            <?php
            }
            ?>
        </div>
    </main>
    <footer>
        <?php include_once 'includes/footer.php'; ?>
    </footer>
</body>

</html>