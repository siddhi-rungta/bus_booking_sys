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
    // Get operator_id from operator table
    $operator_id = $_POST['operator_id'];

    // Check if operator_id exists
    $sql_check_operator = "SELECT operator_name, LicenseNumber, contact FROM operator WHERE operator_id = ?";
    $stmt_check_operator = $conn->prepare($sql_check_operator);
    $stmt_check_operator->bind_param("i", $operator_id);
    $stmt_check_operator->execute();
    $stmt_check_operator->store_result();

    if ($stmt_check_operator->num_rows > 0) {
        // Operator exists, fetch details
        $stmt_check_operator->bind_result($operator_name, $LicenseNumber, $contact);
        $stmt_check_operator->fetch();

        // Insert into bus table
        $bus_id = $_POST['bus_id'];
        $bus_number = $_POST['bus_number'];
        $bus_type = $_POST['bus_type'];
        $seat_capacity = $_POST['seat_capacity'];

        $sql_bus = "INSERT INTO bus (bus_id, bus_number, bus_type, seat_capacity, operator_id) VALUES (?, ?, ?, ?, ?)";
        $stmt_bus = $conn->prepare($sql_bus);
        $stmt_bus->bind_param("issii", $bus_id, $bus_number, $bus_type, $seat_capacity, $operator_id);
        $stmt_bus->execute();

        $conn->commit();
        echo "<script>
                alert('New bus record created successfully for Operator: $operator_name');
                window.location.href = 'insertbusdetails.html';
              </script>";
    } else {
        // Operator does not exist
        echo "<script>
                alert('Operator with ID $operator_id does not exist. Please enter a valid Operator ID.');
                window.location.href = 'insertbusdetails.html';
              </script>";
        // Rollback transaction
        $conn->rollback();
    }
} catch (Exception $e) {
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>

