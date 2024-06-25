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

    $sql = "SELECT *from operator";
    $result = $conn->query($sql);

    if ($result->num_rows > 0) {
        $data = [];
        while ($row = $result->fetch_assoc()) {
            $data[] = $row;
        }
        $_SESSION['dataoperator'] = $data;
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
    <link rel="stylesheet" href="../style.css"> <!-- Replace with your own CSS file -->
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
                        <a class="nav-link active" aria-current="page" href="../index1.html">Home</a>
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
    <h2>Operator Data  <span><a class="btn btn-success" href="operator_details.html" role="button">Add</a></span>
    </h2>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">Operator ID</th>
                    <th scope="col">Operator Name</th>
                    <th scope="col">License Number</th>
                    <th scope="col">Contact</th>
                    <th scope="col">Action</th>

                </tr>
            </thead>
            <tbody>
            <?php  if(isset($_SESSION['dataoperator']) && is_array($_SESSION['dataoperator'])):
            foreach ($_SESSION['dataoperator'] as $row): ?>
      <tr>
 
        <td><?php echo htmlspecialchars($row['operator_id']); ?></td>
        <td><?php echo htmlspecialchars($row['operator_name']); ?></td>
        <td><?php echo htmlspecialchars($row['LicenseNumber']); ?></td>
        <td><?php echo htmlspecialchars($row['contact']); ?></td>
        <td>
  <a class="btn btn-success" href="#" role="button" data-bs-toggle="modal" data-bs-target="#updateModal" onclick="setUpdateModal('<?php echo $row['operator_id']; ?>', '<?php echo $row['operator_name']; ?>', '<?php echo $row['LicenseNumber']; ?>', '<?php echo $row['contact']; ?>')">Update</a>
  <a class="btn btn-danger" href="#" role="button" onclick="deleteOperator('<?php echo $row['operator_id']; ?>')">Delete</a>
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
        <h5 class="modal-title" id="updateModalLabel">Update Operator</h5>
        <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
      </div>
      <form id="updateForm" method="post" action="update_operator.php">
        <div class="modal-body">
          <input type="hidden" name="operator_id" id="update_operator_id">
          <div class="mb-3">
            <label for="update_operator_name" class="form-label">Operator Name</label>
            <input type="text" class="form-control" id="update_operator_name" name="operator_name" required>
          </div>
          <div class="mb-3">
            <label for="update_license_number" class="form-label">License Number</label>
            <input type="text" class="form-control" id="update_license_number" name="license_number" required>
          </div>
          <div class="mb-3">
            <label for="update_contact" class="form-label">Contact</label>
            <input type="text" class="form-control" id="update_contact" name="contact" required>
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
<form id="deleteForm" method="post" action="delete_operator.php" style="display: none;">
  <input type="hidden" name="operator_id" id="delete_operator_id">
</form>

    </div>

   

        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2024 <a class="text-reset fw-bold" href="index.php">BusTech.com</a>
        </div>
    </footer>
    <!-- Footer -->
    <script>
function setUpdateModal(operator_id, operator_name, license_number, contact) {
  document.getElementById('update_operator_id').value = operator_id;
  document.getElementById('update_operator_name').value = operator_name;
  document.getElementById('update_license_number').value = license_number;
  document.getElementById('update_contact').value = contact;
}

function deleteOperator(operator_id) {
  if (confirm("Are you sure you want to delete this operator?")) {
    document.getElementById('delete_operator_id').value = operator_id;
    document.getElementById('deleteForm').submit();
  }
}
</script>

    <!-- Bootstrap JS Bundle with Popper -->
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>