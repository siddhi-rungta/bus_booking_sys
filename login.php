<?php
session_start();

// Database connection details
$servername = "localhost";
$dbname = "bus_booking_sys";
$db_username = "root"; // Your MySQL username
$db_password = ""; // Your MySQL password

// Create connection
$conn = new mysqli($servername, $db_username, $db_password, $dbname);

// Check connection
if ($conn->connect_error) {
    die("Connection failed: " . $conn->connect_error);
}

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $username = $_POST['username'];
    $password = $_POST['password'];
    
    // Prepare and bind
    $stmt = $conn->prepare("SELECT user_id, password FROM tbluser WHERE username = ?");
    $stmt->bind_param("s", $username);
    $stmt->execute();
    $stmt->bind_result($user_id, $hashed_password);
    $stmt->fetch();
    $stmt->close();

    // Verify the password
    if (password_verify($password, $hashed_password)) {
        // Store user details in session
        $_SESSION['username'] = $username;
        $_SESSION['user_id'] = $user_id;

        if ($username === 'admin') {
            header("Location: admin.html");
        } else {
            header("Location: index1.html");
        }
    } else {
        echo "Invalid username or password";
    }
}

$conn->close();
?>
