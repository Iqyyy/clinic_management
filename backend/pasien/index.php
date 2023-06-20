<?php
    // include 'config.php';
    // Konfigurasi database
    $host = "localhost"; // Ganti dengan nama host yang digunakan
    $username = "root"; // Ganti dengan username untuk akses ke database
    $password = ""; // Ganti dengan password untuk akses ke database
    $database = "klinik"; // Ganti dengan nama database yang digunakan

    // Membuat koneksi ke database
    $conn = mysqli_connect($host, $username, $password, $database);

    session_start();

    if(isset($_POST['reservasi']))
    {
        // Ambil nilai dari form reservasi
        $selectedDate = $_POST['tanggal'];
        $selectedDoctor = $_POST['nama_dokter'];
        $selectedTime = $_POST['no_antrean'];

        // Ambil id_user pasien dari sesi atau login
        $id_pasien = $_SESSION['id_user'];

        // Periksa koneksi
        if (!$conn) {
            die("Koneksi gagal: " . mysqli_connect_error());
        }

        // Ambil id_jadwal_dokter berdasarkan id_user dokter dan hari dari tabel jadwal_dokter
        $sql = "SELECT id_jadwal FROM jadwal_dokter WHERE id_user = (SELECT id_user FROM users WHERE nama_user = '$selectedDoctor') AND hari = DAYOFWEEK('$selectedDate') AND jam = $selectedTime";
        $result = mysqli_query($conn, $sql);

        if ($result && mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $id_jadwal_dokter = $row['id_jadwal'];
            

            // Ambil no_antrean berdasarkan jam dari tabel jadwal_dokter
            $no_antrean = $selectedTime;


            // Insert data ke tabel antrean
            $sql = "INSERT INTO antrean (id_periksa,id_jadwal_dokter, id_pasien, no_antrean, tanggal) VALUES (DEFAULT, '$id_jadwal_dokter', '$id_pasien', '$no_antrean', '$selectedDate')";
            if (mysqli_query($conn, $sql)) {
                echo "Data antrean berhasil disimpan.";
            } else {
                echo "Terjadi kesalahan dalam penyimpanan data antrean: " . mysqli_error($conn);
            }
        } else {
            echo "Jadwal dokter tidak ditemukan untuk tanggal dan jam tersebut.";

        }
    }

    // Ambil nama_user dari tabel users berdasarkan id_user dari session
    $id_user = $_SESSION["id_user"];
    $query = "SELECT nama_user FROM users WHERE id_user = '$id_user'";
    $result = mysqli_query($conn, $query);

    if ($result && mysqli_num_rows($result) > 0) {
        $row = mysqli_fetch_assoc($result);
        $nama_user = $row["nama_user"];
        // echo $nama_user;
    } else {
        echo "Gagal mendapatkan nama pengguna.";
    }

    // Tutup koneksi
    mysqli_close($conn);
?>



<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <title>ASRI MEDICAL</title>

    <!-- font awesome cdn link  -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css">

    <!-- custom css file link  -->
    <link rel="stylesheet" href="../../css/style.css">

    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.5.1/jquery.min.js"></script>
</head>
<body>
    
<!-- header section starts  -->

<header class="header">

    <a href="#" class="logo"> <i class="fa fa-medkit"></i> <strong>ASRI</strong>medical </a>

    <nav class="navbar">
        <a href="#home">home</a>
        <a href="#about">about</a>
        <a href="#services">services</a>
        <a href="#doctors">doctors</a>
        <a href="#appointment">reservasi</a>
        <a >
        <?php
            echo $nama_user;
        ?>
        </a>
        <a href="../../logout.php">logout</a>

    </nav>

    <div id="menu-btn" class="fas fa-bars"></div>

</header>

<!-- header section ends -->

<!-- home section starts  -->

