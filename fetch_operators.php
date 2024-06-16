<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_sys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

// Fetch operator IDs and names
$sql = "SELECT operator_id, operator_name FROM operator";
$result = $conn->query($sql);

$operators = [];
while ($row = $result->fetch_assoc()) {
    $operators[] = $row;
}

// Return operator data as JSON
echo json_encode($operators);

$conn->close();
?>
