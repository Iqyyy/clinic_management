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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                                            <li class="breadcrumb-item active">Lihat Detail Uang Keluar</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Lihat Detail Uang Keluar</h4>
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
                                                <th data-hide="phone">Nama Obat</th>
                                                <th data-hide="phone">Supplier</th>
                                                <th data-hide="phone">Jumlah</th>
                                                <th data-hide="phone">Biaya Total</th>
                                                <th data-hide="phone">Tanggal Pembelian</th>
                                                <th></th>
                                            </tr>
                                            </thead>
                                            <?php
                                            /*
                                                *get details of allpatients
                                                *
                                            */
                                            $id_pembelian = $_GET['id_pembelian'];
                                            $ret = "SELECT obat.nama_obat, pembelian.supplier, pembelian.jumlah, pembelian.biaya_total, pembelian.tgl_pembelian
                                            FROM pembelian
                                            JOIN obat ON pembelian.id_obat = obat.id_obat
                                            WHERE pembelian.id_obat = ?
                                            ";
                                            $stmt = $mysqli->prepare($ret);
                                            $stmt->bind_param('i', $id_pembelian);
                                            $stmt->execute();
                                            $res = $stmt->get_result();
                                            $cnt=1;
                                            $total = 0;
                                            while ($row = $res->fetch_object()) {
                                            ?>
                                                <tbody>
                                                    <tr>
                                                        <td><?php echo $cnt;?></td>
                                                        <td><?php echo $row->nama_obat; ?></td>
                                                        <td><?php echo $row->supplier; ?></td>
                                                        <td><?php echo $row->jumlah; ?></td>
                                                        <td><?php echo $row->biaya_total; ?></td>
                                                        <td><?php echo $row->tgl_pembelian; ?></td>
                                                        <td></td>
                                                    </tr>
                                                </tbody>
                                                <?php $total += $row->biaya_total; ?>
                                            <?php  $cnt = $cnt +1 ; }?>
                                            <tbody>
                                                <tr>
                                                    <td colspan="4" align="right">TOTAL</td>
                                                    <td><?php echo $total; ?></td>
                                                    <td></td>
                                                </tr>
                                            </tbody>
                                            
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