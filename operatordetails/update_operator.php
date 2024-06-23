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
    $operator_name = $_POST['operator_name'];
    $license_number = $_POST['license_number'];
    $contact = $_POST['contact'];

    $sql = "UPDATE operator SET operator_name=?, LicenseNumber=?, contact=? WHERE operator_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("sssi", $operator_name, $license_number, $contact, $operator_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Operator updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating operator: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: operatordisplay.php"); // Redirect to your admin page
exit();
?>
