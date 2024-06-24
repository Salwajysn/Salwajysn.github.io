<?php
session_start(); // Mulai sesi PHP

// Sisipkan file koneksi ke database
require_once "db_connect.php";

// Periksa apakah user_id tersedia dalam sesi PHP
if (isset($_SESSION['user_id'])) {
    $user_id = $_SESSION['user_id']; // Ambil user_id dari sesi PHP
} else {
    // Jika tidak ada user_id dalam sesi, arahkan kembali ke halaman login
    header("Location: login.php");
    exit(); // Pastikan keluar dari skrip PHP setelah redirect
}

// Query untuk mengambil data pengguna dari database berdasarkan user_id
$sql = "SELECT * FROM user WHERE Id_User = '$user_id'";
$result = $conn->query($sql);

// Memeriksa apakah data pengguna ditemukan
if ($result->num_rows > 0) {
    $user = $result->fetch_assoc();
    $namaUser = htmlspecialchars($user['Nama_User']); // Ambil nama pengguna
} else {
    echo "Pengguna tidak ditemukan";
    exit(); // Keluar dari skrip PHP jika pengguna tidak ditemukan
}

?>

<!--HALAMAN WEB TECHTREE: QUIZ-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="quiz_admin.css">
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <script src="quiz.js" defer></script>
    <title>Quiz Materi</title>
  </head>

  <body>
    <header>
      <!--LOGO-->
      <a id="logo_link" href="dashboard.php">
          <img src="Logo.png" id="logo">
      </a>
      <!--MATERI YANG SEDANG DIPELAJARI-->
      <h3>Fotografi</h3>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <h2><?php echo htmlspecialchars($namaUser); ?></h2>
      </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
      <h1 class="titleH1">Quiz</h1>
      <!--section class="editable_nama_materi">
        <h2>#2 Tools UI/UX</h2>
        <i class="fa-solid fa-pen-to-square" onclick="editMateriJudul()"></i>
      </section-->
      <!--button back to materi-->
      <section class="kembaliKeMateri">
        <button onclick="redirectToPage('detailKelasFotografi.php')">
          <i class="fa-solid fa-chevron-left"></i>
          <span>Kembali ke Materi</span>
        </button>
      </section>

      <div class="class-form-wrap" id="quizContainer">
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>1. Memengaruhi tampilan, nuansa, dan warna sehingga foto atau video yang dibuat dapat menyampaikan pesannya dengan baik adalah fungsi dari ...</h3>
  
            <!--PILIHAN JAWABAN (C)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Komposisi</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Exposure</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Camera angle</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Aperture</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>2. Berikut merupakan elemen dasar yang termasuk ke dalam exposure triangle, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN (B)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">ISO</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Exposure</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Aperture</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Shutter Speed</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>3. Konsep paling umum dalam hal tata letak yakni ...</h3>
  
            <!--PILIHAN JAWABAN (C)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Rule of First</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Rule of Second</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Rule of Third</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Rule of Fourth</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>4. Agar prototype yang ada di Figma dapat langsung terlihat pada smartphone, smartphone perlu menginstall aplikasi ...</h3>
            
            <!--PILIHAN JAWABAN (A)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Wide shot</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Knee shot</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Low camera angle</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Close Up</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>5. Pengambilan gambar yang memperlihatkan bagian kepala hingga bahu subjek merupakan jenis pengambilan gambar ...</h3>
  
            <!--PILIHAN JAWABAN (D)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Wide shot</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Knee shot</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Low camera angle</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Close Up</span>
              </label>
            </div>
          </form>
        </div>
      </div>

      <!--WARNING SUBMIT-->
      <button class="kirim">Kirim</button>
      
      <!--Footer-->
      <section id="colorBG">
        <p style="text-align: center;">&copy; 2024 Proyek Website Bootcamp TechThree -- Kelompok 3</p>
      </section> 
    </main>
  </body>
</html>