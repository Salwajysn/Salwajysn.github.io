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
    // Simpan nama admin
    $admin_name = htmlspecialchars($admin['Nama_Admin']);
} else {
    // Handle jika admin tidak ditemukan, sesuai kebutuhan aplikasi Anda
    $admin_name = "Informasi admin tidak ditemukan";
}

// Ambil detail proyek dari database berdasarkan id_project
$id_project = 'PR03'; // Ganti dengan id_project yang ingin diedit
$sql_project = "SELECT * FROM projects WHERE Id_Projects = ?";
$stmt_project = $conn->prepare($sql_project);
$stmt_project->bind_param('s', $id_project);
$stmt_project->execute();
$result_project = $stmt_project->get_result();
$project = $result_project->fetch_assoc();

// Pastikan $project tidak null sebelum digunakan
if ($project) {
    // Simpan data proyek
    $project_id = htmlspecialchars($project['Id_Projects']);
    $id_kelas = htmlspecialchars($project['Id_Kelas']); // Simpan id_kelas untuk keperluan update
    $project_title = htmlspecialchars($project['title']);
    $project_description = htmlspecialchars($project['description']);
    $project_overview = htmlspecialchars($project['overview']);
    $project_results = htmlspecialchars($project['results']);
} else {
    // Handle jika proyek tidak ditemukan
    $project_id = "Proyek tidak ditemukan";
    $id_kelas = ""; // Sesuaikan jika tidak ditemukan
    $project_title = "";
    $project_description = "";
    $project_overview = "";
    $project_results = "";
}

$stmt->close();
$stmt_project->close();
$conn->close();
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="editProyekAkhir.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Proyek Akhir | Admin</title>
    <script src="proyekAkhir.js" defer></script>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard_admin.php">
        <img src="Logo.png" id="logo">
    </a>
    <h3>Pemrograman Web - Proyek Akhir</h3>
    <h4 class="halaman_admin">Halaman Admin</h4>
    <section class="profileAdjust">
        <img src="user.png">
        <h2><?php echo $admin_name; ?></h2>
    </section>
</header>
<main>
    <h1>Proyek Akhir</h1>
    <form id="editProjectForm" method="POST" action="update_data_project.php">
        <!-- Input tersembunyi untuk ID proyek -->
        <input type="hidden" name="project_id" value="<?php echo $project_id; ?>">
        <!-- Input tersembunyi untuk ID kelas -->
        <input type="hidden" name="id_kelas" value="<?php echo $id_kelas; ?>">
        <section class="editable_nama_materi">
            <h2 id="projectTitle"><?php echo $project_title; ?></h2>
            <i class="fa-solid fa-pen-to-square" onclick="editMateriJudul()"></i>
            <input type="hidden" id="hiddenProjectTitle" name="title" value="<?php echo $project_title; ?>">
        </section>
        <section class="editable_icon_video">
            <h2>Deskripsi Proyek</h2>
            <i class="fa-solid fa-pen-to-square" onclick="editSection(this)"></i>
            <input type="hidden" id="hiddenProjectDescription" name="description" value="<?php echo $project_description; ?>">
        </section>
        <p id="projectDescription" class="paragraf"><?php echo $project_description; ?></p>
        <section class="editable_icon_video">
            <h2>Gambaran Umum dan Tujuan Proyek</h2>
            <i class="fa-solid fa-pen-to-square" onclick="editSection(this)"></i>
            <input type="hidden" id="hiddenProjectOverview" name="overview" value="<?php echo $project_overview; ?>">
        </section>
        <p id="projectOverview" class="paragraf"><?php echo $project_overview; ?></p>
        <section class="editable_icon_video">
            <h2>Hasil Akhir yang Diharapkan</h2>
            <i class="fa-solid fa-pen-to-square" onclick="editSection(this)"></i>
            <input type="hidden" id="hiddenProjectResults" name="results" value="<?php echo $project_results; ?>">
        </section>
        <p id="projectResults" class="paragraf"><?php echo $project_results; ?></p>
        <p class="paragraf paragrafNone">Gabung seluruh file menjadi satu dalam tautan <span class="googleDrive">google drive</span>.</p>

    </form>
    <section class="backToDashboard">
            <button onclick="redirectToPage('dashboard_admin.php')">
                <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard
            </button>
        </section>
</main>
</body>
</html>
