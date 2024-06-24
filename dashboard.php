<?php
session_start(); // Mulai sesi PHP

// Sisipkan file koneksi ke database
require_once "db_connect.php";

// Periksa apakah user_id tersedia dalam sesi PHP
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Ambil user_id dari sesi PHP
} else {
    // Jika tidak ada user_id dalam sesi, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Pastikan keluar dari skrip PHP setelah redirect
}

// Fungsi untuk memperbarui jumlah kelas yang diikuti pengguna
function update_class_count($conn, $user_id) {
  // Query untuk menghitung jumlah kelas yang diikuti berdasarkan progress
  $sql_count = "SELECT COUNT(DISTINCT Id_Kelas) AS total_kelas FROM progress WHERE Id_User = '$user_id' AND percentage IS NOT NULL";
  $result_count = $conn->query($sql_count);
  $total_kelas = 0;

  if ($result_count->num_rows > 0) {
      $row = $result_count->fetch_assoc();
      $total_kelas = $row['total_kelas'];
  }
  return $total_kelas;
}

// Ambil jumlah kelas yang diikuti
$total_kelas_diikuti = update_class_count($conn, $user_id);

// Query untuk mengambil persentase progres pengguna untuk kelas tertentu
$sql_progress = "SELECT percentage FROM progress WHERE Id_User = '$user_id' AND Id_Kelas = 'Kls01'";
$result_progress = $conn->query($sql_progress);

// Memeriksa apakah data progres ditemukan
if ($result_progress->num_rows > 0) {
    $progress = $result_progress->fetch_assoc();
    $percentage = $progress['percentage'];
} else {
    $percentage = 0; // Jika tidak ada progres, atur default ke 0 atau sesuai kebutuhan
}

// Query untuk mengambil persentase progres untuk kelas yang diikuti
$sql_kelas_diikuti = "SELECT p.Id_Kelas, p.percentage
                      FROM progress p
                      WHERE p.Id_User = '$user_id'";
$result_kelas_diikuti = $conn->query($sql_kelas_diikuti);

// Inisialisasi array untuk menyimpan persentase progres untuk setiap kelas
$progress_kelas_diikuti = array();

if ($result_kelas_diikuti->num_rows > 0) {
    while ($row = $result_kelas_diikuti->fetch_assoc()) {
        $progress_kelas_diikuti[$row['Id_Kelas']] = $row['percentage'];
    }
}

// Query untuk mengambil data pengguna dari database berdasarkan user_id
$sql = "SELECT * FROM user WHERE Id_User = '$user_id'";
$result = $conn->query($sql);

// Memeriksa apakah data pengguna ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $namaUser = htmlspecialchars($user['Nama_User']); // Ambil nama pengguna
} else {
    echo "Pengguna tidak ditemukan";
    exit(); // Keluar dari skrip PHP jika pengguna tidak ditemukan
}
if (isset($_POST['follow_class'])) {
  $new_class_id = $_POST['class_id'];
  $user_id = $_POST['user_id'];
  $start_date = date('Y-m-d'); // Tanggal mulai kelas

  // Periksa apakah pengguna sudah mengikuti kelas ini sebelumnya
  $sql_check_following = "SELECT * FROM user_kelas WHERE Id_User = '$user_id' AND Id_Kelas = '$new_class_id'";
  $result_check_following = $conn->query($sql_check_following);

  if ($result_check_following->num_rows > 0) {
      // Jika sudah mengikuti, maka proses untuk berhenti mengikuti
      $sql_delete_class = "DELETE FROM user_kelas WHERE Id_User = '$user_id' AND Id_Kelas = '$new_class_id'";
      if ($conn->query($sql_delete_class) === TRUE) {
          echo "Kelas berhasil dihentikan.";
      } else {
          echo "Error: " . $sql_delete_class . "<br>" . $conn->error;
      }
  } else {
      // Jika belum mengikuti, tambahkan ke user_kelas
      $sql_add_class = "INSERT INTO user_kelas (Id_User, Id_Kelas, Tanggal_Mulai) VALUES ('$user_id', '$new_class_id', '$start_date')";
      if ($conn->query($sql_add_class) === TRUE) {
          // Tambahkan data progres awal di tabel progress
          $sql_progress = "INSERT INTO progress (Id_User, Id_Kelas, percentage) VALUES ('$user_id', '$new_class_id', 0)";
          if ($conn->query($sql_progress) === TRUE) {
              echo "Kelas baru berhasil diikuti!";
          } else {
              echo "Error: " . $sql_progress . "<br>" . $conn->error;
          }
      } else {
          echo "Error: " . $sql_add_class . "<br>" . $conn->error;
      }
  }

  // Perbarui jumlah kelas yang diikuti
  $total_kelas_diikuti = update_class_count($conn, $user_id);
}


