<?php
  session_start();
  if(isset($_POST['logout'])) 
  {
    session_destroy();
    header('location:..\login_page.php'); //redirect the user to login page
    exit;
    ob_end_flush();
  }
?>
<!DOCTYPE html>
<html lang="en">
<head><title>Life Plus_ Prescription</title></head>
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
            <li class="nav-item">
              <a class="nav-link" href="home_pat.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="pat_prescrip.php">Prescription</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="appointment.php">Appointments</a>
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

  <div class="page-section pb-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 py-3 wow fadeInUp">
          <a name="prescri"><h1>Prescriptions</h1></a>
        </div>
  
        <!-- ADDING TABLES -->
        <div class="table-responsive">
            <?php
              $conn = mysqli_connect("localhost","root","","hospital_life_plus");
              $pat = $_SESSION['patient'];
              
              $query = "SELECT distinct username,app_date from `prescription` where username='{$pat}'";
              $data = mysqli_query($conn,$query);
            ?>

            <table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
              <thead>
                <tr>
                <th>Username</th>
                <th> Appointment Date</th>
                <th>View</th>
                </tr>
              </thead>
              <tbody>
              <?php
                if(mysqli_num_rows($data) > 0)
                {
                  while($row = mysqli_fetch_assoc($data))
                  {
                      ?>
                  <tr>
                    <td><?php echo $row['username']; ?></td>
                    <td><?php echo $row['app_date']; ?></td>
                    <td>
                      <div class = "card shadow mb-4">
                      <div class = "card-header py-3">
                      <form action = "display_prescrip.php" method = "post">
                        
                        <input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
                        <input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
                        <input type= "submit" name="view" class = "btn btn-success" data-toggle="modal" value="VIEW">
                      </form>
                    </td>
                  </tr>
						  <?php						
                }
              }
              else 
              {
                echo "No record found";
              }
              ?>
              </tbody>
            </table>
          </div>
        </div>
      </div>
    </div>
  </div>

  <footer class="page-footer">
    <div class="container">
      <div class="row px-md-3">
        <div class="col-sm-6 col-lg-3 py-3">
          <h5>Company</h5>
          <ul class="footer-menu">
            <li><a href="#">About Us</a></li>
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
          <h5>Contact</h5>
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
<?php
include('C:\wamp64\www\Hospital\admin\a_header.php');
include('C:\wamp64\www\Hospital\patient\p_head.php');
include('C:\wamp64\www\Hospital\admin\script.php');
?>
</html>