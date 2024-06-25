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
    $fullname = $_POST['fullname'];
    $email = $_POST['email'];
    $contact = $_POST['contact'];
    $messages = $_POST['messages'];
    
    $sql_contact = "INSERT INTO contact ( fullname,email, contact, messages) VALUES ( ?,?, ?, ?)";
    $stmt_contact = $conn->prepare($sql_contact);
    $stmt_contact->bind_param("ssss",$fullname, $email, $contact, $message);
    $stmt_contact->execute();

    
    $conn->commit();
    echo "<script>
            alert('New records created successfully');
            window.location.href = 'contactform.php';
          </script>";


} catch (Exception $e) {
 
    $conn->rollback();
    echo "Failed to insert data: " . $e->getMessage();
}

$conn->close();
?>