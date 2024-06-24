<?php
session_start();

include 'db_connect.php';

// Periksa apakah admin belum login, redirect ke halaman login jika belum
if (!isset($_SESSION['admin_logged_in']) || $_SESSION['admin_logged_in'] !== true) {
    header('Location: login.php');
    exit;
}

// Ambil data yang dikirim melalui POST
$field = $_POST['field'];
$value = $_POST['value'];

// Validasi input
$allowed_fields = ['title', 'description', 'overview', 'results'];
if (!in_array($field, $allowed_fields)) {
    echo "Field tidak valid.";
    exit;
}

// Ambil jenis proyek dari referer URL (dapat dikembangkan lebih lanjut untuk keamanan)
if (strpos($_SERVER['HTTP_REFERER'], 'editProyekAkhir_admin.php') !== false) {
    $id_project = 'PR01'; // Id_Project untuk UI/UX
} elseif (strpos($_SERVER['HTTP_REFERER'], 'editProyekAkhir_fotografi_admin.php') !== false) {
    $id_project = 'PR02'; // Id_Project untuk Fotografi
} elseif (strpos($_SERVER['HTTP_REFERER'], 'editProyekAkhir_web_admin.php') !== false) {
    $id_project = 'PR03'; // Id_Project untuk Web
} else {
    echo "Referer tidak valid.";
    exit;
}

// Siapkan pernyataan SQL untuk memperbarui data proyek
$sql = "UPDATE projects SET $field = ? WHERE Id_Projects = ?";
$stmt = $conn->prepare($sql);
$stmt->bind_param('ss', $value, $id_project); // Bind parameter untuk value dan id_project

if ($stmt->execute()) {
    echo "Data proyek berhasil diperbarui";
} else {
    echo "Terjadi kesalahan saat memperbarui data proyek";
}
?>
