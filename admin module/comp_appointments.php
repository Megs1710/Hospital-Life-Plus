<?php
include('a_header.php');
include('navbar.php');
?>

<br><br>
<!-- ADDING TABLES -->
<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$data = mysqli_query($conn,"SELECT * from `appointment` where status=1");
	
?>
	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>Username</th>
			<th>First name</th>
			<th>Last name</th>
			<th>email id</th>
			<th>Department</th>
            <th>Appointment Date</th>
            <th>Slot No</th>
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
                    <td><?php echo $row['app_date']; ?></td>
                    <td><?php echo $row['slot']; ?></td>					
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