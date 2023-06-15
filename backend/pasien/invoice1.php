<?php
// Konfigurasi koneksi ke database
$servername = "localhost"; // Ganti dengan nama server database Anda
$username = "root"; // Ganti dengan username database Anda
$password = ""; // Ganti dengan password database Anda
$dbname = "klinik"; // Ganti dengan nama database Anda

// Membuat koneksi
$conn = new mysqli($servername, $username, $password, $dbname);

session_start();

// Memeriksa koneksi
if ($conn->connect_error) {
    die("Koneksi ke database gagal: " . $conn->connect_error);
}

// Mendapatkan id_pasien dari data login
$id_pasien = $_SESSION['id_user']; // Ganti dengan cara Anda mendapatkan id_pasien dari data login

// Mengambil data antrean berdasarkan id_pasien
$sql = "SELECT antrean.*, users.nama_user, jadwal_dokter.id_user AS id_dokter, jadwal_dokter.jam
        FROM antrean
        INNER JOIN users ON antrean.id_pasien = users.id_user
        INNER JOIN jadwal_dokter ON antrean.id_jadwal_dokter = jadwal_dokter.id_jadwal
        WHERE antrean.id_pasien = '$id_pasien'
        ORDER BY antrean.tanggal ASC";
$result = $conn->query($sql);

// Memeriksa hasil query
if ($result->num_rows > 0) {
    // Mendapatkan data dari setiap baris
    while ($row = $result->fetch_assoc()) {
        // Ambil data yang diperlukan
        $tanggal = date('Y-m-d', strtotime($row['tanggal']));
        $id_periksa = $row['id_periksa'];
        $waktu_periksa = date('H:i:s', strtotime($row['jam']));
        $nama_pasien = $row['nama_user'];
        $id_dokter = $row['id_dokter'];
        $no_antrean = $row['no_antrean'];


        // Mengambil nama dokter berdasarkan id_dokter
        $sql_dokter = "SELECT nama_user FROM users WHERE id_user = '$id_dokter'";
        $result_dokter = $conn->query($sql_dokter);
        $row_dokter = $result_dokter->fetch_assoc();
        $nama_dokter = $row_dokter['nama_user'];

        // Tampilkan data ke dalam HTML
       
    }
}
?>

<!DOCTYPE html>
<html>
<head>
  <meta charset="utf-8" />
  <link rel="icon" href="/favicon.ico" />
  <meta name="viewport" content="width=device-width, initial-scale=1" />
  <meta name="theme-color" content="#000000" />
  <title>Bukti Pemesanan</title>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Outfit%3A400%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Source+Sans+Pro%3A400%2C500%2C600%2C800"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Overpass%3A500%2C600"/>
  <link rel="stylesheet" href="https://fonts.googleapis.com/css?family=Montserrat%3A500%2C800"/>
  <link rel="stylesheet" href="../../css/invoice.css"/>
  <script src="https://cdn.jsdelivr.net/npm/jsbarcode/dist/JsBarcode.min.js"></script>
  <script>
    window.onload = function() {
      var tanggal = "<?php echo $tanggal; ?>";
      var noAntrean = "<?php echo $no_antrean; ?>";
      var noPeriksa = "<?php echo $id_periksa; ?>";
      var barcodeData = tanggal + "_" + noAntrean + "_" + noPeriksa;

      JsBarcode("#barcode", "1231321329123131998", {
        format: "CODE128",
        displayValue: false
      });
    }
  </script>
</head>
<body>
<div class="frame-87-Vci">
  <div class="group-2-cSS">
    <div class="rectangle-4-8fg"></div>
    <div class="line-1-fvW"></div>
    <p class="scan-barcode-di-resepsionis-ketika-anda-tiba-CQe">*Scan Barcode di Resepsionis ketika Anda Tiba</p>
    <div class="image-2-T5g">
      <svg id="barcode"></svg>
    </div>
    <img class="line-4-j3C" src="REPLACE_IMAGE:34:309"/>
    <div class="ticket-eAA">
      <div class="top-kyt">
        <div class="number-JEi">
          <?php
          echo '<p class="tanggal-r1L">Tanggal</p>';
          echo '<p class="may-11-2023-Eg6">' . $tanggal . '</p>';
          ?>
        </div>
        <div class="number-Mki">
          <?php
          echo '<p class="ruangan-hpa">Ruangan</p>';
          echo '<p class="a-Dnv">A</p>';
          ?>
        </div>
        <div class="number-MPL">
          <?php
          echo '<p class="nomor-periksa-uve">Nomor Periksa</p>';
          echo '<p class="f12234-2kN">' . $id_periksa . '</p>';
          ?>
        </div>
      </div>
      <div class="bottom-y9p">
        <div class="number-KDg">
          <?php
          echo '<p class="waktu-periksa-Gei">Waktu Periksa</p>';
          echo '<p class="am-est-C2a">' . $waktu_periksa . '</p>';
          ?>
        </div>
        <div class="number-iWi">
          <?php
          echo '<p class="nama-fB4">Nama</p>';
          echo '<p class="selbi-Xj4">' . $nama_pasien . '</p>';
          ?>
        </div>
        <div class="number-4U6">
          <?php
          echo '<p class="dokter-bU2">Dokter</p>';
          echo '<p class="angel-7BU">' . $nama_dokter . '</p>';
          ?>
        </div>
      </div>
    </div>
    <?php
        echo '<p class="antrian-234-358">Antrian #' . $no_antrean . '</p>';
     ?>
    <p class="antrian-234-358">Antrian #</p>
    <div class="doc2023-05-2408-13-09-jie"  id="34:436"></div>
    <div class="footer-pzz">
      <div class="frame-86-Mk2">
        <div class="rectangle-397-uFk"></div>
        <div class="group-81-eUE">
          <p class="phone-Cke">Phone</p>
          <p class="item-91-9876543210-7ci">+91 9876543210</p>
        </div>
        <div class="rectangle-398-3FU"></div>
      </div>
      <div class="auto-group-u5yc-nir">
        <div class="rectangle-398-8Gv"></div>
        <div class="group-83-RG2">
          <p class="email-MQa">Email</p>
          <p class="asrigmailcom-SS2">asri@gmail.com</p>
        </div>
        <div class="rectangle-401-mDQ"></div>
      </div>
      <div class="auto-group-jxcq-tYv">
        <div class="rectangle-399-Rok"></div>
        <div class="auto-group-yjau-mci">
          <p class="website-j3k">Website</p>
          <p class="asricoid-2Hk">asri.co.id</p>
        </div>
        <div class="rectangle-400-Mqp"></div>
      </div>
    </div>
    <div class="rectangle-22-74J"></div>
    <div class="rectangle-23-2SA"></div>
  </div>
</div>
</body>
</html>
