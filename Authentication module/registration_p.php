<?php
 session_start();
 ob_start();
 $error_message = "";
 $conn = mysqli_connect("localhost","root","","hospital_life_plus");
 
if(isset($_POST['generate'])) 
{
	$p_num = rand(1000,9999);
	$username="pat".$p_num;

	$first= $_POST['firstname'];		//first name	
	$last= $_POST['lastname'];			//last name
	$birthdate= $_POST['date'];			//birthdate
	$gender= $_POST['gender'];			//gender
	$hno= $_POST['hno'];				//address
	$street= $_POST['street'];	
	$city= $_POST['city'];	
	$state= $_POST['state'];
	$pincode= $_POST['pincode'];
	$email= $_POST['email'];			//email
	$mobile= $_POST['mobile'];			//Mobile number
	$pass= $_POST['pass'];			//password

	$check_username = mysqli_query($conn, "SELECT * FROM `patient_registration` WHERE username='{$username}'");
    $count_rows = mysqli_num_rows($check_username);

	if($count_rows==0)
    {
        /* check if the user with the entered email already exists in db, if email already exists, do not allow to register
        $res = mysqli_query($conn,"SELECT * FROM `patient_registration` WHERE email='{$email}'");
        $count = mysqli_num_rows($res);*/

        $res2 = mysqli_query($conn,"SELECT * FROM `admin` WHERE email='{$email}'");
        $count2 = mysqli_num_rows($res2);

		if($count2<1)
        {
            //here we generate OTP
            $OTP = rand(100000,999999);
			echo "OTP: $OTP <br>";
			echo "email: $email <br>";

            //Here the sending process begins
            require_once("mailing_function.php");
            $mail_status = sendOTP($email, $username,$OTP,false);
			echo "email stat: $mail_status <br>";

			if($mail_status == 1) 
            {
				// INSERT VALUES IN temp TABLE
				$temp = mysqli_query($conn,"INSERT INTO `temp` VALUES('{$username}','{$first}', '{$last}', '{$birthdate}', '{$gender}', '$hno', '{$street}', '{$city}', '{$state}', '$pincode', '{$email}', '$mobile','{$pass}')");
	
                // INSERT VALUES IN OTP TABLE
                $res = mysqli_query($conn,"INSERT INTO `otp_info` VALUES ('{$email}','{$OTP}')");
                            
                $_SESSION['email'] = $email;
                header('location:otp_page.php'); //redirect to otp_page
                exit;
                ob_end_flush();
            } 
            else 
                $error_message = "Email address is not valid!";
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
	<title>New Patient Registration</title>
	<link rel="stylesheet" href="project_style.css">
</head>

<body class="register">
	<div class="wrapper">

		<h1 class="title">PATIENT REGISTRATION</h1>
		<h2> Enter your Details:</h2>

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
			
			<!--Birth date-->
			<div class="txt_field">
				<label for name="date" class="fld_label">Date Of Birth</label>
				<input type = "date" name = "date"required class="fld_inp">
				<br><br><br>
			</div>
			
			<!--Gender radio-->
			<div class="">
				<label>Gender: </label>
				<br><br>
				<input type = "radio"  name="gender" value = "female">Female
				<input type = "radio"  name="gender" value = "male">Male
				<input type = "radio"  name="gender" value = "others">Others
				<br><br><br>
			</div>
			
			<!--Address-->
			<div class="txt_field">
				<h3>Address</h3>
				<br>
				<label for name="hno" class="fld_label">House No</label>
				<input type = "text" name="hno" required class="fld_inp">
				<br><br>

				<label for name="street" class="fld_label">Street</label>
				<input type = "text" name="street" required class="fld_inp">
				<br><br>

				<label for name="city" class="fld_label">City</label>
				<input type = "text" name="city" required class="fld_inp">
				<br><br>
				
				<label for name="state" class="fld_label">State</label>
				<input type = "text" name="state" required class="fld_inp">
				<br><br>

				<label for name="pincode" class="fld_label">Pin Code</label>
				<input type = "text" name="pincode" required class="fld_inp">
				<br><br><br>
			</div>
			
			
			<!--email id -->
			<div class="txt_field">
				<label for name="email" class="fld_label">Email ID</label>
				<input type = "email" name="email" required class="fld_inp">
				<br><br><br>
			</div>
			
			<!--mobile no -->
			<div class="txt_field">
			<label for name="mobile" class="fld_label">Mobile No.</label>
				<input type = "text" name="mobile" required class="fld_inp">
				<br><br><br>
			</div>

			<!--password -->
			<div class="txt_field">
			<label for name="pass" class="fld_label">Set Password.</label>
				<input type = "password" required id = "pass" name="pass" required class="fld_inp">
				<br><br><br>
			</div>
			<div>
				<input class="" type="checkbox" id="show-password-check" onclick="showHidePassword()">
				<label class="fld_label" for="show-password-check">Show Password</label>
				<br><br><br>
			</div>
			
			<div>
				<input type ="submit" class="butn" name="generate" value="GENERATE OTP">
			</div>

			<script>
				function showHidePassword() {
					var x = document.getElementById("pass");
					if (x.type === "password") {
						x.type = "text";
					} else {
						x.type = "password";
					}
				}
			</script>
		</form>
	</div>

</body>
</html>