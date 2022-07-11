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
              <a class="nav-link" href="#contact">Tests</a>
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

  <div class="page-section pb-0">
    <div class="container">
        <div class= "container-fluid">
          <div class = "card shadow mb-4">
            <div class = "card-header py-3">
              <h6 class = "m-0 font-weight-bold text-primary"> Add Prescription</h6>
            </div>

            <div class="card-body">
              <?php
              //echo $_SERVER["PHP_SELF"];
              $conn = mysqli_connect("localhost","root","","hospital_life_plus");
              // || !empty($_SESSION['details']['pat'])

              if(isset($_POST['prescribe']) || !empty($_SESSION['details']['pat']))
              {
                $username = $_POST['username'];
                $a_date = $_POST['app_date'];

                if(!empty($_SESSIION['details']['pat']))
                {
                  $username = $_POST['details']['pat'];
                  $a_date = $_POST['details']['app'];
                }
                
                $query = "SELECT * from `appointment` where username='$username' and app_date='$a_date'";
                $data = mysqli_query($conn,$query);
                
                foreach($data as $row)
                {
              ?>
    		      <form action="<?php echo $_SERVER["PHP_SELF"];?>" method= "POST">
                <div class="row mt-5 ">
                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        Patient ID: <?php echo $row['username']; ?>
                    </div>

                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        Email :<?php echo $row['email']; ?>
                    </div>

                    <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
                        Patient Name:<?php echo $row['fname'];?>
                    </div>

                    <div class="col-12 col-sm-6 py-2 wow fadeInRight">
                        <?php echo $row['lname']; ?>
                    </div>
                    <div class="col-12 col-sm-3 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="medicine name" name="med">
                    </div>
                    <div class="col-12 col-sm-3 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="medicine type" name="type">
                    </div>
                    <div class="col-12 col-sm-3 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="dosage" name="dose">
                    </div>
                    <div class="col-12 col-sm-3 py-2 wow fadeInLeft">
                        <input type="text" class="form-control" placeholder="times per day" name="times">
                    </div>
                    <div>
                      <input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
                      <input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
                      <input type= "submit" name="add_med" class = "btn btn-success" data-toggle="modal" value="ADD">

                      <a href="home_doc.php" class="btn btn-danger" >Cancel</a>
                    </div>
                </div>
			        </form>
              <div class="row mt-5 ">
                <div>
                  <form action = "disp_prescription" method = "post">
                    <input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
                    <input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
                    <?php
                      $_SESSION['details']['pat']= $row['username'];
                      $_SESSION['details']['app']= $row['app_date'];
                    ?>
                    <button type= "submit" name="appoint" class="btn btn-primary" data-toggle="modal">Done</button>
                  </form>
                </div>
              </div>
              <?php
                }
              }
              ?>
	          </div>
          </div>
        </div>
            
        <?php
          //session_start();

          $conn = mysqli_connect("localhost","root","","hospital_life_plus");
          if(isset($_POST['add_med'])) 
          {
              $username=$_POST['username'];
              $a_date=$_POST['app_date'];
              $med=$_POST['med'];
              $type=$_POST['type'];
              $dose=$_POST['dose'];
              $times=$_POST['times'];

              $query = "INSERT INTO `prescription` VALUES('{$username}','{$a_date}','$med','$type','$dose','$times')";
              $data = mysqli_query($conn,$query);
              $_SESSION['details']['pat']= $_POST['username'];
              $_SESSION['details']['app']= $_POST['app_date'];
          }
        ?>
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
<?php
include('C:\wamp64\www\Hospital\admin\a_header.php');
include('C:\wamp64\www\Hospital\patient\p_head.php');
include('C:\wamp64\www\Hospital\admin\script.php');
?>
</html>