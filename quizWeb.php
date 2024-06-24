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
      <h3>Pengembangan Web</h3>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <p>User0767</p>
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
        <button onclick="redirectToPage('detailKelasWeb.php')">
          <i class="fa-solid fa-chevron-left"></i>
          <span>Kembali ke Materi</span>
        </button>
      </section>

      <div class="class-form-wrap" id="quizContainer">
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>1. Berikut ini merupakan jenis - jenis IDE, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN (D)-->
            <div class="quizAnswers">
              <!--A-->
              <label class="container">
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">VS Code</span>
              </label>
              <!--B-->
              <label class="container">
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Vim</span>
              </label>
              <!--C-->
              <label class="container">
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Atom</span>
              </label>
              <!--D-->
              <label class="container">
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Maze</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>2. Berikut merupakan bahasa programming yang popular digunakan pada pengembangan web, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN (A)-->
            <div class="quizAnswers">
              <!--A-->
              <label class="container">
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Assembly</span>
              </label>
              <!--B-->
              <label class="container">
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">PHP</span>
              </label>
              <!--C-->
              <label class="container">
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Python</span>
              </label>
              <!--D-->
              <label class="container">
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Node.JS</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>3. Bertujuan untuk menata layout dan halaman web, seperti warna font, ukuran frame, dan komponen lain dengan tujuan untuk membuat halaman web lebih menarik adalah fungsi bahasa ...</h3>
  
            <!--PILIHAN JAWABAN (C)-->
            <div class="quizAnswers">
              <!--A-->
              <label class="container">
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Marvel</span>
              </label>
              <!--B-->
              <label class="container">
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">JavaScript</span>
              </label>
              <!--C-->
              <label class="container">
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">CSS</span>
              </label>
              <!--D-->
              <label class="container">
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">HTML</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>4. Untuk memberikan warna merah pada suatu kata atau kalimat, dapat menggunakan style ...</h3>
            
            <!--PILIHAN JAWABAN (A)-->
            <div class="quizAnswers">
              <!--A-->
              <label class="container">
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">color: red;</span>
              </label>
              <!--B-->
              <label class="container">
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">font-color: red;</span>
              </label>
              <!--C-->
              <label class="container">
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">color=red;</span>
              </label>
              <!--D-->
              <label class="container">
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">color-font: red;</span>
              </label>
            </div>
          </form>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>5. Judul halaman web biasanya diletakkan pada section ...</h3>
  
            <!--PILIHAN JAWABAN (D)-->
            <div class="quizAnswers">
              <!--A-->
              <label class="container">
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">lefter</span>
              </label>
              <!--B-->
              <label class="container">
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">head</span>
              </label>
              <!--C-->
              <label class="container">
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">footer</span>
              </label>
              <!--D-->
              <label class="container">
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">body</span>
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