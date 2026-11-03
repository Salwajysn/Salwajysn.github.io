// =========================================================
// PORTFOLIO SCRIPT
// =========================================================

// 1) Teks yang diketik otomatis di hero (ubah sesuka kamu)
const roles = ["Data Analyst", "Data Scientist", "Machine Learning Enthusiast"];
const typedEl = document.getElementById("typed");
let roleIdx = 0, charIdx = 0, deleting = false;

function typeLoop() {
  const word = roles[roleIdx];
  typedEl.textContent = word.slice(0, charIdx);

  if (!deleting && charIdx < word.length) {
    charIdx++;
    setTimeout(typeLoop, 90);
  } else if (!deleting) {
    deleting = true;
    setTimeout(typeLoop, 1400);
  } else if (charIdx > 0) {
    charIdx--;
    setTimeout(typeLoop, 45);
  } else {
    deleting = false;
    roleIdx = (roleIdx + 1) % roles.length;
    setTimeout(typeLoop, 300);
  }
}
typeLoop();

// 2) Navbar: ganti gaya saat scroll + menu mobile
const nav = document.getElementById("nav");
const navToggle = document.getElementById("navToggle");
const navLinks = document.getElementById("navLinks");

window.addEventListener("scroll", () => {
  nav.classList.toggle("scrolled", window.scrollY > 30);
});

navToggle.addEventListener("click", () => {
  const open = navLinks.classList.toggle("open");
  navToggle.classList.toggle("open", open);
  navToggle.setAttribute("aria-expanded", open);
});
navLinks.querySelectorAll("a").forEach((a) =>
  a.addEventListener("click", () => {
    navLinks.classList.remove("open");
    navToggle.classList.remove("open");
    navToggle.setAttribute("aria-expanded", false);
  })
);

// 3) Animasi muncul saat di-scroll
const io = new IntersectionObserver(
  (entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        e.target.classList.add("visible");
        io.unobserve(e.target);
      }
    });
  },
  { threshold: 0.12 }
);
document.querySelectorAll(".reveal").forEach((el, i) => {
  el.style.transitionDelay = (i % 3) * 80 + "ms";
  io.observe(el);
});

// 4) Efek cahaya mengikuti kursor di dalam card (.spot)
document.querySelectorAll(".spot").forEach((card) => {
  card.addEventListener("mousemove", (e) => {
    const r = card.getBoundingClientRect();
    card.style.setProperty("--mx", e.clientX - r.left + "px");
    card.style.setProperty("--my", e.clientY - r.top + "px");
  });
});

// 5) Cahaya besar yang mengikuti kursor di seluruh halaman
const glow = document.querySelector(".cursor-glow");
window.addEventListener("mousemove", (e) => {
  glow.style.left = e.clientX + "px";
  glow.style.top = e.clientY + "px";
});

// 6) Highlight menu sesuai section yang sedang dilihat
const sections = document.querySelectorAll("main section[id]");
const links = document.querySelectorAll(".nav__links a:not(.nav__cta)");
const spy = new IntersectionObserver(
  (entries) => {
    entries.forEach((e) => {
      if (e.isIntersecting) {
        links.forEach((l) => l.classList.toggle("active", l.getAttribute("href") === "#" + e.target.id));
      }
    });
  },
  { rootMargin: "-45% 0px -50% 0px" }
);
sections.forEach((s) => spy.observe(s));

// 7) Tahun otomatis di footer
document.getElementById("year").textContent = new Date().getFullYear();

// 8) Filter sertifikat (kategori: data, ml, career)
const chips = document.querySelectorAll(".chip");
const certCards = document.querySelectorAll("#certGrid .cert-card");
chips.forEach((chip) =>
  chip.addEventListener("click", () => {
    chips.forEach((c) => c.classList.remove("active"));
    chip.classList.add("active");
    const f = chip.dataset.filter;
    certCards.forEach((card) => {
      const cats = (card.dataset.cat || "").split(" ");
      card.classList.toggle("hide", f !== "all" && !cats.includes(f));
    });
  })
);

// 9) Lightbox: klik gambar (sertifikat atau foto kegiatan) untuk memperbesar, Esc atau klik latar untuk menutup
const lightbox = document.getElementById("lightbox");
const lightboxImg = document.getElementById("lightboxImg");
const lightboxCap = document.getElementById("lightboxCap");
let lastThumb = null;

function openLightbox(btn) {
  lastThumb = btn;
  lightboxImg.src = btn.dataset.full;
  lightboxImg.alt = btn.dataset.title;
  lightboxCap.textContent = btn.dataset.title;
  lightbox.hidden = false;
  document.body.style.overflow = "hidden";
  document.getElementById("lightboxClose").focus();
}
function closeLightbox() {
  lightbox.hidden = true;
  document.body.style.overflow = "";
  if (lastThumb) lastThumb.focus();
}
document.querySelectorAll("[data-full]").forEach((btn) =>
  btn.addEventListener("click", () => openLightbox(btn))
);
document.getElementById("lightboxClose").addEventListener("click", closeLightbox);
lightbox.addEventListener("click", (e) => {
  if (e.target === lightbox) closeLightbox();
});
document.addEventListener("keydown", (e) => {
  if (e.key === "Escape" && !lightbox.hidden) closeLightbox();
});

// 10) Ganti tema gelap / terang (pilihan disimpan di browser)
const root = document.documentElement;
const themeBtn = document.getElementById("themeToggle");
const metaTheme = document.getElementById("metaTheme");

function applyTheme(t) {
  root.setAttribute("data-theme", t);
  metaTheme.setAttribute("content", t === "light" ? "#f3f6fc" : "#0a1628");
  themeBtn.setAttribute("aria-label", t === "light" ? "Switch to dark theme" : "Switch to light theme");
}
applyTheme(root.getAttribute("data-theme") === "light" ? "light" : "dark");

themeBtn.addEventListener("click", () => {
  const next = root.getAttribute("data-theme") === "light" ? "dark" : "light";
  applyTheme(next);
  try { localStorage.setItem("theme", next); } catch (e) {}
});
