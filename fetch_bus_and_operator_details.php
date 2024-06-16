<?php
$servername = "localhost";
$username = "root";
$password = "";
$dbname = "bus_booking_sys";

$conn = new mysqli($servername, $username, $password, $dbname);

if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

$bus_id = $_POST['bus_id'];

$sql = "SELECT bus.bus_number, bus.bus_type, bus.operator_id, operator.operator_name 
        FROM bus 
        JOIN operator ON bus.operator_id = operator.operator_id 
        WHERE bus.bus_id = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param("i", $bus_id);
$stmt->execute();
$stmt->bind_result($bus_number, $bus_type, $operator_id, $operator_name);
$stmt->fetch();

$data = ['bus_number' => $bus_number, 'bus_type' => $bus_type, 'operator_id' => $operator_id, 'operator_name' => $operator_name];

echo json_encode($data);

$stmt->close();
$conn->close();
?>
