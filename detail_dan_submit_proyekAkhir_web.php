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
      <h3>Pemrograman Web - Proyek Akhir</h3>
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
      <h2 class="judulProyek">Sistem Manajemen Toko Online</h2>
      <!--deskripsi proyek-->
      <h2 class="subTitle_proyek">Deskripsi Proyek</h2>
      <p class="paragraf">Sistem ini memungkinkan pemilik toko dapat menjalankan toko online secara efisien seperti dalam hal mengelola produk, 
        inventaris, pesanan, dan pelanggan mereka secara terpusat melalui antarmuka web yang responsif dan mudah digunakan.
        Pada web diharapkan terdapat beberapa fitur seperti untuk manajemen produk, pesanan, pelanggan, pencarian dan dilter serta checkout dan pembayaran
      </p>

      <!--gambaran umum dan tujuan-->
      <h2 class="subTitle_proyek">Gambaran Umum dan Tujuan Proyek</h2>
      <p class="paragraf">
        Fitur Utama:
        - Tambah, edit, dan hapus produk dengan deskripsi, gambar, harga, dan kategori.
        - Kelola stok produk dan status ketersediaan.
        - Lihat dan kelola pesanan yang masuk dari pelanggan.
        - Konfirmasi, proses, dan hapus pesanan.
        - Daftar dan kelola informasi pelanggan.
        - Lihat riwayat pembelian pelanggan dan status akun.
        - Pencarian produk berdasarkan nama, kategori, atau harga.
        - Filter produk untuk mempermudah navigasi pelanggan.
        - Integrasi dengan sistem pembayaran online (opsional).
        - Proses checkout yang aman dan mudah bagi pengguna.
        
        Desain:
        Antarmuka yang intuitif dan ramah pengguna dengan estetika modern dan minimalis. Penggunaan warna dan gambar yang mencerminkan 
        nilai-nilai keberlanjutan serta tata letak yang jelas dan mudah dinavigasi.

        Tujuan Proyek:
        Membuat platform e-commerce yang fungsional dan dapat diimplementasikan, mencakup aspek manajemen produk, pesanan, dan pelanggan 
        secara efisien.
      </p>

      <!--hasil akhir produk-->
      <h2 class="subTitle_proyek">Hasil Akhir yang Diharapkan</h2>
      <p class="paragraf">Hasil akhir proyek yang diharapkan berupa: 
        - Kode Sumber (HTML, CSS, JavaScript, dan backend (PHP, Python))
        - Dokumentasi lengkap seperti cara instalasi, konfigurasi, dan manual user
        - Presentasi atau laporan yang berisi ringkasan fitur - fitur
        - Video demo web 
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