<section class="home" id="home">

    <div class="image">
        <img src="../../image/home-img.svg" alt="">
    </div>

    <div class="content">
        <h3>we take care of your healthy life</h3>
        <p> A person who has good physical health is likely to have bodily functions and processes working at their peak.</p>
        <a href="#appointment" class="btn"> appointment us <span class="fas fa-chevron-right"></span> </a>
    </div>

</section>

<!-- home section ends -->

<!-- icons section starts  -->

<section class="icons-container">

    <div class="icons">
        <i class="fas fa-user-md"></i>
        <h3> Jam Ops</h3>
        <p>Weekdays: 08.00-15.00</p>
    </div>

    <div class="icons">
        <i class="fas fa-users"></i>
        <h3>BPJS</h3>
        <p>satisfied patients</p>
    </div>

    <div class="icons">
        <i class="fas fa-procedures"></i>
        <h3>Dokter</h3>
        <p>Dokter spesialis dan tenaga medis yang profesional di bidangnya</p>
    </div>

    <div class="icons">
        <i class="fas fa-hospital"></i>
        <h3>Layanan Modern</h3>
        <p>Sistem Antrean dan Rekam Medis yang modern</p>
    </div>

</section>

<!-- icons section ends -->

<!-- about section starts  -->

<section class="about" id="about">

    <h1 class="heading"> <span>about</span> us </h1>

    <div class="row">

        <div class="image">
            <img src="../../image/about-img.svg" alt="">
        </div>

        <div class="content">
            <h3>take the world's best quality treatment</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Iure ducimus, quod ex cupiditate ullam in assumenda maiores et culpa odit tempora ipsam qui, quisquam quis facere iste fuga, minus nesciunt.</p>
            <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. Natus vero ipsam laborum porro voluptates voluptatibus a nihil temporibus deserunt vel?</p>
            <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

    </div>

</section>

<!-- about section ends -->

<!-- services section starts  -->

<section class="services" id="services">

    <h1 class="heading"> our <span>services</span> </h1>

    <div class="box-container">

        <div class="box">
            <i class="fas fa-notes-medical"></i>
            <h3>antri mudah</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
            <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-user-md"></i>
            <h3>expert doctors</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
            <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

        <div class="box">
            <i class="fas fa-pills"></i>
            <h3>medicines</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
            <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>


        <div class="box">
            <i class="fas fa-heartbeat"></i>
            <h3>rekam medis</h3>
            <p>Lorem ipsum dolor sit amet consectetur, adipisicing elit. Ad, omnis.</p>
            <a href="#" class="btn"> learn more <span class="fas fa-chevron-right"></span> </a>
        </div>

    </div>

</section>

<!-- services section ends -->



<!-- doctors section starts  -->

<section class="doctors" id="doctors" style="overflow: hidden;">
    <h1 class="heading"> our <span>doctors</span> </h1>

    <div class="box-container" style="display: flex; flex-wrap: nowrap; overflow-x: auto;">
    <?php
    // Konfigurasi database
    $host = "localhost"; // Ganti dengan nama host yang digunakan
    $username = "root"; // Ganti dengan username untuk akses ke database
    $password = ""; // Ganti dengan password untuk akses ke database
    $database = "klinik"; // Ganti dengan nama database yang digunakan

    // Membuat koneksi ke database
    $conn = mysqli_connect($host, $username, $password, $database);

    // Periksa koneksi
    if (!$conn) {
        die("Koneksi gagal: " . mysqli_connect_error());
    }

    // Query untuk mengambil data pengguna dengan level_user = 2
    $query = "SELECT * FROM users WHERE level_user = 2";
    $result = mysqli_query($conn, $query);


    // Perulangan untuk menampilkan data users
    while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="box" style="flex: 0 0 auto; width: 300px; margin-right: 20px;">';
        echo '<img src="../../image/doc-1.jpg" alt="" style="width: 100%; height: auto;">';
        echo '<h3>' . $row['nama_user'] . '</h3>';
        echo '<span>Spesialis ' . $row['spesialis'] . '</span>';
        echo '<div class="share">';
        echo '<a href="#appointment" onclick="changeDoctorName(\''.$row['nama_user'].'\')"> Pilih Dokter </a>';
        echo '</div>';
        echo '</div>';
    }
    ?>
