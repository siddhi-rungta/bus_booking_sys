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
    // Get data from POST request
    $operator_id = $_POST['operator_id'];
    $bus_id = $_POST['bus_id'];
    $route_id = $_POST['route_id'];
    $starting_location = $_POST['starting_location'];
    $destination = $_POST['destination'];
    $departure_time = $_POST['departure_time'];
    $schedule_date = $_POST['schedule_date'];
    $fare_amount = $_POST['fare_amount'];

    // Check if operator exists
    $sql_check_operator = "SELECT operator_name, LicenseNumber, contact FROM operator WHERE operator_id = ?";
    $stmt_check_operator = $conn->prepare($sql_check_operator);
    $stmt_check_operator->bind_param("i", $operator_id);
    $stmt_check_operator->execute();
    $stmt_check_operator->store_result();

    if ($stmt_check_operator->num_rows > 0) {
        // Operator exists, fetch details
        $stmt_check_operator->bind_result($operator_name, $LicenseNumber, $contact);
        $stmt_check_operator->fetch();
    } else {
        // Operator does not exist
        echo "<script>alert('Operator with ID $operator_id does not exist. Please enter a valid Operator ID.');</script>";
        // Rollback transaction and exit
        $conn->rollback();
        $conn->close();
        exit;
    }

    // Check if bus exists and belongs to the operator
    $sql_check_bus = "SELECT bus_number, bus_type, seat_capacity FROM bus WHERE bus_id = ? AND operator_id = ?";
    $stmt_check_bus = $conn->prepare($sql_check_bus);
    $stmt_check_bus->bind_param("ii", $bus_id, $operator_id);
    $stmt_check_bus->execute();
    $stmt_check_bus->store_result();

    if ($stmt_check_bus->num_rows > 0) {
        // Bus exists, fetch details
        $stmt_check_bus->bind_result($bus_number, $bus_type, $seat_capacity);
        $stmt_check_bus->fetch();

       
    } else {
        // Bus does not exist
        echo "<script>alert('Bus with ID $bus_id does not exist or does not belong to the specified operator. Please enter a valid Bus ID.');</script>";
        // Rollback transaction and exit
        $conn->rollback();
        $conn->close();
        exit;
    }

    // Insert into route table
    $sql_route = "INSERT INTO route (route_id, bus_id, starting_location, destination, departure_time, schedule_date, fare_amount) VALUES (?, ?, ?, ?, ?, ?, ?)";
    $stmt_route = $conn->prepare($sql_route);
    $stmt_route->bind_param("iissssi", $route_id, $bus_id, $starting_location, $destination, $departure_time, $schedule_date, $fare_amount);
    $stmt_route->execute();

    $conn->commit();
    echo "<script>
            alert('New records created successfully created for\\nBus Number: $bus_number and\\operator name: $operator_name');
            window.location.href = 'routedetails.html';
          </script>";

} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>

