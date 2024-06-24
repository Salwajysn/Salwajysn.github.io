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
      <h3>Fotografi</h3>
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
        <button onclick="redirectToPage('materi_admin_fotografi.php')">
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