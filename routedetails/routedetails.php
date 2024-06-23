
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
    <link rel="stylesheet" href="../style.css">
</head>
<body>
    <nav class="navbar navbar-expand-lg bg-body-tertiary">
        <div class="container-fluid">
            <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
                <span class="navbar-toggler-icon"></span>
            </button>
            <a class="navbar-brand" href="../index.html">BusTech</a>
            <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
                <ul class="navbar-nav me-auto mb-2 mb-lg-0">
                    <li class="nav-item">
                        <a class="nav-link active" aria-current="page" href="../index.html">Home</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../booking.html">Booking</a>
                    </li>
                    <li class="nav-item">
                        <a class="nav-link" href="../contact.html">Contact Us</a>
                    </li>
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
            <button type="button" class="btn btn-primary">
            <A href="../admin.html" style="text-decoration: none; color: white;">Admin</A></button>
                </div>
       
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
              <td>
  <a class="btn btn-success" href="#" role="button" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateModal(
                                                                                                                                '<?php echo $row['route_id']; ?>',
                                                                                                                                '<?php echo $row['bus_id']; ?>',
                                                                                                                                '<?php echo $row['starting_location']; ?>',
                                                                                                                                '<?php echo $row['destination']; ?>',
                                                                                                                                '<?php echo $row['bus_type']; ?>',
                                                                                                                                '<?php echo $row['Schedule_date']; ?>',
                                                                                                                                '<?php echo $row['departure_time']; ?>',
                                                                                                                                '<?php echo $row['fare_amount']; ?>'
                                                                                                                                )">Update</a>
  <a class="btn btn-danger" href="#" role="button" onclick="deleteroute('<?php echo $row['route_id']; ?>')">Delete</a>
</td>

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

    <!-- Update Modal -->
<!-- Update Modal -->
<div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Route</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateForm" method="post" action="update_route.php">
        <div class="modal-body">
          <input type="hidden" name="route_id" id="update_route_id">
          <div class="mb-3">
            <label for="update_bus_id" class="form-label">Bus ID</label>
            <select class="form-control" id="update_bus_id" name="bus_id" required onchange="updateBusType()">
              <?php
              // Fetch bus IDs and types for the dropdown
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sql = "SELECT bus_id, bus_type FROM bus";
              $result = $conn->query($sql);
              $busData = [];
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  $busData[] = $row;
                  echo '<option value="' . $row['bus_id'] . '">' . $row['bus_id'] . '</option>';
                }
              }
              $conn->close();
              ?>
            </select>
          </div>
          <div class="mb-3">
            <label for="update_bus_type" class="form-label">Bus Type</label>
            <input type="text" class="form-control" id="update_bus_type" name="bus_type" readonly>
          </div>
          <div class="mb-3">
            <label for="update_starting_location" class="form-label">From</label>
            <input type="text" class="form-control" id="update_starting_location" name="starting_location" required>
          </div>
          <div class="mb-3">
            <label for="update_destination" class="form-label">To</label>
            <input type="text" class="form-control" id="update_destination" name="destination" required>
          </div>
          <div class="mb-3">
            <label for="update_Schedule_date" class="form-label">Schedule date</label>
            <input type="date" class="form-control" id="update_Schedule_date" name="Schedule_date" required>
          </div>
          <div class="mb-3">
            <label for="update_departure_time" class="form-label">Departure time</label>
            <input type="time" class="form-control" id="update_departure_time" name="departure_time" required>
          </div>
          <div class="mb-3">
            <label for="update_fare_amount" class="form-label">Price</label>
            <input type="text" class="form-control" id="update_fare_amount" name="fare_amount" required>
          </div>
        </div>
        <div class="modal-footer">
          <button type="button" class="btn btn-secondary" data-bs-dismiss="modal">Close</button>
          <button type="submit" class="btn btn-primary">Update</button>
        </div>
      </form>
    </div>
  </div>
</div>
<form id="deleteForm" method="post" action="delete_route.php" style="display: none;">
  <input type="hidden" name="route_id" id="delete_route_id">
</form>

<form id="deleteForm" method="post" action="delete_route.php" style="display: none;">
  <input type="hidden" name="route_id" id="delete_route_id">
</form>

<form id="deleteForm" method="post" action="delete_route.php" style="display: none;">
  <input type="hidden" name="bus_id" id="delete_route_id">
</form>


        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 <a class="text-reset fw-bold" href="index.php">BusTech.com</a>
        </div>
    </footer>
    <!-- Footer -->
     <script>
          var busData = <?php echo json_encode($busData); ?>;

function updateBusType() {
    var bus_id = document.getElementById('update_bus_id').value;
    var busTypeField = document.getElementById('update_bus_type');

    for (var i = 0; i < busData.length; i++) {
        if (busData[i].bus_id == bus_id) {
            busTypeField.value = busData[i].bus_type;
            break;
        }
    }
}
    function setUpdateModal(route_id, bus_id, starting_location, destination, bus_type, Schedule_date, departure_time, fare_amount) {
    document.getElementById('update_route_id').value = route_id;
    document.getElementById('update_bus_id').value = bus_id;
    document.getElementById('update_starting_location').value = starting_location;
    document.getElementById('update_destination').value = destination;
    document.getElementById('update_bus_type').value = bus_type;
    document.getElementById('update_Schedule_date').value = Schedule_date;
    document.getElementById('update_departure_time').value = departure_time;
    document.getElementById('update_fare_amount').value = fare_amount;
}
</script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>