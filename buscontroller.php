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

try {
    $destination = $_POST['destination'];
    $starting_location = $_POST['starting_location'];
    $Schedule_date = $_POST['Schedule_date'];
    // $sql = "SELECT bus_number, bus_type, departure_time, fare_amount FROM bus LEFT OUTER JOIN route ON bus.bus_id=route.bus_id WHERE starting_location=? AND destination=? AND Schedule_date='2024-06-13'";
    // $stmt_operator = $conn->prepare($sql);
    // $stmt_operator->bind_param("ss", $starting_location, $destination);
    // $sql = "SELECT bus_number, bus_type, departure_time, fare_amount FROM bus LEFT OUTER JOIN route ON bus.bus_id=route.bus_id WHERE starting_location=? AND destination=? AND Schedule_date=?";
    // $stmt_operator = $conn->prepare($sql);
    // $stmt_operator->bind_param("sss", $starting_location, $destination, $Schedule_date);
    // $stmt_operator->execute();

    $sql = "SELECT bus_number,starting_location,destination,bus_type, departure_time, fare_amount FROM bus LEFT OUTER JOIN route ON bus.bus_id=route.bus_id WHERE starting_location='$starting_location' OR destination='$destination' OR Schedule_date='$Schedule_date'";
    $result = $conn->query($sql);
    // $result = $stmt_operator->get_result();

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $_SESSION['data'] = $data;
    } else {
        echo "No records found.";
    }
} catch (\Throwable $th) {
    // Log or display the error message
}
 

$conn->close();

header("Location: busdetails.php");
exit;
?>
