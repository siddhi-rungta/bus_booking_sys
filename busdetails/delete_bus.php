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

    $sql = "DELETE FROM bus WHERE bus_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $bus_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Bus deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting bus: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: busview.php"); // Redirect to your admin page
exit();
?>
