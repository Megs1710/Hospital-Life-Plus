
<?php
  session_start();
  if(!isset($_SESSION['admin'])) 
                            {
                                header("..\login_page.php");
                            }
  if(isset($_POST['logout'])) 
  {
    session_destroy();
    header('location:..\login_page.php'); //redirect the user to login page
    exit;
    ob_end_flush();
  }
  include('a_header.php');
  include('navbar.php');
?>

<!-- Content Wrapper -->
        <div id="content-wrapper" class="d-flex flex-column">

            <!-- Main Content -->
            <div id="content">
                <!-- Topbar -->
                <nav class="navbar navbar-expand navbar-light bg-white topbar mb-4 static-top shadow">
                    <ul class="navbar-nav ml-auto">
                        <?php 
                          /*  if(!isset($_SESSION['admin'])) 
                            {
                                header("..\login_page.php");
                            }
                            else 
                            {*/
                        ?>
                        <li class="nav-item dropdown no-arrow">
                            <form action = "<?php echo $_SERVER["PHP_SELF"]; ?>" method = "post">
                                <input type= "submit" name="logout" class="btn btn-primary" data-toggle="modal" value="Log Out">
                            </form>                            
                        </li>
                        <?php 
                         //   } 
                        ?>
                    </ul>
                </nav>
                <!-- End of Topbar -->

                <!-- Begin Page Content -->
                <div class="container-fluid">

                    <!-- Page Heading -->
                    <div class="d-sm-flex align-items-center justify-content-between mb-4">
                        <h1 class="h3 mb-0 text-gray-800">Dashboard</h1>
                    </div>

                    <!-- Content Row -->
                    <div class="row">
                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-primary shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-primary text-uppercase mb-1">
                                                Total No.of Doctors</div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
											<?php
												$conn = mysqli_connect("localhost","root","","hospital_life_plus");
                                                $data = mysqli_query($conn,"SELECT username FROM doctor order by username");
		
												$row = mysqli_num_rows($data);
												echo $row;												
											?>
											
											</div>
                                        </div>
                                        <div class="col-auto">
											<i class="fa fa-stethoscope fa-2x text-gray-300" aria-hidden="true"></i>
                                            
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-success shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-success text-uppercase mb-1">
                                               Total No.of Patients
											   </div>
                                            <div class="h5 mb-0 font-weight-bold text-gray-800">
												<?php
													$conn = mysqli_connect("localhost","root","","hospital_life_plus");
													$query = "SELECT username FROM patient_registration order by username";
													$data = mysqli_query($conn,$query);
													
													$row = mysqli_num_rows($data);
													echo $row;
												
												
												?>
											
											</div>
                                        </div>
                                        <div class="col-auto">
											<i class="fas fa-user-friends fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-info shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-info text-uppercase mb-1">
                                                Total Tests
                                            </div>
                                            <div class="row no-gutters align-items-center">
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 mr-3 font-weight-bold text-gray-800">
                                                        <?php
                                                            $conn = mysqli_connect("localhost","root","","hospital_life_plus");
                                                            $query = "SELECT username FROM alloted_test";
                                                            $data = mysqli_query($conn,$query);
                                                            
                                                            $row = mysqli_num_rows($data);
                                                            echo $row;
                                                        ?>
                                                    </div>
                                                </div>
                                            </div>
                                        </div>
                                        <div class="col-auto">
                                            <i class="fas fa-clipboard-list fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                        <div class="col-xl-3 col-md-6 mb-4">
                            <div class="card border-left-warning shadow h-100 py-2">
                                <div class="card-body">
                                    <div class="row no-gutters align-items-center">
                                        <div class="col mr-2">
                                            <div class="text-xs font-weight-bold text-warning text-uppercase mb-1">
                                                Pending Requests</div>
                                                <div class="col-auto">
                                                    <div class="h5 mb-0 font-weight-bold text-gray-800">
                                                        <?php
                                                            $conn = mysqli_connect("localhost","root","","hospital_life_plus");
                                                            $query = "SELECT username FROM app_req order by username";
                                                            $data = mysqli_query($conn,$query);
                                                            
                                                            $row = mysqli_num_rows($data);
                                                            echo $row;
                                                        ?>
                                                    </div>
                                                </div>
											
											</div>
                                        <div class="col-auto">
                                            <i class="fas fa-comments fa-2x text-gray-300"></i>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>

                    </div>
                   
                </div>
                <!-- /.container-fluid -->

            </div>
            <!-- End of Main Content -->

<?php
include('script.php');
?>