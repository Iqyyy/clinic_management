<?php
  session_start();
  include('assets/inc/config.php');
  include('assets/inc/checklogin.php');
  check_login();
  $uid=$_SESSION['uid'];
//   if(isset($_GET['delete_mdr_number']))
//   {
//         $id=intval($_GET['delete_mdr_number']);
//         $adn="DELETE FROM his_medical_records WHERE  mdr_number = ?";
//         $stmt= $mysqli->prepare($adn);
//         $stmt->bind_param('i',$id);
//         $stmt->execute();
//         $stmt->close();	 
  
//           if($stmt)
//           {
//             $success = "Medical Records Deleted";
//           }
//             else
//             {
//                 $err = "Try Again Later";
//             }
//     }
?>

<!DOCTYPE html>
<html lang="en">
    
<?php include('assets/inc/head.php');?>

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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Reporting</a></li>
                                            <li class="breadcrumb-item active">Medical Records</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">View Medical Records</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 

                        <div class="row">
                            <div class="col-12">
                                <div class="card-box">
                                    <h4 class="header-title"></h4>
                                    <div class="mb-2">
                                        <div class="row">
                                            <div class="col-12 text-sm-center form-inline" >
                                                <div class="form-group mr-2" style="display:none">
                                                    <select id="demo-foo-filter-status" class="custom-select custom-select-sm">
                                                        <option value="">Show all</option>
                                                        <option value="Discharged">Discharged</option>
                                                        <option value="OutPatients">OutPatients</option>
                                                        <option value="InPatients">InPatients</option>
                                                    </select>
                                                </div>
                                                <div class="form-group">
                                                    <input id="demo-foo-search" type="text" placeholder="Search" class="form-control form-control-sm" autocomplete="on">
                                                </div>
                                            </div>
                                        </div>
                                    </div>
                                    
                                    <div class="table-responsive">
                                        <table id="demo-foo-filtering" class="table table-bordered toggle-circle mb-0" data-page-size="7">
                                            <thead>
                                            <tr>
                                                <th>#</th>
                                                <th data-toggle="true">Nama Pasien</th>
                                                <th data-hide="phone">Tanggal Periksa</th>
                                                <th data-hide="phone">Keluhan</th>
                                                <th data-hide="phone">Diagnosa</th>
                                                <th data-hide="phone">Tindakan</th>
                                                <th data-hide="phone">Resep Obat</th>
                                                <th data-hide="phone">Aksi</th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *get details of allpatients
                                                *
                                            */
                                                $ret="SELECT DISTINCT rekam_medis.id_rm, users.nama_user, rekam_medis.tgl_periksa, rekam_medis.keluhan_pasien, rekam_medis.diagnosa, rekam_medis.tindakan, rekam_medis.resep_obat
                                                FROM antrean
                                                JOIN jadwal_dokter ON antrean.id_jadwal_dokter = jadwal_dokter.id_jadwal
                                                JOIN users ON antrean.id_pasien = users.id_user AND users.level_user = 3
                                                JOIN users AS users_dokter ON jadwal_dokter.id_user = users_dokter.id_user AND users_dokter.level_user = 2
                                                JOIN rekam_medis ON rekam_medis.id_data_user = users.id_user
                                                WHERE rekam_medis.id_data_user = users.id_user
                                                ORDER BY nama_user ASC"; 
                                                //sql code to get to ten docs  randomly
                                                $stmt= $mysqli->prepare($ret) ;
                                                $stmt->execute() ;//ok
                                                $res=$stmt->get_result();
                                                $cnt=1;
                                                while($row=$res->fetch_object())
                                                {
                                            ?>

                                                <tbody>
                                                <tr>
                                                    <td><?php echo $cnt;?></td>
                                                    <td><?php echo $row->nama_user;?></td>
                                                    <td><?php echo $row->tgl_periksa;?></td>
                                                    <td><?php echo $row->keluhan_pasien;?></td>
                                                    <td><?php echo $row->diagnosa;?></td>
                                                    <td><?php echo $row->tindakan;?></td>
                                                    <td><?php echo $row->resep_obat;?></td>
                                                    <td>
                                                        <a href="his_admin_view_single_medical_record.php?id_rm=<?php echo $row->id_rm;?>" class="badge badge-success"><i class="fas fa-eye"></i> View</a>
                                                    </td>
                                                </tr>
                                                </tbody>
                                            <?php  $cnt = $cnt +1 ; }?>
                                            <tfoot>
                                            <tr class="active">
                                                <td colspan="8">
                                                    <div class="text-right">
                                                        <ul class="pagination pagination-rounded justify-content-end footable-pagination m-t-10 mb-0"></ul>
                                                    </div>
                                                </td>
                                            </tr>
                                            </tfoot>
                                        </table>
                                    </div> <!-- end .table-responsive-->
                                </div> <!-- end card-box -->
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

        <!-- Footable js -->
        <script src="assets/libs/footable/footable.all.min.js"></script>

        <!-- Init js -->
        <script src="assets/js/pages/foo-tables.init.js"></script>

        <!-- App js -->
        <script src="assets/js/app.min.js"></script>
        
    </body>

</html>