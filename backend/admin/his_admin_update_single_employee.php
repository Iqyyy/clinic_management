<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['update_employee']))
		{
            $id_user = $_GET['id_user'];
            $nama_user=$_POST['nama_user'];
			$no_telp_user=$_POST['no_telp_user'];
            $alamat_user=$_POST['alamat_user'];
            $ttl_user = $_POST['ttl_user'];
            $pwd = $_POST['pwd'];

			// $doc_fname=$_POST['doc_fname'];
			// $doc_lname=$_POST['doc_lname'];
			// $doc_number=$_GET['doc_number'];
            // $doc_email=$_POST['doc_email'];
            // $doc_pwd=sha1(md5($_POST['doc_pwd']));
            // $doc_dpic=$_FILES["doc_dpic"]["name"];
		    // move_uploaded_file($_FILES["doc_dpic"]["tmp_name"],"../doc/assets/images/users/".$_FILES["doc_dpic"]["name"]);

            //sql to insert captured values
			$query="UPDATE  users  SET nama_user=?, ttl_user=?, no_telp_user=?, alamat_user=?, pwd=? WHERE id_user = ?";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssi', $nama_user, $ttl_user, $no_telp_user, $alamat_user, $pwd, $id_user);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Employee Details Updated";
			}
			else {
				$err = "Please Try Again Or Try Later";
			}
			
			
		}
?>
<!--End Server Side-->
<!DOCTYPE html>
<html lang="en">
    
    <!--Head-->
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
                                            <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Employee</a></li>
                                            <li class="breadcrumb-item active">Manage Employee</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Update Employee Details</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <?php
                            $id_user=$_GET['id_user'];
                            $ret="SELECT  * FROM users WHERE id_user=?";
                            $stmt= $mysqli->prepare($ret) ;
                            $stmt->bind_param('i',$id_user);
                            $stmt->execute() ;//ok
                            $res=$stmt->get_result();
                            //$cnt=1;
                            while($row=$res->fetch_object())
                            {
                        ?>
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Isi Seluruh Data</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Nama</label>
                                                    <input type="text" required="required" value="<?php echo $row->nama_user;?>" name="nama_user" class="form-control" id="inputEmail4" placeholder="Masukkan Nama">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Tanggal Lahir</label>
                                                    <input type="text" required="required" value="<?php echo $row->ttl_user;?>" name="ttl_user" class="form-control" id="inputEmail4" placeholder="DD/MM/YYYY">
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Alamat</label>
                                                <input required="required" type="text" value="<?php echo $row->alamat_user;?>" class="form-control" name="alamat_user" id="inputAddress" placeholder="Masukkan Alamat">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">No Telfon</label>
                                                    <input required="required" type="text" value="<?php echo $row->no_telp_user;?>" name="no_telp_user" class="form-control" id="inputCity">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Kata Sandi</label>
                                                    <input type="text" required="required" value="<?php echo $row->pwd;?>" name="pwd" class="form-control" id="inputEmail4" placeholder="Masukkan Kata Sandi Baru">
                                                </div>
                                            </div>

                                            <button type="submit" name="update_employee" class="ladda-button btn btn-success" data-style="expand-right">Update Data</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
                        <?php  }?>
                        <!-- end row -->

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

        <!-- App js-->
        <script src="assets/js/app.min.js"></script>

        <!-- Loading buttons js -->
        <script src="assets/libs/ladda/spin.js"></script>
        <script src="assets/libs/ladda/ladda.js"></script>

        <!-- Buttons init js-->
        <script src="assets/js/pages/loading-btn.init.js"></script>
        
    </body>

</html>