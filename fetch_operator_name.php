<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_sys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Get operator ID from POST request
$operator_id = $_POST['operator_id'];

// Fetch operator name
$sql = "SELECT operator_name FROM operator WHERE operator_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $operator_id);
$stmt->execute();
$stmt->bind_result($operator_name);
$stmt->fetch();

// Return operator name
echo $operator_name;

$stmt->close();
$conn->close();
?>