</div>
</section>

<!-- doctors section ends -->

<!-- appointmenting section starts   -->

<section class="appointment" id="appointment">

    <h1 class="heading"> <span>reserve</span> now </h1>

    <div class="row">

        <div class="image">
            <img src="../../image/appointment-img.svg" alt="">
        </div>

        <form action="<?php echo $_SERVER['PHP_SELF']; ?>" method="post">
            <?php
            if (isset($message)) {
                foreach ($message as $message) {
                    echo '<p class ="message">' . $message . '</p>';
                }
            }
            ?>

                <h3>RESERVASI</h3>
                <input type="text" name="nama_dokter" id="doctor_name" placeholder="Nama Dokter" class="box" readonly>
                <input type="date" name="tanggal" id="date_input" placeholder="Pilih Tanggal" class="box" min="<?php echo date('Y-m-d'); ?>" max="<?php echo date('Y-m-d', strtotime('+1 month')); ?>">
                <div id="available_days_label"></div>
                <div id="warning_message"></div>
                <select class="box" name="no_antrean">
                    <option disabled selected> Pilih Jam </option>
                    <!-- tampilkan jam disini -->
                    
                </select>
                <script>

                    // Menggunakan event change untuk menangkap perubahan tanggal pada kolom date
                    $('#date_input').change(function() {
                        var selectedDate = $(this).val();
                        checkSelectedDay(selectedDate);
                    });


                    var selectedDoctor = "";

                    function changeDoctorName(namaDokter) {

                        selectedDoctor = namaDokter;
                        console.log(selectedDoctor);

                        document.getElementById("doctor_name").value = selectedDoctor;

                       // Mengirim permintaan Ajax ke server-side PHP
                        $.ajax({
                        url: 'get_jam.php',
                        method: 'POST',
                        data: {
                            'nama_dokter': selectedDoctor
                        },
                        success: function(response) {
                            // Menghapus opsi jam sebelumnya
                            $('select[name="no_antrean"]').empty();

                            var jamArray = [];

                            try { 
                                jamArray = JSON.parse(response);
                                console.log(jamArray);
                            } catch (error) {
                                console.log("Terjadi kesalahan pada respons JSON : " + error);
                            }

                            // Menambahkan opsi jam baru
                            if (jamArray.length > 0) {
                                jamArray.forEach(function(item) {
                                    var jamText = '';
                                    switch (item) {
                                        case '1':
                                            jamText = '08.00 - 08.30';
                                            break;
                                        case '2':
                                            jamText = '08.30 - 09.00';
                                            break;
                                        case '3':
                                            jamText = '09.00 - 09.30';
                                            break;
                                        case '4':
                                            jamText = '09.30 - 10.00';
                                            break;
                                        case '5':
                                            jamText = '10.00 - 10.30';
                                            break;
                                        case '6':
                                            jamText = '10.30 - 11.00';
                                            break;
                                        case '7':
                                            jamText = '11.00 - 11.30';
                                            break;
                                        case '8':
                                            jamText = '11.30 - 12.00';
                                            break;
                                        case '9':
                                            jamText = '13.00 - 13.30';
                                            break;
                                        case '10':
                                            jamText = '13.30 - 14.00';
                                            break;
                                        case '11':
                                            jamText = '14.00 - 14.30';
                                            break;
                                        case '12':
                                            jamText = '14.30 - 15.00';
                                            break;
                                        case '13':
                                            jamText = '15.00 - 15.30';
                                            break;
                                        case '14':
                                            jamText = '15.30 - 16.00';
                                            break;
                                        default:
                                            jamText = 'Jam tidak valid';
                                            break;
                                    }
                                    $('select[name="no_antrean"]').append('<option value="' + item + '">' + jamText + '</option>');
                                });
                            } else {
                                $('select[name="no_antrean"]').append('<option disabled selected> Tidak ada jam tersedia </option>');
                            }
                        },
                        error: function(xhr, status, error) {
                            console.log("Terjadi kesalahan:" + status + ":" + error); // Tampilkan pesan error ke console
                            $('select[name="no_antrean"]').empty();
                            $('select[name="no_antrean"]').append('<option disabled selected> Gagal memuat data </option>');
                        }
                        });

                        // Get available days for the selected doctor
                        $.ajax({
                        url: 'get_hari.php',
                        method: 'POST',
                        data: {
                            'nama_dokter': selectedDoctor
                        },
                        success: function(response) {
                            // Menghapus label hari sebelumnya
                            $('#label_hari').remove();

                            var hariArray = [];

                            try {
                            hariArray = JSON.parse(response);
                            console.log(hariArray);
                            } catch (error) {
                            console.log("Terjadi kesalahan pada respons JSON: " + error);
                            }

                            if (hariArray.length > 0) {
                                var availableDays = [];

                                hariArray.forEach(function(hariValue) {
                                    switch (hariValue) {
                                    case '1':
                                        availableDays.push('Senin');
                                        break;
                                    case '2':
                                        availableDays.push('Selasa');
                                        break;
                                    case '3':
                                        availableDays.push('Rabu');
                                        break;
                                    case '4':
                                        availableDays.push('Kamis');
                                        break;
                                    case '5':
                                        availableDays.push("Jum'at");
                                        break;
                                    default:
                                        break;
                                    }
                                });

                                var availableDaysLabel = 'Hari yang tersedia: ' + availableDays.join(', ');
                                $('#available_days_label').text(availableDaysLabel);

                            } else {
                            $('#available_days_label').text('');
                            }
                        },
                        error: function() {
                            console.log('Terjadi kesalahan dalam mengambil data hari.');
                        }
                        });

                    }

                    function checkSelectedDay(selectedDate) {
                        if (selectedDoctor !== '') {
                            var selectedDay = new Date(selectedDate).getDay();

                            $.ajax({
                            url: 'get_hari.php',
                            method: 'POST',
                            data: {
                                nama_dokter: selectedDoctor
                            },
                            success: function(response) {
                                var hariArray = [];

                                try {
                                hariArray = JSON.parse(response);
                                console.log(hariArray);
                                } catch (error) {
                                console.log("Terjadi kesalahan pada respons JSON: " + error);
                                }

                                var availableDays = [];

                                hariArray.forEach(function(hariValue) {
                                switch (hariValue) {
                                    case '1':
                                    availableDays.push('Senin');
                                    break;
                                    case '2':
                                    availableDays.push('Selasa');
                                    break;
                                    case '3':
                                    availableDays.push('Rabu');
                                    break;
                                    case '4':
                                    availableDays.push('Kamis');
                                    break;
                                    case '5':
                                    availableDays.push("Jumat");
                                    break;
                                    default:
                                    break;
                                }
                                });

                                if (availableDays.length > 0) {
                                if (availableDays.includes(getDayName(selectedDay))) {
                                    $('#warning_message').text('').hide();
                                } else {
                                    $('#warning_message').text('Tanggal yang dipilih bukan hari yang tersedia.').show().css('color', 'red');
                                }
                                } else {
                                $('#warning_message').text('').hide();
                                }
                            },
                            error: function() {
                                console.log('Terjadi kesalahan dalam mengambil data hari.');
                            }
                            });
                        } else {
                            $('#warning_message').text('').hide();
                        }
                    }

                    // Fungsi untuk mendapatkan nama hari berdasarkan kode hari (0-6)
                    function getDayName(dayCode) {
                        var dayNames = ['Minggu', 'Senin', 'Selasa', 'Rabu', 'Kamis', 'Jumat', 'Sabtu'];
                        return dayNames[dayCode];
                    }

                </script>

                <br><input type="submit" name="reservasi" value="RESERVASI" class="btn">
        </form>

    </div>

