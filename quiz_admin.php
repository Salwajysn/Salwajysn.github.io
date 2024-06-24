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
    <title>Quiz Materi | Admin</title>
    <script src="kelasBootcamp.js" defer></script>
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
      <h1 class="titleH1">Quiz</h1>
      <!--section class="editable_nama_materi">
        <h2>#2 Tools UI/UX</h2>
        <i class="fa-solid fa-pen-to-square" onclick="editMateriJudul()"></i>
      </section-->
      <!--button back to materi-->
      <section class="kembaliKeMateri">
        <button onclick="redirectToPage('materi_admin.php')">
          <i class="fa-solid fa-chevron-left"></i>
          <span>Edit Materi</span>
        </button>
      </section>
      <section class="delete_all">
        <h3>Hapus Seluruh Soal Quiz</h3>
        <i class="fa-solid fa-trash-can" onclick="deleteAllQuestions()"></i>
      </section>

      <div class="class-form-wrap" id="quizContainer">
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>1. Sebagai seorang desainer, penting untuk memilih tools yang dapat meningkatkan...</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Kreativitas dan Estetika</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Produktivitas dan Kreativitas</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Produktivitas dan Estetika</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Usabilitas dan Estetika</span>
              </label>
            </div>
          </form>
          <!--edit tools-->
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>2. Tools apa yang akan kita gunakan pada kelas ini dalam membuat desain UI/UX?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Capcut</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Procreate</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Adobe Photoshop</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Figma</span>
              </label>
            </div>
          </form>
          <!--edit tools-->
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>3. Plugin apa yang dapat digunakan dalam membuat animasi yang ringan untuk desain UI/UX?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">AEUX</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Jetpack</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Instagram Feed</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Yoast SEO</span>
              </label>
            </div>
          </form>
          <!--edit tools-->
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>4. Agar prototype yang ada di Figma dapat langsung terlihat pada smartphone, smartphone perlu menginstall aplikasi ...</h3>
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Adobe Photoshop</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Canva</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Medium</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Figma Mirror App</span>
              </label>
            </div>
          </form>
          <!--edit tools-->
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>
  
        <div class="editable_soal_quiz">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>5. Website untuk melakukan testing prototype yang dapat dibuat adalah, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Canva</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Maze</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Sketch</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Marvel</span>
              </label>
            </div>
          </form>
          <!--edit tools-->
          <div class="tools_edit">
            <i class="fa-solid fa-pen-to-square" onclick="editQuestion(this)"></i>
            <i class="fa-solid fa-trash-can" onclick="deleteQuestion(this)"></i>
          </div>
        </div>
      </div>

      <!--TAMBAH PERTANYAAN-->
      <button class="tambah_soal" onclick="addQuestion()">Tambah Soal Quiz
        <i class="fa-solid fa-square-plus"></i>
      </button>
    </main>
  </body>
</html>