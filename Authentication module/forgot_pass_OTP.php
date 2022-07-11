<?php
    session_start();
    $email = $_SESSION['email'];
	$error_message = "";
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        if(!empty($_POST["submit_otp"]) && !empty($_POST['otp_box'])) 
        {
			
            // retrieve the otp entered by the user
            $OTP = $_POST["otp_box"];
			$conn = mysqli_connect("localhost","root","","hospital_life_plus"); // establish connection to database
			
			// check if the entered otp matches 
			$res = mysqli_query($conn,"SELECT * FROM `otp_info` WHERE otp=".$OTP);
            $count  = mysqli_num_rows($res);

			if($count>0) 
            {
                // delete the otp entry associated with the registered user
                header('location:password_reset_page.php');
                exit;
            } 
            else 
                $error_message = "Invalid OTP!";
        }

		if(!empty($_POST['resend_otp']))
        {
			$conn = mysqli_connect("localhost","root","","hospital_life_plus"); // establish connection to database
			
			//delete previous otp and temp user
            $res = mysqli_query($conn,"DELETE FROM `otp_info` WHERE email='{$email}'");

            //here we generate OTP
            $OTP = rand(100000,999999);

            //Here the sending process begins
            require_once("mailing_function.php");
            $mail_status = sendOTP($email,$username,$OTP,true);
			
			if($mail_status == 1) 
            {
				
                // INSERT VALUES IN OTP TABLE
                $res = mysqli_query($conn,"INSERT INTO `otp_info` VALUES ('{$email}', '{$OTP}')");
                
                header('location:forgot_pass_OTP.php'); //redirect to forgot_password_otp_page
                exit;
            }
        }
    }
?>

<!DOCTYPE>
<html dir="ltr">
<head>
    <meta charset = "utf-8">
    <title>Forgot_password_otp</title>
    <link rel="stylesheet" href="project_style.css">
    <style>
        .card{
            margin: 140px auto;
            position: relative;
            align-items: center;
            width: 30%;
            padding: 2rem;

            background: rgba(255, 255, 255, 0.27);
            border-radius: 10px;
        }
    </style>
</head>

<body class="otp">
    <div class ="card">
        <h2 class="title">OTP VERIFICATION</h2><br><br>
        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        
            <?php
                if(!empty($error_message)) { 
            ?>
                <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
            <?php
                }
            ?>

            <div class="txt_field">
                <label for name="otp_box" class="fld_label">Enter OTP</label>
                <input type = "text" id = "otp_box" name="otp_box" class="fld_inp" placeholder = "Enter OTP">
                <br>
            </div>
            
            <div>
            <input type ="submit" class="butn" name="submit_otp" value="VERIFY OTP"><br>
            </div>
            <input type ="submit" class="butn" name="resend_otp" value="RESEND OTP"><br>
        </form>
    </div>
</body>
</html>