?>


<!--HALAMAN WEB TECHTREE: DASHBOARD USER (SETELAH LOGIN)-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="dashboard.css">
    <title>Dashboard</title>
    <script src="dashboard.js" defer></script>
  </head>

  <body>
    <header>
      <!---->
      <a id="logo_link" href="dashboard.php">
          <img src="Logo.png" id="logo">
      </a>
      <!--Navigasi halaman lapor keluh kesah dan profile-->
      <nav id="nav_header">
        <!--Navigasi Feedback/Lapor-->
        <a href="feedback.php" class="circle-container">
          <img class="circle-img" src="feedback.png">
        </a>
        <!--Navigasi Halaman Profile-->
        <p onclick="toggleMenu()" class="circle-container">
          <img class="circle-img" src="user.png">
        </p>
        <!--dropdown menu-->
        <div id="subMenu" class="subMenu-wrap">
          <div class="subMenu">
            <div class="user-info">
              <img src="user.png">
              <h2><?php echo htmlspecialchars($namaUser); ?></h2>
            </div>
            <hr>
              <!--link-->
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('dashboardContent')">
                <img src="dashboardIcon.png">
                <p>Dashboard</p>
              </a>
              <a href="profile.php" class="sub-menu-link">
                <img src="profileIcon.png">
                <p>Profile</p>
              </a>
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('kelasBootcampContent')">
                <img src="kelasSayaIcon.png">
                <p>Kelas Bootcamp</p>
              </a>
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('proyekAkhirContent')">
                <img src="projectIcon.png">
                <p>Proyek Akhir</p>
              </a>
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('sertifContent')">
                <img src="certificateIcon.png">
                <p>Sertifikat</p>
              </a>
              </a>
              <a href="feedback.php" class="sub-menu-link">
                <img src="feedback.png">
                <p>Feedback</p>
              </a>
              <!--log out-->
              <a href="logOut" id="logOut" class="sub-menu-link">
                <img src="logOut.png">
                <p>Keluar</p>
              </a>
          </div>
        </div>
      </nav>
    </header>

    <!--Navigasi bagian kiri-->
    <nav id="navDashboard">
      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('dashboardContent')">
        <img class="iconAdjust" src="dashboardIcon.png">
        <p class="navAdjust">Dashboard</p>
      </a>

      <a href="profile.php" class="sectionDashboard">
        <img class="iconAdjust" src="profileIcon.png">
        <p class="navAdjust">Profile </p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('kelasBootcampContent')">
        <img class="iconAdjust" src="kelasSayaIcon.png">
        <p class="navAdjust">Kelas Bootcamp</p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('proyekAkhirContent')">
        <img class="iconAdjust" src="projectIcon.png">
        <p class="navAdjust">Proyek Akhir</p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('sertifContent')">
        <img class="iconAdjust" src="certificateIcon.png">
        <p class="navAdjust">Sertifikat</p>
      </a>

      <a href="feedback.php" class="sectionDashboard">
        <img class="iconAdjust" src="feedback.png">
        <p class="navAdjust">Feedback</p>
      </a>
    </nav>
    
    <!--Bagian utama halaman-->
    <main>
      <!--halaman konten (center)-->
      <div class="content active" id="dashboardContent">
        <div id="motivationSquare">
          <h1 id="haloUser">Halo, <?php echo $namaUser; ?>!</h1>
          <p id="teruskanProgresAnda">Teruskan progres Anda dan hadapi tantangan baru!</p>
          <div id="innerSquare">
            <!--jumlah kelas yang diikuti-->
            <section>
              <img class="iconAdjustInner" src="kelasSayaIcon.png">
              <h1 class="titleSubSquareMotivate">Kelas yang Diikuti</h1>
              <hr>
              <p class="jumlahMotivate"><span class="jumlahMotivateBold"><?php echo $total_kelas_diikuti; ?></span> dari 3</p>
            </section>
            <!--sertifikat-->
            <section>
              <img class="iconAdjustInner" src="certificateIcon.png">
              <h1 class="titleSubSquareMotivate">Sertifikat</h1>
              <hr>
              <p class="jumlahMotivate"><span class="jumlahMotivateBold">1</span> dari 3</p>
            </section>
          </div>
        </div>

        <!--lanjutkan progres kelas-->
        <h1 id="lanjutkanMateri">Lanjutkan Materi</h1>
        <div id="materiSquare">
          <img class="imgBoxAdjust" src="uiux.png">
        <section class="divideTitleBar">
          <h1>Desain UI/UX - Tools</h1>
        <div class="progress-container">
            <div class="progress-bar" style="width: <?php echo $percentage; ?>%;"><span class="percentageBar"><?php echo $percentage; ?>%</span></div>
        </div>
        </section>
        <button class="lihatDetailKelas" onclick="redirectToPage3('detailKelas.php')">Lihat Detail Kelas</button>
      </div>
      </div>

      <!--KELAS BOOTCAMP-->
      <div class="content" id="kelasBootcampContent">
        <!--kelas yang diikuti-->
        <!--kelas yang diikuti-->
        <h1 class="subTitle-kelas">Kelas yang Diikuti</h1>
        <div class="classWrap">
        <img class="imgAdjust2" src="uiux.png">
        <section class="divideTitleBar2">
          <h1 class="titleKelas">Desain UI/UX - Tools</h1>
        <div class="progress-container2">
        <div class="progress-bar2" style="width: <?php echo isset($progress_kelas_diikuti['Kls01']) ? $progress_kelas_diikuti['Kls01'] : 0; ?>%;"><span class="percentageBar2"><?php echo isset($progress_kelas_diikuti['Kls01']) ? $progress_kelas_diikuti['Kls01'] : 0; ?>%</span></div>
      </div>
  </section>
  <button class="lihatDetailKelas2" onclick="redirectToPage3('detailKelas.php')">Lihat Detail Kelas</button>
