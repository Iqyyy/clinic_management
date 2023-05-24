<?php
    session_start();
	include('assets/inc/config.php');

        if(isset($_POST['tambah_tindakan']))
        {
            $jenis_tindakan=$_POST['jenis_tindakan'];
            $biaya_tindakan=$_POST['biaya_tindakan'];


            $query = "INSERT INTO tindakan (id_tindakan, jenis_tindakan, biaya_tindakan) VALUES (DEFAULT, ?, ?)";
            $stmt = $mysqli->prepare($query);
            $rc = $stmt->bind_param('sd', $jenis_tindakan, $biaya_tindakan);
            $stmt->execute();

            if($stmt)
            {
                $success = "Tindakan berhasil ditambahkan";
            }
            else {
                $err = "Terjadi kesalahan input data";
            }
        }
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Tindakan</a></li>
                                            <li class="breadcrumb-item active">Tambah Tindakan</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Tindakan</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Isikan Seluruh Data</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="jenis_tindakan" class="col-form-label">Jenis Tindakan</label>
                                                    <input type="text" required="required" name="jenis_tindakan" class="form-control" id="jenis_tindakan" placeholder="Masukkan Jenis Tindakan">
                                                </div>
                                            </div>

                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="biaya_tindakan" class="col-form-label">Harga (Rp) </label>
                                                    <input type="text" required="required" name="biaya_tindakan" class="form-control" id="biaya_tindakan" placeholder="Masukkan Biaya Pelaksanaan">
                                                </div>
                                            </div>

                                            <button type="submit" name="tambah_tindakan" class="ladda-button btn btn-primary" data-style="expand-right">Tambah Tindakan</button>

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


