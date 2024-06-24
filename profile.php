<?php
// Include file koneksi database
include 'db_connect.php';

// Memulai session (jika belum dimulai)
session_start();

// Mengambil ID User dari session atau dari parameter yang dikirim
if (isset($_SESSION['user_id'])) {
    $userId = $_SESSION['user_id'];
} else {
    // Handle case when user is not logged in, redirect to login page or handle appropriately
    header("Location: login.php");
    exit;
}

// Query untuk mengambil data user berdasarkan ID
$query = "SELECT `Nama_User`, `No_Telp_User`, `email` FROM `user` WHERE `Id_User`='$userId'";
$result = $conn->query($query);

// Variabel untuk menyimpan data pengguna
$namaUser = "";
$noTelpUser = "";
$emailUser = "";

if ($result->num_rows > 0) {
    // Loop through each row to fetch data
    while ($row = $result->fetch_assoc()) {
        $namaUser = $row['Nama_User'];
        $noTelpUser = $row['No_Telp_User'];
        $emailUser = $row['email'];
    }
} else {
    echo "Data user tidak ditemukan.";
}

// Jika form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $pnumber = $_POST['pnumber'];
    $email = $_POST['email'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    // Validasi dan proses perubahan data
    if (!empty($name)) {
        // Update data user di tabel user
        $updateFields = "`Nama_User`='$name', `No_Telp_User`='$pnumber', `email`='$email'";
        
        // Jika password diisi dan sesuai dengan konfirmasi
        if (!empty($pwd) && $pwd == $cpwd) {
            $updateFields .= ", `Password_User`='$pwd'";
        }

        $updateUserQuery = "UPDATE `user` SET $updateFields WHERE `Id_User`='$userId'";

        // Eksekusi query update
        if ($conn->query($updateUserQuery) === TRUE) {
            echo "Data user berhasil diperbarui.";
            
            // Set ulang nilai namaUser, noTelpUser, emailUser setelah berhasil update
            $namaUser = $name;
            $noTelpUser = $pnumber;
            $emailUser = $email;
        } else {
            echo "Error: " . $updateUserQuery . "<br>" . $conn->error;
        }
    } else {
        echo "Nama lengkap harus diisi.";
    }
}
?>

<!DOCTYPE html>
<html>
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">
    <title>Profile</title>
    <link rel="stylesheet" href="techthree.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="dashboard.js" defer></script>
    <script src="profile.js" defer></script>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard.php">
        <img src="Logo.png" id="logo">
    </a>
    <!--Navigasi halaman lapor keluh kesah dan profile-->
    <nav id="nav_header">
        <!--Navigasi Feedback/Lapor-->
        <a href="feedback.php" class="circle-container">
            <img class="circle-img" src="feedback.png">
        </a>
        <!--Navigasi Halaman Profile-->
        <p id="userProf" onclick="toggleMenu()" class="circle-container">
            <img class="circle-img" src="user.png">
        </p>
        <!--dropdown menu-->
        <div id="subMenu" class="subMenu-wrap">
            <div class="subMenu">
                <div class="user-info">
                    <img src="user.png">
                    <h2><?php echo htmlspecialchars($namaUser); ?></h2>
                </div>
                <hr>
                <!--link-->
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('dashboardContent', 'dashboard.php')">
                    <img src="dashboardIcon.png">
                    <p>Dashboard</p>
                </a>
                <a href="profile.php" class="sub-menu-link">
                    <img src="profileIcon.png">
                    <p>Profile</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('kelasBootcampContent', 'dashboard.php')">
                    <img src="kelasSayaIcon.png">
                    <p>Kelas Bootcamp</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('proyekAkhirContent', 'dashboard.php')">
                    <img src="projectIcon.png">
                    <p>Proyek Akhir</p>
                </a>
                <a href="#" class="sub-menu-link">
                    <img src="certificateIcon.png">
                    <p>Sertifikat</p>
                </a>
                <a href="feedback.php" class="sub-menu-link">
                    <img src="feedback.png">
                    <p>Feedback</p>
                </a>
                <!--log out-->
                <a href="#" id="logOut" class="sub-menu-link">
                    <img src="logOut.png">
                    <p>Keluar</p>
                </a>
            </div>
        </div>
    </nav>
</header>
<h1 id="h1-p"><b>My Profile</b></h1>
<div class="container-profile">
    <div class="row">
        <div class="col" id="my-profile">
            <img src="user.png" id="profilePicture" class="default-avatar" onclick="changeAvatar()" alt="Ava Image">
            <h3 class="h-p"><b><?php echo htmlspecialchars($namaUser); ?></b></h3>
            <h6 class="h-p"><?php echo htmlspecialchars($emailUser); ?></h6>
            <h6 class="h-p"><?php echo htmlspecialchars($noTelpUser); ?></h6>
        </div>

        <div class="col">
            <form id="edit-profile" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 style="text-align: center"><b><u>Edit Profile</u></b></h4>
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($namaUser); ?>" placeholder="Masukkan nama lengkap"><br>
                <label for="pnumber">No. Handphone</label>
                <input type="tel" id="pnumber" name="pnumber" value="<?php echo htmlspecialchars($noTelpUser); ?>" placeholder="Masukkan No. Handphone baru"><br>           
                <label for="email">Email</label>
                <input type="email" id="email" name="email" value="<?php echo htmlspecialchars($emailUser); ?>" placeholder="Masukkan email aktif baru"><br>
                <div class="row" id="sandi-profile">
                    <div class="col">
                        <label for="pwd">Kata Sandi</label>
                        <input type="password" id="pwd" name="pwd" placeholder="Masukkan kata sandi baru"><br>
                    </div>
                    <div class="col">
                        <label for="cpwd">Ulangi Kata Sandi</label>
                        <input type="password" id="cpwd" name="cpwd" placeholder="Ulangi kata sandi baru"><br>
                    </div>
                </div><br>
                <button class="button-regist" type="submit">Edit</button>
            </form>
        </div>                    
    </div>
</div>
</body>
</html>
