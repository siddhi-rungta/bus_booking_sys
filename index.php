
<!DOCTYPE html>
<html>
<head>
  <!-- <link rel="stylesheet" type="text/css" href="style.css"> -->
  <title>bus Booking System</title>
  <meta charset="utf-8">
  <Link rel="stylesheet" href="style.css">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css" rel="stylesheet" >
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet"
  integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
  <meta name="viewport" content="width=device-width, initial-scale=1">
  

  
</head>
<body>

  <nav class="navbar navbar-expand-lg bg-body-tertiary">
    <div class="container-fluid">
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarTogglerDemo03" aria-controls="navbarTogglerDemo03" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
      </button>
      <a class="navbar-brand" href="index.php">BusTech</a>
      <div class="collapse navbar-collapse" id="navbarTogglerDemo03">
        <ul class="navbar-nav me-auto mb-2 mb-lg-0">
          <li class="nav-item">
            <a class="nav-link active" aria-current="page" href="index.php">Home</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="booking.html">Booking</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="contact.html">Contact Us</a>
          </li>
          <li class="nav-item">
            <a class="nav-link" href="#accordionFlushExample">FAQs</a>
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

  <div class="carousel-inner">
      <div class="carousel-item active">
        <img src="images/background.png" class="d-block w-100" alt="...">
        <div class="carousel-caption d-none d-md-block">
          <form class="row gy-6 align-items-center " action="buscontroller.php" method="post">
            <div class=" d-flex flex-row justify-content-center">
              <div class="col-sm-2 p-2 g-col-6">
              <label for="starting_location " >From</label>
              <select id="starting_location" class="form-select p-2 g-col-6">
                <option selected>Choose...</option>
                <option value="kathmandu">Kathmandu</option>
                <option value="pokhara">Pokhara</option>
                <option value="birgunj">Birgunj</option>
              </select>
              </div>
              <div class="col-sm-2 p-2 g-col-6">
              <label for="destination" >To</label>
              <select id="destination" class="form-select p-2 g-col-6">
                <option selected>Choose...</option>
                <option value="kathmandu">Kathmandu</option>
                <option value="pokhara">Pokhara</option>
                <option value="birgunj">Birgunj</option>
              </select>    </div>
             <div class="col-sm-2 p-2 g-col-6">
                <label>Date</label>
                <input type="date" class="form-control p-2 g-col-6" id="Schedule_date" name="Schedule_date" >
              </div>
              
              <div class="col-auto" style="padding-top: 30px;">
                <button type="submit" class="btn btn-primary p-2 g-col-6" style="background-color: white; color: black; height: 43px">Search</button>
              </div>
            </div>
           
          </form>
        </div>
      </div>
      
    </div>
   
<div class="container my-4">
        <div class="row mb-2">
          <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-primary-emphasis">Travel</strong>
                <h3 class="mb-0">Hassle free travel</h3>
                <p class="card-text mb-auto">We offer easy and comfortable travel without any external agent. Just one click and your trip is secured from one destination to another.</p>
              </div>
              <div class="col-auto d-none d-lg-block">
               <img class="bd-placeholder-img" src="images/travel.png">
              </div>
            </div>
          </div>
          <div class="col-md-6">
            <div class="row g-0 border rounded overflow-hidden flex-md-row mb-4 shadow-sm h-md-250 position-relative">
              <div class="col p-4 d-flex flex-column position-static">
                <strong class="d-inline-block mb-2 text-success-emphasis">Interior</strong>
                <h3 class="mb-0">Clean Interior</h3>
                <p class="mb-auto">We regularly clean and sanitize each and every part of the bus. The interior is really clean and comfortable</p>
  
                 
              </div>
              <div class="col-auto d-none d-lg-block">
                <img  class="bd-placeholder-img" width="200" height="250" src="images/seat.png">
              </div>
            </div>
          </div>
        </div>
       <hr>
        <div class="accordion accordion-flush" id="accordionFlushExample">
  <div class="accordion-item">
    <h1><b>Frequently Asked Questions</b></h1>
    <h2 class="accordion-header" id="flush-headingOne">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseOne" aria-expanded="false" aria-controls="flush-collapseOne">
        What is BusTech
      </button>
    </h2>
    <div id="flush-collapseOne" class="accordion-collapse collapse" aria-labelledby="flush-headingOne" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">BusTech is Online bus booking system. </div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingTwo">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseTwo" aria-expanded="false" aria-controls="flush-collapseTwo">
        How do I book a bus ticket?
      </button>
    </h2>
    <div id="flush-collapseTwo" class="accordion-collapse collapse" aria-labelledby="flush-headingTwo" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">To book a bus ticket, you can visit our website. Select your desired route, date, and then proceed to booking.</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Are the Buses AC or Non AC?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">We have both AC and Non AC buses available.</div>
    </div>
  </div>
  <div class="accordion-item">
    <h2 class="accordion-header" id="flush-headingThree">
      <button class="accordion-button collapsed" type="button" data-bs-toggle="collapse" data-bs-target="#flush-collapseThree" aria-expanded="false" aria-controls="flush-collapseThree">
        Are the Buses sanitized?
      </button>
    </h2>
    <div id="flush-collapseThree" class="accordion-collapse collapse" aria-labelledby="flush-headingThree" data-bs-parent="#accordionFlushExample">
      <div class="accordion-body">Yes the buses are properly cleaned and thorougly sanitized</div>
    </div>
  </div>
</div>
<hr></div>
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
<script src="https://cdn.jsdelivr.net/npm/@popperjs/core@2.9.2/dist/umd/popper.min.js" ></script>
<script src="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/js/bootstrap.min.js"></script>

</body>
</html>

