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
    // Insert into operator table
    $operator_id = $_POST['operator_id'];
    $operator_name = $_POST['operator_name'];
    $LicenseNumber = $_POST['LicenseNumber'];
    $contact = $_POST['contact'];

    $sql_operator = "INSERT INTO operator (operator_id, operator_name, LicenseNumber, contact) VALUES (?, ?, ?, ?)";
    $stmt_operator = $conn->prepare($sql_operator);
    $stmt_operator->bind_param("isss", $operator_id, $operator_name, $LicenseNumber, $contact);
    $stmt_operator->execute();

    // Insert into bus table
    $bus_id = $_POST['bus_id'];
    $bus_number = $_POST['bus_number'];
    $bus_type = $_POST['bus_type'];
    $seat_capacity = $_POST['seat_capacity'];

    $sql_bus = "INSERT INTO bus (bus_id, bus_number, bus_type, seat_capacity, operator_id) VALUES (?, ?, ?, ?, ?)";
    $stmt_bus = $conn->prepare($sql_bus);
    $stmt_bus->bind_param("issii", $bus_id, $bus_number, $bus_type, $seat_capacity, $operator_id);
    $stmt_bus->execute();

    // Insert into route table
    $route_id = $_POST['route_id'];
    $starting_location = $_POST['starting_location'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $schedule_date = $_POST['schedule_date'];
    $fare_amount = $_POST['fare_amount'];

    $sql_route = "INSERT INTO route (route_id, bus_id, starting_location, destination, departure_time, schedule_date, fare_amount) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_route = $conn->prepare($sql_route);
    $stmt_route->bind_param("iissssi", $route_id, $bus_id, $starting_location, $destination, $departure_time, $schedule_date, $fare_amount);
    $stmt_route->execute();

    $conn->commit();
    echo "<script>
            alert('New records created successfully');
            window.location.href = 'admin.html';
          </script>";

   

} catch (Exception $e) {
 
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>
