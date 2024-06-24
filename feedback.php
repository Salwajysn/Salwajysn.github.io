<?php
session_start();

// Mengambil ID User dari session atau dari parameter yang dikirim
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Handle case when user is not logged in, redirect to login page or handle appropriately
    header("Location: login.php");
    exit;
}

// Include file koneksi database
include 'db_connect.php';

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

// Variabel untuk menampung pesan sukses atau error
$message = '';

// Memproses pengiriman data dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Validasi dan bersihkan input
    $rating = isset($_POST['rating']) ? $_POST['rating'] : '';
    $kategori_masukan = isset($_POST['kategori_masukan']) ? $_POST['kategori_masukan'] : '';
    $pesan_detail = isset($_POST['pesan-detail']) ? $_POST['pesan-detail'] : '';

    // Konversi rating menjadi string
    switch ($rating) {
        case '1':
            $ratingString = 'Sangat Buruk';
            break;
        case '2':
            $ratingString = 'Buruk';
            break;
        case '3':
            $ratingString = 'Netral';
            break;
        case '4':
            $ratingString = 'Baik';
            break;
        case '5':
            $ratingString = 'Sangat Baik';
            break;
        default:
            $ratingString = '';
            break;
    }

    // Query untuk menyimpan feedback ke dalam database
    $query = "INSERT INTO feedback (Id_User, nilai, kategori, komentar) VALUES ('$userId', '$ratingString', '$kategori_masukan', '$pesan_detail')";

    if ($conn->query($query) === TRUE) {
        // Mendapatkan ID feedback yang baru saja dimasukkan
        $feedbackId = $conn->insert_id;

        // Format id_feedback dalam format 'fdbck01', 'fdbck02', dst.
        $id_feedback = 'fdbck' . str_pad($feedbackId, 2, '0', STR_PAD_LEFT);

        // Set pesan sukses
        $message = "Feedback berhasil disimpan. ID Feedback: $id_feedback";
    } else {
        // Jika terjadi error saat menyimpan
        $message = "Error: " . $query . "<br>" . $conn->error;
    }
}
?>

<!-- HALAMAN WEB TECHTREE: HALAMAN FEEDBACK USER -->
<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="feedback.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Feedback</title>
    <script src="dashboard.js" defer></script>
    <script>
        // Fungsi untuk menampilkan alert
        function showFeedbackAlert() {
            alert("<?php echo $message; ?>");
        }
    </script>
</head>

<body>
<header>
    <a id="logo_link" href="dashboard.php">
        <img src="Logo.png" id="logo">
    </a>
    <nav id="nav_header">
        <a href="feedback.php" class="circle-container">
            <img class="circle-img" src="feedback.png">
        </a>
        <p onclick="toggleMenu()" class="circle-container">
            <img class="circle-img" src="user.png">
        </p>
        <div id="subMenu" class="subMenu-wrap">
            <div class="subMenu">
                <div class="user-info">
                    <img src="user.png">
                    <h2><?php echo htmlspecialchars($namaUser); ?></h2>
                </div>
                <hr>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('dashboardContent', 'dashboard.php')">
                    <img src="dashboardIcon.png">
                    <p>Dashboard</p>
                </a>
                <a href="profile.php" class="sub-menu-link">
                    <img src="profileIcon.png">
                    <p>Profil</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('kelasBootcampContent', 'dashboard.php')">
                    <img src="kelasSayaIcon.png">
                    <p>Kelas Bootcamp</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('proyekAkhirContent', 'dashboard.php')">
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
                <a href="#" id="logOut" class="sub-menu-link">
                    <img src="logOut.png">
                    <p>Keluar</p>
                </a>
            </div>
        </div>
    </nav>
</header>

<main>
    <h1>Feedback / Masukan</h1>
    <hr>
    <form action="feedback.php" method="POST" onsubmit="showFeedbackAlert()">
        <div>
            <label>Secara keseluruhan, bagaimana Anda menilai pengalaman Anda di situs web TechThree?</label>
            <div class="emojiRating">
                <label>
                    <input type="radio" name="rating" value="1">
                    <i class="fa-regular fa-face-sad-tear"></i>
                    <span>Sangat Buruk</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="2">
                    <i class="fa-regular fa-face-frown"></i>
                    <span>Buruk</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="3">
                    <i class="fa-regular fa-face-meh"></i>
                    <span>Netral</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="4">
                    <i class="fa-regular fa-face-smile-beam"></i>
                    <span>Baik</span>
                </label>
                <label>
                    <input type="radio" name="rating" value="5">
                    <i class="fa-regular fa-face-grin-hearts"></i>
                    <span>Sangat Baik</span>
                </label>
            </div>

            <div class="class_form">
                <label for="kategori_masukan">Kategori Masukan</label>
                <select id="kategori_masukan" name="kategori_masukan">
                    <option value="masalah-bug">Masalah/Bug</option>
                    <option value="saran-website">Saran Website/Request Fitur</option>
                    <option value="masukan-umum">Masukan Umum</option>
                </select>
            </div>

            <div class="class_form">
                <label for="pesan-detail">Apakah ada hal spesifik yang harus kami ketahui lebih lanjut?</label>
                <textarea name="pesan-detail" id="pesan-detail"></textarea>
            </div>

            <input type="submit" name="submit" value="Submit">
        </div>
    </form>
</main>
</body>
</html>
