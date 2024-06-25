<?php 
session_start();
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Bus Seat Selection</title>
    <link rel="stylesheet" href="css/style.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet">
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
                        <a class="nav-link active" aria-current="page" href="index1.html">Home</a>
                    </li>
                
                    <li class="nav-item">
                        <a class="nav-link" href="contactform.php">Contact Us</a>
                    </li>
                </ul>
           
            </div>
        </div>
    </nav>
    <div class="container-fluid full-height">
        <div class="row h-100">
          <div class="col-12 col-md-6 text-black d-flex align-items-center ">
          <form class="row g-3"  action="process_booking.php" method="post">
              <div class="col-md-6">
                <label for="fullname" class="form-label">Full Name</label>
                <input type="text" class="form-control" id="fullname" name="fullname" required>
              </div>
              <div class="col-md-6">
                <label for="contact" class="form-label">Contact</label>
                <input type="text" class="form-control" id="contact" name="contact" required>
              </div>
              <div class="col-md-6">
    <label for="Number_of_seats" class="form-label">Number of Seats</label>
    <input type="number" class="form-control" id="Number_of_seats" name="Number_of_seats" required oninput="calculateTotal()">
</div>

              <div class="col-md-6">
                <label for="bus_number" class="form-label">Bus NUmber</label>
                <input type="number" class="form-control" id="bus_number" name="bus_number" value="<?php echo htmlspecialchars($_GET['bus_number']); ?>" >
              </div>
  
              <div class="col-md-6">
                <label for="starting_location" class="form-label">From</label>
                <input type="text" class="form-control" id="starting_location" name="starting_location" value="<?php echo htmlspecialchars($_GET['starting_location']); ?>" >
              </div>
              <div class="col-md-6">
                <label for="destination" class="form-label">To</label>
                <input type="text" class="form-control" id="destination" name="destination" value="<?php echo htmlspecialchars($_GET['destination']); ?>" >
              </div>
              <div class="col-md-6">
                <label for="bus_type" class="form-label">Bus Type</label>
                <input type="text" class="form-control" id="bus_type" name="bus_type" value="<?php echo htmlspecialchars($_GET['bus_type']); ?>" >
              </div>
              <div class="col-md-6">
                <label for="Schedule_date" class="form-label">Schedule date</label>
                <input type="date" class="form-control" id="Schedule_date" name="Schedule_date" value="<?php echo isset($_GET['Schedule_date']) ? htmlspecialchars($_GET['Schedule_date']) : ''; ?>">

              </div>
              <div class="col-md-6">
                <label for="departure_time" class="form-label">Departure Time</label>
                <input type="text" class="form-control" id="departure_time" name="departure_time" value="<?php echo htmlspecialchars($_GET['departure_time']); ?>" readonly>
              </div>
              <div class="col-md-6">
    <label for="fare_amount" class="form-label">Total Fare</label>
    <input type="hidden" class="form-control" id="fare_amount" name="fare_amount" value="<?php echo isset($_GET['fare_amount']) ? htmlspecialchars($_GET['fare_amount']) : '0.00'; ?>">
    <span id="total_fare">Total Fare: $<?php echo isset($_GET['fare_amount']) ? htmlspecialchars($_GET['fare_amount']) : '0.00'; ?></span>
</div>



    

              <button type="submit" class="btn btn-primary">Confirm Booking</button>
          </form>
          </div>
          <div class="col-md-6">
                <div id="carouselExampleAutoplaying" class="carousel slide mb-4" data-bs-ride="carousel">
                    <div class="carousel-inner">
                        <div class="carousel-item active">
                            <img src="images/outside.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/book.png" class="d-block w-100" alt="...">
                        </div>
                        <div class="carousel-item">
                            <img src="images/businside.png" class="d-block w-100" alt="...">
                        </div>
                    </div>
                    <button class="carousel-control-prev" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="prev">
                        <span class="carousel-control-prev-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Previous</span>
                    </button>
                    <button class="carousel-control-next" type="button" data-bs-target="#carouselExampleAutoplaying" data-bs-slide="next">
                        <span class="carousel-control-next-icon" aria-hidden="true"></span>
                        <span class="visually-hidden">Next</span>
                    </button>
                </div>
<span>
                <!-- Bus Details -->
                <div class="mt-3">
                    <h5>Bus Details</h5>
                    <ul>
                        <li>Bus Number: <?php echo htmlspecialchars($_GET['bus_number']); ?></li>
                        <li>From: <?php echo htmlspecialchars($_GET['starting_location']); ?></li>
                        <li>To: <?php echo htmlspecialchars($_GET['destination']); ?></li>
                        <li>Bus Type: <?php echo htmlspecialchars($_GET['bus_type']); ?></li>
                        <li>Schedule Date: <?php echo htmlspecialchars($_GET['Schedule_date']); ?></li>
                        <li>Departure Time: <?php echo htmlspecialchars($_GET['departure_time']); ?></li>
                        <li>Fare Amount: $<?php echo isset($_GET['fare_amount']) ? htmlspecialchars($_GET['fare_amount']) : '0.00'; ?></li>
                    </ul>
                </div></span>
            </div>
        </div>
    </div>

    <hr>
    <!-- Footer -->
    <footer class="text-center text-lg-start bg-body-tertiary text-muted">
        <section class="">
            <div class="container text-center text-md-start mt-5">
                <div class="row mt-3">
                    <div class="col-md-3 col-lg-4 col-xl-3 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Buses</h6>
                        <p>Quick and easy bus booking services.</p>
                    </div>
                    <div class="col-md-2 col-lg-2 col-xl-2 mx-auto mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Features</h6>
                        <p><a href="#!" class="text-reset">AC BUS</a></p>
                        <p><a href="#!" class="text-reset">Pricing</a></p>
                        <p><a href="booking.php" class="text-reset">Booking</a></p>
                        <p><a href="contact.php" class="text-reset">Contact</a></p>
                    </div>
                    <div class="col-md-4 col-lg-3 col-xl-3 mx-auto mb-md-0 mb-4">
                        <h6 class="text-uppercase fw-bold mb-4">Contact</h6>
                        <p><i class="fas fa-home me-3"></i> Egypt, Minya</p>
                        <p><i class="fas fa-envelope me-3"></i> info@example.com</p>
                        <p><i class="fas fa-phone me-3"></i> + 01 234 567 88</p>
                        <p><i class="fas fa-print me-3"></i> + 01 234 567 89</p>
                    </div>
                </div>
            </div>
        </section>
        <div class="text-center p-4" style="background-color: rgba(0, 0, 0, 0.05);">
            © 2023 Copyright:
            <a class="text-reset fw-bold" href="index.php">BusTech</a>
        </div>
    </footer>
    <script>
function calculateTotal() {
    var numberOfSeats = document.getElementById('Number_of_seats').value;
    var fareAmount = <?php echo isset($_GET['fare_amount']) ? $_GET['fare_amount'] : 0; ?>;
    var total = numberOfSeats * fareAmount;
    document.getElementById('total_fare').innerText = 'Total Fare: $' + total.toFixed(2);
    document.getElementById('fare_amount').value = total.toFixed(2);
}
</script>


    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>

