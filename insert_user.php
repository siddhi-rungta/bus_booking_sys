<?php
// Check if the request method is POST
if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    // Database connection details
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

    // Retrieve form data
    $fullName = $_POST['FullName'];
    $userName = $_POST['username'];
    $address = $_POST['Address'];
    $contact = $_POST['Contact'];
    $email = $_POST['Email'];
    $password = $_POST['Password'];
    $confirmPassword = $_POST['ConfirmPassword'];

    // Validate form data (e.g., password match)
    if ($password !== $confirmPassword) {
        die("Passwords do not match!");
    }

    // Hash the password for security
    $hashedPassword = password_hash($password, PASSWORD_DEFAULT);

    // Prepare and bind
    $stmt = $conn->prepare("INSERT INTO tbluser (FullName, UserName, Address, Contact, Email, Password) VALUES (?, ?, ?, ?, ?, ?)");
    $stmt->bind_param("ssssss", $fullName, $userName, $address, $contact, $email, $hashedPassword);

    // Execute the statement
    if ($stmt->execute()) {
        echo "<script>
            alert('New records created successfully');
            window.location.href = 'index1.html';
          </script>";
    } else {
        echo "Error: " . $stmt->error;
    }

    // Close the statement and connection
    $stmt->close();
    $conn->close();
} else {
    echo "Invalid request method.";
}
?>
