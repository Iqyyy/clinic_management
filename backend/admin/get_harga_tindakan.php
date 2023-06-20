<?php
session_start();
include('assets/inc/config.php');

if (isset($_GET['jenis_tindakan'])) {
    $jenis_tindakan = $_GET['jenis_tindakan'];

    // Mengambil data biaya tindakan dari database
    $query = "SELECT biaya_tindakan FROM tindakan WHERE jenis_tindakan = ?";
    $stmt = $mysqli->prepare($query);
    $stmt->bind_param('s', $jenis_tindakan);
    $stmt->execute();
    $stmt->bind_result($biaya_tindakan);

    if ($stmt->fetch()) {
        // Tindakan ditemukan, biaya tindakan diisi sesuai dengan data yang ditemukan
        echo $biaya_tindakan;
    } else {
        // Tindakan tidak ditemukan, biaya tindakan diisi dengan 0
        echo "0";
    }

    $stmt->close();
}
?>
