<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="materi_admin.css">
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Materi Kelas | Admin</title>
    <script src="kelasBootcamp.js" defer></script>

    <!-- Include jQuery library -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // Function to handle editing materi judul
        function editMateriJudul(idMateri) {
            var newJudul = prompt("Masukkan judul baru:");
            if (newJudul != null) {
                console.log("Mengirim permintaan untuk memperbarui judul:", newJudul);
                // Send data to update_materi.php using Ajax
                $.ajax({
                    type: 'POST',
                    url: 'update_materi.php',
                    data: { idMateri: idMateri, newJudul: newJudul },
                    success: function(response) {
                        console.log("Respons dari server:", response);
                        alert(response); // Show success or error message
                        if (response.includes("berhasil")) {
                            // Update the judul on the page
                            document.getElementById("judul-" + idMateri).innerText = newJudul;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error dari AJAX:", status, error);
                        alert("Gagal memperbarui judul materi.");
                    }
                });
            }
        }

        // Function to handle editing video link
        function editVideoLink(idMateri) {
            var newLink = prompt("Masukkan link video baru:");
            if (newLink != null) {
                console.log("Mengirim permintaan untuk memperbarui link video:", newLink);
                // Send data to update_materi.php using Ajax
                $.ajax({
                    type: 'POST',
                    url: 'update_materi.php',
                    data: { idMateri: idMateri, newLink: newLink },
                    success: function(response) {
                        console.log("Respons dari server:", response);
                        alert(response); // Show success or error message
                        if (response.includes("berhasil")) {
                            // Update the video link on the page
                            document.getElementById("video-" + idMateri).src = newLink;
                        }
                    },
                    error: function(xhr, status, error) {
                        console.error("Error dari AJAX:", status, error);
                        alert("Gagal memperbarui link video.");
                    }
                });
            }
        }
    </script>
</head>
<body>
    <header>
        <!--LOGO-->
        <a id="logo_link" href="dashboard_admin.php">
            <img src="Logo.png" id="logo">
        </a>
        <!--MATERI YANG SEDANG DIPELAJARI-->
        <h3>Desain UI/UX</h3>
        <h4 class="halaman_admin">Halaman Admin</h4>
        <!--Sees User Name-->
        <section class="profileAdjust">
            <img src="user.png">
            <p>Admin123</p>
        </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
        <h1>Materi</h1>

        <!-- Materi sections -->
        <?php
        // Include db_connect.php to connect to database
        include 'db_connect.php';

        // Get current page
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 1; // Number of records per page
        $offset = ($page - 1) * $limit;

        // Query to retrieve materi data hanya untuk UI/UX
        $query = "SELECT * FROM materi WHERE Id_Kelas = 'Kls01' LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            $row = mysqli_fetch_assoc($result);
            $idMateri = $row['Id_Materi'];
            $namaMateri = $row['Nama_Materi'];
            $videoLink = $row['video_link'];
        ?>
            <section class="editable_nama_materi">
                <h2 id="judul-<?php echo $idMateri; ?>"><?php echo $namaMateri; ?></h2>
                <i class="fa-solid fa-pen-to-square" onclick="editMateriJudul('<?php echo $idMateri; ?>')"></i>
            </section>
            <section class="editable_icon_video">
                <h2>Perbarui Link Video</h2>
                <i class="fa-solid fa-pen-to-square" onclick="editVideoLink('<?php echo $idMateri; ?>')"></i>
            </section>
            <iframe id="video-<?php echo $idMateri; ?>" width="420" height="315" src="<?php echo $videoLink; ?>" allowfullscreen frameborder="0"></iframe>
        <?php
        } else {
            echo "Tidak ada data materi.";
        }

        // Get total number of UI/UX materials
        $total_query = "SELECT COUNT(*) as total FROM materi WHERE Id_Kelas = 'Kls01'";
        $total_result = mysqli_query($conn, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_pages = ceil($total_row['total'] / $limit);

        // Close database connection
        mysqli_close($conn);
        ?>

        <!-- Navigasi halaman -->
        <section class="navigation">
            <?php if ($page < $total_pages) { ?>
                <a href="materi_admin.php?page=<?php echo $page + 1; ?>"></a>
            <?php } else { ?>
                <a href="quiz_admin.php"></a>
            <?php } ?>
        </section>

        <!--button goes to quiz-->
        <section class="mulaiQuiz">
            <button onclick="redirectToPage('dashboard_admin.php')">
                <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
            <?php if ($page < $total_pages) { ?>
                <button onclick="window.location.href='materi_admin.php?page=<?php echo $page + 1; ?>'">Next Materi
                    <i class="fa-solid fa-chevron-right"></i></button>
            <?php } else { ?>
                <button onclick="redirectToPage('quiz_admin.php')">Edit Quiz
                    <i class="fa-solid fa-chevron-right"></i></button>
            <?php } ?>
        </section>
    </main>
</body>
</html>
