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
    // SQL query to fetch bus data with operator name
    $sql = "SELECT b.bus_id, b.bus_number, b.bus_type, b.seat_capacity, o.operator_name,o.operator_id 
            FROM bus b
            JOIN operator o ON b.operator_id = o.operator_id";
    
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $databus = [];
        while ($row = $result->fetch_assoc()) {
            $databus[] = $row;
        }
        $_SESSION['databus'] = $databus; // Store data in session variable
    } else {
        echo "No records found.";
    }
} catch (Exception $e) {
    echo "Error: " . $e->getMessage();
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
    <link rel="stylesheet" href="style.css"> <!-- Replace with your own CSS file -->
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
            </button>
       
            </div>
        </div>
    </nav>

    <div class="container mt-4">
        <h2>Bus Data  <span><a class="btn btn-success" href="insertbusdetails.html" role="button">Add</a></span>
        </h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Bus ID</th>
                    <th scope="col">Bus Number</th>
                    <th scope="col">Bus Type</th>
                    <th scope="col">Seat Capacity</th>
                    <th scope="col">Operator Name</th>
                    <th scope="col">Action</th>
                </tr>
            </thead>
            <tbody>
            <?php  if(isset($_SESSION['databus']) && is_array($_SESSION['databus'])):
            foreach ($_SESSION['databus'] as $row): ?>
      <tr>
      <td><?php echo htmlspecialchars($row['bus_id']); ?></td>
        <td><?php echo htmlspecialchars($row['bus_number']); ?></td>
        <td><?php echo htmlspecialchars($row['bus_type']); ?></td>
        <td><?php echo htmlspecialchars($row['seat_capacity']); ?></td>
        
        <td><?php echo htmlspecialchars($row['operator_name']); ?></td>
        <td>
  <a class="btn btn-success" href="#" role="button" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateModal(
                                                                                                                                '<?php echo $row['bus_id']; ?>',
                                                                                                                                '<?php echo $row['bus_number']; ?>',
                                                                                                                                '<?php echo $row['bus_type']; ?>',
                                                                                                                                '<?php echo $row['seat_capacity']; ?>',
                                                                                                                                '<?php echo $row['operator_id']; ?>'
                                                                                                                                )">Update</a>
  <a class="btn btn-danger" href="#" role="button" onclick="deleteBus('<?php echo $row['bus_id']; ?>')">Delete</a>
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
        <!-- Update Modal -->
        <div class="modal fade" id="updateModal" tabindex="-1" aria-labelledby="updateModalLabel" aria-hidden="true">
  <div class="modal-dialog">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="updateModalLabel">Update Bus</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateForm" method="post" action="update_bus.php">
        <div class="modal-body">
          <input type="hidden" name="bus_id" id="update_bus_id">
          <div class="mb-3">
            <label for="update_bus_number" class="form-label">Bus Number</label>
            <input type="text" class="form-control" id="update_bus_number" name="bus_number" required>
          </div>
          <div class="mb-3">
            <label for="update_bus_type" class="form-label">Bus Type</label>
            <input type="text" class="form-control" id="update_bus_type" name="bus_type" required>
          </div>
          <div class="mb-3">
            <label for="update_seat_capacity" class="form-label">Seat Capacity</label>
            <input type="text" class="form-control" id="update_seat_capacity" name="seat_capacity" required>
          </div>
          <div class="mb-3">
            <label for="update_operator_id" class="form-label">Operator</label>
            <select class="form-control" id="update_operator_id" name="operator_id" required>
              <?php
              // Fetch operator names and IDs for the dropdown
              $conn = new mysqli($servername, $username, $password, $dbname);
              $sql = "SELECT operator_id, operator_name FROM operator";
              $result = $conn->query($sql);
              if ($result->num_rows > 0) {
                while ($row = $result->fetch_assoc()) {
                  echo '<option value="' . $row['operator_id'] . '">' . $row['operator_name'] . '</option>';
                }
              }
              $conn->close();
              ?>
            </select>
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
<form id="deleteForm" method="post" action="delete_bus.php" style="display: none;">
  <input type="hidden" name="bus_id" id="delete_bus_id">
</form>

    </div>

   

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 <a class="text-reset fw-bold" href="index.php">BusTech.com</a>
        </div>
    </footer>
    <!-- Footer -->
    <script>
function setUpdateModal(bus_id, bus_number, bus_type, seat_capacity, operator_id) {
  document.getElementById('update_bus_id').value = bus_id;
  document.getElementById('update_bus_number').value = bus_number;
  document.getElementById('update_bus_type').value = bus_type;
  document.getElementById('update_seat_capacity').value = seat_capacity;
  document.getElementById('update_operator_id').value = operator_id;
}
function deleteBus(bus_id) {
  if (confirm("Are you sure you want to delete this Bus?")) {
    document.getElementById('delete_bus_id').value = bus_id;
    document.getElementById('deleteForm').submit();
  }
}
</script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
