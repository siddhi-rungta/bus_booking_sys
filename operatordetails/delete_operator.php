<?php
session_start();
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_sys";

// Create connection
$conn = new mysqli($servername, $username, $password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $operator_id = $_POST['operator_id'];

    $sql = "DELETE FROM operator WHERE operator_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $operator_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Operator deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting operator: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: operatordisplay.php"); // Redirect to your admin page
exit();
?>
