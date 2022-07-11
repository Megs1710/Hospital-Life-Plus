<?php
  session_start();
  if(isset($_POST['logout'])) 
  {
    session_destroy();
    header('location:..\login_page.php'); //redirect the user to login page
    exit;
    ob_end_flush();
  }

  if(isset($_POST['done']))
  {
    $conn = mysqli_connect("localhost","root","","hospital_life_plus");

    $username = $_SESSION['details']['pat'];
    $a_date = $_SESSION['details']['app'];

    $query = "SELECT * from `appointment` where username='$username' and app_date='$a_date'";
    $data2 = mysqli_query($conn,$query);
    $row = mysqli_fetch_assoc($data2);
    $fname = $row['fname'];
    $lname = $row['lname'];
    $email = $row['email'];
    $dept = $row['dept'];
    $doc = $row['doc'];
    $slot = $row['slot'];

    $query = "UPDATE `appointment` SET status=1 where username='$username' and app_date='$a_date'";
    $data1 = mysqli_query($conn,$query);
    header('location:..\doctor\home_doc.php'); 
  }
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">

  <meta http-equiv="X-UA-Compatible" content="ie=edge">

  <meta name="copyright" content="MACode ID, https://macodeid.com/">

  <title>Life Plus_ Doctor</title>
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
        <a class="navbar-brand" href="home_doc.php"><span class="text-primary">Hospital </span>Life +</a>

        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupport" aria-controls="navbarSupport" aria-expanded="false" aria-label="Toggle navigation">
          <span class="navbar-toggler-icon"></span>
        </button>

        <div class="collapse navbar-collapse" id="navbarSupport">
          <ul class="navbar-nav ml-auto">
            <li class="nav-item">
              <a class="nav-link" href="home_doc.php">Home</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#appointments">Appointments</a>
            </li>
            <li class="nav-item">
              <a class="nav-link" href="#contact">Tests</a>
            </li>
            <li class="nav-item active">
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
  

<div class="page-section">
    <div class="container">
      <h1 class="text-center wow fadeInUp">Make Test Appointment</h1>
	 <?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT distinct  dept from `doctor`";
	$data = mysqli_query($conn,$query);
	?>
		
		<div class="text-center wow fadeInUp">
		<div class="row mt-5 ">
		<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>DEPARTMENT</th>
			<th>TEST</th>
			</tr>
		</thead>
		<tbody>
		
		</div>
		<?php
			if(mysqli_num_rows($data) > 0)
			{
				while($row = mysqli_fetch_assoc($data))
				{
						?>
				<tr>
					<td><?php echo $row['dept']; ?></td>
					<td>
						<form action = "test_form.php" method = "post">
							<input type = "hidden" name = "dept" value="<?php echo $row['dept']; ?>">
							<button type="submit" name="testname" class = "btn btn-success"> ADD </button>
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
<div class="container">
            <div class="container text-center wow zoomIn">
                <div class="col-12 col-sm-6 py-2 wow fadeInUp">
                <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
                    <input type= "submit" name="done" class="btn btn-primary" value="Back To Home Page"><br><br><br><br>
                </form>
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