</section>


<!-- appointmenting section ends -->

<!-- invoice -->

<section>

    <div>
        <a href="invoice1.php" style="text-align: center; display: block;">Unduh Bukti Reservasi</a>
    </div>


</section>

<!-- invoice end -->
<!-- review section starts  -->

<section class="review" id="review">
    
    <h1 class="heading"> client's <span>review</span> </h1>

    <div class="box-container">

        <div class="box">
            <img src="../../image/pic-1.jpg" alt="">
            <h3>angel</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam sapiente nihil aperiam? Repellat sequi nisi aliquid perspiciatis libero nobis rem numquam nesciunt alias sapiente minus voluptatem, reiciendis consequuntur optio dolorem!</p>
        </div>

        <div class="box">
            <img src="../../image/pic-1.jpg" alt="">
            <h3>angel</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam sapiente nihil aperiam? Repellat sequi nisi aliquid perspiciatis libero nobis rem numquam nesciunt alias sapiente minus voluptatem, reiciendis consequuntur optio dolorem!</p>
        </div>

        <div class="box">
            <img src="../../image/pic-1.jpg" alt="">
            <h3>angel</h3>
            <div class="stars">
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star"></i>
                <i class="fas fa-star-half-alt"></i>
            </div>
            <p class="text">Lorem ipsum dolor sit amet consectetur adipisicing elit. Laboriosam sapiente nihil aperiam? Repellat sequi nisi aliquid perspiciatis libero nobis rem numquam nesciunt alias sapiente minus voluptatem, reiciendis consequuntur optio dolorem!</p>
        </div>

    </div>

