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
  <head><title>Life Plus_ Doctor</title></head>
<body>

  <!-- Back to top button -->
  <div class="back-to-top"></div>

  <header>
    <nav class="navbar navbar-expand-lg navbar-light shadow-sm">
      <div class="container">
        <a class="navbar-brand" href="home_doc.php"><span class="text-primary">Hospital </span>Life +</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item active">
              <a class="nav-link" href="home_doc.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#appointments">Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="tests.php">Tests</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Contact Us</a>
            </li>
            <li class="nav-item">
              <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
                <input type= "submit" name="logout" class="btn btn-primary" data-toggle="modal" value="Log Out">
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
        <h1 class="display-4">Welcome Doctor</h1>
      </div>
    </div>
  </div>

  <div class="page-section pb-0">
    <div class="container">
      <div class="row align-items-center">
        <div class="col-lg-6 py-3 wow fadeInUp">
          <a name="appointments"><h1>Appointments</h1></a>
        </div>
  
        <!-- ADDING TABLES -->
        <div class="table-responsive">
            <?php
              $conn = mysqli_connect("localhost","root","","hospital_life_plus");
              $doc = $_SESSION['doctor'];
              
              $query = "SELECT dept from `doctor` where username='{$doc}'";
              $data1 = mysqli_query($conn,$query);

              $row = mysqli_fetch_assoc($data1);
              $d_dept=$row['dept'];

              $query = "SELECT a.username, a.fname, a.lname, app_date, slot, status from `appointment` a where a.dept='{$d_dept}' and a.doc='{$doc}' order by status asc, app_date desc";
              $data = mysqli_query($conn,$query);
              
            ?>

            <table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
              <thead>
                <tr>
                <th>Username</th>
                <th>First name</th>
                <th>Last name</th>
                <th>date</th>
                <th>slot</th>
                <th>Status</th>
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
                    <td><?php echo $row['fname']; ?></td>
                    <td><?php echo $row['lname']; ?></td>
                    <td><?php echo $row['app_date']; ?></td>
                    <td><?php echo $row['slot']; ?></td>
                    <td>
                        <?php 
                          if($row['status']==0)
                          {
                            
                        ?>
                          <form action = "prescription" method = "post">
                            <input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
                            <input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
                            <button type= "submit" name="prescribe" class = "btn btn-success" data-toggle="modal">PRESCRIBE</button>
                          </form>
                        <?php
                          }
                          else
                          {
                        ?>
                          <form action = "view_prescrip" method = "post">
                            <input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
                            <input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
                            <button type= "submit" name="view" class = "btn btn-success" data-toggle="modal">VIEW</button>
                          </form>
                        <?php
                          }
                        ?>
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

  <footer class="page-footer" name="footer">
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
<?php
include('C:\wamp64\www\Hospital\admin\a_header.php');
include('C:\wamp64\www\Hospital\patient\p_head.php');
?>
</html>