<?php
session_start();
ini_set('display_errors', 1);
error_reporting(E_ALL);
if (!isset($_SESSION['user_id']) || (time() > $_SESSION['timeout'])) {
    session_unset();     // Unset all session variables
    session_destroy();
    echo "<p style='text-align: center;'>You're not logged in. Please <a href='signin.php' style='color: white;'>sign in</a>.</p>";
} else {
    if (isset($_GET['id'])) {
        try {
            $conn = new PDO('mysql:host=sql.freedb.tech;dbname=freedb_mydatabase-lucasywamoto', 'freedb_lucasywamoto', '8#z%zs8m!@NXYB!');
            $conn->setAttribute(PDO::ATTR_ERRMODE, PDO::ERRMODE_EXCEPTION);

            $stmt = $conn->prepare("DELETE FROM timesheet WHERE workshift_id = :id");

            $stmt->bindParam(':id', $_GET['id']);
            $stmt->execute();

            header("Location: timesheet.php");
            exit();
        } catch (PDOException $e) {
            echo "Error: " . $e->getMessage();
        }
    } else {
        echo "No employee ID provided.";
    }
}
?>