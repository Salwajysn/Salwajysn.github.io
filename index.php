<?php
// Include file koneksi ke database
include 'db_connect.php';

// Ambil data kelas dari database
$query = "SELECT * FROM kelas";
$result = mysqli_query($conn, $query);

if (!$result) {
    die("Query error: " . mysqli_error($conn));
}

$kelas = mysqli_fetch_all($result, MYSQLI_ASSOC);
?>

<!DOCTYPE html>
<html lang="id">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B">
    <link rel="stylesheet" href="landingPage.css">
    <title>Kursus UI/UX, Fotografi, dan Pengembangan Web | TechThree</title>
    <script src="landingPage.js" defer></script>
</head>

<body>
<header>
    <a id="logo_link" href="index.php">
        <img src="Logo.png" id="logo">
    </a>
      <!--Navigation Bar-->
      <nav class="nav_header">
        <a class="navLink" href="index.php">Beranda</a>
        <a class="navLink" href="#footer">Tentang</a>
        <a class="navLink" href="#pilihanKelas">Kelas</a>
      </nav>

      <!--Button Log In and Sign Up-->
      <div id="buttonStyle" class="nav_header">
        <a id="masuk_button" href="login.php" role="button">Masuk</a>
        <a class="buttonBerwarna" href="registrasi.php" role="button">Daftar</a>
      </div>
    </header>

    <!--Foto Atas-->
    <div class="fotoDanTeks">
      <!--Tulisan di kiri-->
      <div>
        <h1 id="judulFoto">Selamat Datang di Bootcamp <span class="techThreeWarna">TechThree</span></h1>
        <p id="deskripsi">Tingkatkan keterampilan Anda dengan mengikuti kursus intensif kami di bidang UI/UX, Fotografi, dan Pengembangan Web. 
          Bergabunglah dan mulailah perjalanan Anda menuju karier yang sukses.</p>
        <button onclick="redirectToPage()" id="mulaiSekarang" class="buttonBerwarna">Mulai Sekarang</button>
      </div>

      <!--Tulisan di kanan-->
      <img id="fotoAwal" src="FotoAwal.jpg">
    </div>

    <!--Kenapa memilih bootcamp kita-->
    <div class="fotoDanTeks2-grid">
      <h1 id="mengapaTech3">Mengapa Harus <span class="techThreeWarna">TechThree</span></h1>
      <div class="fotoDanTeks2-grid-items">
        <!--section pertama-->
        <section class="sectionAlasan">
          <img class="stylingIcon" src="belajarAnywhere.png">
          <h3 class="subJudulAlasan">Belajar dari mana saja</h3>
          <p class="deskripsiAlasan">Tempat bukan lagi menjadi halangan Anda untuk mengembangkan diri.</p>
        </section>
        <!--section kedua-->
        <section class="sectionAlasan">
          <img class="stylingIcon" src="lifetimeAccess.png">
          <h3 class="subJudulAlasan">Akses seumur hidup</h3>
          <p class="deskripsiAlasan">Akses materi kursus yang tersedia untuk Anda kapanpun.</p>
        </section>
        <!--section ketiga-->
        <section class="sectionAlasan">
          <img class="stylingIcon" src="kursusOnline.png">
          <h3 class="subJudulAlasan">Materi yang komprehensif</h3>
          <p class="deskripsiAlasan">Materi yang disusun dengan baik untuk mempersiapkan diri anda.</p>
        </section>
      </div>
    </div>

    <!--Pilihan Kelas/Coursesnya-->
    <div id="pilihanKelas" class="fotoDanTeks3-grid">
      <h1 id="telusuriKelas">Telusuri Kelas</h1>
      <div class="fotoDanTeks2-grid-items">
        <!--section pertama-->
        <section class="containerKontenKelas">
          <div class="illustBG">
            <img class="stylingIllust" src="uiux.png">
          </div>
          <h3 class="subJudulKelas">Desain UI/UX</h3>
          <p class="deskripsiKelas">Pelajari dasar-dasar dan teknik lanjutan dalam mendesain antarmuka pengguna yang intuitif dan pengalaman pengguna yang memukau,
            ideal untuk mereka yang ingin mengembangkan keterampilan dalam menciptakan produk digital yang ramah pengguna.</p>
          <a class="lebihLanjutLink" href="registrasi.php">Lebih Lanjut</a>
        </section>
        <!--section kedua-->
        <section class="containerKontenKelas">
          <div class="illustBG">
            <img class="stylingIllust" src="fotografi.png">
          </div>
          <h3 class="subJudulKelas">Fotografi</h3>
          <p class="deskripsiKelas">Menguasai seni dan teknik fotografi dengan panduan profesional. Kursus ini mencakup semua aspek fotografi, mulai dari komposisi dan 
            pencahayaan hingga pengeditan foto dengan software seperti Adobe Lightroom atau Photoshop.</p>
          <a class="lebihLanjutLink" href="registrasi.php">Lebih Lanjut</a>
        </section>
        <!--section ketiga-->
        <section class="containerKontenKelas">
          <div class="illustBG">
            <img class="stylingIllust" src="webdev.png">
          </div>
          <h3 class="subJudulKelas">Pengembangan Web</h3>
          <p class="deskripsiKelas">Kursus ini mencakup pemrograman front-end dengan HTML, CSS, dan JavaScript serta pengembangan back-end menggunakan PHP dan sistem 
            manajemen basis data (DBMS).</p>
          <a class="lebihLanjutLink" href="registrasi.php">Lebih Lanjut</a>
        </section>
      </div>
    </div>

    <!--Cara Mengikuti Kelas Kami-->
    <div class="fotoDanTeks4-grid">
      <h1 id="caraKelas">Cara Mengikuti Kelas di <span class="techThreeWarna">TechThree</span></h1>
      <div class="fotoDanTeks4-grid-items">
        <!--section pertama-->
        <section class="containerCaraIkut">
          <img class="stylingIllust" src="daftarkanDiri.png">
          <h3 class="subJudulCara">Daftarkan diri Anda</h3>
          <p class="deskripsiCara">Isi formulir pendaftaran dengan informasi pribadi Anda dan pastikan semua data yang Anda masukkan benar.</p>
        </section>
        <!--section kedua-->
        <section class="containerCaraIkut">
          <img class="stylingIllust" src="pilihKelas.png">
          <h3 class="subJudulCara">Pilih kelas yang diminati</h3>
          <p class="deskripsiCara">Telusuri daftar kelas yang tersedia dan pilih yang sesuai dengan minat dan kebutuhan Anda.</p>
        </section>
        <!--section ketiga-->
        <section class="containerCaraIkut">
          <img class="stylingIllust" src="belajarSecepatnya.png">
          <h3 class="subJudulCara">Mulai belajar secepatnya</h3>
          <p class="deskripsiCara">Anda bisa segera mengakses materi kursus dan mulai belajar materi yang tersedia.</p>
        </section>
      </div>
    </div>

    <!--Footer-->
    <footer id="footer">
      <div class="footer-grid">
        <!--Clickable Logo-->
        <a id="logo_linkFooter" href="index.php">
          <img src="Logo.png" id="logoFooter">
        </a>
        <table>
          <th colspan="2" class="subAnggota">KELOMPOK 3-KELAS B</th>
          <tr>
            <td>Leli Sawitri</td>
            <td>2210511040</td>
          </tr>
          <tr>
            <td>Salwa Nafisa</td>
            <td>2210511051</td>
          </tr>
          <tr>
            <td>Ika Kusuma Wardani</td>
            <td>2210511058</td>
          </tr>
          <tr>
            <td>Choirunnisa Zalfaa Nabilah</td>
            <td>2210511070</td>
          </tr>
          <tr>
            <td>Inayah Puteri Salsabila</td>
            <td>2329915067</td>
          </tr>
        </table>
      </div>
      <section id="colorBG">
        <p>&copy; 2024 Proyek Website Bootcamp TechThree -- Kelompok 3</p>
      </section>
    </footer>
  </body>
</html>