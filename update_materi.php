<?php
// update_materi.php

// Include db_connect.php to connect to database
include 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $idMateri = $_POST['idMateri'];

    if (isset($_POST['newJudul'])) {
        $newJudul = $_POST['newJudul'];
        $query = "UPDATE materi SET Nama_Materi = '$newJudul' WHERE Id_Materi = '$idMateri'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Judul materi berhasil diperbarui.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    } elseif (isset($_POST['newLink'])) {
        $newLink = $_POST['newLink'];
        $query = "UPDATE materi SET video_link = '$newLink' WHERE Id_Materi = '$idMateri'";
        $result = mysqli_query($conn, $query);

        if ($result) {
            echo "Link video berhasil diperbarui.";
        } else {
            echo "Error: " . mysqli_error($conn);
        }
    }
}

// Close database connection
mysqli_close($conn);
?>
