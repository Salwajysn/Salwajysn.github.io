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

// Tangkap input dari form
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $link_google_drive = $_POST['project_submit'];

    // Prepared statement untuk memasukkan data ke database
    $stmt = $conn->prepare("INSERT INTO submission (Id_Submission, link_google_drive, submitted_at, Id_User, Id_Kelas) VALUES (?, ?, NOW(), ?, ?)");

    // Generate Id_Submission secara unik (misalnya menggunakan UUID)
    $idSubmission = uniqid('SUB');

    // Tentukan nilai Id_Kelas, disini kita menggunakan 'Kls01'
    $idKelas = 'Kls01';

    // Bind parameters ke statement
    $stmt->bind_param("ssss", $idSubmission, $link_google_drive, $userId, $idKelas);

    // Eksekusi statement
    if ($stmt->execute()) {
        echo "Proyek berhasil disubmit.";
    } else {
        echo "Gagal menyimpan proyek: " . $stmt->error;
    }

    // Tutup statement
    $stmt->close();
}

// Tutup koneksi
$conn->close();
?>
