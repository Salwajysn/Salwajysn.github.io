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
              <a href="#" class="sub-menu-link">
                <img src="certificateIcon.png">
                <p>Sertifikat</p>
              </a>
              <a href="feedback.php" class="sub-menu-link">
                <img src="feedback.png">
                <p>Feedback</p>
              </a>
              <!--log out-->
              <a href="#" id="logOut" class="sub-menu-link">
                <img src="logOut.png">
                <p>Keluar</p>
              </a>
          </div>
        </div>
      </nav>
    </header>
    
    <!--Bagian utama halaman-->
    <h1 style="margin: 50px 0 0 150px; font-size: 40px;" class="subTitle-kelas">Pemrograman Web</h1>
    <!--Materi-->
    <div class="containerKelas">
      <div class="detailKelas">
        <div class="image-container">
          <img src="11.png" alt="Gambar">
          <button class="overlay-button" onclick="redirectToPage3('web1.php')">
            <h5>Mulai Belajar</h5>
          </button>
        </div>
        <div>
          <h4>#1 Web Development Introduction</h4>
        </div>
      </div>
      <div class="detailKelas">
        <div class="image-container">
          <img src="12.png" alt="Gambar">
          <button class="overlay-button" onclick="redirectToPage3('web2.php')">
            <h5>Mulai Belajar</h5>
          </button>
        </div>
        <div>
          <h4>#2 Web Development Tools</h4>
        </div>
      </div>
      <div class="detailKelas">
        <div class="image-container">
          <img src="13.png" alt="Gambar">
          <button class="overlay-button" onclick="redirectToPage3('web3.php')">
            <h5>Mulai Belajar</h5>
          </button>
        </div>
        <div>
          <h4>#3 HTML Basics</h4>
        </div>
      </div>
      <div class="detailKelas">
        <div class="image-container">
          <img src="14.png" alt="Gambar">
          <button class="overlay-button" onclick="redirectToPage3('web4.php')">
            <h5>Mulai Belajar</h5>
          </button>
        </div>
        <div>
          <h4>#4 CSS Basics</h4>
        </div>
      </div>
      <div class="detailKelas">
        <div class="image-container">
          <img src="15.png" alt="Gambar">
          <button class="overlay-button" onclick="redirectToPage3('web5.php')">
            <h5>Mulai Belajar</h5>
          </button>
        </div>
        <div>
          <h4>#5 Responsive Website with Bootstrap</h4>
        </div>
      </div>
    </div>

    <!--Footer-->
    <footer id="footer">
      <div class="footer-grid"></div>
    <section id="colorBG"></section>
    <section id="colorBG">
      <p>&copy; 2024 Proyek Website Bootcamp TechThree -- Kelompok 3</p>
    </section> 
  </body>
</html>