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

    <!-- Sertakan pustaka jQuery -->
    <script src="https://ajax.googleapis.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>

    <script>
        // Fungsi untuk mengedit judul materi
        function editMateriJudul(idMateri) {
            var newJudul = prompt("Masukkan judul baru:");
            if (newJudul != null) {
                console.log("Mengirim permintaan untuk memperbarui judul:", newJudul);
                // Kirim data ke update_materi.php menggunakan Ajax
                $.ajax({
                    type: 'POST',
                    url: 'update_materi.php',
                    data: { idMateri: idMateri, newJudul: newJudul },
                    success: function(response) {
                        console.log("Respons dari server:", response);
                        alert(response); // Tampilkan pesan sukses atau error
                        if (response.includes("berhasil")) {
                            // Perbarui judul di halaman
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

        // Fungsi untuk mengedit link video
        function editVideoLink(idMateri) {
            var newLink = prompt("Masukkan link video baru:");
            if (newLink != null) {
                console.log("Mengirim permintaan untuk memperbarui link video:", newLink);
                // Kirim data ke update_materi.php menggunakan Ajax
                $.ajax({
                    type: 'POST',
                    url: 'update_materi.php',
                    data: { idMateri: idMateri, newLink: newLink },
                    success: function(response) {
                        console.log("Respons dari server:", response);
                        alert(response); // Tampilkan pesan sukses atau error
                        if (response.includes("berhasil")) {
                            // Perbarui link video di halaman
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
        <h3>Pengembangan Web</h3>
        <h4 class="halaman_admin">Halaman Admin</h4>
        <!--Nama Pengguna-->
        <section class="profileAdjust">
            <img src="user.png">
            <p>Admin123</p>
        </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
        <h1>Materi</h1>

        <!-- Bagian Materi -->
        <?php
        // Sertakan db_connect.php untuk menghubungkan ke database
        include 'db_connect.php';

        // Dapatkan halaman saat ini
        $page = isset($_GET['page']) ? (int)$_GET['page'] : 1;
        $limit = 1; // Jumlah catatan per halaman
        $offset = ($page - 1) * $limit;

        // Query untuk mengambil data materi hanya untuk Kls03 (Pengembangan Web) dan materi dengan ID tertentu
        $query = "SELECT * FROM materi WHERE Id_Kelas = 'Kls03' OR Id_Materi IN ('mw01', 'mw02', 'mw03', 'mw04', 'mw05') LIMIT $limit OFFSET $offset";
        $result = mysqli_query($conn, $query);

        if (mysqli_num_rows($result) > 0) {
            while ($row = mysqli_fetch_assoc($result)) {
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
            }
        } else {
            echo "Tidak ada data materi.";
        }

        // Dapatkan jumlah total materi Pengembangan Web
        $total_query = "SELECT COUNT(*) as total FROM materi WHERE Id_Kelas = 'Kls03'";
        $total_result = mysqli_query($conn, $total_query);
        $total_row = mysqli_fetch_assoc($total_result);
        $total_pages = ceil($total_row['total'] / $limit);

        // Tutup koneksi database
        mysqli_close($conn);
        ?>

        <!-- Navigasi halaman -->
        <section class="navigation">
            <?php if ($page < $total_pages) { ?>
                <a href="materi_admin_web.php?page=<?php echo $page + 1; ?>"></a>
            <?php } else { ?>
                <a href="quiz_web_admin.php"></a>
            <?php } ?>
        </section>

        <!-- Tombol untuk kembali ke dashboard atau ke quiz -->
        <section class="mulaiQuiz">
            <button onclick="redirectToPage('dashboard_admin.php')">
                <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
            <?php if ($page < $total_pages) { ?>
                <button onclick="window.location.href='materi_admin_web.php?page=<?php echo $page + 1; ?>'">Next Materi
                    <i class="fa-solid fa-chevron-right"></i></button>
            <?php } else { ?>
                <button onclick="redirectToPage('quiz_web_admin.php')">Edit Quiz
                    <i class="fa-solid fa-chevron-right"></i></button>
            <?php } ?>
        </section>
    </main>
</body>
</html>
