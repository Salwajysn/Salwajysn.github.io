<?php
require 'db_connect.php';

$error_message = "";

if ($_SERVER['REQUEST_METHOD'] == 'POST') {
    $Nama_User = $_POST['name'];
    $Tanggal = $_POST['tanggal'];
    $Bulan = $_POST['bulan'];
    $Tahun = $_POST['tahun'];
    $No_Telp_User = $_POST['pnumber'];
    $email = $_POST['email'];
    $Password_User = $_POST['pwd'];
    $Confirm_Password = $_POST['cpwd'];

    // Validasi input
    if ($Password_User != $Confirm_Password) {
        $error_message = "Kata sandi tidak cocok!";
    } else {
        // Cek apakah email sudah terdaftar
        $check_email_query = "SELECT * FROM user WHERE email='$email'";
        $result = $conn->query($check_email_query);

        if ($result->num_rows > 0) {
            $error_message = "Email sudah terdaftar! Silakan gunakan email lain.";
        } else {
            // Membuat ID unik untuk user
            $user_count_query = "SELECT COUNT(*) AS total_users FROM user";
            $result = $conn->query($user_count_query);
            $row = $result->fetch_assoc();
            $total_users = $row['total_users'];
            $Id_User = sprintf("User%03d", $total_users + 1);

            $Tanggal_Lahir_User = $Tahun . '-' . $Bulan . '-' . $Tanggal;

            // Simpan password langsung ke database tanpa hashing
            $sql = "INSERT INTO user (Id_User, Nama_User, Password_User, No_Telp_User, Tanggal_Lahir_User, email) 
                    VALUES ('$Id_User', '$Nama_User', '$Password_User', '$No_Telp_User', '$Tanggal_Lahir_User', '$email')";

            if ($conn->query($sql) === TRUE) {
                echo "<script>alert('Registrasi berhasil!'); window.location.href = 'login.php';</script>";
            } else {
                echo "Error: " . $sql . "<br>" . $conn->error;
            }

            // Setelah berhasil submit, kosongkan pesan error
            $error_message = "";
        }
    }
    $conn->close();
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Registrasi</title>
    <link rel="stylesheet" href="techthree.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
          integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
</head>
<body>
<!-- REGISTRATION -->
<header>
    <a id="logo_link" href="index.php">
        <img src="Logo.png" id="logo">
    </a>
</header>
<div class="container-regist">
    <div class="row">
        <div class="col">
            <form class="form-registration" action="registrasi.php" method="POST">
                <h1 style="text-align: center;"><b>DAFTAR</b></h1><br>
                <!-- Display error message if any -->
                <?php if (!empty($error_message)) : ?>
                    <div class="alert alert-danger" role="alert">
                        <?php echo $error_message; ?>
                    </div>
                <?php endif; ?>
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" placeholder="Masukkan nama lengkap" required><br>
                <label for="date">Tanggal Lahir</label>
                <div class="row">
                    <div class="col">
                        <input type="number" id="tanggal" name="tanggal" min="1" max="31" placeholder="Tanggal" required>
                    </div>
                    <div class="col">
                        <input type="number" id="bulan" name="bulan" min="1" max="12" placeholder="Bulan" required>
                    </div>
                    <div class="col">
                        <input type="number" id="tahun" name="tahun" min="1900" max="2099" placeholder="Tahun" required><br>
                    </div>
                </div><br>
                <label for="pnumber">No. Handphone</label>
                <input type="tel" id="pnumber" name="pnumber" placeholder="Masukkan No. Handphone" required><br>           
                <label for="email">Email</label>
                <input type="email" id="email" name="email" placeholder="Masukkan email aktif" required><br>
                <label for="pwd">Kata Sandi</label>
                <input type="password" id="pwd" name="pwd" placeholder="Masukkan min 8 karakter" required><br>
                <label for="cpwd">Ulangi Kata Sandi</label>
                <input type="password" id="cpwd" name="cpwd" placeholder="Masukkan min 8 karakter" required><br>
                <button class="button-regist" type="submit">Kirim</button>
                <a style="color: #811700;" href="login.php">Sudah punya akun?</a>
            </form>
        </div>
        <div class="col">
            <img id="img-regist" src="registrasi.png" alt="Registrasi Image">
        </div>
    </div>
</div>
</body>
</html>
