<!--HALAMAN WEB TECHTREE: MENILAI PROYEK PESERTA-->
<!DOCTYPE html>
<html lang="id">
  <head>
    <meta charset="UTF-8"> <!--Character encoding-->
    <!--Responsive design viewport-->
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta name="author" content="Kelompok3_B"> <!-- Author of the webpage -->
    <link rel="stylesheet" href="menilaiProyek_admin.css">
    <!-- Include FontAwesome from CDN -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.0.0-beta3/css/all.min.css">
    <title>Nilai Proyek Akhir</title>
    <script src="nilaiProyek_peserta.js" defer></script>
  </head>

  <body>
    <header>
      <!--LOGO-->
      <a id="logo_link" href="dashboard_admin.php">
          <img src="Logo.png" id="logo">
      </a>
      <!--HEADER ADMIN-->
      <h3>Desain UI/UX - Proyek Akhir</h3>
      <h4 class="halaman_admin">Halaman Admin</h4>
      <!--Sees User Name-->
      <section class="profileAdjust">
        <img src="user.png">
        <p>Admin123</p>
      </section>
    </header>

    <!--Bagian utama halaman-->
    <main>
      <h1>Menilai Proyek Akhir Peserta</h1>
      <hr>
      
      <!--KOTAK PENTING 1-->
      <div class="kotakDanNilai">
        <div class="kotakSubmit">
          <!--profile user-->
          <section class="profile_user">
            <img src="user.png">
            <p>user2276</p>
          </section>
          <!--link isi proyek peserta-->
          <section class="link_submit">
            <p>Link Submit:</p>
            <a target="_blank" href="https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing" class="link_proyek_submit">
            https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing</a>
          </section>
        </div>
        <div class="kotak_nilai_sertif">
        <!--kotak nilai-->
          <div class="kotak_untuk_menilai">
            <button onclick="showInput(this)">Beri Nilai</button>
            <input type="number" class="nilaiInput" style="display: none;" max="100">
            <button onclick="saveNilai(this)"  style="display: none;">Simpan</button>
            <p class="nilaiText"></p>
          </div>
          <div class="kotak_untuk_menilai">
            <button>Buat Sertifikat</button>
          </div>
        </div>
      </div>

      <!--KOTAK PENTING 2-->
      <div class="kotakDanNilai">
        <div class="kotakSubmit">
          <!--profile user-->
          <section class="profile_user">
            <img src="user.png">
            <p>user_KIM</p>
          </section>
          <!--link isi proyek peserta-->
          <section class="link_submit">
            <p>Link Submit:</p>
            <a target="_blank" href="https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing" class="link_proyek_submit">
            https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing</a>
          </section>
        </div>
        <div class="kotak_nilai_sertif">
          <!--kotak nilai-->
            <div class="kotak_untuk_menilai">
              <button onclick="showInput(this)">Beri Nilai</button>
              <input type="number" class="nilaiInput" style="display: none;" max="100">
              <button onclick="saveNilai(this)"  style="display: none;">Simpan</button>
              <p class="nilaiText"></p>
            </div>
            <div class="kotak_untuk_menilai">
              <button>Buat Sertifikat</button>
            </div>
          </div>
        </div>

      <!--KOTAK PENTING 3-->
      <div class="kotakDanNilai">
        <div class="kotakSubmit">
          <!--profile user-->
          <section class="profile_user">
            <img src="user.png">
            <p>uiux-lover76</p>
          </section>
          <!--link isi proyek peserta-->
          <section class="link_submit">
            <p>Link Submit:</p>
            <a target="_blank" href="https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing" class="link_proyek_submit">
            https://drive.google.com/drive/folders/1-aCEIbJeM5MosSHyTJIkuHWegJrM7YmI?usp=sharing</a>
          </section>
        </div>
        <div class="kotak_nilai_sertif">
          <!--kotak nilai-->
            <div class="kotak_untuk_menilai">
              <button onclick="showInput(this)">Beri Nilai</button>
              <input type="number" class="nilaiInput" style="display: none;" max="100">
              <button onclick="saveNilai(this)"  style="display: none;">Simpan</button>
              <p class="nilaiText"></p>
            </div>
            <div class="kotak_untuk_menilai">
              <button>Buat Sertifikat</button>
            </div>
          </div>
        </div>

      <!--button to dashboard-->
      <section class="backToDashboard">
        <button onclick="redirectToPage('dashboard_admin.php')">
          <i class="fa-solid fa-chevron-left"></i>Kembali ke Dashboard</button>
      </section>
    </main>
  </body>
</html>