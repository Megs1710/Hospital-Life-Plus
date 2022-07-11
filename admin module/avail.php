<?php
include('a_header.php');
include('navbar.php');
?>

<!-- Button trigger modal -->
<div class = "card shadow mb-4">
	<div class = "card-header py-3">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dregister">
  ADD Doctor
</button>
</h6>
<br><br>

<!-- ADDING TABLES -->
<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT * from `doctor`";
	$data = mysqli_query($conn,$query);
	
?>

	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>Doc ID</th>
			<th>First name</th>
			<th>Last name</th>
			<th>Department</th>
			<th>Availability</th>
			<th>Edit</th>
			</tr>
		</thead>
		<tbody>
		<?php
			if(mysqli_num_rows($data) > 0)
			{
				while($row = mysqli_fetch_assoc($data))
				{
						?>
				<tr>
					<td><?php echo $row['username']; ?></td>
					<td><?php echo $row['fname']; ?></td>
					<td><?php echo $row['lname']; ?></td>
					<td><?php echo $row['dept']; ?></td>
					<td><?php echo $row['stat']; ?></td>
					<td>
                        <button type="submit" class = "btn btn-success" data-toggle="modal" data-target="#edit">EDIT</button>
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


<!-- Modal -->
<div class="modal fade" id="edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Doctor Availability</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >  
	
	<!--name-->
	<div class="form-group">
		First Name : 
		<input type = "text"  name = "firstname">
		<br><br>
		Last Name:
		<input type="text" name = "lastname">
		<br><br><br>
	</div>
	
	<!--Gender radio-->
	<div class="form-group">
		<label>Gender: </label>
		<br><br>
		<input type = "radio"  name="gender" value = "female" checked=" ">Female
		<input type = "radio"  name="gender" value = "male" checked=" ">Male
		<input type = "radio"  name="gender" value = "others" checked=" ">Others
		<br><br><br>
	</div>
	
    <!--department-->
    <div class="form-group">
		Department: 
		<input type = "text"  name = "dept">
		<br><br><br>
	</div>
	
	<!--email id -->
	<div class="form-group">
		email ID: 
		<input type = "email"  name = "email">
		<br><br><br>
	</div>
	
	<!--mobile no -->
	<div class="form-group">
		Mobile no: 
		<input type = "text"  name = "mobile">
		<br><br><br>
	</div>
	
	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="generate_doc" class="btn btn-primary" >Save</button>
      </div>
	
	</div>
	</form>
    </div>
</div>
</div>
    
<?php

//session_start();
//ob_start();
$error_message = "";
$conn = mysqli_connect("localhost","root","","hospital_life_plus");

//$d_num = rand(1000,9999);
//$username="doc".$d_num;
	
 
if(isset($_POST['generate_doc'])) 
{
		
	$d_num = rand(1000,9999);
	$username="doc".$d_num;

	$first= $_POST['firstname'];		//first name
	$last= $_POST['lastname'];			//last name
	$gender= $_POST['gender'];			//gender
	$dept= $_POST['dept'];				//department
	$email= $_POST['email'];			//email
	$mobile= $_POST['mobile'];			//Mobile number

	$num2=rand(1000,9999);
	$pass= $last.$num2;			//password

	$check_username = mysqli_query($conn, "SELECT * FROM `doctor` WHERE username='{$username}'");
    $count_rows = mysqli_num_rows($check_username);

	if($count_rows==0)
    {
        /* check if the user with the entered email already exists in db, if email already exists, do not allow to register
        $res = mysqli_query($conn,"SELECT * FROM `doctor` WHERE email='{$email}'");
        $count = mysqli_num_rows($res);*/

        $res2 = mysqli_query($conn,"SELECT * FROM `admin` WHERE email='{$email}'");
        $count2 = mysqli_num_rows($res2);

		if($count2<1)
        {
			// INSERT VALUES IN doctor TABLE
			$data = mysqli_query($conn,"INSERT INTO `doctor`  VALUES ('{$username}','{$first}','{$last}','{$gender}','{$dept}','{$email}','$mobile','{$pass}')");

			require_once("C:\wamp64\www\Hospital\doctor_mail.php");
			$mail_status = sendDetails($email,$username,$pass);

			if($mail_status==1)
			{
				//echo "success <br>";
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
//session_destroy();
?>


 
<?php
include('script.php');
?>