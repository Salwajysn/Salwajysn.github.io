# Portfolio Salwa Nafisa

Website portfolio statis (HTML, CSS, JavaScript), tanpa build tools.

## Struktur
- index.html  : isi konten (teks, project, pengalaman, komunitas, sertifikat)
- style.css   : tampilan. Warna tema gelap di :root, tema terang di :root[data-theme="light"]
- script.js   : animasi, ganti tema, filter dan lightbox
- assets/foto.jpg        : foto profil (timpa dengan foto baru, nama file sama)
- assets/projects/       : preview project (rasio 16:10). SNT-Guard: snt-guard.jpg
- assets/exp/            : foto kegiatan experience
- assets/certs/          : gambar sertifikat
- assets/icons/          : logo skill berwarna (class ic--color). GitHub dan Flask tetap hitam, otomatis putih di tema gelap

## Cara lihat di komputer
Klik dua kali index.html, atau di VS Code pakai ekstensi Live Server.

## Menambah isi
- Project baru     : copy satu blok <article class="card spot project ..."> di section Projects.
- Pengalaman baru  : copy satu blok <article class="timeline__item ..."> di section Experience.
- Komunitas baru   : copy satu blok <article> di section Communities.
- Sertifikat baru  : simpan JPG di assets/certs/, copy satu blok <article class="... cert-card ...">.
  data-cat menentukan filter: data, ml, career (boleh lebih dari satu).
- Ikon skill       : <span><img class="ic" src="assets/icons/python.svg" alt="" />Python</span>.
  Tanpa ikon cukup <span>Teks</span>.