</div>

        <h1 id="kelasLainnya" class="subTitle-kelas">Kelas Lainnya</h1>
        <div class="classWrap">
          <img class="imgAdjust2" src="fotografi.png">
          <h1 class="titleKelas2">Fotografi</h1>
          <button class="lihatDetailKelas2" onclick="redirectToPage3('detailKelasFotografi.php')">Ikuti Kelas</button>
        </div>
        <div class="classWrap">
          <img class="imgAdjust2" src="webdev.png">
          <h1 class="titleKelas2">Pengembangan Web</h1>
          <button class="lihatDetailKelas2" onclick="redirectToPage3('detailKelasWeb.php')">Ikuti Kelas</button>
        </div>
      </div>

      <!--SERTIFIKAT-->
      <div class="content" id="sertifContent">
        <h1 style="text-align: left; font-size: 5vh;" class="subTitle-kelas">Sertifikat</h1>
        <script src="https://unpkg.com/pdf-lib" defer></script>

        <div id="pdfContainer">
            <iframe id="pdfViewer" type="application/pdf" src="./sertifikatLeo.pdf" width="100%" height="800px"></iframe>
        </div>
        <script src="sertifikat.js" defer></script>
      </div>

      <!--PROYEK AKHIR-->
      <div class="content" id="proyekAkhirContent">
        <!--kelas yang diikuti-->
        <h1 class="subTitle-kelas">Proyek Akhir</h1>
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <h1 class="titleKelas3">Design Aplikasi Mobile E-Commerce Niche untuk Fashion Sustainable</h1>
          <?php if ($percentage >= 100): ?>
            <button class="lihatDetailKelas3" onclick="redirectToPage3('detail_dan_submit_proyekAkhir.php')">Lihat Detail Proyek</button>
          <?php else: ?>
            <button class="lihatDetailKelas3" disabled>Terkunci</button>
            <img class="locked" src="locked.png">
          <?php endif; ?>
        </div>

    </main>
  </body>
</html>