</section>
<section class="footer">

    <div class="box-container">

        <div class="box">
            <h3>quick links</h3>
            <a href="#home"> <i class="fas fa-chevron-right"></i> home </a>
            <a href="#about"> <i class="fas fa-chevron-right"></i> about </a>
            <a href="#services"> <i class="fas fa-chevron-right"></i> services </a>
            <a href="#doctors"> <i class="fas fa-chevron-right"></i> doctors </a>
            <a href="#appointment"> <i class="fas fa-chevron-right"></i> appointment </a>
        </div>

        <div class="box">
            <h3>our services</h3>
            <a href="#"> <i class="fas fa-chevron-right"></i> dental care </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> message therapy </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> cardioloty </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> diagnosis </a>
            <a href="#"> <i class="fas fa-chevron-right"></i> ambulance service </a>
        </div>

        <div class="box">
            <h3>appointment info</h3>
            <a href="#"> <i class="fas fa-phone"></i> 08188238801 </a>
            <a href="#"> <i class="fas fa-phone"></i> 0882546978 </a>
            <a href="#"> <i class="fas fa-envelope"></i> angel@gmail.com </a>
            <a href="#"> <i class="fas fa-map-marker-alt"></i> jakarta, indonesia </a>
        </div>

        <div class="box">
            <h3>follow us</h3>
            <a href="#"> <i class="fab fa-faceappointment-f"></i> faceappointment </a>
            <a href="#"> <i class="fab fa-twitter"></i> twitter </a>
            <a href="#"> <i class="fab fa-instagram"></i> instagram </a>
            <a href="#"> <i class="fab fa-linkedin"></i> linkedin </a>
            <a href="#"> <i class="fab fa-pinterest"></i> pinterest </a>
        </div>

    </div>

    <div class="credit"> created by <span>angel</span> | all rights reserved </div>

</section>

<!-- footer section ends -->



<!-- js file link  -->
<script src="../../js/script.js"></script>

</body>
</html>

