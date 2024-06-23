<?php
session_start();

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $fullname = $_POST['fullname'];
    $contact = $_POST['contact'];
    $Number_of_seats = $_POST['Number_of_seats'];
    $bus_number = $_POST['bus_number'];
    $starting_location = $_POST['starting_location'];
    $destination = $_POST['destination'];
    $bus_type = $_POST['bus_type'];
    $Schedule_date = $_POST['Schedule_date'];
    $departure_time = $_POST['departure_time'];
    $fare_amount = $_POST['fare_amount'];


    $conn = new mysqli('localhost', 'root', '', 'bus_booking_sys');

    if ($conn->connect_error) {
        die("Connection failed: " . $conn->connect_error);
    }

    $sql = "INSERT INTO booking (fullname, contact, Number_of_seats, bus_number, starting_location, destination, bus_type, Schedule_date, departure_time, fare_amount) VALUES (?, ?, ?, ?, ?, ?, ?, ?, ?, ?)";
    $stmt = $conn->prepare($sql);
    $stmt->bind_param("ssisssssss", $fullname, $contact, $Number_of_seats, $bus_number, $starting_location, $destination, $bus_type, $Schedule_date, $departure_time, $fare_amount);

    if ($stmt->execute()) {
        echo "<div class='alert alert-success' role='alert'>Booking confirmed successfully!</div>";
    } else {
        echo "<div class='alert alert-danger' role='alert'>Error: " . $stmt->error . "</div>";
    }

    $stmt->close();
    $conn->close();
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>Booking Confirmation</title>
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
                        <a class="nav-link active" aria-current="page" href="index.html">Home</a>
                    </li>
                   
                    <li class="nav-item">
                        <a class="nav-link" href="contact.php">Contact Us</a>
                    </li>
                </ul>
                <div class="d-grid gap-2 d-md-flex justify-content-md-end">
                    <button type="button" class="btn btn-primary" data-bs-toggle="modal" data-bs-target="#exampleModal">LOGIN</button>
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
                                            <input class="sign" type="submit" id="sub" value="LOGIN">
                                        </form>
                                    </div>
                                </div>
                                <div class="modal-footer">
                                    <p>Not a member? <a href="signup.php">SignUp</a></p>
                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </nav>
    <div class="container-fluid full-height">
        <div class="row h-100">
          <div class="col-12 col-md-6 text-black d-flex align-items-center justify-content-center">
            
            <button type="button" class="btn btn-primary">
            <A href="index.html" style="text-decoration: none; color: white;">Homepage</A></button>
            </button>
          </div>
          <div class="col-12 col-md-4 text-white d-flex align-items-center ">
            <div id="carouselExampleAutoplaying" class="carousel slide" data-bs-ride="carousel">
                <div class="carousel-inner">
                  <div class="carousel-item active">
                    <img src="images/mountaina.png" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="images/seats.png" class="d-block w-100" alt="...">
                  </div>
                  <div class="carousel-item">
                    <img src="images/bus.png" class="d-block w-100" alt="...">
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
    <script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.11.6/dist/umd/popper.min.js"></script>
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0-alpha3/dist/js/bootstrap.min.js"></script>
</body>
</html>
