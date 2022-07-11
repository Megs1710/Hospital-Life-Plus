<?php
    session_start(); //start the session, needed for $_SESSION
    $conn=mysqli_connect("localhost","root","","hospital_life_plus"); // establish connection to database
    ob_start();
    $error_message = "";

    // here the password and username checking for login will take place
    if($_SERVER['REQUEST_METHOD']=="POST")
    {
        if(!empty($_POST['login']))
         {
            // retrieve the username and password
            $username = $_POST["username"];
            $password = $_POST["pass"];

            /* search if the entered username and password are present in the patient or doctor table or admin table. 
            If yes, then allow login.*/
            $res1 = mysqli_query($conn,"SELECT * FROM `patient_registration` WHERE username='{$username}'");
            $count1 = mysqli_num_rows($res1);

            $res2 = mysqli_query($conn,"SELECT * FROM `doctor` WHERE username='{$username}'");
            $count2 = mysqli_num_rows($res2);
            $count3 = 0;

            if($count1<1 && $count2<1)
            {
                $res3 = mysqli_query($conn,"SELECT * FROM `admin` WHERE username='{$username}'");
                $count3 = mysqli_num_rows($res3);
            }
            
            $row = NULL;             
            if($count1>0 || $count2>0 || $count3>0)
            {
                
                if($count1>0)
                {
                    $row=mysqli_fetch_array($res1,MYSQLI_ASSOC); //fetch the row of data from above table
                }
                if($count2>0)
                {
                    $row=mysqli_fetch_array($res2,MYSQLI_ASSOC); //fetch the row of data from above table
                }
                if($count3>0)
                {
                    $row=mysqli_fetch_array($res3,MYSQLI_ASSOC); //fetch the row of data from above table
                }
                $pass = $row['passwrd'];
                $check = strcmp($password,$pass);

                if($check == 0)
                {
                    if($count1>0)
                    {
                        $_SESSION['patient']=$username;
                        header('location:patient/home_pat.php'); //redirect the user to home page
                        exit;
                        ob_end_flush();
                    }
                    if($count2>0)
                    {
                        $_SESSION['doctor']=$username;
                        header('location:doctor/home_doc.php'); //redirect the user to home page
                        exit;
                        ob_end_flush();
                    }
                    if($count3>0)
                    {
                        $_SESSION['admin']=$username;
                        header('location:admin/index.php'); //redirect the user to home page
                        exit;
                        ob_end_flush();
                    }
                } 
                else 
                {
                    $error_message = "Incorrect password";
                }
            } 
            else 
            {
                $error_message = "This user is not registered with us";
            }
        }
    }
?>
<!DOCTYPE>
<html dir="ltr">
<head>
 <meta charset = "utf-8">
  <title>LOGIN</title>
 <link rel="stylesheet" href="project_style.css">
</head>
<body class="login">
<header class="hosp_name">
    <h1>HOSPITAL LIFE PLUS</h1>
</header>
 <div class ="wrapper">
	<h1 class="title">LOGIN</h1>

	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post">
        <?php
            if(!empty($error_message)) { 
        ?>
            <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
        <?php
            }
        ?>

        <div class="txt_field">
            <label for name="username" class="fld_label">Unique ID</label>
            <input type = "text" required name="username" id = "username" class="fld_inp" placeholder = "Enter your Username">
            <br>
        </div>
        
        <div class="txt_field">
            <label for name="pass" class="fld_label">Password</label>
            <input type = "password" required name="pass" id = "pass" class="fld_inp" placeholder = "Enter your password">
        </div>
        
        <div class="passwrd">
            <input class="" type="checkbox" id="show-password-check" onclick="showHidePassword()">
            <label for="show-password-check">Show Password</label>
            <p class= "forgot_pass" style="text-align: right; position:relative;"><a href="forgot_password.php">Forgot password?</a></p>
            <br><br><br>
        </div>

        <div>
            <input type ="submit" class="butn" name="login" id="login" value="LOGIN">
        </div>
        <br><p class="description">Don't have an account?<a href="registration_p.php">Sign Up</a><p>
	</form>
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

</body>
</html>