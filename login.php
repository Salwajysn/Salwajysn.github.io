<?php
session_start();
require_once 'db_connect.php';

if ($_SERVER["REQUEST_METHOD"] == "POST") {
    $identifier = $_POST['identifier'];
    $password = $_POST['pwd'];

    // Debugging: Cek nilai identifier dan password
    // echo "Identifier: $identifier, Password: $password";

    // Query untuk mencari admin berdasarkan Id_Admin
    $sql_admin = "SELECT * FROM admin WHERE Id_Admin = ?";
    $stmt_admin = $conn->prepare($sql_admin);
    $stmt_admin->bind_param('s', $identifier);
    $stmt_admin->execute();
    $result_admin = $stmt_admin->get_result();
    $admin = $result_admin->fetch_assoc();

    // Jika admin ditemukan
    if ($admin) {
        // Verifikasi password admin dari database
        // Debugging: Cek password yang diambil dari database
        // echo "Password dari DB: " . $admin['Password_Admin'];
        
        if ($password === $admin['Password_Admin']) {
            $_SESSION['admin_id'] = $admin['Id_Admin'];
            $_SESSION['admin_name'] = $admin['Nama_Admin'];

            // Redirect ke dashboard admin
            header("location: dashboard_admin.php");
            exit();
        } else {
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
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Login</title>
    <link rel="stylesheet" href="techthree.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
    <!-- LOGIN -->
    <header>
        <a id="logo_link" href="index.php">
            <img src="Logo.png" id="logo">
        </a>
    </header>
    <div class="container-login">
        <div class="row">
            <div class="col">
                <img id="img-regist" src="login.png" alt="Login Image">
            </div>
            <div class="col">
                <form class="form-login" action="login_admin.php" method="POST">
                    <h1 style="text-align: center;"><b>MASUK</b></h1><br>
                    <label for="identifier">User ID</label>
                    <input type="text" id="identifier" name="identifier" placeholder="Masukkan User ID" required><br>
                    <label for="pwd">Kata Sandi</label>
                    <input type="password" id="pwd" name="pwd" placeholder="Masukkan min 8 karakter" required><br>
                    <button class="button-login" type="submit">Submit</button>
                    <a style="color: #811700;" href="registrasi.php">Belum punya akun?</a>
                </form>
                </form>
            </div>
        </div>
    </div>
</body>
</html>
