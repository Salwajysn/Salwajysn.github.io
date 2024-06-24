<?php
// proses_nilai.php

session_start(); // Mulai session

// Sisipkan file koneksi ke database
include 'db_connect.php';

// Ambil Id_Admin dari session
if (isset($_SESSION['id_admin'])) {
    $idAdmin = $_SESSION['id_admin'];
} else {
    // Jika session Id_Admin tidak tersedia (misalnya, belum login), kembalikan respons error
    echo json_encode(array("status" => "error", "message" => "Admin belum login"));
    exit;
}

// Ambil data POST dari frontend
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Pastikan data yang diterima adalah angka untuk nilai
    $nilai = isset($_POST['nilai']) ? intval($_POST['nilai']) : null;
    $idTugas = isset($_POST['id_tugas']) ? intval($_POST['id_tugas']) : null;

    // Validasi input (misalnya, pastikan nilai antara 0-100)
    if ($nilai !== null && $nilai >= 0 && $nilai <= 100 && $idTugas !== null) {
        // Siapkan query untuk memasukkan nilai ke tabel nilai_tugas
        $query = "INSERT INTO tugas (Id_Admin, Id_Tugas, nilai_tugas) VALUES (?, ?, ?)";
        
        // Gunakan prepared statement untuk menghindari SQL injection
        $stmt = $conn->prepare($query);
        $stmt->bind_param("sii", $idAdmin, $idTugas, $nilai);
        
        // Jalankan query
        if ($stmt->execute()) {
            // Jika sukses, kembalikan respons berhasil
            echo json_encode(array("status" => "success", "message" => "Nilai berhasil disimpan"));
        } else {
            // Jika gagal, kembalikan respons gagal
            echo json_encode(array("status" => "error", "message" => "Gagal menyimpan nilai"));
        }
        
        // Tutup statement
        $stmt->close();
    } else {
        // Jika ada kesalahan validasi data
        echo json_encode(array("status" => "error", "message" => "Data tidak valid"));
    }
} else {
    // Jika bukan metode POST
    http_response_code(405); // Method Not Allowed
    echo json_encode(array("status" => "error", "message" => "Metode request tidak diizinkan"));
}

// Tutup koneksi database
$conn->close();
?>
