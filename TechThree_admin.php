<!DOCTYPE html>
<html lang="id">
    <head>
        <meta charset="UTF-8">
        <meta name="viewport" content="width=device-width, initial-scale=1.0">
        <title>Tech Three Database</title>
        <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
        <link rel="stylesheet" href="TechThree_admin.css">
        <link rel="stylesheet" href="dashboard_admin.css">
        <title>Dashboard | Admin</title>
        <!-- Include FontAwesome from CDN -->
        <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
        <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
        <script src="TechThree_admin.js"></script>
        <script src="dashboard_admin.js"></script>
    </head>
    <body>
        <header>
            <!---->
            <a id="logo_link" href="dashboard_admin.php">
                <img src="Logo.png" id="logo">
            </a>
            <!--Navigasi halaman lapor keluh kesah dan profile-->
            <nav id="nav_header">
                <!--Navigasi Liat Feedback User-->
                <a href="javascript:void(0);" class="circle-container" onclick="navigateTo('feedbackContent', 'dashboard_admin.php')">
                    <img class="circle-img" src="feedback.png">
                </a>
                <!--Navigasi Halaman Profile-->
                <p onclick="toggleMenu()" class="circle-container">
                    <img class="circle-img" src="user.png">
                </p>
                <!--dropdown menu-->
                <div id="subMenu" class="subMenu-wrap">
                    <div class="subMenu">
                        <div class="user-info">
                            <img src="user.png">
                            <h2>Admin123</h2>
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
        
        <div class="container1">
            <div>
                <h1>Tabel User dan Kelas</h1>
                <table class="valueTable">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>ID Kelas</th>
                            <th>Tanggal Mulai</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="idUser">id_user</td>
                            <td><span class="idKelas">Desain UI/UX</span></td>
                            <td><span class="tglMulai">1 Juni 2024</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
            
            <div>
                <h1>Tabel Tugas</h1>
                <table class="valueTable">
                    <thead>
                        <tr>
                            <th>ID Tugas</th>
                            <th>Nama Tugas</th>
                            <th>Nilai Tugas</th>
                            <th>ID Tutor</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="idTugas">id_tugas</td>
                            <td><span class="namaTugas">Tugas 1</span></td>
                            <td><span class="nilai">100</span></td>
                            <td><span class="idTutor">id_tutor</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>

        <div class="container1">
            <div>
                <h1>Tabel Materi</h1>
                <table class="valueTable">
                    <thead>
                        <tr>
                            <th>ID Materi</th>
                            <th>Nama Materi</th>
                            <th>Durasi Materi</th>
                            <th>Video Link</th>
                            <th>ID Kelas</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="idMateri">id_uiux</td>
                            <td><span class="namaMateri">Desain UI/UX</span></td>
                            <td><span class="durasi">30 menit</span></td>
                            <td><span class="link">www</span></td>
                            <td><span class="idKelas">id_kelas_UI/UX</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                        <tr>
                            <td class="idMateri">id_fotografi</td>
                            <td><span class="namaMateri">Fotografi</span></td>
                            <td><span class="durasi">30 menit</span></td>
                            <td><span class="link">www</span></td>
                            <td><span class="idKelas">id_kelas_fotografi</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                        <tr>
                            <td class="idMateri">id_web</td>
                            <td><span class="namaMateri">Pemrograman Web</span></td>
                            <td><span class="durasi">30 menit</span></td>
                            <td><span class="link">www</span></td>
                            <td><span class="idKelas">id_kelas_web</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>

            <div>
                <h1>Tabel Kelas</h1>
                <table class="valueTable">
                    <thead>
                        <tr>
                            <th>ID Kelas</th>
                            <th>Nama Kelas</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="idKelas">id_kelas_Pemrograman Web</td>
                            <td><span class="namaKelas">Pemrograman Web</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>
        
        <div class="container1">
            <div>
                <h1>Tabel User</h1>
                <table class="valueTable">
                    <thead>
                        <tr>
                            <th>ID User</th>
                            <th>Nama User</th>
                            <th>Password User</th>
                            <th>No. Telp</th>
                            <th>Nama Kelas</th>
                            <th>Tanggal Lahir User</th>
                            <th>Email</th>
                            <th>Id Admin</th>
                            <th>Id Tugas</th>
                            <th>Nilai Tugas</th>
                            <th>Edit</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="idUser">id_user</td>
                            <td><span class="namaUser">Nama User</span></td>
                            <td><span class="passUser">Password User</span></td>
                            <td><span class="noUser">62812</span></td>
                            <td><span class="namaKelas">Desain UI/UX</span></td>
                            <td><span class="tglLahir">1 Januari 2004</span></td>
                            <td><span class="email">user@gmail.com</span></td>
                            <td><span class="idAdmin">id_admin</span></td>
                            <td><span class="idTugas">id_tugas</span></td>
                            <td><span class="nilai">100</span></td>
                            <td><button class="edit-btn"><i class="fa-solid fa-pen-to-square"></i></button></td>
                        </tr>
                    </tbody>
                </table>
                <br>
            </div>
        </div>

        <!--Footer-->
        <section id="colorBG">
            <p>&copy; 2024 Proyek Website Bootcamp TechThree -- Kelompok 3</p>
        </section>
    </body>
</html>