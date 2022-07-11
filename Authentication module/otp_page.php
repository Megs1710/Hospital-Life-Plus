<?php
session_start();

//getting email
$email = $_SESSION['email'];
$error_message = "";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(isset($_POST["submit_otp"]) && !empty($_POST['otp_box'])) 
    {
        // retrieve the otp entered by the user
        $OTP = $_POST["otp_box"];

        // establish connection to db
        $conn = mysqli_connect("localhost","root","","hospital_life_plus");

        // check if the entered otp matches
        $res = mysqli_query($conn,"SELECT * FROM `OTP_INFO` WHERE otp=".$OTP."");
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $count  = mysqli_num_rows($res);

        if($count>0) 
        {
            // delete the otp entry associated with the registered user and also delete the other expired otp records
            $res = mysqli_query($conn,"DELETE FROM `OTP_INFO` WHERE email='{$email}'");

           $result = mysqli_query($conn, "SELECT * FROM `temp` WHERE email='{$email}'");
            $row=mysqli_fetch_array($result,MYSQLI_ASSOC); //fetch the row of data from above table
            
            $username=$row['username'];
            $first= $row['fname'];		//first name	
            $last= $row['lname'];			//last name
            $birthdate= $row["DOB"];			//birthdate
            $gender= $row["gender"];			//gender
            $hno= $row['Hno'];				//address
            $street= $row['street'];	
            $city= $row['city'];	
            $state= $row['state'];
            $pincode= $row['pincode'];
            $email= $row['email'];			//email
            $mobile= $row['mobile'];			//Mobile number
            $pass= $row['passwrd'];			//password

            $data = mysqli_query($conn,"INSERT INTO `patient_registration`  VALUES ('{$username}','{$first}', '{$last}', '{$birthdate}', '{$gender}', '$hno', '{$street}', '{$city}', '{$state}', '$pincode', '{$email}', '$mobile','{$pass}')");
            $row = mysqli_query($conn,"DELETE FROM `temp` WHERE email='{$email}'");
            header('location:login_page.php'); //redirect to login_page
           exit;
        } 
        else 
        {
            $error_message = "Invalid OTP!";
        }
    }
    if(!empty($_POST['resend_otp']))
    {
        // establish connection to db
        $conn = mysqli_connect("localhost","root","","hospital_life_plus");

        $result = mysqli_query($conn, "SELECT * FROM `temp` WHERE email='{$email}'");
        $row=mysqli_fetch_array($result,MYSQLI_ASSOC);
        $username= $row['username'];
        $email= $row['email'];

        //delete previous otp
        $res = mysqli_query($conn,"DELETE FROM `OTP_INFO` WHERE email='{$email}'");

        //here we generate OTP
        $OTP = rand(100000,999999);

        //Here the sending process begins
        require_once("mailing_function.php");
        $mail_status = sendOTP($email,$username,$OTP,false);

        if($mail_status == 1) 
        {
            // INSERT VALUES IN OTP TABLE
            $res = mysqli_query($conn,"INSERT INTO `OTP_INFO` VALUES ('{$email}' , '{$OTP}')");
            header('location:otp_page.php'); //redirect to otp_page
            exit;
        }
    }
}
?>

<!DOCTYPE>
<html dir="ltr">
<head>
 <meta charset = "utf-8">
  <title>OTP PAGE</title>
 <link rel="stylesheet" href="project_style.css">
 <style>
        .card{
            margin: auto;
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
	<h2 class="title">VERIFY THAT IT'S YOU</h2><br><br>
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