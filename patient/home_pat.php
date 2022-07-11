<?php
  session_start();
  if(isset($_POST['logout'])) 
  {
    session_destroy();
    ?>
    <script type="text/javascript">
      window.history.forward();
        function noBack() {
            window.history.forward();
        }
    </script>
  <?php
    header('location:..\login_page.php'); //redirect the user to login page
    exit;
    ob_end_flush();
  }
?>

<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Life Plus_ Homepage</title>
  <!--C:\wamp64\www\Hospital\patient -->

  <link rel="stylesheet" href="..\patient\assets\css\maicons.css">

  <link rel="stylesheet" href="..\patient\assets\css\bootstrap.css">

  <link rel="stylesheet" href="..\patient\assets\vendor\owl-carousel\css\owl.carousel.css">

  <link rel="stylesheet" href="..\patient\assets\vendor\animate\animate.css">

  <link rel="stylesheet" href="..\patient\assets\css\theme.css">
</head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="home_pat.php"><span class="text-primary">Hospital </span>Life +</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home_pat.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pat_prescrip.php">Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointment.php">Appointment</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pat_tests.php">Tests</a>
            </li>
            <li class="nav-item">
              <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
                <input type= "submit" name="logout" class="btn btn-danger" data-toggle="modal" value="Log Out">
              </form>
            </li>
          </ul>
        </div> <!-- .navbar-collapse -->
      </div> <!-- .container -->
    </nav>
  </header>

  <div class="page-hero bg-image overlay-dark" style="background: url(bg_image_1.jpg);">
    <div class="hero-section">
      <div class="container text-center wow zoomIn">
        <span class="subhead">Let's make your life happier</span>
        <h1 class="display-4">Healthy Living</h1>
        <a href="appointment.php" class="btn btn-primary">Book Appointment</a>
      </div>
    </div>
  </div>


  <div class="bg-light">
    <div class="page-section py-3 mt-md-n5 custom-index">
      <div class="container">
        <div class="row justify-content-center">
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-secondary text-white">
                <span class="mai-chatbubbles-outline"></span>
              </div>
              <p><span>Life Plus</span> doctors</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-primary text-white">
                <span class="mai-shield-checkmark"></span>
              </div>
              <p><span>life</span>-Plus Protection</p>
            </div>
          </div>
          <div class="col-md-4 py-3 py-md-0">
            <div class="card-service wow fadeInUp">
              <div class="circle-shape bg-accent text-white">
                <span class="mai-basket"></span>
              </div>
              <p><span>Life</span>-Plus Pharmacy</p>
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .page-section -->

    <div class="page-section pb-0">
      <div class="container">
        <div class="row align-items-center">
          <div class="col-lg-6 py-3 wow fadeInUp">
            <h1>Welcome to Hospital <br> Life Plus</h1>
            <p class="text-grey mb-4">Lorem ipsum dolor sit amet, consetetur sadipscing elitr, sed diam nonumy eirmod tempor invidunt ut labore et dolore magna aliquyam erat, sed diam voluptua. At vero eos et accusam et justo duo dolores et ea rebum. Accusantium aperiam earum ipsa eius, inventore nemo labore eaque porro consequatur ex aspernatur. Explicabo, excepturi accusantium! Placeat voluptates esse ut optio facilis!</p>
            <a href="about.php" class="btn btn-primary">Learn More</a>
          </div>
          <div class="col-lg-6 wow fadeInRight" data-wow-delay="400ms">
            <div class="img-place custom-img-1">
              <img src="..\patient\assets\img\bg-doctor.png" alt="">
            </div>
          </div>
        </div>
      </div>
    </div> <!-- .bg-light -->
  </div> <!-- .bg-light -->

  <div class="page-section">
    <div class="container">
      <div class="row justify-content-center">
        <div class="col-lg-10 mt-5">
          <h1 class="text-center mb-5 wow fadeInUp">Our Doctors</h1>
          <div class="row justify-content-center">
            <div class="col-md-6 col-lg-4 wow zoomIn">
              <div class="card-doctor">
                <div class="header">
                  <img src="doctor_1.jpg" alt="">
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr. Stein Albert</p>
                  <span class="text-sm text-grey">Cardiology</span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 wow zoomIn">
              <div class="card-doctor">
                <div class="header">
                  <img src="doctor_2.jpg" alt="">
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr. Alexa Melvin</p>
                  <span class="text-sm text-grey">Dental</span>
                </div>
              </div>
            </div>
            <div class="col-md-6 col-lg-4 wow zoomIn">
              <div class="card-doctor">
                <div class="header">
                  <img src="doctor_3.jpg" alt="">
                </div>
                <div class="body">
                  <p class="text-xl mb-0">Dr. Rebecca Steffany</p>
                  <span class="text-sm text-grey">General Health</span>
                </div>
              </div>
            </div>
          </div>
        </div>
      </div>
    </div>
    <div class="container text-center wow zoomIn">
        <a href="about.php" class="btn btn-primary">learn More</a>
      </div>
  </div>

  <footer class="page-footer" name="footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="about.php">About Us</a></li>
            <li><a href="#">Services</a></li>
          </ul>
        </div>
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>More</h5>
          <ul class="footer-menu">
            <li><a href="#">Terms & Condition</a></li>
            <li><a href="#">Privacy</a></li>
            <li><a href="#">Advertise</a></li>
          </ul>
        </div>
       
        <div class="col-sm-6 col-lg-3 py-3">
        <a name="contact"> <h5>Contact</h5></a>
          <p class="footer-link mt-2">Computer Department, Goa College Of Engineering</p>
          <p class="footer-link mt-2">91-89422-68436</p>
          <a href="https://mail.google.com/" class="footer-link">lifeplus.goa@gmail.com</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="https://www.facebook.com/" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="https://twitter.com/" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="https://www.google.com/" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="https://www.instagram.com/" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="https://www.linkedin.com/" target="_blank"><span class="mai-logo-linkedin"></span></a>
          </div>
        </div>
      </div>

      <hr>

      <p id="copyright">Designed by: Megan Fernandes and Nouf Shaikh</p>
    </div>
  </footer>

<script src="../assets/js/jquery-3.5.1.min.js"></script>

<script src="../assets/js/bootstrap.bundle.min.js"></script>

<script src="../assets/vendor/owl-carousel/js/owl.carousel.min.js"></script>

<script src="../assets/vendor/wow/wow.min.js"></script>

<script src="../assets/js/theme.js"></script>
  
</body>
</html>