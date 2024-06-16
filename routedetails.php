
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

    $sql = "SELECT r.route_id,r.bus_id, r.starting_location,r.destination, b.bus_type, r.Schedule_date,r.departure_time,r.fare_amount
            FROM route r
            JOIN bus b ON r.bus_id = b.bus_id";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $_SESSION['dataroute'] = $data;
    } else {
        echo "No records found.";
    }
} catch (\Throwable $th) {
    // Log or display the error message
}
 

$conn->close();

?>
<!DOCTYPE html>
<html>
<head>
    <title>Bus Booking System</title>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css">
    <link rel="stylesheet" href="style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="index.html">BusTech</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="booking.html">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="contact.html">Contact Us</a>
                    </li>
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary">
            <A href="admin.html" style="text-decoration: none; color: white;">Admin</A></button>
            </button>
       
            </div>
        </div>
    </nav>

    <div class="container mt-4">
    <h2>Route Data  <span><a class="btn btn-success" href="insert_routedetails.html" role="button">Add</a></span></h2>
    <table class="table table-striped table-hover">
            <thead>
                <tr>
                <th scope="col">Route ID</th>
                <th scope="col">Bus ID</th>
                <th scope="col">From</th>
                <th scope="col">TO</th>
                <th scope="col">Bus Type</th>
                <th scope="col">Schedule Date</th>
                <th scope="col">Departure time</th>
                <th scope="col">Price</th>
                <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
            <?php  if(isset($_SESSION['dataroute']) && is_array($_SESSION['dataroute'])):
            foreach ($_SESSION['dataroute'] as $row): ?>
            <tr>
              <td><?php echo htmlspecialchars($row['route_id']); ?></td>
              <td><?php echo htmlspecialchars($row['bus_id']); ?></td>
              <td><?php echo htmlspecialchars($row['starting_location']); ?></td>
              <td><?php echo htmlspecialchars($row['destination']); ?></td>
              <td><?php echo htmlspecialchars($row['bus_type']); ?></td>
              <td><?php echo htmlspecialchars($row['Schedule_date']); ?></td>
              <td><?php echo htmlspecialchars($row['departure_time']); ?></td>
              <td><?php echo htmlspecialchars($row['fare_amount']); ?></td>
              <td><a class="btn btn-success" href="#" role="button">Update</a> <a class="btn btn-danger" href="#" role="button">Delete</a></td>

            </tr>
      <?php endforeach;
       else: ?>
            <tr>
                <td colspan="2">No data available</td>
            </tr>
        <?php endif; ?>
            </tbody>
        </table>
        <br><br>
        
        <br><br><br><br><br><hr>
    </div>

   

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 <a class="text-reset fw-bold" href="index.php">BusTech.com</a>
        </div>
    </footer>
    <!-- Footer -->

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>