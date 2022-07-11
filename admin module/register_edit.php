<?php
include('a_header.php');
include('navbar.php');
?>

<div class= "container-fluid">

<!-- template for editing-->
<div class = "card shadow mb-4">
	<div class = "card-header py-3">
		<h6 class = "m-0 font-weight-bold text-primary"> Edit Doctor data </h6>
	</div>
		<div class="card-body">
		
		<!--php or editing-->
		<?php
		$conn = mysqli_connect("localhost","root","","hospital_life_plus");

		if(isset($_POST['edit_btn']))
		{
			$username = $_POST['edit_username'];
			
			$query = "select * from `doctor` where username='$username'";
			$data = mysqli_query($conn,$query);
			
			//edit and update of doctor 
			foreach($data as $row)
			{
				?>
				<form action="<?php echo $_SERVER["PHP_SELF"];?>" method= "POST">
				<div class="form-group">
					<!--username-->
					<input type = "hidden" value= "<?php echo $row['username']; ?>" name = "edit_username" class = "form-control" >
					<br>
					<br>
				</div>
				
				<div class="form-group">
					First Name : 
					<input type = "text" value= "<?php echo $row['fname']; ?>" name = "edit_firstname" class = "form-control" >
					<br>
					Last Name:
					<input type="text" value= "<?php echo $row['lname']; ?>" name = "edit_lastname" class = "form-control"> 
					<br>
				</div>
			
				<!--Gender radio-->
				<div class="form-group" class = "form-control">
					<label>Gender: </label>
					<br>
					<input type = "radio" value= "<?php echo $row['gender']; ?>" name="edit_gender" checked=" " >Female
					<input type = "radio" value= "<?php echo $row['gender'];?>" name="edit_gender" checked=" " >Male
					<input type = "radio" value= "<?php echo $row['gender'];?>" name="edit_gender" checked=" ">Others
					<br><br>
				</div>
			
				<!--department-->
				<div class="form-group">
					Department: 
					<input type = "text" value= "<?php echo $row['dept'];?>" name = "edit_dept" class = "form-control" >
					<br>
				</div>
				
				<!--email id -->
				<div class="form-group">
					email ID: 
					<input type = "email" value= "<?php echo $row['email']; ?>" name = "edit_email" class = "form-control">
					<br>
				</div>
				
				<!--mobile no -->
				<div class="form-group">
					Mobile no: 
					<input type = "text" value= "<?php echo $row['mobile']; ?>" name = "edit_mobile" class = "form-control">
					<br>
				</div>
				
				<!--password -->
				<div class="form-group">
					Password: 
					<input type = "password" value= "<?php echo $row['passwrd']; ?>" name = "edit_passwrd" class = "form-control" >
					<br>
				</div>
				
				<div>
					<a href="register_d.php" class="btn btn-danger" >Cancel</a>
					<button type="submit" name="update" onclick="link()" class="btn btn-primary">Update</button>
					<script>
						function link()
						{
							window.location.href="register_d.php";
						}
					</script>
				</div>
				</form>
				<?php
			}
		}
		?>
	</div>
</div>
</div>
<!--over -->

<!-- database connection for doctor DB edit-->
<?php
//session_start();

//$conn = mysqli_connect("localhost","root","","hospital_life_plus");
if(isset($_POST['update'])) 
{
	$username=$_POST['edit_username'];		//username
	$first= $_POST['edit_firstname'];		//first name
	$last= $_POST['edit_lastname'];			//last name
	$gender= $_POST['edit_gender'];			//gender
	$dept= $_POST['edit_dept'];				//department
	$email= $_POST['edit_email'];			//email
	$mobile= $_POST['edit_mobile'];			//Mobile number
	$pass= $_POST['edit_passwrd'];			//password
	
	$query = "UPDATE doctor SET fname ='$first', lname='$last', gender='$gender', dept='$dept', email='$email', mobile='$mobile', passwrd='$pass' WHERE username='$username'";
	$data = mysqli_query($conn,$query);
	
	
	if($data)
	{
		echo "your data is updated";
		header('Location:register_d.php');
	}
	else
	{
		echo "your data is not updated";
		header('location:register_d.php');
		
	}
	
	//header("location: register_d");
}



?>
<?php
include('script.php');
?>