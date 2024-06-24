<?php
// Include file koneksi database
include 'db_connect.php';

// Memulai session (jika belum dimulai)
session_start();

// Mengambil ID Admin dari session atau dari parameter yang dikirim
if (isset($_SESSION['admin_id'])) {
    $adminId = $_SESSION['admin_id'];
} else {
    // Handle case when admin is not logged in, redirect to login page or handle appropriately
    header("Location: login_admin.php");
    exit;
}

// Query untuk mengambil data admin berdasarkan ID
$query = "SELECT `Nama_Admin`, `No_Telp_Admin` FROM `admin` WHERE `Id_Admin`='$adminId'";
$result = $conn->query($query);

// Variabel untuk menyimpan data admin
$namaAdmin = "";
$noTelpAdmin = "";

if ($result->num_rows > 0) {
    // Loop through each row to fetch data
    while ($row = $result->fetch_assoc()) {
        $namaAdmin = $row['Nama_Admin'];
        $noTelpAdmin = $row['No_Telp_Admin'];
    }
} else {
    echo "Data admin tidak ditemukan.";
}

// Jika form disubmit dengan method POST
if ($_SERVER["REQUEST_METHOD"] == "POST") {
    // Mengambil data dari form
    $name = $_POST['name'];
    $pnumber = $_POST['pnumber'];
    $pwd = $_POST['pwd'];
    $cpwd = $_POST['cpwd'];

    // Validasi dan proses perubahan data
    if (!empty($name)) {
        // Update data admin di tabel admin
        $updateFields = "`Nama_Admin`='$name', `No_Telp_Admin`='$pnumber'";
        
        // Jika password diisi dan sesuai dengan konfirmasi
        if (!empty($pwd) && $pwd == $cpwd) {
            $updateFields .= ", `Password_Admin`='$pwd'";
        }

        $updateAdminQuery = "UPDATE `admin` SET $updateFields WHERE `Id_Admin`='$adminId'";

        // Eksekusi query update
        if ($conn->query($updateAdminQuery) === TRUE) {
            echo "Data admin berhasil diperbarui.";
            
            // Set ulang nilai namaAdmin, noTelpAdmin setelah berhasil update
            $namaAdmin = $name;
            $noTelpAdmin = $pnumber;
        } else {
            echo "Error: " . $updateAdminQuery . "<br>" . $conn->error;
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
    <title>Profile Admin</title>
    <link rel="stylesheet" href="techthree.css">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" 
        integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <script src="dashboard_admin.js" defer></script>
    <script src="profile.js" defer></script>
</head>
<body>
<header>
    <a id="logo_link" href="dashboard_admin.php">
        <img src="Logo.png" id="logo">
    </a>
    <!--Navigasi halaman lapor keluh kesah dan profile-->
    <nav id="nav_header">
        <!--Navigasi Lihat Feedback User-->
        <a href="javascript:void(0);" class="circle-container" onclick="navigateTo('feedbackContent', 'dashboard_admin.php')">
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
                    <h2><?php echo htmlspecialchars($namaAdmin); ?></h2>
                </div>
                <hr>
                <!--link-->
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('dashboardContent', 'dashboard_admin.php')">
                    <img src="dashboardIcon.png">
                    <p>Dashboard</p>
                </a>
                <a href="profile_admin.php" class="sub-menu-link">
                    <img src="profileIcon.png">
                    <p>Profile</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('kelasBootcampContent', 'dashboard_admin.php')">
                    <img src="kelasSayaIcon.png">
                    <p>Kelas Bootcamp</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('proyekAkhirContent', 'dashboard_admin.php')">
                    <img src="projectIcon.png">
                    <p>Proyek Akhir</p>
                </a>
                <a href="#" class="sub-menu-link">
                    <img src="certificateIcon.png">
                    <p>Sertifikat</p>
                </a>
                <a href="TechThree_admin.php" class="sub-menu-link">
                    <img src="Company.png">
                    <p>Tech Three</p>
                </a>
                <a href="javascript:void(0);" class="sub-menu-link" onclick="navigateTo('feedbackContent', 'dashboard_admin.php')">
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
            <h3 class="h-p"><b><?php echo htmlspecialchars($namaAdmin); ?></b></h3>
            <h6 class="h-p">No. Telp: <?php echo htmlspecialchars($noTelpAdmin); ?></h6>
            <h6 class="h-p">ID: <?php echo htmlspecialchars($adminId); ?></h6>
        </div>

        <div class="col">
            <form id="edit-profile" method="POST" action="<?php echo htmlspecialchars($_SERVER["PHP_SELF"]); ?>">
                <h4 style="text-align: center"><b><u>Edit Profile</u></b></h4>
                <label for="name">Nama Lengkap</label>
                <input type="text" id="name" name="name" value="<?php echo htmlspecialchars($namaAdmin); ?>" placeholder="Masukkan nama lengkap"><br>
                <label for="pnumber">No. Handphone</label>
                <input type="tel" id="pnumber" name="pnumber" value="<?php echo htmlspecialchars($noTelpAdmin); ?>" placeholder="Masukkan No. Handphone baru"><br>           
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
