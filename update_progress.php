<?php
session_start();
require_once "db_connect.php";

if ($_SERVER['REQUEST_METHOD'] === 'POST') {
    $userId = $_POST['userId'];
    $materiId = $_POST['materiId'];
    $kelasId = $_POST['kelasId'];

    // Escape input untuk menghindari SQL Injection
    $userId = $conn->real_escape_string($userId);
    $materiId = $conn->real_escape_string($materiId);
    $kelasId = $conn->real_escape_string($kelasId);

    // Hitung progres baru
    $sql = "SELECT percentage FROM progress WHERE Id_User = '$userId' AND Id_Kelas = '$kelasId'";
    $result = $conn->query($sql);
    if ($result->num_rows > 0) {
        $row = $result->fetch_assoc();
        $currentPercentage = $row['percentage'];
        $newPercentage = min($currentPercentage + 20, 100); // Progres tidak boleh melebihi 100%

        // Update progres di database
        $sql = "UPDATE progress SET percentage = '$newPercentage', updated_at = NOW() WHERE Id_User = '$userId' AND Id_Kelas = '$kelasId'";
    } else {
        // Jika tidak ada progres sebelumnya, buat yang baru
        $newPercentage = 20;
        $sql = "INSERT INTO progress (Id_Progress, Id_User, Id_Materi, Id_Kelas, percentage, created_at, updated_at)
                VALUES (UUID(), '$userId', '$materiId', '$kelasId', '$newPercentage', NOW(), NOW())";
    }

    if ($conn->query($sql) === TRUE) {
        echo "Progres berhasil diupdate";
    } else {
        echo "Error: " . $sql . "<br>" . $conn->error;
    }
} else {
    echo "Metode request tidak valid.";
}

$conn->close();
?>
