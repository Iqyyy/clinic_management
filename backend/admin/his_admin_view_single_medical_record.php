<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $uid=$_SESSION['uid'];
?>
<!DOCTYPE html>
<html lang="en">
    
<?php include ('assets/inc/head.php');?>

    <body>

        <!-- Begin page -->
        <div id="wrapper">

            <!-- Topbar Start -->
            <?php include('assets/inc/nav.php');?>
            <!-- end Topbar -->

            <!-- ========== Left Sidebar Start ========== -->
                <?php include("assets/inc/sidebar.php");?>
            <!-- Left Sidebar End -->

            <!-- ============================================================== -->
            <!-- Start Page Content here -->
            <!-- ============================================================== -->
            <?php
                $id_rm=$_GET['id_rm'];
                $ret = "SELECT DISTINCT rekam_medis.id_rm, users.*, rekam_medis.tgl_periksa, rekam_medis.keluhan_pasien, rekam_medis.diagnosa, rekam_medis.tindakan, rekam_medis.resep_obat, users_dokter.nama_user AS nama_dokter
                FROM antrean
                JOIN jadwal_dokter ON antrean.id_jadwal_dokter = jadwal_dokter.id_jadwal
                JOIN users ON antrean.id_pasien = users.id_user AND users.level_user = 3
                JOIN users AS users_dokter ON jadwal_dokter.id_user = users_dokter.id_user AND users_dokter.level_user = 2
                JOIN rekam_medis ON rekam_medis.id_data_user = users.id_user
                WHERE rekam_medis.id_data_user = users.id_user AND rekam_medis.id_rm = ? ;
                ";
                // $ret="SELECT DISTINCT rekam_medis.id_rm, users.*, rekam_medis.tgl_periksa, rekam_medis.keluhan_pasien, rekam_medis.diagnosa, rekam_medis.tindakan, rekam_medis.resep_obat
                // FROM antrean
                // JOIN jadwal_dokter ON antrean.id_jadwal_dokter = jadwal_dokter.id_jadwal
                // JOIN users ON antrean.id_pasien = users.id_user AND users.level_user = 3
                // JOIN users AS users_dokter ON jadwal_dokter.id_user = users_dokter.id_user AND users_dokter.level_user = 2
                // JOIN rekam_medis ON rekam_medis.id_data_user = users.id_user
                // WHERE rekam_medis.id_data_user = users.id_user AND id_rm = ? ;
                // ";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('i',$id_rm);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
                    $mysqlDateTime = $row->mdr_date_rec;
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
                                                <li class="breadcrumb-item"><a href="his_admin_dashboard.php">Dashboard</a></li>
                                                <li class="breadcrumb-item"><a href="javascript: void(0);">Rekam Medis</a></li>
                                                <li class="breadcrumb-item active">Lihat Rekam Medis</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">#<?php echo $row->id_rm;?></h4>
                                    </div>
                                </div>
                            </div>     
                            <!-- end page title --> 

                            <div class="row">
                                <div class="col-12">
                                    <div class="card-box">
                                        <div class="row">
                                            <div class="col-xl-5">

                                                <div class="tab-content pt-0">

                                                    <div class="tab-pane active show" id="product-1-item">
                                                        <img src="assets/images/medical_record.png" alt="" class="img-fluid mx-auto d-block rounded">
                                                    </div>
                            
                                                </div>
                                            </div> <!-- end col -->
                                            <div class="col-xl-7">
                                                <div class="pl-xl-3 mt-3 mt-xl-0">
                                                    <h2 class="mb-3">Dokter Pemeriksa : <?php echo $row->nama_dokter;?></h2>
                                                    <hr>
                                                    <h2 class="mb-3">Nama : <?php echo $row->nama_user;?></h2>
                                                    <hr>
                                                    <h3 class="text-danger">Umur : <?php $dob = $row->ttl_user; $age = date_diff(date_create($dob), date_create('today'))->y; echo $age;?> Tahun</h3>
                                                    <hr>
                                                    <h3 class="text-danger ">BPJS ID : <?php echo $row->no_user;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Keluhan : <?php echo $row->keluhan_pasien;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Diagnosa : <?php echo $row->diagnosa;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Tindakan : <?php echo $row->tindakan;?></h3>
                                                    <hr>
                                                    <h3 class="text-danger ">Tanggal Periksa : <?php echo $row->tgl_periksa;?></h3>
                                                    <hr>
                                                    <h2 class="align-centre">Resep Obat</h2>
                                                    <hr>
                                                    <p class="text-muted mb-4">
                                                        <?php echo $row->resep_obat;?>
                                                    </p>
                                                    <hr>
                                                </div>
                                            </div> <!-- end col -->
                                        </div>
                                        <!-- end row -->

                                      
                                    </div> <!-- end card-->
                                </div> <!-- end col-->
                            </div>
                            <!-- end row-->
                            
                        </div> <!-- container -->

                    </div> <!-- content -->

                    <!-- Footer Start -->
                        <?php include('assets/inc/footer.php');?>
                    <!-- end Footer -->

                </div>
            <?php }?>

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