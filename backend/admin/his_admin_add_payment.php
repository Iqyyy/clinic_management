<?php
session_start();
include('assets/inc/config.php');

$biaya_tindakan_total = 0; // Inisialisasi harga total tindakan

if (isset($_POST['tambah_tindakan'])) {
    $jenis_tindakan = $_POST['jenis_tindakan'];

    // Mengambil data biaya tindakan dari database
    $query = "SELECT biaya_tindakan FROM tindakan WHERE jenis_tindakan = ?";
    $stmt = $mysqli->prepare($query);

    $biaya_tindakan_total = 0; // Inisialisasi harga total tindakan

    foreach ($jenis_tindakan as $tindakan) {
        $stmt->bind_param('s', $tindakan);
        $stmt->execute();
        $stmt->bind_result($biaya_tindakan);
    
        if ($stmt->fetch()) {
            // Tindakan ditemukan, tambahkan biaya tindakan ke harga total
            $biaya_tindakan_total += $biaya_tindakan;
        }
    }
    
    $stmt->close();
    
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
                                            <li class="breadcrumb-item"><a href="javascript: void(0);">Keuangan</a></li>
                                            <li class="breadcrumb-item active">Tambah Uang Masuk</li>
                                        </ol>
                                    </div>
                                    <h4 class="page-title">Tambah Uang Masuk</h4>
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
                                          <div class="form-group col-md-4">
                                                  <label for="inputCity" class="col-form-label">ID Rekam Medis</label>
                                                  <input required="required" type="text" name="id_rm" class="form-control" id="inputCity" placeholder="Masukkan ID Rekam Medis">
                                          </div>
                                          <div class="form-row" id="tindakan-row-1">
                                              <div class="form-group col-md-6">
                                                  <label for="jenis_tindakan_1" class="col-form-label">Jenis Tindakan</label>
                                                  <select name="jenis_tindakan[]" class="form-control" id="jenis_tindakan_1" required>
                                                  <?php
                                                    // Mengambil data jenis tindakan dari database
                                                    $query = "SELECT jenis_tindakan FROM tindakan";
                                                    $result = $mysqli->query($query);
                                                    while ($row = $result->fetch_assoc()) {
                                                        echo '<option value="' . $row['jenis_tindakan'] . '">' . $row['jenis_tindakan'] . '</option>';
                                                    }
                                                  ?>
                                                  </select>
                                              </div>

                                              <div class="form-group col-md-1">

                                                <label for="jumlah_tindakan_1" class="col-form-label">Jumlah</label>
                                                <input type="text" name="jumlah_tindakan[]" id="jumlah_tindakan_1" class="form-control">

                                              </div>
                                              
                                              <div class="form-group col-md-5">
                                                  <label for="biaya_tindakan_1" class="col-form-label">Harga (Rp)</label>
                                                  <input type="text" readonly="readonly" name="biaya_tindakan[]" class="form-control biaya-tindakan"
                                                      id="biaya_tindakan_1" placeholder="Harga Tindakan" value="">
                                              </div>
                                              <div class="form-group col-md-1">
                                                  <button type="button" class="btn btn-danger remove-tindakan" data-row="1">Hapus</button>
                                              </div>
                                          </div>

                                          <div id="tindakan-container"></div>

                                          <div class="form-group col-md-6">
                                            <label for="total_harga" class="col-form-label">Total Harga (Rp)</label>
                                            <input type="text" readonly="readonly" name="total_harga" class="form-control" id="total_harga" placeholder="Total Harga" value="<?php echo $biaya_tindakan_total; ?>">
                                          </div>


                                          <button type="button" id="tambah_tindakan" class="btn btn-primary">Tambah Tindakan</button>

                                          <script>
                                            var tindakanCount = 1;
                                            var tindakanContainer = document.getElementById("tindakan-container");
                                            var tambahTindakanButton = document.getElementById("tambah_tindakan");
                                            var totalHargaInput = document.getElementById("total_harga");

                                            function removeTindakan(event) {
                                                var rowId = event.target.getAttribute("data-row");
                                                var row = document.getElementById("tindakan-row-" + rowId);
                                                row.remove();
                                                updateTotalHarga();
                                            }

                                            function createTindakanRow() {
                                                tindakanCount++;
                                                var newRow = document.createElement("div");
                                                newRow.classList.add("form-row");
                                                newRow.id = "tindakan-row-" + tindakanCount;

                                                var jenisTindakanDiv = document.createElement("div");
                                                jenisTindakanDiv.classList.add("form-group", "col-md-6");

                                                var jenisTindakanLabel = document.createElement("label");
                                                jenisTindakanLabel.classList.add("col-form-label");
                                                jenisTindakanLabel.textContent = "Jenis Tindakan";

                                                var jenisTindakanSelect = document.createElement("select");
                                                jenisTindakanSelect.classList.add("form-control", "jenis-tindakan");
                                                jenisTindakanSelect.setAttribute("name", "jenis_tindakan[]");
                                                jenisTindakanSelect.required = true;

                                                <?php
                                                // Mengambil data jenis tindakan dari database
                                                $query = "SELECT jenis_tindakan FROM tindakan";
                                                $result = $mysqli->query($query);
                                                while ($row = $result->fetch_assoc()) {
                                                    echo 'var jenisTindakanOption = document.createElement("option");';
                                                    echo 'jenisTindakanOption.value = "' . $row['jenis_tindakan'] . '";';
                                                    echo 'jenisTindakanOption.textContent = "' . $row['jenis_tindakan'] . '";';
                                                    echo 'jenisTindakanSelect.appendChild(jenisTindakanOption);';
                                                }
                                                ?>

                                                jenisTindakanDiv.appendChild(jenisTindakanLabel);
                                                jenisTindakanDiv.appendChild(jenisTindakanSelect);

                                                var jumlahTindakanDiv = document.createElement("div");
                                                jumlahTindakanDiv.classList.add("form-group", "col-md-1");

                                                var jumlahTindakanLabel =document.createElement("label");
                                                jumlahTindakanLabel.classList.add("col-form-label");
                                                jumlahTindakanLabel.textContent = "Jumlah";

                                                var jumlahTindakanInput = document.createElement("input");
                                                jumlahTindakanInput.classList.add("form-control", "jumlah-tindakan");
                                                jumlahTindakanInput.setAttribute("type","text");
                                                jumlahTindakanInput.setAttribute("name", "jumlah_tindakan[]");

                                                jumlahTindakanDiv.appendChild(jumlahTindakanLabel);
                                                jumlahTindakanDiv.appendChild(jumlahTindakanInput);

                                                var hargaTindakanDiv = document.createElement("div");
                                                hargaTindakanDiv.classList.add("form-group", "col-md-5");

                                                var hargaTindakanLabel = document.createElement("label");
                                                hargaTindakanLabel.classList.add("col-form-label");
                                                hargaTindakanLabel.textContent = "Harga (Rp)";

                                                var hargaTindakanInput = document.createElement("input");
                                                hargaTindakanInput.classList.add("form-control", "biaya-tindakan");
                                                hargaTindakanInput.setAttribute("type", "text");
                                                hargaTindakanInput.readOnly = true;
                                                hargaTindakanInput.setAttribute("placeholder", "Harga Tindakan");
                                                hargaTindakanInput.setAttribute("name", "biaya_tindakan[]");

                                                hargaTindakanDiv.appendChild(hargaTindakanLabel);
                                                hargaTindakanDiv.appendChild(hargaTindakanInput);

                                                var removeButtonDiv = document.createElement("div");
                                                removeButtonDiv.classList.add("form-group", "col-md-1");

                                                var removeButton = document.createElement("button");
                                                removeButton.classList.add("btn", "btn-danger", "remove-tindakan");
                                                removeButton.setAttribute("type", "button");
                                                removeButton.setAttribute("data-row", tindakanCount);
                                                removeButton.textContent = "Hapus";
                                                removeButton.addEventListener("click", removeTindakan);

                                                removeButtonDiv.appendChild(removeButton);

                                                newRow.appendChild(jenisTindakanDiv);
                                                newRow.appendChild(jumlahTindakanDiv);
                                                newRow.appendChild(hargaTindakanDiv);
                                                newRow.appendChild(removeButtonDiv);

                                                tindakanContainer.appendChild(newRow);

                                                // Mendaftarkan event listener untuk setiap elemen select jenis tindakan pada baris yang baru ditambahkan
                                                var jenisTindakanSelects = newRow.querySelectorAll("select.jenis-tindakan");
                                                jenisTindakanSelects.forEach(function (select) {
                                                    select.addEventListener("change", function () {
                                                        var jenisTindakan = this.value;
                                                        var hargaTindakanInput = this.closest(".form-row").querySelector(".biaya-tindakan");
                                                        var xhr = new XMLHttpRequest();
                                                        xhr.open("GET", "get_harga_tindakan.php?jenis_tindakan=" + jenisTindakan, true);
                                                        xhr.onreadystatechange = function () {
                                                            if (xhr.readyState === 4 && xhr.status === 200) {
                                                                var hargaTindakan = xhr.responseText;
                                                                hargaTindakanInput.value = hargaTindakan;
                                                                updateTotalHarga();
                                                            }
                                                        };
                                                        xhr.send();
                                                    });
                                                });

                                                updateTotalHarga();
                                            }

                                            tambahTindakanButton.addEventListener("click", createTindakanRow);

                                            function updateTotalHarga() {
                                                var totalHarga = 0;
                                                var biayaTindakanInputs = document.querySelectorAll(".biaya-tindakan");
                                                biayaTindakanInputs.forEach(function (input) {
                                                    var biayaTindakan = parseInt(input.value) || 0;
                                                    totalHarga += biayaTindakan;
                                                });
                                                totalHargaInput.value = totalHarga;
                                            }
                                        </script>


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

        <script>
          document.addEventListener("DOMContentLoaded", function() {
              // Mendaftarkan event listener untuk setiap elemen select jenis tindakan
              var jenisTindakanSelects = document.querySelectorAll("select[name='jenis_tindakan[]']");
              var totalHargaInput = document.getElementById("total_harga");
              jenisTindakanSelects.forEach(function(select) {
                select.addEventListener("change", function() {
                  var jenisTindakan = this.value;
                  var hargaTindakanInput = this.closest(".form-row").querySelector(".biaya-tindakan");
                  var xhr = new XMLHttpRequest();
                  xhr.open("GET", "get_harga_tindakan.php?jenis_tindakan=" + jenisTindakan, true);
                  xhr.onreadystatechange = function() {
                    if (xhr.readyState === 4 && xhr.status === 200) {
                      var hargaTindakan = xhr.responseText;
                      hargaTindakanInput.value = hargaTindakan;
                    }
                  };
                  xhr.send();
                });
              });
              updateTotalHarga();

              function updateTotalHarga() {
                var totalHarga = 0;
                var biayaTindakanInputs = document.querySelectorAll(".biaya-tindakan");
                biayaTindakanInputs.forEach(function (input) {
                  var biayaTindakan = parseInt(input.value);
                  if (!isNaN(biayaTindakan)) {
                    totalHarga += biayaTindakan;
                  }
                });
                totalHargaInput.value = totalHarga;
              }

            });
        </script>

    </body>

</html>
