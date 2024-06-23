<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_sys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$sql = "SELECT bus_id, bus_number FROM bus";
$result = $conn->query($sql);

$buses = [];
while ($row = $result->fetch_assoc()) {
    $buses[] = $row;
}

echo json_encode($buses);

$conn->close();
?>
