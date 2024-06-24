<?php
session_start();

include 'db_connect.php';

// Periksa apakah admin belum login, redirect ke halaman login jika belum
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

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
    $admin_name = htmlspecialchars($admin['Nama_Admin']);
} else {
    $admin_name = "Informasi admin tidak ditemukan";
}

// Ambil data proyek berdasarkan Id_Project
$id_project = 'PR01';
$sql_project = "SELECT * FROM projects WHERE Id_Projects = ?";
$stmt_project = $conn->prepare($sql_project);
$stmt_project->bind_param('s', $id_project);
$stmt_project->execute();
$result_project = $stmt_project->get_result();
$project = $result_project->fetch_assoc();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="editProyekAkhir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Proyek Akhir | Admin </title>
    <script src="proyekAkhir.js" defer></script>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard_admin.php">
        <img src="Logo.png" id="logo">
    </a>
    <h3>Desain UI/UX - Proyek Akhir</h3>
    <h4 class="halaman_admin">Halaman Admin</h4>
    <section class="profileAdjust">
        <img src="user.png">
        <h2><?php echo $admin_name; ?></h2>
    </section>
</header>
<main>
    <h1>Proyek Akhir</h1>
    <!--judul proyek akhir-->
    <section class="editable_nama_materi">
        <h2><?php echo htmlspecialchars($project['title']); ?></h2>
        <i class="fa-solid fa-pen-to-square" onclick="editMateriJudul()"></i>
    </section>
    <!--deskripsi produk-->
    <section class="editable_icon_video">
        <h2>Deskripsi Proyek</h2>
        <i class="fa-solid fa-pen-to-square" onclick="editSection(this, 'description')"></i>
    </section>
    <p class="paragraf"><?php echo htmlspecialchars($project['description']); ?></p>
    <!--gambaran umum dan tujuan-->
    <section class="editable_icon_video">
        <h2>Gambaran Umum dan Tujuan Proyek</h2>
        <i class="fa-solid fa-pen-to-square" onclick="editSection(this, 'overview')"></i>
    </section>
    <p class="paragraf"><?php echo htmlspecialchars($project['overview']); ?></p>
    <!--hasil akhir produk-->
    <section class="editable_icon_video">
        <h2>Hasil Akhir yang Diharapkan</h2>
        <i class="fa-solid fa-pen-to-square" onclick="editSection(this, 'results')"></i>
    </section>
    <p class="paragraf"><?php echo htmlspecialchars($project['results']); ?></p>
    <p class="paragraf paragrafNone">Gabung seluruh file menjadi satu dalam tautan <span class="googleDrive">google drive</span>.</p>
    <!--button goes to dashboard-->
    <section class="backToDashboard">
        <button onclick="redirectToPage('dashboard_admin.php')">
            <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
    </section>
</main>
</body>
</html>
