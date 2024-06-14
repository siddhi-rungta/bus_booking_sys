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

    
    $conn->commit();
    echo "<script>
            alert('New records created successfully');
            window.location.href = 'operator.html';
          </script>";


} catch (Exception $e) {
 
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>