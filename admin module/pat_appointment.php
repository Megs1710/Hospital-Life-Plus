<?php
include('a_header.php');
include('navbar.php');
?>

<br><br>
<!-- ADDING TABLES -->
<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT * from `app_req`";
	$data = mysqli_query($conn,$query);
	
?>

	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>Username</th>
			<th>First name</th>
			<th>Last name</th>
			<th>email id</th>
			<th>Department</th>
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
					<td><?php echo $row['email']; ?></td>
					<td><?php echo $row['dept']; ?></td>
					<td>
						
						<form action = "DateSlot.php" method = "post">
							<input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
							<button type ="submit" name="dateslot"  class = "btn btn-primary" >ADD </button>
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
include('script.php');
?>