<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_employee']))
		{
			$nama_user=$_POST['nama_user'];
			$no_user=$_POST['no_user'];
            $no_telp_user=$_POST['no_telp_user'];
            $alamat_user=$_POST['alamat_user'];
            $ttl_user = $_POST['ttl_user'];
            $jk_user = $_POST['jk_user'];
            $nik = $_POST['nik'];
            $spesialis = $_POST['spesialis'];            
            $pwd = $_POST['pwd'];

            if ($spesialis == 'admin') {
                $level_user = '1';
            } elseif ($spesialis == 'dokter') {
                $level_user = '2';
            }
            
            
            //sql to insert captured values
			$query="insert into users (id_user, level_user, nama_user, spesialis, nik, pwd, ttl_user, alamat_user, no_telp_user, jk_user, no_user) values(DEFAULT,?,?,?,?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('ssssssssss', $level_user, $nama_user, $spesialis, $nik, $pwd,  $ttl_user, $alamat_user, $no_telp_user, $jk_user, $no_user);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Data pegawai berhasil ditambahkan";
			}
			else {
				$err = "Terjadi kesalahan input data";
			}
			
			
		}    
?>
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pegawai</a></li>
                                            <li class="breadcrumb-item active">Tambah Pegawai</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Pegawai</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
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
                                                    <input type="text" required="required" name="nama_user" class="form-control" id="inputEmail4" placeholder="Nama Pegawai">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Tanggal Lahir</label>
                                                    <input type="text" required="required" name="ttl_user" class="form-control" id="inputEmail4" placeholder="YYYY-MM-DD">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputNIK" class="col-form-label">NIK</label>
                                                    <input type="text" required="required" name="nik" class="form-control" id="inputEmail4" placeholder="NIK">
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputpwd" class="col-form-label">Kata Sandi</label>
                                                    <input type="password" required="required" name="pwd" class="form-control" id="inputEmail4" placeholder="password">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">Role</label>
                                                    <select id="inputState" required="required" name="spesialis" class="form-control">
                                                        <option>Role</option>
                                                        <option name="spesialis" value="admin">admin</option>
                                                        <option name="spesialis" value="dokter">dokter</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <div class="form-group">
                                                <label for="inputAddress" class="col-form-label">Alamat</label>
                                                <input required="required" type="text" class="form-control" name="alamat_user" id="inputAddress" placeholder="Alamat Pegawai">
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">No Telfon</label>
                                                    <input required="required" type="text" name="no_telp_user" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputCity" class="col-form-label">BPJS ID / IDI ID</label>
                                                    <input required="required" type="text" name="no_user" class="form-control" id="inputCity">
                                                </div>
                                                <div class="form-group col-md-4">
                                                    <label for="inputState" class="col-form-label">Jenis Kelamin</label>
                                                    <select id="inputState" required="required" name="jk_user" class="form-control">
                                                        <option>Jenis Kelamin</option>
                                                        <option name="jk_user" value="L">Pria</option>
                                                        <option name="jk_user" value="P">Wanita</option>
                                                    </select>
                                                </div>
                                            </div>

                                            <button type="submit" name="add_employee" class="ladda-button btn btn-primary" data-style="expand-right">Tambah Pegawai</button>

                                        </form>
                                        <!--End Patient Form-->
                                    </div> <!-- end card-body -->
                                </div> <!-- end card-->
                            </div> <!-- end col -->
                        </div>
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