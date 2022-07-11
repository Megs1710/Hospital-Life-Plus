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
<head>
  <title>Life Plus_ Doctor</title>
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
              <a class="nav-link" href="tests.php">Tests</a>
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
<div class = "card shadow mb-4">
	<div class = "card-header py-3">
		<h6 class = "m-0 font-weight-bold text-primary"> add tests </h6>
	</div>
		<div class="card-body">
	<?php
		$conn = mysqli_connect("localhost","root","","hospital_life_plus");
		$pat= $_SESSION['details']['pat'];
		$adate = $_SESSION['details']['app'];

		if(isset($_POST['testname']))
		{
			$dept = $_POST['dept'];
			
              $conn = mysqli_connect("localhost","root","","hospital_life_plus");
             // $pat= $_SESSION['details']['pat'];
//$adate = $_SESSION['details']['date'];
              
              $query = "SELECT distinct username,app_date from `prescription` where username='{$pat}' and app_date='{$adate}'";
              $data = mysqli_query($conn,$query);
			

			//$query="SELECT dept from `doctor_registration`";
			
			/*echo $dept;
			//$query1 = "select doctor_registration.dept from `doctor_registration` RIGHT JOIN `alloted_test` ON doctor_registration.dept = alloted_test.dept";
			//$data1 = mysqli_query($conn,$query1);
			
			$query = "SELECT * from `alloted_test` where dept='$dept'";
			$data = mysqli_query($conn,$query);
			
			//edit and update of doctor 
			foreach($data as $row)
			{*/

				?>
				 <?php
                if(mysqli_num_rows($data) > 0)
                {
                  while($row = mysqli_fetch_assoc($data))
                  {
                      ?>
					<form action="<?php echo $_SERVER["PHP_SELF"];?>" method= "POST">
					
					<div class="form-group">
						<!--username-->
						<input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
						<input type = "hidden" name = "dept" value= "<?php echo $dept; ?>"   >
						<input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">

						<br>
						<br>
					</div>
					
					<div class="form-group" class = "form-control">
						<textarea rows="4" cols="20" name="test_name" placeholder="Enter Tests Here" class = "form-control" ></textarea>
					</div>	
					
					<button type="button" class="btn btn-secondary">Close</button>
					
					<?php $_SESSION['app']= $row['app_date'];?>
					<button type="submit" name="test_btn" class="btn btn-primary" >Save</button>
					</div>
					</form>
					<?php
					}
				}
			}
		?>

</div>


<?php
//session_start();

//$conn = mysqli_connect("localhost","root","","hospital_life_plus");
if(isset($_POST['test_btn'])) 
{
	$dept= $_POST['dept'];				//department
	$test_name= $_POST['test_name'];
  $stat=1;
	//$pat= $_SESSION['details']['pat'];	
	//$adate = $_SESSION['details']['date'];
	
			/*$query1 = "SELECT * from `prescription` where username='$pat'";
			$data1 = mysqli_query($conn,$query1);
			
			
			$username=$row['username'];
			$dept= $row['dept'];			//first name
			$date= $row['app_date'];
			$email= $row['email'];			//email

			require_once("test_mail.php");
			$mail_status = sendDetails($email,$dept,$test_name);

			if($mail_status == 1) 
			{*/
				// INSERT VALUES IN OTP TABLE
				$query = "insert into `alloted_test` values('$pat','$dept','$adate','$test_name') ";
				$data = mysqli_query($conn,$query);
				
				
				if($data)
				{
					echo "your data is updated";
					header('Location:tests.php');
				}
				else
				{
					echo "your data is not updated";
					//header('location:tests.php');
					
				}
		
}
//session_destroy();

?>
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
include('C:\wamp64\www\Hospital\admin\script.php');
?>

