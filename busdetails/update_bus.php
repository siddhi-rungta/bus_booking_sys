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
    $bus_id = $_POST['bus_id'];
    $bus_number = $_POST['bus_number'];
    $bus_type = $_POST['bus_type'];
    $seat_capacity = $_POST['seat_capacity'];
    $operator_id = $_POST['operator_id'];

    $sql = "UPDATE bus SET bus_number=?, bus_type=?, seat_capacity=?, operator_id=? WHERE bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssiii", $bus_number, $bus_type, $seat_capacity, $operator_id, $bus_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Bus updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating bus: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: busview.php");
exit();
?>
