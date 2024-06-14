<?php
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

// Start transaction
$conn->begin_transaction();
try {

  $fullname = $_POST['fullname'];
  $contact = $_POST['contact'];
  $starting_location = $_POST['starting_location'];
  $destination = $_POST['destination'];
  $date_of_travel = $_POST['date_of_travel'];
  $bus_number = $_POST['bus_number'];
  $bus_id = $_POST['bus_id'];
  $number_of_seats = $_POST['Number_of_seats'];
  $selected_seats = $_POST['selected_seats']; // New field

  $sql_operator = "INSERT INTO booking (fullname, contact, starting_location, destination, date_of_travel, bus_number, bus_id, number_of_seats, selected_seats) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?)";
  $stmt_operator = $conn->prepare($sql_operator);
  $stmt_operator->bind_param("ssssssiss", $fullname, $contact, $starting_location, $destination, $date_of_travel, $bus_number, $bus_id, $number_of_seats, $selected_seats);
  $stmt_operator->execute();
  $conn->commit();
    echo "New records created successfully";

} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>
