<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $uid=$_SESSION['uid'];
?>

<!DOCTYPE html>
    <html lang="en">

    <?php include('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
             <?php include("assets/inc/nav.php");?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->

            <!--Get Details Of A Single User And Display Them Here-->
            <?php
                $no_user=$_GET['no_user'];
                $id_user=$_GET['id_user'];
                $ret="SELECT  * FROM users WHERE id_user=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$id_user);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
            {
                $mysqlDateTime = $row->pat_date_joined;
            ?>
            <div class="content-page">
                <div class="content">

                    <!-- Start Content-->
                    <div class="container-fluid">

                        <!-- start page title -->
                        <div class="row">
                            <div class="col-12">
                                <div class="page-title-box">
                                    <div class="page-title-right">
                                        <ol class="breadcrumb m-0">
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Patients</a></li>
                                            <li class="breadcrumb-item active">View Patients</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title"><?php echo $row->nama_user;?>'s Profile</h4>
                                </div>
                            </div>
                        </div>
                        <!-- end page title -->

                        <div class="row">
                            <div class="col-lg-4 col-xl-4">
                                <div class="card-box text-center">
                                    <img src="assets/images/users/patient.png" class="rounded-circle avatar-lg img-thumbnail"
                                        alt="profile-image">

                                    
                                    <div class="text-left mt-3">
                                        
                                        <p class="text-muted mb-2 font-13"><strong>Full Name :</strong> <span class="ml-2"><?php echo $row->nama_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Mobile :</strong><span class="ml-2"><?php echo $row->no_telp_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Address :</strong> <span class="ml-2"><?php echo $row->alamat_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Date Of Birth :</strong> <span class="ml-2"><?php echo $row->ttl_user;?></span></p>
                                        <p class="text-muted mb-2 font-13"><strong>Age :</strong> <span class="ml-2"><?php $dob = $row->ttl_user; $age = date_diff(date_create($dob), date_create('today'))->y; echo $age;?> Years</span></p>
                                        <p class="text-muted mb-2 font-13"><strong>BPJS ID :</strong> <span class="ml-2"><?php echo $row->no_user;?></span></p>
                                        <hr>
                                        <p class="text-muted mb-2 font-13"><strong>Date Recorded :</strong> <span class="ml-2"><?php echo date("d/m/Y - h:m", strtotime($mysqlDateTime));?></span></p>
                                        <hr>




                                    </div>

                                </div> <!-- end card-box -->

                            </div> <!-- end col-->
                            
                            <?php }?>
                        </div>
                        <!-- end row-->

                    </div> <!-- container -->

                </div> <!-- content -->

                <!-- Footer Start -->
                <?php include('assets/inc/footer.php');?>
                <!-- end Footer -->

            </div>
            

            <!-- ============================================================== -->
            <!-- End Page content -->
            <!-- ============================================================== -->


        </div>
        <!-- END wrapper -->

        <!-- Right bar overlay-->
        <div class="rightbar-overlay"></div>

        <!-- Vendor js -->
        <script src="assets/js/vendor.min.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>

    </body>


</html>