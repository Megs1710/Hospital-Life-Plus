<?php
include('a_header.php');
include('navbar.php');
?>

<!-- Button trigger modal -->
<div class = "card shadow mb-4">
	<div class = "card-header py-3">
<button type="button" class="btn btn-primary" data-toggle="modal" data-target="#dept_add">
  ADD Department
</button>
</h6>
<br><br>

<!-- ADDING TABLES -->
<div class="table-responsive">

<?php
	$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	$query = "SELECT * from `department`";
	$data = mysqli_query($conn,$query);
	
?>

	<table class = "table table-bordered" id="dataTable" width = "100%" cellspacing ="0">
		<thead>
			<tr>
			<th>Department</th>
			<th>Contact Number</th>
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
					<td><?php echo $row['dname']; ?></td>
					<td><?php echo $row['contact']; ?></td>
					<td>
					 	<input type = "hidden" name = "edit_dept" value="<?php echo $row['dname']; ?>">
                         <input type = "hidden" name = "num" value="<?php echo $row['contact']; ?>">
                            <button type="button" class="btn btn-sucess" data-toggle="modal" data-target="#dept_edit">
                            EDIT
                            </button>
					</td>
					<td>
						<form action = "<?php echo $_SERVER["PHP_SELF"];?>" method = "post">
							<input type = "hidden" name = "delete_username" value="<?php echo $row['dname']; ?>">
							<button type=submit name="delete" class = "btn btn-danger"> DELETE </button>
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
	$username = $_POST['delete_username'];
	
	$query = "delete from `department` where dname='$username'";
	$data = mysqli_query($conn,$query);
}

?>

<div class="modal fade" id="dept_edit" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Editing Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >  
	<?php
        if(!empty($error_message)) { 
    ?>
    <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
    <?php
       }
    ?>
	<!--name-->
	<div class="form-group">
		Department Name : 
		<input type = "text"  name = "dname">
		<br><br>
	</div>
	
	<!--mobile no -->
	<div class="form-group">
		Contact no: 
		<input type = "text"  name = "contact">
		<br><br><br>
	</div>
	
	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="edit" class="btn btn-primary" >Save</button>
      </div>
	
	</div>
	</form>
    </div>
</div>
</div>

<!-- Modal -->
<div class="modal fade" id="dept_add" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel" aria-hidden="true">
  <div class="modal-dialog" role="document">
    <div class="modal-content">
      <div class="modal-header">
        <h5 class="modal-title" id="exampleModalLabel">Adding Department</h5>
        <button type="button" class="close" data-dismiss="modal" aria-label="Close">
          <span aria-hidden="true">&times;</span>
        </button>
      </div>
      <div class="modal-body">
        
	<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post" >  
	<?php
        if(!empty($error_message)) { 
    ?>
    <div class="error_msg" role="alert"><?php echo $error_message; ?></div>
    <?php
       }
    ?>
	<!--name-->
	<div class="form-group">
		Department Name : 
		<input type = "text"  name = "dname">
		<br><br>
	</div>
	
	<!--mobile no -->
	<div class="form-group">
		Contact no: 
		<input type = "text"  name = "contact">
		<br><br><br>
	</div>
	
	<div class="modal-footer">
        <button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
        <button type="submit" name="add_dept" class="btn btn-primary" >Save</button>
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
	
 
if(isset($_POST['add_dept'])) 
{
	$dept= $_POST['dname'];				//department
	$contact= $_POST['contact'];			//Mobile number

	$check_dept = mysqli_query($conn, "SELECT * FROM `department` WHERE dname='{$dept}'");
    $count_rows = mysqli_num_rows($check_dept);

	if($count_rows==0)
    {
        $data = mysqli_query($conn,"INSERT INTO `department`  VALUES ('{$dept}','$contact')");
	}
	else 
        $error_message = "Department already exists!";
	
}

if(isset($_POST['edit']))
{
	$username = $_POST['delete_username'];
	
	$query = "delete from `department` where dname='$username'";
	$data = mysqli_query($conn,$query);
}
//session_destroy();
?>
<?php
include('script.php');
?>