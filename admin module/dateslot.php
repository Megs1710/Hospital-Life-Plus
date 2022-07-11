<?php
include('a_header.php');
include('navbar.php');
?>

<div class= "container-fluid">

	<!-- template for editing-->
	<div class = "card shadow mb-4">
		<div class = "card-header py-3">
			<h6 class = "m-0 font-weight-bold text-primary"> schedule appointment </h6>
		</div>
		<div class="card-body">
			<?php
				$conn = mysqli_connect("localhost","root","","hospital_life_plus");
				if(isset($_POST['dateslot']))
				{
					$username = $_POST['username'];
					
					$query = "SELECT * from `app_req` where username='$username'";
					$data = mysqli_query($conn,$query);
					
					//edit and update of doctor 
					foreach($data as $row)
					{
			?>
				<form action="<?php echo $_SERVER["PHP_SELF"];?>" method="post"  >  
					<?php
						if(!empty($error_message)) { 
					?>
					<div class="error_msg" role="alert"><?php echo $error_message; ?></div>
					<?php
						}
					?>

					<div class="form-group">
						<input type = "hidden" value= "<?php echo $row['username']; ?>" name = "username" class = "form-control" >
						<input type = "hidden" value= "<?php echo $row['dept']; ?>" name = "dept" class = "form-control" >
					</div>
						
					<div class="form-group">
						Date:<input type = "date" name = "app_date" class = "form-control"><br><br>
					</div>
					
					<div class="form-group">
						Slot:<input type = "text" name = "slot" class = "form-control"><br><br>
					</div>

					<div class="form-group">
						Doctor:
						<select name="doc" id="doc" class="custom-select">
							<?php
								$dep=$row['dept'];
								$query = "SELECT * from `doctor` where dept='{$dep}'";
								$data2 = mysqli_query($conn,$query);
								if(mysqli_num_rows($data2) > 0)
								{
									while($row = mysqli_fetch_assoc($data2))
									{
										?>
										<option value="<?php echo $row['username']?>"><?php echo "Dr. ".$row['fname']." ".$row['lname'];?></option>
										<?php						
									}
								}
								?>
						</select><br><br>
					</div>
					
					<div class="modal-footer">
						<button type="button" class="btn btn-secondary" data-dismiss="modal">Close</button>
						<input type="submit" name="book" id= "book" class="btn btn-primary" value="save" >
					</div>
				</form>
			<?php
				}
			}
			?>
		</div>
	</div>
</div>

<?php

$error_message = "";
$conn = mysqli_connect("localhost","root","","hospital_life_plus");
	
if(isset($_POST['book'])) 
{
    $username = $_POST['username'];
	$dept = $_POST['dept'];
	$doc= $_POST['doc'];
	$date= $_POST['app_date'];			
	$slot= $_POST['slot'];

	$res1 = mysqli_query($conn,"SELECT * FROM `appointment` WHERE dept='{$dept}' AND app_date='{$date}'");
	$count1 = mysqli_num_rows($res1);
	$count2=0;

	if($count1 > 4)
	{		
		$error_message = "Slots full for selected date";
	}
	else
	{
		$res = mysqli_query($conn,"SELECT * FROM `appointment` WHERE dept='{$dept}' AND app_date='{$date}' AND slot='{$slot}'");
		$count2 = mysqli_num_rows($res);
		if($count1>0)
		{		
			$error_message = "Slot taken. Try another slot";
		}
		else
		{
			$query1 = "SELECT * from `app_req` where username='$username'";
			$data1 = mysqli_query($conn,$query1);
			$row=mysqli_fetch_array($data1,MYSQLI_ASSOC);

			$query2 = "SELECT * from `doctor` where username='$doc'";
			$data2 = mysqli_query($conn,$query2);
			$row2=mysqli_fetch_array($data2,MYSQLI_ASSOC);

			$docfn=$row2['fname'];
			$docln=$row2['lname'];
			
			$first= $row['fname'];		//first name
			$last= $row['lname'];			//last name
			$email= $row['email'];			//email
			$stat=0;
			
			require_once("C:\wamp64\www\Hospital\apt_mail.php");
			$mail_status = sendDetails($email,$date,$slot,$docfn,$docln);

			if($mail_status == 1) 
			{
				// INSERT VALUES IN OTP TABLE
				$query = "INSERT INTO `appointment` values ('$username','$first', '$last','$email', '$dept','$doc','$date','$slot','$stat')";
				$data = mysqli_query($conn,$query);
				
				if($data)
				{
					$data1 = mysqli_query($conn,"DELETE FROM `app_req` where username='$username'");
				}
				else
				{
					echo "your data is not updated";
				}
			}
		}
	}
	

}
//session_destroy();

?>

<?php
include('script.php');
?>