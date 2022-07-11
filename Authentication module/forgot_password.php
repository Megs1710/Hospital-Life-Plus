<?php
    session_start();
    $error_message = "";
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        if(!empty($_POST['submit_email'])) 
        {
            // retrieve the email
            $email = $_POST['email'];
            $username = $_POST['username'];
			$conn = mysqli_connect("localhost","root","","hospital_life_plus"); // establish connection to database
			
			//check if email is registered
            $res1 = mysqli_query($conn,"SELECT * FROM `patient_registration` WHERE email='{$email}' AND username='{$username}'");
            $count1 = mysqli_num_rows($res1);

            $res2 = mysqli_query($conn,"SELECT * FROM `doctor` WHERE email='{$email}' AND username='{$username}'");
            $count2 = mysqli_num_rows($res2);
            $count3 = 0;

			if($count1<1 && $count2<1)
            {
                $res3 = mysqli_query($conn,"SELECT * FROM `admin` WHERE email='{$email}'");
                $count3 = mysqli_num_rows($res3); 
            }
			if($count1>0 || $count2>0 || $count3>0)
            {
                //here we generate OTP
                $OTP = rand(100000,999999);

                //Here the sending process begins
                require_once("mailing_function.php");
                $mail_status = sendOTP($email,$username,$OTP,true);
				
				if($mail_status == 1) 
                {
					$_SESSION['email'] = $email;
                    // INSERT VALUES IN OTP TABLE
                    $res = mysqli_query($conn,"INSERT INTO `otp_info` VALUES ('{$email}', '{$OTP}')");
                    header('location:forgot_pass_OTP.php'); //redirect to otp_page
                    exit;
                }
            } 
            else
            {
                $error_message = "This email is not registered with us";
            }   
        }
    }

?>


<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset = "utf-8">
    <title>forgot password</title>
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

<body class="reset_pass">
    <div class ="card">
        <h1 class="title">VERIFY THAT IT'S YOU</h1>
            <?php
                if(!empty($error_message)) {
            ?>
            <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
            <?php
                }
            ?>

        <form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <div class="txt_field">
            <label for name="username" class="fld_label">Username</label>
            <input type = "text" name="username" required class="fld_inp">
            <br><br>
        </div>

        <!--email id -->
        <div class="txt_field">
            <label for name="email" class="fld_label">Email ID</label>
            <input type = "email" name="email" required class="fld_inp">
            <br><br>
        </div>
        
        <div>
        <input type ="submit" class="butn" name="submit_email" value="VERIFY"><br>
        </div>
    </div>
</body>
</html>