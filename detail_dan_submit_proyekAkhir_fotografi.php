<?php
session_start(); // Mulai sesi PHP

// Include file koneksi database
include 'db_connect.php';

// Mengambil ID User dari session atau dari parameter yang dikirim
if (isset($_SESSION['user_id'])) {
  $userId = $_SESSION['user_id'];
} else {
  // Handle case when user is not logged in, redirect to login page or handle appropriately
  header("Location: login.php");
  exit;
}

// Query untuk mengambil data user berdasarkan ID
$query = "SELECT `Nama_User` FROM `user` WHERE `Id_User`='$userId'";
$result = $conn->query($query);

// Variabel untuk menampilkan nama pengguna
$namaUser = '';

if ($result->num_rows > 0) {
  // Loop through each row to fetch data
  while ($row = $result->fetch_assoc()) {
      $namaUser = $row['Nama_User'];
  }
} else {
  echo "Data user tidak ditemukan.";
}

// Tangkap input dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link_google_drive = $_POST['project_submit'];

    // Prepared statement untuk memasukkan data ke database
    $stmt = $conn->prepare("INSERT INTO submission (link_google_drive) VALUES (?)");
    $stmt->bind_param("s", $link_google_drive);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Proyek berhasil disubmit.";
    } else {
        echo "Gagal menyimpan proyek: " . $stmt->error;
    }

    // Tutup statement dan koneksi
    $stmt->close();
    $conn->close();
}
?>

<!--HALAMAN WEB TECHTREE: DETAIL DAN SUBMIT PROYEK AKHIR-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="detail_dan_submit_proyekAkhir.css">
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Proyek Akhir</title>
    <script src="proyekAkhir.js" defer></script>
    <script src="update_user_page.js"></script>
  </head>

  <body>
    <header>
      <!--LOGO-->
      <a id="logo_link" href="dashboard.php">
          <img src="Logo.png" id="logo">
      </a>
      <!--PROYEK AKHIR-->
      <h3>Fotografi - Proyek Akhir</h3>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <h2><?php echo htmlspecialchars($namaUser); ?></h2>
      </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
      <h1>Proyek Akhir</h1>
      <!--judul proyek akhir-->
      <h2 class="judulProyek">Portraiture through Cultural Lens</h2>
      <!--deskripsi proyek-->
      <h2 class="subTitle_proyek">Deskripsi Proyek</h2>
      <p class="paragraf">Peserta akan mengembangkan kemampuan fotografi potret mereka dengan fokus pada lensa budaya. Mereka akan diminta untuk menangkap 
        esensi kehidupan sehari-hari, ekspresi wajah, dan cerita melalui fotografi potret yang menggambarkan keanekaragaman budaya di sekitar 
        mereka. Tugas ini menggabungkan teknik fotografi potret, penggunaan cahaya, komposisi, serta kemampuan untuk membangun hubungan 
        dengan subjek foto.
      </p>

      <!--gambaran umum dan tujuan-->
      <h2 class="subTitle_proyek">Gambaran Umum dan Tujuan Proyek</h2>
      <p class="paragraf">
        Fitur Utama:
        - Fokus pada budaya
        - Narasi visual yang kuat dalam menghubungkan tiap foto

        Tujuan Proyek:
        - Memberikan pengalaman mendalam dalam fotografi potret dengan sudut pandang budaya yang kuat
        - Memahami bagaimana latar belakang budaya seseorang dapat mempengaruhi ekspresi dan identitas
        - Belajar menceritakan cerita melalui foto
        - Mengasah keterampilan dalam berinteraksi dengan subjek foto dari latar belakang budaya yang berbeda
      </p>

      <!--hasil akhir produk-->
      <h2 class="subTitle_proyek">Hasil Akhir yang Diharapkan</h2>
      <p class="paragraf">Hasil akhir proyek yang diharapkan berupa: 
        Portofolio digital
        Video presentasi
      </p>
      <p class="paragraf paragrafNone">Gabung seluruh file menjadi satu dalam tautan <span class="googleDrive">google drive</span>.</p>

      <!--form pengumpulan proyek-->
        <h2 class="subTitle_proyek">Submit Proyek</h2>
        <form action="submit_project.php" method="post">
        <input id="project_submit" type="url" name="project_submit" placeholder="Masukkan Link Google Drive" required>
        <input type="submit">
        </form>

      <!--button goes to dashboard-->
      <section class="backToDashboard">
        <button onclick="redirectToPage('dashboard.php')">
          <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
      </section>
    </main>
  </body>
</html>
