<!--Server side code to handle  Patient Registration-->
<?php
	session_start();
	include('assets/inc/config.php');
		if(isset($_POST['add_patient_mdr']))
		{
			$mdr_pat_name = $_POST['mdr_pat_name'];
			$mdr_pat_number = $_POST['mdr_pat_number'];
            //$pres_pat_type = $_POST['pres_pat_type'];
            $mdr_pat_adr = $_POST['mdr_pat_adr'];
            $mdr_pat_age = $_POST['mdr_pat_age'];
            $mdr_number = $_POST['mdr_number'];
            $mdr_pat_prescr = $_POST['mdr_pat_prescr'];
            $mdr_pat_ailment = $_POST['mdr_pat_ailment'];
            //sql to insert captured values
			$query="INSERT INTO  his_medical_records  (mdr_pat_name, mdr_pat_number, mdr_pat_adr, mdr_pat_age, mdr_number, mdr_pat_prescr, mdr_pat_ailment) VALUES(?,?,?,?,?,?,?)";
			$stmt = $mysqli->prepare($query);
			$rc=$stmt->bind_param('sssssss', $mdr_pat_name, $mdr_pat_number, $mdr_pat_adr, $mdr_pat_age, $mdr_number, $mdr_pat_prescr, $mdr_pat_ailment);
			$stmt->execute();
			/*
			*Use Sweet Alerts Instead Of This Fucked Up Javascript Alerts
			*echo"<script>alert('Successfully Created Account Proceed To Log In ');</script>";
			*/ 
			//declare a varible which will be passed to alert function
			if($stmt)
			{
				$success = "Patient Medical Record Addded";
			}
			else {
				$err = "Please Try Again Or Try Later";
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
            <?php
                $pat_number = $_GET['id_user'];
                $ret="SELECT  * FROM users WHERE id_user=?";
                $stmt= $mysqli->prepare($ret) ;
                $stmt->bind_param('s',$pat_number);
                $stmt->execute() ;//ok
                $res=$stmt->get_result();
                //$cnt=1;
                while($row=$res->fetch_object())
                {
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
                                                <li class="breadcrumb-item active">Tambah Rekam Medis</li>
                                            </ol>
                                        </div>
                                        <h4 class="page-title">Tambah Rekam Medis</h4>
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

                                                    <div class="form-group col-md-4">
                                                        <label for="inputEmail4" class="col-form-label">Nama</label>
                                                        <input type="text" required="required" readonly name="mdr_pat_name" value="<?php echo $row->nama_user;?>" class="form-control" id="inputEmail4" placeholder="Nama Lengkap">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Umur</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_age" value="<?php $dob = $row->ttl_user; $age = date_diff(date_create($dob), date_create('today'))->y; echo $age;?> Tahun" class="form-control"  id="inputPassword4" placeholder="Umur">
                                                    </div>

                                                    <div class="form-group col-md-4">
                                                        <label for="inputPassword4" class="col-form-label">Alamat</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_adr" value="<?php echo $row->alamat_user;?>" class="form-control"  id="inputPassword4" placeholder="Alamat Pasien">
                                                    </div>

                                                </div>

                                                <div class="form-row">

                                                    <div class="form-group col-md-6">
                                                        <label for="inputEmail4" class="col-form-label">No BPJS</label>
                                                        <input type="text" required="required" readonly name="mdr_pat_number" value="<?php echo $row->no_user;?>" class="form-control" id="inputEmail4" placeholder="No BPJS">
                                                    </div>

                                                    <!-- <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Tanggal Periksa</label>
                                                        <input required="required" type="text" readonly name="mdr_pat_ailment" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control"  id="inputPassword4" placeholder="Patient`s Age">
                                                    </div> -->
                                                </div>
                                                <?php }?>
                                                <hr>
                                                <div class="form-row">
                                                </div>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Keluhan</label>
                                                        <textarea required="required"  type="text" class="form-control" name="keluhan" id="editor"></textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Diagnosa</label>
                                                        <textarea required="required"  type="text" class="form-control" name="diagnosa" id="editor"></textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Tindakan</label>
                                                        <textarea required="required"  type="text" class="form-control" name="tindakan" id="editor"></textarea>
                                                </div>
                                                <div class="form-group">
                                                        <label for="inputAddress" class="col-form-label">Resep Obat</label>
                                                        <textarea required="required"  type="text" class="form-control" name="resep_obat" id="editor"></textarea>
                                                </div>
                                                <div class="form-group col-md-6">
                                                        <label for="inputPassword4" class="col-form-label">Tanggal Periksa</label>
                                                        <input required="required" type="text" readonly name="tanggal_periksa" value="<?php echo date('Y-m-d H:i:s'); ?>" class="form-control"  id="inputPassword4" placeholder="Tanggal Periksa">
                                                    </div>
                                        
                                                <button type="submit" name="tambah_rekam_medis" class="ladda-button btn btn-primary" data-style="expand-right">Add Patient Medical Record</button>

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
        <script src="//cdn.ckeditor.com/4.6.2/basic/ckeditor.js"></script>
        <script type="text/javascript">
        CKEDITOR.replace('editor')
        </script>

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