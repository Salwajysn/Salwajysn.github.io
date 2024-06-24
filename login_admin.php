<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = isset($_POST['identifier']) ? trim($_POST['identifier']) : '';
    $password = isset($_POST['pwd']) ? trim($_POST['pwd']) : '';

    // Query untuk mencari admin berdasarkan Id_Admin
    $sql = "SELECT * FROM admin WHERE Id_Admin = ?";
    $stmt = $conn->prepare($sql);

    if ($stmt === false) {
        die("Error preparing statement: " . $conn->error);
    }

    $stmt->bind_param('s', $identifier);
    $stmt->execute();
    $result = $stmt->get_result();

    if ($result === false) {
        die("Error executing query: " . $stmt->error);
    }

    $admin = $result->fetch_assoc();

    if ($admin) {
        // Menggunakan perbandingan string langsung, atau password_verify jika password dienkripsi
        if ($password === $admin['Password_Admin']) {
            $_SESSION['admin_logged_in'] = true;
            $_SESSION['admin_id'] = $admin['Id_Admin'];
            $_SESSION['admin_name'] = $admin['Nama_Admin'];

            // Redirect ke dashboard admin
            header('Location: dashboard_admin.php');
            exit;
        } else {
            // Jika password salah, tampilkan pesan error
            echo "<div class='alert alert-danger' role='alert'>Password admin salah</div>";
        }
    } else {
        // Jika tidak ada admin yang ditemukan, coba cari di tabel user
        $sql_user = "SELECT * FROM user WHERE email = ?";
        $stmt_user = $conn->prepare($sql_user);
        $stmt_user->bind_param('s', $identifier);
        $stmt_user->execute();
        $result_user = $stmt_user->get_result();
        $user = $result_user->fetch_assoc();

        // Jika user ditemukan
        if ($user) {
            // Verifikasi password user dari database
            if ($password === $user['Password_User']) {
                $_SESSION['user_id'] = $user['Id_User'];
                $_SESSION['user_email'] = $user['email'];

                // Redirect ke dashboard user
                header("location: dashboard.php");
                exit();
            } else {
                echo "<div class='alert alert-danger' role='alert'>Password user salah</div>";
            }
        } else {
            // Jika tidak ada user yang ditemukan
            echo "<div class='alert alert-danger' role='alert'>User tidak ditemukan</div>";
        }
    }
} else {
    // Jika bukan metode POST, redirect ke halaman login
    header('Location: login_admin.php');
    exit;
}
?>
