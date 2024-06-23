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

    // Check if bus and operator exist and belong together
    $sql_check_bus = "SELECT bus_number, bus.bus_type, bus.operator_id, operator.operator_name 
                      FROM bus 
                      JOIN operator ON bus.operator_id = operator.operator_id 
                      WHERE bus.bus_id = ? AND bus.operator_id = ?";
    $stmt_check_bus = $conn->prepare($sql_check_bus);
    $stmt_check_bus->bind_param("ii", $bus_id, $operator_id);
    $stmt_check_bus->execute();
    $stmt_check_bus->store_result();

    if ($stmt_check_bus->num_rows > 0) {
        // Bus and operator exist, fetch details
        $stmt_check_bus->bind_result($bus_number, $bus_type, $operator_id, $operator_name);
        $stmt_check_bus->fetch();
    } else {
        // Bus and operator do not match
        echo "<script>alert('Bus with ID $bus_id does not exist or does not belong to the specified operator. Please enter a valid Bus ID and Operator ID.');</script>";
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

    // Commit transaction
    $conn->commit();
    echo "<script>
            alert('New records successfully created for\\nBus Number: $bus_number\\nBus Type: $bus_type\\nOperator Name: $operator_name');
            window.location.href = 'routedetails.php';
          </script>";

} catch (Exception $e) {
    // Rollback transaction if there was an error
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

// Close the connection
$conn->close();
?>
