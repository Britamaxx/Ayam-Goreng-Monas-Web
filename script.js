/* =================================================================== */
/* BAGIAN 1: CLASS CAROUSEL (Mendefinisikan 'blueprint')               */
/* =================================================================== */
class Carousel {
  constructor() {
    this.track = document.querySelector(".carousel-track");
    this.slides = document.querySelectorAll(".carousel-slide");
    this.dots = document.querySelectorAll(".dot");
    this.carouselElement = document.querySelector(".image-carousel"); // Kita butuh ini untuk mouse enter/leave

    this.currentIndex = 0;
    this.totalSlides = this.slides.length;
    this.autoPlayInterval = null;
    this.autoPlayDelay = 4000; // 4 detik

    this.init();
  }

  init() {
    this.dots.forEach((dot) => {
      dot.addEventListener("click", (e) => {
        const index = parseInt(e.target.dataset.index);
        this.goToSlide(index);
      });
    });

    // Ini adalah baris yang menyebabkan error sebelumnya
    // Sekarang aman karena kita HANYA memanggil 'new Carousel()'
    // jika '.image-carousel' ada.
    this.carouselElement.addEventListener("mouseenter", () => this.stopAutoPlay());
    this.carouselElement.addEventListener("mouseleave", () => this.startAutoPlay());

    this.startAutoPlay();
  }

  goToSlide(index) {
    this.currentIndex = index;
    this.updateCarousel();
    this.resetAutoPlay();
  }

  goToNext() {
    this.currentIndex = (this.currentIndex + 1) % this.totalSlides;
    this.updateCarousel();
  }

  updateCarousel() {
    const offset = -this.currentIndex * 100;
    this.track.style.transform = `translateX(${offset}%)`;

    this.dots.forEach((dot, index) => {
      if (index === this.currentIndex) {
        dot.classList.add("active");
      } else {
        dot.classList.remove("active");
      }
    });
  }

  startAutoPlay() {
    this.autoPlayInterval = setInterval(() => {
      this.goToNext();
    }, this.autoPlayDelay);
  }

  stopAutoPlay() {
    if (this.autoPlayInterval) {
      clearInterval(this.autoPlayInterval);
      this.autoPlayInterval = null;
    }
  }

  resetAutoPlay() {
    this.stopAutoPlay();
    this.startAutoPlay();
  }
}

/* =================================================================== */
/* BAGIAN 2: DATA LOKASI (Untuk tombol detail)                         */
/* =================================================================== */
const googleMapsLinks = {
  "AGM Mall SCP": "https://maps.app.goo.gl/DZd2yCgrp4CzVrni9",
  "AGM Mall Lembuswana": "https://maps.app.goo.gl/e6Z7DnGi2DDGtJtZA",
  "AGM Mall Samarinda Square": "https://maps.app.goo.gl/cc82P97bxeyLUBux8",
};

/* =================================================================== */
/* BAGIAN 3: FUNGSI ANIMASI STORY (Blueprint animasi)                  */
/* =================================================================== */
function setupStoryAnimation() {
  const elementsToAnimate = document.querySelectorAll(
    ".story-header, .timeline-item"
  );

  // Pengecekan internal: Jika tidak ada elemen story di halaman ini,
  // jangan lakukan apa-apa.
  if (elementsToAnimate.length === 0) {
    return;
  }

  // Opsi observer
  const options = {
    threshold: 0.15, // Picu saat 15% elemen terlihat
  };

  // Buat observer
  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        entry.target.classList.add("show"); // Tambahkan class .show untuk memicu CSS
        observer.unobserve(entry.target); // Berhenti mengamati setelah muncul
      }
    });
  }, options);

  // Amati setiap elemen yang ada di 'elementsToAnimate'
  elementsToAnimate.forEach((element) => {
    observer.observe(element);
  });
}

/* =================================================================== */
/* BAGIAN 4: EKSEKUSI UTAMA (Setelah HTML dimuat)                      */
/* INI ADALAH BAGIAN DENGAN PERBAIKAN KUNCI                           */
/* =================================================================== */
document.addEventListener("DOMContentLoaded", () => {
  
  //--- Perbaikan untuk Carousel ---
  // HANYA jalankan 'new Carousel()' JIKA elemen .image-carousel ADA di halaman.
  if (document.querySelector(".image-carousel")) {
    new Carousel();
  }

  //--- Perbaikan untuk Tombol Detail ---
  // HANYA jalankan kode ini JIKA tombol .detail-btn ADA di halaman.
  const detailButtons = document.querySelectorAll(".detail-btn");
  if (detailButtons.length > 0) {
    detailButtons.forEach((button) => {
      button.addEventListener("click", function () {
        const card = this.closest(".card");
        const outletName = card.querySelector("h3").textContent;
        const mapsLink = googleMapsLinks[outletName];

        if (mapsLink && mapsLink !== "") {
          window.open(mapsLink, "_blank");
        } else {
          alert("Link Google Maps untuk " + outletName + " belum tersedia");
        }
      });
    });
  }

  //--- Perbaikan untuk Animasi Story ---
  // Selalu panggil fungsi ini.
  // Fungsi ini sudah punya pengecekan internal (di BAGIAN 3)
  // jadi aman dipanggil di halaman manapun.
  setupStoryAnimation();

});