<?php
session_start(); // Mulai sesi PHP

// Sisipkan file koneksi ke database
require_once "db_connect.php";

// Misalnya, ambil nama pengguna dari session jika ada
$nama_user = isset($_SESSION['Nama_User']) ? $_SESSION['Nama_User'] : 'Pengguna'; // Ganti 'Nama_User' dengan key sesuai data sesi Anda

// Di sini kita akan menggunakan Kls01 (UI/UX) sebagai contoh
$id_kelas = "Kls01";

// Query untuk mengambil satu materi sesuai dengan kelas UI/UX
$sql = "SELECT * FROM materi WHERE Id_Kelas = '$id_kelas' LIMIT 1"; // Hanya ambil satu baris pertama
$result = $conn->query($sql);

// Inisialisasi variabel untuk nama materi dan link video
$nama_materi = '';
$video_link = '';

if ($result->num_rows > 0) {
    // Ambil data dari baris hasil query
    $row = $result->fetch_assoc();
    $nama_materi = $row['Nama_Materi'];
    $video_link = $row['video_link'];

    // Langkah 3: Tampilkan data dalam template HTML
?>
<!-- HALAMAN WEB TECHTREE: MATERI VIDEO -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="materi.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Materi Kelas</title>
    <script src="kelasBootcamp.js" defer></script>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard.php">
        <img src="Logo.png" id="logo">
    </a>
    <h3><?php echo htmlspecialchars($nama_materi); ?></h3> <!-- Menggunakan htmlspecialchars untuk menghindari XSS -->
    <div class="progresWrap">
        <div class="progress-container">
            <div class="progress-bar"></div>
        </div>
        <p class="progress-score">20%</p>
        <p class="materiSelesai">Materi sudah diselesaikan</p>
    </div>
    <section class="profileAdjust">
        <img src="user.png">
        <p><?php echo htmlspecialchars($nama_user); ?></p> <!-- Menggunakan variabel $nama_user -->
    </section>
</header>

<main>
    <h1>Materi</h1>
    <?php if (!empty($nama_materi)): ?>
        <h2><?php echo htmlspecialchars($nama_materi); ?></h2>
        <!-- Tampilkan video dari YouTube sesuai dengan video_link dari database -->
        <?php if (!empty($video_link)): ?>
            <iframe width="420" height="315" src="<?php echo htmlspecialchars($video_link); ?>" allowfullscreen frameborder="0"></iframe>
        <?php else: ?>
            <p>Video tidak tersedia</p>
        <?php endif; ?>
    <?php endif; ?>

    <section class="mulaiQuiz">
        <p>Sudah selesai menonton?</p>
        <button>Mulai Quiz</button>
    </section>
</main>
</body>
</html>
<?php
} else {
    echo "Tidak ada materi yang tersedia untuk kelas ini.";
}

// Langkah 4: Tutup koneksi database
$conn->close();
?>
