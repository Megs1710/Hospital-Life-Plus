<?php
 session_start();
 ob_start();
 $error_message = "";
 $msg = "";
 $conn = mysqli_connect("localhost","root","","hospital_life_plus");
 
if(isset($_POST['add_doc'])) 
{
	$num = rand(1000,9999);
	$username="doc".$num;
	//echo "Username: $username <br>";

	$first= $_POST['firstname'];			
	$last= $_POST['lastname'];			
	$gender= $_POST['gender'];			
	$city= $_POST['city'];	
	$state= $_POST['state'];
	$dept= $_POST['dept'];
	$email= $_POST['email'];			
	$office= $_POST['office'];
	$mobile= $_POST['mobile'];

	$num2=rand(1000,9999);
	$pass= $last.$num2;			//password
	//echo "Password: $pass <br>";

	$check_username = mysqli_query($conn, "SELECT * FROM `doctor` WHERE username='{$username}'");
    $count_rows = mysqli_num_rows($check_username);

	if($count_rows==0)
    {
        // check if the user with the entered email already exists in db, if email already exists, do not allow to register
        $res = mysqli_query($conn,"SELECT * FROM `doctor` WHERE email='{$email}'");
        $count = mysqli_num_rows($res);

        $res2 = mysqli_query($conn,"SELECT * FROM `admin` WHERE email='{$email}'");
        $count2 = mysqli_num_rows($res2);

		if($count<1 && $count2<1)
        {
			// INSERT VALUES IN doctor TABLE
			$data = mysqli_query($conn,"INSERT INTO `doctor`  VALUES ('{$username}','{$first}','{$last}','{$gender}','{$city}','{$state}','{$dept}','{$email}','$office','$mobile','{$pass}')");

			require_once("doctor_mail.php");
			$mail_status = sendDetails($email,$username,$pass);

			if($mail_status==1)
			{
				echo "success <br>";
				$_SESSION['email'] = $email;
				// header('location:login_page.php'); //redirect to otp_page
				 exit;
				 ob_end_flush();
			}
		}
		else 
            $error_message = "Email already exists!";
	}
	else 
        $error_message = "Username already taken!";
}
?>
<!DOCTYPE>
<html dir="ltr">
<head>
	<title>New Doctor Registration</title>
	<link rel="stylesheet" href="project_style.css">
</head>

<body class="register">
	<div class="wrapper">
		<h1 class="title">DOCTOR REGISTRATION</h1>

		<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >
			<?php
				if(!empty($error_message)) { 
			?>
				<div class="error_msg" role="alert"><?php echo $error_message; ?></div>
			<?php
				}
			?>

			<!--name-->
			<div class="txt_field">
				<label for name="firstname" class="fld_label">First Name</label>
				<input type = "text"  name = "firstname" required class="fld_inp">
				<br><br>
				<label for name="lastname" class="fld_label">Last Name</label>
				<input type="text" name = "lastname" required class="fld_inp">
				<br><br><br>
			</div>
			
			<!--Gender radio-->
			<div class="">
				<label class="fld_label">Gender: </label>
				<br><br>
				<input type = "radio"  name="gender" value = "female">Female
				<input type = "radio"  name="gender" value = "male">Male
				<input type = "radio"  name="gender" value = "others">Others
				<br><br><br>
			</div>
			
			<!--Address-->
			<div class="txt_field">
				<h3 style="font-family: Montserrat; ">Address</h3><br>
				<label for name="city" class="fld_label">City</label>
				<input type = "text"  name = "city" required class="fld_inp">
				<br><br>
				<label for name="state" class="fld_label">State</label>
				<input type = "text"  name = "state" required class="fld_inp">
				<br><br><br>
			</div>
			
			<!--department-->
			<div class="txt_field">
				<label for name="dept" class="fld_label">Department</label>
				<input type = "text"  name = "dept" required class="fld_inp">
				<br><br>
			</div>
			
			<!--email id -->
			<div class="txt_field">
				<h3 style="font-family: Montserrat; ">Contact Details</h3>
				<label for name="email" class="fld_label">email ID</label>
				<input type = "email"  name = "email" required class="fld_inp">
				<br><br>
			</div>
			
			<!--contact numbers-->
			<div class="txt_field">
				<label for name="office" class="fld_label">Office No.</label> 
				<input type = "text"  name = "office" required class="fld_inp">
				<br><br>
				<label for name="mobile" class="fld_label">Personal Mobile No.</label> 
				<input type = "text"  name = "mobile" required class="fld_inp">
				<br><br><br>
			</div>
			
			<div>
				<input type ="submit" class="butn" name="add_doc" value="ADD DOCTOR">
			</div>
		</form>
	</div>
</body>
</html>