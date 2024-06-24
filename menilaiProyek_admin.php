<?php
session_start(); // Mulai sesi PHP

// Sisipkan file koneksi
require_once 'db_connect.php';

// Mengambil ID Admin dari session atau dari parameter yang dikirim
if (isset($_SESSION['admin_id'])) {
  $adminId = $_SESSION['admin_id'];
} else {
  // Handle case when admin is not logged in, redirect to login page or handle appropriately
  header("Location: login_admin.php");
  exit;
}

// Query untuk mengambil data admin berdasarkan ID
$query = "SELECT `Nama_Admin`, `No_Telp_Admin` FROM `admin` WHERE `Id_Admin`='$adminId'";
$result = $conn->query($query);

// Variabel untuk menyimpan data admin
$namaAdmin = "";
$noTelpAdmin = "";

if ($result->num_rows > 0) {
  // Loop through each row to fetch data
  while ($row = $result->fetch_assoc()) {
      $namaAdmin = $row['Nama_Admin'];
      $noTelpAdmin = $row['No_Telp_Admin'];
  }
} else {
  echo "Data admin tidak ditemukan.";
}

// Query untuk mengambil data submission
$sql = "SELECT Id_Submission, link_google_drive, submitted_at, Id_User FROM submission";
$result = $conn->query($sql);

// Memeriksa jika ada data yang diambil
if ($result->num_rows > 0) {
    $submissions = $result->fetch_all(MYSQLI_ASSOC); // Mengambil semua data dan menampungnya dalam array
} else {
    $submissions = []; // Jika tidak ada data, inisialisasi array kosong
}
?>

<!--HALAMAN WEB TECHTREE: MENILAI PROYEK PESERTA-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="menilaiProyek_admin.css">
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Nilai Proyek Akhir</title>
    <script src="nilaiProyek_peserta.js" defer></script>
  </head>

  <body>
    <header>
      <!--LOGO-->
      <a id="logo_link" href="dashboard_admin.php">
          <img src="Logo.png" id="logo">
      </a>
      <!--HEADER ADMIN-->
      <h3>Desain UI/UX - Proyek Akhir</h3>
      <h4 class="halaman_admin">Halaman Admin</h4>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <h2><?php echo htmlspecialchars($namaAdmin); ?></h2>
      </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
    <h1>Menilai Proyek Akhir Peserta</h1>
    <hr>

    <?php foreach ($submissions as $submission): ?>
        <div class="kotakDanNilai">
            <div class="kotakSubmit">
                <section class="profile_user">
                    <img src="user.png">
                    <p><?php echo $submission['Id_User']; ?></p>
                </section>
                <section class="link_submit">
                    <p>Link Submit:</p>
                    <a target="_blank" href="<?php echo $submission['link_google_drive']; ?>" class="link_proyek_submit">
                        <?php echo $submission['link_google_drive']; ?>
                    </a>
                </section>
            </div>
            <div class="kotak_nilai_sertif">
                <div class="kotak_untuk_menilai">
                    <button onclick="showInput(this)">Beri Nilai</button>
                    <input type="number" class="nilaiInput" style="display: none;" max="100">
                    <button onclick="saveNilai(this)"  style="display: none;">Simpan</button>
                    <p class="nilaiText"></p>
                </div>
                <script>
                    function showSuccessMessage() {
                        alert("Selamat, sertifikat berhasil dibuat!");
                    }  
                </script>       
                <div class="kotak_untuk_menilai" onclick="showSuccessMessage()">
                        <button>Buat Sertifikat</button>
                </div>    
            </div>
        </div>
    <?php endforeach; ?>

    <section class="backToDashboard">
        <button onclick="redirectToPage('dashboard_admin.php')">
            <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
    </section>
</main>
