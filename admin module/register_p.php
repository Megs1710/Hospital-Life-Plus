<?php
include('a_header.php');
include('navbar.php');
?>

<!-- ADDING TABLES -->
<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT * from `patient_registration`";
	$data = mysqli_query($conn,$query);
	
?>
	<br><br><br><br>
	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>Username</th>
			<th>First name</th>
			<th>Last name</th>
			<th>DOB</th>
			<th>Gender</th>
			<th>Hno.</th>
			<th>Street</th>
			<th>City</th>
			<th>State</th>
			<th>Pincode</th>
			<th>email id</th>
			<th>Mobile no</th>
			<th>Password</th>
			<th>Edit</th>
			<th>Delete</th>
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
					<td> <?php echo $row['username']; ?> </td>
					<td> <?php echo $row['fname']; ?> </td>
					<td> <?php echo $row['lname']; ?> </td>
					<td> <?php echo $row['DOB']; ?> </td>
					<td> <?php echo $row['gender']; ?> </td>
					<td> <?php echo $row['Hno']; ?> </td>
					<td> <?php echo $row['street']; ?> </td>
					<td> <?php echo $row['city']; ?> </td>
					<td> <?php echo $row['state']; ?> </td>
					<td> <?php echo $row['pincode']; ?> </td>
					<td> <?php echo $row['email']; ?> </td>
					<td> <?php echo $row['mobile']; ?> </td>
					<td> <?php echo $row['passwrd']; ?> </td>
					<td>
						<form action = "patient_edit.php" method = "post">
			
							<input type = "hidden" name = "edit_username" value="<?php echo $row['username']; ?>">
							<button type=submit name="edit_p" class = "btn btn-success" > EDIT </button>
							<br>
							</div>
							</div>
							</div>
						</form>
					</td>
					<td>
						<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post">
							<input type = "hidden" name = "delete_username" value="<?php echo $row['username']; ?>">
							<button type=submit name="delete_p" class = "btn btn-danger"> DELETE </button>
						</form>
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

<?php
$conn = mysqli_connect("localhost","root","","hospital_life_plus");
if(isset($_POST['delete_p']))
{
	$username = $_POST['delete_username'];
	
	$query = "delete from `patient_registration` where username='$username'";
	$data = mysqli_query($conn,$query);
}

?>

<!-- template for editing-->
<!--<div class = "card shadow mb-4">
	<div class = "card-header py-3">
		<h6 class = "m-0 font-weight-bold text-primary"> Edit Patient data </h6>
	</div>
		<div class="card-body">-->


?>
<?php
include('script.php');
?>