<?php
session_start();

// Periksa apakah admin belum login, redirect ke halaman login
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: dashboard_admin.php'); // Sesuaikan URL ini sesuai halaman login Anda
    exit;
}

// Sertakan koneksi ke database atau file yang diperlukan
require_once 'db_connect.php';

// Query untuk menghitung jumlah user terdaftar
$sqlUserTerdaftar = "SELECT COUNT(Id_User) AS total_user FROM user";
$resultUserTerdaftar = $conn->query($sqlUserTerdaftar);
$rowUserTerdaftar = $resultUserTerdaftar->fetch_assoc();
$totalUserTerdaftar = $rowUserTerdaftar['total_user'];

// Query untuk menghitung jumlah user yang telah menyelesaikan kelas
$sqlUserSelesaiKelas = "SELECT COUNT(Id_User) AS total_user_selesai FROM user_kelas WHERE Tanggal_Selesai IS NOT NULL";
$resultUserSelesaiKelas = $conn->query($sqlUserSelesaiKelas);
$rowUserSelesaiKelas = $resultUserSelesaiKelas->fetch_assoc();
$totalUserSelesaiKelas = $rowUserSelesaiKelas['total_user_selesai'];

// Query untuk mengambil feedback
$sqlFeedback = "SELECT Id_User, nilai, kategori, komentar FROM feedback";
$resultFeedback = $conn->query($sqlFeedback);

// Ambil informasi admin berdasarkan admin_id dari sesi
$admin_id = $_SESSION['admin_id'];
$sql = "SELECT * FROM admin WHERE Id_Admin = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('s', $admin_id);
$stmt->execute();
$result = $stmt->get_result();
$admin = $result->fetch_assoc();

// Pastikan $admin tidak null sebelum digunakan
if ($admin) {
    // Simpan nama admin
    $admin_name = htmlspecialchars($admin['Nama_Admin']);
} else {
    // Handle jika admin tidak ditemukan, sesuai kebutuhan aplikasi Anda
    $admin_name = "Informasi admin tidak ditemukan";
}
?>

