<?php
session_start(); // Memulai sesi PHP

// Sisipkan file koneksi ke database
require_once "db_connect.php";

// Misalnya, ambil nama pengguna dari session jika ada
$nama_user = isset($_SESSION['Nama_User']) ? $_SESSION['Nama_User'] : 'Pengguna'; // Ganti 'Nama_User' dengan key sesuai data sesi Anda
$user_id = isset($_SESSION['user_id']) ? $_SESSION['user_id'] : null;

if ($user_id === null) {
    die('User tidak teridentifikasi. Silakan login kembali.');
}

// Di sini kita akan menggunakan Kls02 (Fotografi) sebagai contoh
$id_kelas = "Kls02";

// Query untuk mengambil materi kelima sesuai dengan kelas Fotografi
$sql = "SELECT * FROM materi WHERE Id_Kelas = '$id_kelas' LIMIT 4, 1"; // Ambil baris kelima (indeks 4) untuk halaman foto5.php
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
    <script src="update_progress.js" defer></script>
    <style>
        .tandai-selesai {
            display: inline-block;
            padding: 20px 20px;
            color: #FFFFFF;
            background-color: #A93C00;
            border-radius: 7px;
            text-decoration: none;
            text-align: center;
            align-self: flex-end; /* Penempatan di pojok kanan bawah */
            margin-top: 0px;
            margin-bottom: 100px; /* Jarak dari bawah */
            margin-left: 60px;
            margin-right: 0px; /* Jarak dari kanan */
            box-shadow: 0 2px 3px rgba(0, 0, 0, 0.2); /* Efek bayangan untuk memberikan kedalaman */
        }

        .tandai-selesai:hover {
            background-color: #e0e0e0;
            color: #000000; /* Warna teks saat di-hover */
        }
    </style>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard.php">
        <img src="Logo.png" id="logo">
    </a>
    <h3><?php echo htmlspecialchars($nama_materi); ?></h3> <!-- Menggunakan htmlspecialchars untuk menghindari XSS -->
    <div class="progresWrap">
        <div class="progress-container">
            <div class="progress-bar" style="width: 100%;"></div> <!-- Persentase 100% -->
        </div>
        <p class="progress-score">100%</p>
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
    <!-- Tombol Mulai Quiz -->
    <p>Sudah selesai menonton?</p>
    <button id="mulaiQuizButton">Mulai Quiz</button>
    </section>

    <a href="#" class="tandai-selesai" onclick="updateProgress('<?php echo $user_id; ?>', '<?php echo $row['Id_Materi']; ?>', '<?php echo $id_kelas; ?>'); return false;">Tandai Selesai</a>

    <script>
    document.addEventListener('DOMContentLoaded', function() {
        // Mengarahkan ke halaman quizFotografi.php saat tombol diklik
        document.getElementById('mulaiQuizButton').addEventListener('click', function() {
            redirectToPage('quizFotografi.php');
        });
    });
    
    function redirectToPage(targetedPage) {
    window.location.href = targetedPage;
    }
    </script>

</main>
</body>
</html>
<?php
} else {
    echo "Tidak ada materi yang tersedia untuk kelas ini.";
}

// Tutup koneksi database
$conn->close();
?>
