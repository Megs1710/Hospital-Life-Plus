<?php
 session_start();
 ob_start();
 $error_message = "";
 $conn = mysqli_connect("localhost","root","","hospital_life_plus");
 
 if(isset($_POST['logout'])) 
  {
    session_destroy();
    header('location:..\login_page.php'); //redirect the user to login page
    exit;
    ob_end_flush();
  }
  
if(isset($_POST['request'])) 
{
  $user= $_POST['username'];
	$first= $_POST['firstname'];	
	$last= $_POST['lastname'];	
	$email= $_POST['email'];
  $dept= $_POST['department'];
  $status=0;

	$check_username = mysqli_query($conn, "SELECT * FROM `patient_registration` WHERE username='{$user}'");
    $count_rows = mysqli_num_rows($check_username);

	if($count_rows==0)
    {
        $error_message = "Incorrect Username!";
	}
	else
    {
         // check if the user with the entered email exists in db
         $res = mysqli_query($conn,"SELECT * FROM `patient_registration` WHERE email='{$email}'");
         $count = mysqli_num_rows($res);
 
         if($count==0)
         {
            $error_message = "Invalid Email Address!";
         }
         else
         {
              // INSERT VALUES IN temp TABLE
              $temp = mysqli_query($conn,"INSERT INTO `app_req` VALUES('{$user}','{$first}', '{$last}', '{$email}','{$dept}', $status)");
              $conn -> query($temp);              
              header('location:request_sent.php'); //redirect to otp_page
              exit;
              ob_end_flush();
         }
    }   
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Life Plus_ Appointment</title>
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
            <li class="nav-item">
              <a class="nav-link" href="home_pat.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="about.php">About Us</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="pat_prescrip.php">Prescription</a>
            </li>
            <li class="nav-item active">
              <a class="nav-link" href="doctors.html">Appointments</a>
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

  <div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make an Appointment</h1>

      <form class="main-form" action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <?php
				  if(!empty($error_message)) { 
			  ?>
				<div class="error_msg" role="alert"><?php echo $error_message; ?></div>
			  <?php
				  }
			  ?>
        <?php
              $conn = mysqli_connect("localhost","root","","hospital_life_plus");
              $pat = $_SESSION['patient'];
              
              $query = "SELECT * from `patient_registration` where username='{$pat}'";
              $data = mysqli_query($conn,$query);
              $row = mysqli_fetch_assoc($data);

              $query = "SELECT distinct dept from `doctor`";
              $data2 = mysqli_query($conn,$query);
        ?>

        <div class="row mt-5 ">
          <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
              <input type="text" class="form-control" placeholder="Patient Unique ID" name="username" value="<?php echo $row['username']; ?>" required>
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <input type="email" class="form-control" placeholder="Email address.." name="email" value="<?php echo $row['email']; ?>" required>
            </div>

            <div class="col-12 col-sm-6 py-2 wow fadeInLeft">
              <input type="text" class="form-control" placeholder="First Name" name="firstname" value="<?php echo $row['fname']; ?>" required>
            </div>
            <div class="col-12 col-sm-6 py-2 wow fadeInRight">
              <input type="text" class="form-control" placeholder="Last Name" name="lastname" value="<?php echo $row['lname']; ?>" required>
            </div>
          
            <div class="col-12 col-sm-6 py-2 wow fadeInRight" data-wow-delay="300ms">
              <select name="department" id="department" class="custom-select">
              <?php
                if(mysqli_num_rows($data2) > 0)
                {
                  while($row = mysqli_fetch_assoc($data2))
                  {
                      ?>
                      <option value="<?php echo $row['dept']?>"><?php echo $row['dept']?></option>
                      <?php						
                  }
                }
                else 
                {
                  echo "No record found";
                }
                ?>
              </select>
            </div>
          </div>
          <button type="submit" class="btn btn-primary mt-3 wow zoomIn" name="request">Submit Request</button>
        </form>
    </div>
  </div> <!-- .page-section -->

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
        <a name="contact"> <h5>Contact</h5></a>
          <p class="footer-link mt-2">Computer Department, Goa College Of Engineering</p>
          <p class="footer-link mt-2">91-89422-68436</p>
          <a href="https://mail.google.com/" class="footer-link">lifeplus.goa@gmail.com</a>

          <h5 class="mt-3">Social Media</h5>
          <div class="footer-sosmed mt-3">
            <a href="#" target="_blank"><span class="mai-logo-facebook-f"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-twitter"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-google-plus-g"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-instagram"></span></a>
            <a href="#" target="_blank"><span class="mai-logo-linkedin"></span></a>
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