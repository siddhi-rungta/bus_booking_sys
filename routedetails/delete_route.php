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
    $bus_id = $_POST['route_id'];

    $sql = "DELETE FROM bus WHERE route_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("i", $route_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Route deleted successfully!";
    } else {
        $_SESSION['error'] = "Error deleting bus: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: routedetais.php"); // Redirect to your admin page
exit();
?>