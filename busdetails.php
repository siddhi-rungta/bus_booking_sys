
<?php 
session_start();

// // Check if the result set is stored in the session
// if (isset($_SESSION['result_set'])) {
//     $result_set = $_SESSION['result_set'];
//     unset($_SESSION['result_set']); // Clear the session variable after use
// } else {
//     echo "No data available.";
//     exit();
// }
?>
<!DOCTYPE html>
<html>
<head>
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
  <title>bus Booking System</title>
  <meta charset="utf-8">
  <Link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  
  <meta name="viewport" content="width=device-width, initial-scale=1">

  
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
          <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">
            LOGIN
          </button>
          <div class="modal fade" id="exampleModal" tabindex="-1" aria-labelledby="exampleModalLabel" aria-hidden="true">
            <div class="modal-dialog">
              <div class="modal-content">
                <div class="modal-header">
                  <h5 class="modal-title" id="exampleModalLabel">Login</h5>
                  <button type="button" class="btn-close" data-bs-dismiss="modal" aria-label="Close"></button>
                </div>
                <div class="modal-body">
                  <div class="signup">
                    <form action="login.php" method="post">
                        <label for="username">User Name:</label><br>
                        <input class="sign" type="text" id="username" name="username" required><br>
                        <label for="password">Password:</label><br>
                        <input class="sign" type="text" id="password" name="password" required><br>
                       <input class="sign" type="submit" id="sub" value="LOGIN"></a>
                  </form>
          
                </div>
                </div>
                <div class="modal-footer">
                  <p>Not a member? <a href="signup.html">SignUp</a></p>
                  
                </div>
              </div>
            </div>
          </div>
          
        </div>
       
        
      </div>
    </div>
 
    
  </nav>
<table class="table table-striped table-hover">
    <thead>
      <tr>
      
        <th scope="col">Bus Number</th>
        <th scope="col">From</th>
        <th scope="col">TO</th>
        <th scope="col">Bus Type</th>
        <th scope="col">Schedule Date</th>
        <th scope="col">Departure time</th>
        <th scope="col">Price</th>
        <th scope="col"></th>
      </tr>
    </thead>
    <tbody>
    <?php  if(isset($_SESSION['data']) && is_array($_SESSION['data'])):
            foreach ($_SESSION['data'] as $row): ?>
      <tr>
      
        <td><?php echo htmlspecialchars($row['bus_number']); ?></td>
        
        <td><?php echo htmlspecialchars($row['starting_location']); ?></td>
        <td><?php echo htmlspecialchars($row['destination']); ?></td>
        <td><?php echo htmlspecialchars($row['bus_type']); ?></td>
        <td><?php echo htmlspecialchars($row['Schedule_date']); ?></td>
        <td><?php echo htmlspecialchars($row['departure_time']); ?></td>
        <td><?php echo htmlspecialchars($row['fare_amount']); ?></td>
        <td><a href="booking.html"><button type="button" class="btn btn-danger">BOOK</button></a></td>
      </tr>
      <?php endforeach;
       else: ?>
            <tr>
                <td colspan="2">No data available</td>
            </tr>
        <?php endif; ?>
    </tbody>
  </table><BR><BR><BR><BR><BR><BR><BR><HR>
  <!-- Footer -->
<footer class="text-center text-lg-start bg-body-tertiary text-muted">
  <!-- Section: Links  -->
  <section class="">
    <div class="container text-center text-md-start mt-5">
      <!-- Grid row -->
      <div class="row mt-3">
        <!-- Grid column -->
        <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
          <!-- Content -->
          <h6 class="text-uppercase fw-bold mb-4">
            <i class="fas fa-gem me-3"></i>Buses
          </h6>
          <p>
           Quick and easy bus booking services.
          </p>
        </div>

        <!-- Grid column -->
        <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">
            Features
          </h6>
          <p>
            <a href="#!" class="text-reset">AC BUS</a>
          </p>
          <p>
            <a href="#!" class="text-reset">Pricing</a>
          </p>
          <p>
            <a href="booking.html" class="text-reset">Booking</a>
          </p>
          <p>
            <a href="contact.html" class="text-reset">Contact</a>
          </p>
        </div>
        <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
          <!-- Links -->
          <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
          <p><i class="fas fa-home me-3"></i> Kalimati, Kathmandu, Nepal</p>
          <p>
            <i class="fas fa-envelope me-3"></i>
            info@buses.com
          </p>
          <p><i class="fas fa-phone me-3"></i> + 977 5465455</p>
          <p><i class="fas fa-print me-3"></i> + 977 5465456</p>
        </div>
        <!-- Grid column -->
      </div>
      <!-- Grid row -->
    </div>
  </section>
  <!-- Section: Links  -->

  <!-- Copyright -->
  <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
    © 2024 Copyright:
    <a class="text-reset fw-bold" href="index.php">BusTech.com</a>
  </div>
  <!-- Copyright -->
</footer>
<!-- Footer -->
  </body></html>
