<?php
include('a_header.php');
include('navbar.php');
?>

<div class= "container-fluid">

<!-- template for editing-->
<div class = "card shadow mb-4">
	<div class = "card-header py-3">
		<h6 class = "m-0 font-weight-bold text-primary"> Edit Patient data </h6>
	</div>
		<div class="card-body">
		
		<!--php or editing-->
		<?php
		$conn = mysqli_connect("localhost","root","","hospital_life_plus");

		if(isset($_POST['edit_p']))
		{
			$username = $_POST['edit_username'];
			
			$query = "select * from `patient_registration` where username='$username'";
			$data = mysqli_query($conn,$query);
			
			//edit and update of patient 
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
				
				<div class="form-group">
					DOB:
					<input type = "date" value= "<?php echo $row['DOB']; ?>" name = "edit_DOB" class="form-control">
					<br>
				</div>
			
				<!--Gender radio-->
				<div class="form-group" class = "form-control">
					<label>Gender: </label>
					<br>
					<input type = "radio" value= "<?php echo $row['gender']; ?>" name="edit_gender" class="" checked=""  >Female
					<input type = "radio" value= "<?php echo $row['gender'];?>" name="edit_gender" class="" checked="" >Male
					<input type = "radio" value= "<?php echo $row['gender'];?>" name="edit_gender" class="" checked="">Others
					<br><br>
				</div>
			
				<div class="form-group">
					Hno: 
					<input type = "text" value= "<?php echo $row['Hno'];?>" name = "edit_hno" class = "form-control" >
					<br>
				</div>
				
				<div class="form-group">
					Street: 
					<input type = "text" value= "<?php echo $row['street'];?>" name = "edit_street" class = "form-control" >
					<br>
				</div>
				
				<div class="form-group">
					City: 
					<input type = "text" value= "<?php echo $row['city'];?>" name = "edit_city" class = "form-control" >
					<br>
				</div>
				
				<div class="form-group">
					State: 
					<input type = "text" value= "<?php echo $row['state'];?>" name = "edit_state" class = "form-control" >
					<br>
				</div>
				
				<div class="form-group">
					Pincode: 
					<input type = "text" value= "<?php echo $row['pincode'];?>" name = "edit_pincode" class = "form-control" >
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
					<a href="register_p.php" class="btn btn-danger">Cancel</a>
					<!--
					<a href="register_p.php">
					<input type="submit" name="update" class="btn btn-primary" value="Update" >
					</a>
					-->
					<a href="register_p.php">
						<button type="submit" name="update_p" class="btn btn-primary">Update</button>
					</a>
				</div>
				</form>
				<?php
			}
		}
		?>
	</div>
</div>
</div>
</div>
<!--over -->

<!-- database connection for doctor DB edit-->
<?php
//session_start();

$conn = mysqli_connect("localhost","root","","hospital_life_plus");
if(isset($_POST['update_p'])) 
{
	$username=$_POST['edit_username'];		//username
	$first= $_POST['edit_firstname'];		//first name
	$last= $_POST['edit_lastname'];			//last name
	$date =$_POST['edit_DOB'];	
	$gender= $_POST['edit_gender'];		//gender
	$hno= $_POST['edit_hno'];
	$street= $_POST['edit_street'];
	$city= $_POST['edit_city'];				//department
	$state= $_POST['edit_state'];
	$pincode= $_POST['edit_pincode'];
	$email= $_POST['edit_email'];			//email
	$mobile= $_POST['edit_mobile'];			//Mobile number
	$pass= $_POST['edit_passwrd'];			//password
	
	$query = "UPDATE patient_registration SET fname ='$first', lname='$last',DOB ='$date', gender='$gender', Hno='$hno',street='$street', city='$city', state='$state' ,pincode='$pincode', email='$email', mobile='$mobile', passwrd='$pass' WHERE username='$username'";
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