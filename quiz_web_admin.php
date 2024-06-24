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
      <h3>Pengembangan Web</h3>
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
        <button onclick="redirectToPage('materi_admin_web.php')">
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
            <h3>1. Berikut ini merupakan jenis - jenis IDE, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN (D)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">VS Code</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">Vim</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Atom</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Maze</span>
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
            <h3>2. Berikut merupakan bahasa programming yang popular digunakan pada pengembangan web, kecuali ...</h3>
  
            <!--PILIHAN JAWABAN (A)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Assembly</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">PHP</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">Python</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">Node.JS</span>
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
            <h3>3. Bertujuan untuk menata layout dan halaman web, seperti warna font, ukuran frame, dan komponen lain dengan tujuan untuk membuat halaman web lebih menarik adalah fungsi bahasa ...</h3>
  
            <!--PILIHAN JAWABAN (C)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">Marvel</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">JavaScript</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">CSS</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">HTML</span>
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
            <h3>4. Untuk memberikan warna merah pada suatu kata atau kalimat, dapat menggunakan style ...</h3>
            
            <!--PILIHAN JAWABAN (A)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">color: red;</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">font-color: red;</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">color=red;</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">color-font: red;</span>
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
            <h3>5. Judul halaman web biasanya diletakkan pada section ...</h3>
  
            <!--PILIHAN JAWABAN (D)-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span class="opsi">A</span><span class="kalimatJawaban">lefter</span>
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span class="opsi">B</span><span class="kalimatJawaban">head</span>
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span class="opsi">C</span><span class="kalimatJawaban">footer</span>
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span class="opsi">D</span><span class="kalimatJawaban">body</span>
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