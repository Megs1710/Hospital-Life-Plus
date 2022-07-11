<?php
include('a_header.php');
include('navbar.php');
?>

<div class = "card shadow mb-4" style="width:1500px">
	<div class = "card-header py-10" style="width:900px">

<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT * from `alloted_test`";
	$data = mysqli_query($conn,$query);
	
?>

	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th style="width:500px; text-align:center">Username</th>
			<th style="width:500px; text-align:center">Department</th>
			<th style="width:500px; text-align:center">Date</th>
			<th style="width:600px; text-align:center">Test name</th>
			<th style="width:400px; text-align:center">Test status</th>
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
					<td><?php echo $row['dept']; ?></td>
					<td><?php echo $row['app_date']; ?></td>
					<td><?php echo $row['test_name']; ?></td>
					<td style="text-align:center">
						<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post">
							<input type = "hidden" name = "username" value="<?php echo $row['username']; ?>">
							<input type = "hidden" name = "delete_dept" value="<?php echo $row['dept']; ?>">
							<input type = "hidden" name = "app_date" value="<?php echo $row['app_date']; ?>">
						
							<button type=submit name="delete" class = "btn btn-success"> DONE </button>
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
if(isset($_POST['delete']))
{
	
	$dept = $_POST['delete_dept'];
    $username = $_POST['username'];
    $a_date = $_POST['app_date'];
	$query1 = "SELECT * from `prescription` where username='$username' and app_date='$a_date'";
    $data1 = mysqli_query($conn,$query1);
	
	$query = "DELETE from `alloted_test` where dept='$dept'";
	$data = mysqli_query($conn,$query);
}

?>

<?php
include('script.php');
?>