<?php
session_start();

//getting email
$email = $_SESSION['email'];
$error_message = "";

if($_SERVER['REQUEST_METHOD']=="POST")
{
    if(!empty($_POST["reset"])) 
    {
        // retrieve the otp entered by the user
        $password = $_POST["pass"];

        // establish connection to db
        $conn = mysqli_connect("localhost","root","","hospital_life_plus");

        // check if the entered otp matches
        $res = mysqli_query($conn,"SELECT * FROM `OTP_INFO` WHERE email='{$email}'");
        $row=mysqli_fetch_array($res,MYSQLI_ASSOC);
        $count = mysqli_num_rows($res);

        if($count>0) 
        {          
            $res1 = mysqli_query($conn,"SELECT * FROM `patient_registration` WHERE email='{$email}'");
            $count1 = mysqli_num_rows($res1);
            if($count1>0)
            {
                $data = mysqli_query($conn,"UPDATE `patient_registration` SET passwrd='{$password}' WHERE email='{$email}'");
            }
        
            else
            {
                $res1 = mysqli_query($conn,"SELECT * FROM `doctor` WHERE email='{$email}'");
                $count1 = mysqli_num_rows($res1);

                if($count1>0)
                {
                    $data = mysqli_query($conn,"UPDATE `doctor` SET passwrd='{$password}' WHERE email='{$email}'");
                }
                else
                {
                    $res1 = mysqli_query($conn,"SELECT * FROM `admin` WHERE email='{$email}'");
                    $count1 = mysqli_num_rows($res1);

                    if($count1>0)
                    {
                        $data = mysqli_query($conn,"UPDATE `doctor` SET passwrd='{$password}' WHERE email='{$email}'");
                    }
                }

            }
            // delete the otp entry associated with the registered user and also delete the other expired otp records
            $res = mysqli_query($conn,"DELETE FROM `OTP_INFO` WHERE email='{$email}'");
            header('location:login_page.php'); //redirect to login_page
           exit;
        } 
        else 
        {
            $error_message = "Invalid OTP!";
        }
    }
}
?>

<!DOCTYPE>
<html dir="ltr">
<head>
 <meta charset = "utf-8">
  <title>Password_reset</title>
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
	<h2 class="title">PASSWORD RESET</h2><br><br>
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <?php
            if(!empty($error_message)) { 
        ?>
            <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
        <?php
            }
        ?>
        <div class="txt_field">
            <label for name="password" class="fld_label">Enter New Password</label>
            <input type = "password" id = "pass" name="pass" class="fld_inp" placeholder = "Enter New Password">
            <br>
        </div>
        
        <div>
            <input class="" type="checkbox" id="show-password-check" onclick="showHidePassword()">
            <label class="fld_label" for="show-password-check">Show Password</label>
            <br><br>
        </div>

        <div>
        <input type ="submit" class="butn" name="reset" value="RESET"><br>
        </div>
	</form>

    <script>
        function showHidePassword() 
        {
            var x = document.getElementById("pass");
            if (x.type === "password") {
                x.type = "text";
            } else {
                x.type = "password";
            }
        }
    </script>
</div>
</body>
</html>