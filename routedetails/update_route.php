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
    $route_id = $_POST['route_id'];
    $bus_id = $_POST['bus_id'];
    $starting_location = $_POST['starting_location'];
    $destination = $_POST['destination'];
    $Schedule_date = $_POST['Schedule_date'];
    $departure_time = $_POST['departure_time'];
    $fare_amount = $_POST['fare_amount'];

    $sql = "UPDATE route SET bus_id=?, starting_location=?, destination=?, Schedule_date=?, departure_time=?, fare_amount=? WHERE route_id=?";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("isssssi", $bus_id, $starting_location, $destination, $Schedule_date, $departure_time, $fare_amount, $route_id);

    if ($stmt->execute()) {
        $_SESSION['success'] = "Route updated successfully!";
    } else {
        $_SESSION['error'] = "Error updating route: " . $conn->error;
    }

    $stmt->close();
}

$conn->close();
header("Location: routedetails.php");
exit();
?>
