<?php
    // include 'config.php';
    // Konfigurasi database
    $host = "localhost"; // Ganti dengan nama host yang digunakan
    $username = "root"; // Ganti dengan username untuk akses ke database
    $password = ""; // Ganti dengan password untuk akses ke database
    $database = "klinik"; // Ganti dengan nama database yang digunakan

    // Membuat koneksi ke database
    $conn = mysqli_connect($host, $username, $password, $database);

    // Memeriksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    } else {
        // Retrieve selected doctor's available time slots
        $namaDokter = $_POST['nama_dokter'];

        $sql = "SELECT jam FROM jadwal_dokter WHERE id_user = (SELECT id_user FROM users WHERE nama_user = '$namaDokter')";
        $result = $conn->query($sql);

        $jamArray = array();
        if ($result->num_rows > 0) {
            while ($row = $result->fetch_assoc()) {
                $jamArray[] = $row['jam'];
            }
            echo json_encode($jamArray);
        } else {
            echo json_encode([]);
        }

        $conn->close();
    }
?>
