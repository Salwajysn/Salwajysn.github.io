

<!--HALAMAN WEB TECHTREE: QUIZ-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="quiz.css">
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Quiz Materi</title>
    <script src="kelasBootcamp.js" defer></script>
  </head>

  <body>
    <header>
      <!--LOGO-->
      <a id="logo_link" href="dashboard.html">
          <img src="Logo.png" id="logo">
      </a>
      <!--MATERI YANG SEDANG DIPELAJARI-->
      <h3>Desain UI/UX - Tools</h3>
      <div class="progresWrap">
        <div class="progress-container">
          <div class="progress-bar"></div>
        </div>
        <p class="progress-score">20%</p>
        <p class="materiSelesai">Materi sudah diselesaikan</p>
      </div>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <p>user0767</p>
      </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
      <h1 class="titleH1">Quiz</h1>
      <h2 class="titleH2">#2 Tools UI/UX</h2>
      <!--button back to materi-->
      <section class="kembaliKeMateri">
        <button onclick="redirectToPage2()">
          <i class="fa-solid fa-chevron-left"></i>
          <span>Kembali ke Materi</span>
        </button>
      </section>

      <div class="class-form-wrap">
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>1. Sebagai seorang desainer, penting untuk memilih tools yang dapat meningkatkan...</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span>A</span>Kreativitas dan Estetika
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span>B</span>Produktivitas dan Kreativitas
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span>C</span>Produktivitas dan Estetika
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span>D</span>Usabilitas dan Estetika
              </label>
            </div>
          </form>
  
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>2. Tools apa yang akan kita gunakan pada kelas ini dalam membuat desain UI/UX?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span>A</span>Capcut
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span>B</span>Procreate
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span>C</span>Adobe Photoshop
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span>D</span>Figma
              </label>
            </div>
          </form>
  
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>3. Plugin apa yang dapat digunakan dalam membuat animasi yang ringan untuk desain UI/UX?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span>A</span>AEUX
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span>B</span>Jetpack
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span>C</span>Instagram Feed
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span>D</span>Yoast SEO
              </label>
            </div>
          </form>
  
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>4. Lorem ipsum dolor sit amet, consectetur adipiscing elit Pellentesque tincidunt?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span>A</span>Lorem ipsum dolor.
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span>B</span>Lorem ipsum dolor.
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span>C</span>Lorem ipsum dolor.
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span>D</span>Lorem ipsum dolor.
              </label>
            </div>
          </form>
  
          <!--pertanyaan-->
          <form class="class-form" action="GET">
            <!--pertanyaannya-->
            <h3>5. Lorem ipsum dolor sit amet, consectetur adipiscing elit Pellentesque tincidunt?</h3>
  
            <!--PILIHAN JAWABAN-->
            <div class="quizAnswers">
              <!--A-->
              <label>
                <input type="radio" name="answer" value="A">
                <span>A</span>Lorem ipsum dolor.
              </label>
              <!--B-->
              <label>
                <input type="radio" name="answer" value="B">
                <span>B</span>Lorem ipsum dolor.
              </label>
              <!--C-->
              <label>
                <input type="radio" name="answer" value="C">
                <span>C</span>Lorem ipsum dolor.
              </label>
              <!--D-->
              <label>
                <input type="radio" name="answer" value="D">
                <span>D</span>Lorem ipsum dolor.
              </label>
            </div>
          </form>
      </div>

      <!--SUBMIT/SEND FEEDBACK-->
      <input type="submit" name="submit" onclick="seeScore('#hasilQuiz_KKM', 'style', 'display: block;')">

      <!--HASIL SKOR-->
      <div id="hasilQuiz_KKM">
        <h2>Skor Quiz</h2>
        <h1 id="KKM">80%</h1>
        <p>Yey! Anda memenuhi skor minimum yang perlu diraih!</p>
        <button>Materi Selanjutnya</button>
      </div>
    </main>
  </body>
</html>