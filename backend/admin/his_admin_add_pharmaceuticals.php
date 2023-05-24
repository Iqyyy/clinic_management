
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_pharmaceutical']))
		{
            // Mulai transaksi
            $mysqli->begin_transaction();

			$nama_obat = $_POST['nama_obat'];
			$kode_obat = $_POST['kode_obat'];
            $stok_obat = $_POST['stok_obat'];
            $satuan = $_POST['satuan'];
            $harga_jual = $_POST['harga_jual'];
            $harga_beli  = $_POST['harga_beli'];
            $exp_date = $_POST['exp_date'];

            $jumlah = $stok_obat ;
            $supplier = $_POST['supplier'];
                
            //insert into obat
            $query_obat = "INSERT INTO obat (nama_obat, kode_obat, stok_obat, satuan, harga_jual, harga_beli, exp_date) VALUES (?, ?, ?, ?, ?, ?, ?)";
			$stmt_obat = $mysqli->prepare($query_obat);
            $stmt_obat->bind_param("ssissss", $nama_obat, $kode_obat, $stok_obat, $satuan, $harga_jual, $harga_beli, $exp_date);
            $stmt_obat->execute();
			
            //insert into pembelian
            $query_pembelian = "INSERT INTO pembelian (id_obat, jumlah, supplier, tgl_pembelian) VALUES (?, ?, ?, DEFAULT)";
            $stmt_pembelian = $mysqli->prepare($query_pembelian);
            $stmt_pembelian->bind_param("iis", $id_obat, $jumlah, $supplier, );
            $stmt_pembelian->execute();
   
			// Jika kedua perintah berhasil, commit transaksi
            if ($stmt_obat && $stmt_pembelian) {
                $mysqli->commit();
                echo "Data berhasil disimpan.";
            } else {
                // Jika salah satu perintah gagal, rollback transaksi
                $mysqli->rollback();
                echo "Data gagal disimpan.";
            }

		}
?>
<!--End Server Side-->
<!--End Patient Registration-->
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Pharmaceuticals</a></li>
                                            <li class="breadcrumb-item active">Add Pharmaceutical</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Create A Pharmaceutical</h4>
                                </div>
                            </div>
                        </div>     
                        <!-- end page title --> 
                        <!-- Form row -->
                        <div class="row">
                            <div class="col-12">
                                <div class="card">
                                    <div class="card-body">
                                        <h4 class="header-title">Fill all fields</h4>
                                        <!--Add Patient Form-->
                                        <form method="post">
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Nama Obat</label>
                                                    <input type="text" required="required" name="nama_obat" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Kode Obat</label>
                                                    <input required="required" type="text" name="kode_obat" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Jumlah</label>
                                                    <input type="text" required="required" name="stok_obat" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Satuan</label>
                                                    <input required="required" type="text" name="satuan" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Harga Jual (Rp)</label>
                                                    <input type="text" required="required" name="harga_jual" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Harga Beli (Rp)</label>
                                                    <input required="required" type="text" name="harga_beli" class="form-control"  id="inputPassword4">
                                                </div>
                                            </div>
                                            <div class="form-row">
                                                <div class="form-group col-md-6">
                                                    <label for="inputEmail4" class="col-form-label">Supplier</label>
                                                    <input type="text" required="required" name="supplier" class="form-control" id="inputEmail4" >
                                                </div>
                                                <div class="form-group col-md-6">
                                                    <label for="inputPassword4" class="col-form-label">Tanggal Kadaluarsa</label>
                                                    <input required="required" type="text" name="exp_date" class="form-control"  id="inputPassword4" placeholder="YYYY-MM-DD">
                                                </div>
                                            </div>
                                            
                                           <button type="submit" name="add_pharmaceutical" class="ladda-button btn btn-success" data-style="expand-right">Tambah Obat</button>

                                        </form>
                                     
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
        <!--Load CK EDITOR Javascript-->
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>
       
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