<!-- <?php
// include 'config.php';
// Konfigurasi database
$host = "localhost"; // Ganti dengan nama host yang digunakan
$username = "root"; // Ganti dengan username untuk akses ke database
$password = ""; // Ganti dengan password untuk akses ke database
$database = "klinik"; // Ganti dengan nama database yang digunakan

// Membuat koneksi ke database
$conn = mysqli_connect($host, $username, $password, $database);

session_start();

// Mengecek koneksi
if (!$conn) {
    die("Koneksi gagal: " . mysqli_connect_error());
}

?> -->


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
            $id_user = $_SESSION["id_user"]; // Ambil id_user dari session
            $query = "SELECT nama_user FROM users WHERE id_user = '$id_user'"; // Tambahkan kondisi WHERE id_user = '$id_user'
            $result = mysqli_query($conn, $query);
            $row = mysqli_fetch_assoc($result);
            $nama_user = $row["nama_user"];
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
         // Query untuk mengambil data users dengan level_user = 2
        $query = "SELECT * FROM users WHERE level_user = 2";
        $result = mysqli_query($conn, $query);

        // Perulangan untuk menampilkan data users
        while ($row = mysqli_fetch_assoc($result)) {
        echo '<div class="box" style="flex: 0 0 auto; width: 300px; margin-right: 20px;">';
        echo '<img src="../../image/doc-1.jpg" alt="" style="width: 100%; height: auto;">';
        echo '<h3>'.$row['nama_user'].'</h3>';
        echo '<span>Spesialis '.$row['spesialis'].'</span>';
        echo '<div class="share">';
        echo '<a href="#appointment" onclick="changeDoctorName(\''.$row['nama_user'].'\')">RESERVASI</a>';
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

        <form action="<?php echo $_SERVER['PHP_SELF'];?>" method="post">
        <?php
            if(isset($message)) {
                foreach($message as $message) {
                echo'<p class ="message">'.$message.'</p>';
            }
            }
        ?>
      
            <h3>RESERVASI</h3>
            <input type="text" name="nama_user" id="doctor_name" placeholder="Nama Dokter" class="box" readonly>
            <input type="date" name="tanggal" placeholder="Pilih Tanggal" class="box">
            <select class="box" name="no_antrean">
                    <option value="no_antrean" disabled>SESI</option>
                    <option name="no_antrean" value="1">08.00 - 08.30</option>>
                    <option name="no_antrean" value="2">08.30 - 09.00</option>
                    <option name="no_antrean" value="3">09.00 - 09.30</option>>
                    <option name="no_antrean" value="4">09.30 - 10.00</option>
                    <option name="no_antrean" value="5">10.00 - 10.30</option>>
                    <option name="no_antrean" value="6">10.30 - 11.00</option>
                    <option name="no_antrean" value="7">11.00 - 11.30</option>>
                    <option name="no_antrean" value="8">11.30 - 12.00</option>
                    <option name="no_antrean" value="9">13.00 - 13.30</option>>
                    <option name="no_antrean" value="10">13.30 - 14.00</option>
                    <option name="no_antrean" value="11">14.00 - 14.30</option>>
                    <option name="no_antrean" value="12">14.30 - 15.00</option>
                    <option name="no_antrean" value="13">15.00 - 15.30</option>>
                    <option name="no_antrean" value="14">15.30 - 16.00</option>
            </select>

            
            <br><input type="submit" name="reservasi" value="RESERVASI" class="btn">
        </form>

    </div>

</section>
<script>
    function changeDoctorName(doctorName) {
        document.getElementById("doctor_name").value = doctorName;
    }
</script>

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