<!--HALAMAN WEB TECHTREE: DASHBOARD ADMIN (SETELAH LOGIN)-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="dashboard_admin.css">
    <title>Dashboard | Admin</title>
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="dashboard_admin.js" defer></script>
  </head>

  <body>
    <header>
      <!---->
      <a id="logo_link" href="dashboard_admin.php">
          <img src="Logo.png" id="logo">
      </a>
      <h3 class="halaman_admin">Halaman Admin</h3>
      <!--Navigasi halaman lapor keluh kesah dan profile-->
      <nav id="nav_header">
        <!--Navigasi Liat Feedback User-->
        <a href="javascript:void(0);" class="circle-container" onclick="navigateTo('feedbackContent')">
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
              <h2><?php echo htmlspecialchars($admin_name); ?></h2>
            </div>
            <hr>
              <!--link-->
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('dashboardContent')">
                <img src="dashboardIcon.png">
                <p>Dashboard</p>
              </a>
              <a href="profile_admin.php" class="sub-menu-link">
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
              <!--a href="#" class="sub-menu-link">
                <img src="certificateIcon.png">
                <p>Sertifikat</p>
              </a-->
              <a href="TechThree_admin.php" class="sub-menu-link">
                <img src="Company.png">
                <p>Tech Three</p>
              </a>
              <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('feedbackContent')">
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

    <!--Navigasi bagian kiri-->
    <nav id="navDashboard">
      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('dashboardContent')">
        <img class="iconAdjust" src="dashboardIcon.png">
        <p class="navAdjust">Dashboard</p>
      </a>

      <a href="profile_admin.php" class="sectionDashboard" >
        <img class="iconAdjust" src="profileIcon.png">
        <p class="navAdjust">Profile</p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('kelasBootcampContent')">
        <img class="iconAdjust" src="kelasSayaIcon.png">
        <p class="navAdjust">Kelas Bootcamp</p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('proyekAkhirContent')">
        <img class="iconAdjust" src="projectIcon.png">
        <p class="navAdjust">Proyek Akhir</p>
      </a>

      <!--a href="#" class="sectionDashboard" >
        <img class="iconAdjust" src="certificateIcon.png">
        <p class="navAdjust">Sertifikat</p>
      </a-->

      <a href="TechThree_admin.php" class="sectionDashboard">
        <img class="iconAdjust" src="Company.png">
        <p class="navAdjust">Tech Three</p>
      </a>

      <a href="javascript:void(0);" class="sectionDashboard" onclick="navigateTo('feedbackContent')">
        <img class="iconAdjust" src="feedback.png">
        <p class="navAdjust">Feedback</p>
      </a>
    </nav>
    <!--Bagian utama halaman-->
    <main>
      <!--halaman konten (center)-->
      <div class="content active" id="dashboardContent">
        <div id="motivationSquare">
        <h1 id="haloUser">Halo, <?php echo $admin_name; ?>!</h1>
          <p id="teruskanProgresAnda">Selamat datang kembali di dashboard!</p>
          <div id="innerSquare">
            <!--user terdaftar dan user yang telah menyelesaikan kelas-->
            <section class="innerSquareFlex">
              <div>
                <i class="fa-solid fa-user-plus iconAdjustInner"></i>
                <h1 class="titleSubSquareMotivate">User Terdaftar</h1>
              </div>
              <div>
                <i class="fa-solid fa-user-graduate iconAdjustInner"></i>
                <h1 class="titleSubSquareMotivate">User yang Telah Menyelesaikan Kelas</h1>
              </div>
            </section>
            <section class="innerSquareFlex">
            <p class="jumlahMotivateBold"><?php echo $totalUserTerdaftar; ?></p>
            <p class="jumlahMotivateBold"><?php echo $totalUserSelesaiKelas; ?></p>
            </section>
          </div>
        </div>

        <!--KELOLA KELAS-->
        <h1 class="subTitle-kelas">Kelola Kelas</h1>
         <!--kelas 1-->
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <h1 class="titleKelas2">Desain UI/UX</h1>
          <button class="kelolaKelas-main" onclick="activateAndScrollTo('kelasBootcampContent')">Kelola Kelas</button>
        </div>
         <!--kelas 2-->
        <div class="classWrap">
           <img class="imgAdjust2" src="fotografi.png">
           <h1 class="titleKelas2">Fotografi</h1>
           <button class="kelolaKelas-main" onclick="activateAndScrollTo('kelasBootcampContent')">Kelola Kelas</button>
        </div>
         <!--kelas 3-->
        <div class="classWrap">
           <img class="imgAdjust2" src="webdev.png">
           <h1 class="titleKelas2">Pengembangan Web</h1>
           <button class="kelolaKelas-main" onclick="activateAndScrollTo('kelasBootcampContent')">Kelola Kelas</button>
        </div>
        <section class="menujuHalamanMenilai-wrap">
          <h3 class="menujuHalamanMenilai">Menilai Proyek Akhir Peserta</h3> 
          <i class="fa-solid fa-arrow-right-long"></i>
          <button class="menujuHalamanMenilai-button" onclick="activateAndScrollTo2('proyekAkhirContent', 'nilaiProyekAkhirContent')">Buka Proyek Akhir</button>
        </section>
       </div>
      </div>

      <!--KELAS BOOTCAMP-->
      <div class="content" id="kelasBootcampContent">
        <!--KELOLA KELAS-->
        <h1 class="subTitle-kelas">Kelas Bootcamp</h1>
         <!--EDIT MATERI dan SOAL QUIZ-->

         <!--kelas 1-->
         <h2>Desain UI/UX</h2>
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <h1 class="titleKelas2">Materi - Desain UI/UX</h1>
          <button class="kelolaKelas" onclick="redirectToPage3('materi_admin.php')">Edit Materi</button>
        </div>
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <h1 class="titleKelas2">Quiz - Desain UI/UX</h1>
          <button class="kelolaKelas" onclick="redirectToPage3('quiz_admin.php')">Edit Quiz</button>
        </div>
         <!--kelas 2-->
         <h2>Fotografi</h2>
        <div class="classWrap">
           <img class="imgAdjust2" src="fotografi.png">
           <h1 class="titleKelas2">Materi - Fotografi</h1>
           <button class="kelolaKelas" onclick="redirectToPage3('materi_admin_fotografi.php')">Edit Materi</button>
        </div>
         <!--kelas 2-->
       <div class="classWrap">
        <img class="imgAdjust2" src="fotografi.png">
        <h1 class="titleKelas2">Quiz - Fotografi</h1>
        <button class="kelolaKelas" onclick="redirectToPage3('quiz_fotografi_admin.php')">Edit Quiz</button>
     </div>
         <!--kelas 3-->
         <h2>Pengembangan Web</h2>
        <div class="classWrap">
           <img class="imgAdjust2" src="webdev.png">
           <h1 class="titleKelas2">Materi - Pengembangan Web</h1>
           <button class="kelolaKelas" onclick="redirectToPage3('materi_admin_web.php')">Edit Materi</button>
        </div>
       <div class="classWrap">
          <img class="imgAdjust2" src="webdev.png">
          <h1 class="titleKelas2">Quiz - Pengembangan Web</h1>
          <button class="kelolaKelas" onclick="redirectToPage3('quiz_web_admin.php')">Edit Quiz</button>
       </div>
      </div>

      <!--PROYEK AKHIR-->
      <div class="content" id="proyekAkhirContent">
        <!--kelas 1-->
        <h1 class="subTitle-kelas">Proyek Akhir</h1>
        <h2>Edit Detail Proyek Akhir</h2>
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Desain UI/UX</h1>
            <h1 class="titleKelas3b">Design Aplikasi Mobile E-Commerce Niche untuk Fashion Sustainable</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('editProyekAkhir_admin.php')">Edit Proyek Akhir</button>
        </div>
        <!--kelas 2-->
        <div class="classWrap">
          <img class="imgAdjust2" src="fotografi.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Fotografi</h1>
            <h1 class="titleKelas3b">Fotografi: Potret melalui Lensa Budaya</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('editProyekAkhir_fotografi_admin.php')">Edit Proyek Akhir</button>
        </div>
        <!--kelas 3-->
        <div class="classWrap">
          <img class="imgAdjust2" src="webdev.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Pengembangan Web</h1>
            <h1 class="titleKelas3b">Sistem Manajemen Toko Online</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('editProyekAkhir_web_admin.php')">Edit Proyek Akhir</button>
        </div>

        <!--MENILAI PROYEK AKHIR PESERTA-->
        <h2 id="nilaiProyekAkhirContent">Nilai Proyek Akhir Peserta</h2>
        <div class="classWrap">
          <img class="imgAdjust2" src="uiux.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Desain UI/UX</h1>
            <h1 class="titleKelas3b">Design Aplikasi Mobile E-Commerce Niche untuk Fashion Sustainable</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('menilaiProyek_admin.php')">Nilai Proyek Akhir</button>
        </div>
        <!--kelas 2-->
        <div class="classWrap">
          <img class="imgAdjust2" src="fotografi.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Fotografi</h1>
            <h1 class="titleKelas3b">Fotografi: Potret melalui Lensa Budaya</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('menilaiProyekFotografi_admin.php')">Nilai Proyek Akhir</button>
        </div>
        <!--kelas 3-->
        <div class="classWrap">
          <img class="imgAdjust2" src="webdev.png">
          <section class="divideTitleBar">
            <h1 class="titleKelas3a">Pengembangan Web</h1>
            <h1 class="titleKelas3b">Sistem Manajemen Toko Online</h1>
          </section>
          <button class="editProyek" onclick="redirectToPage3('menilaiProyekWeb_admin.php')">Nilai Proyek Akhir</button>
        </div>
      </div>

      <title>Feedback</title>

<!-------------------------------------------SABAR--------------------------------------------------->
    <!--Feedback-->
    <div class="content" id="feedbackContent">
    <h1 class="subTitle-kelas">Feedback</h1>
    <br>
    <div class="feedback">
      <br>
      <table class="feedbackTable">
        <thead>
          <tr>
            <th>ID User</th>
            <th>Nilai</th>
            <th>Kategori</th>
            <th>Komentar</th>
          </tr>        
        </thead>
        <tbody>
        <?php
        while ($row = $resultFeedback->fetch_assoc()) {
          echo "<tr>";
          echo "<td class='idUser'>" . htmlspecialchars($row['Id_User']) . "</td>";
          echo "<td><span class='nilai'>" . htmlspecialchars($row['nilai']) . "</span></td>";
          echo "<td><span class='kategori'>" . htmlspecialchars($row['kategori']) . "</span></td>";
          echo "<td><span class='komentar'>" . htmlspecialchars($row['komentar']) . "</span></td>";
          echo "</tr>";
        }
        ?>
        </tbody>

      </table>
      <br>
    </div>
  </d>
</body>
</html>