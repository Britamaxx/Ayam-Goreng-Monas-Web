/* =================================================================== */
/* BAGIAN 1: CLASS CAROUSEL (Mendefinisikan 'blueprint')               */
/* =================================================================== */
class Carousel {
  constructor() {
    this.track = document.querySelector(".carousel-track");
    this.slides = document.querySelectorAll(".carousel-slide");
    this.dots = document.querySelectorAll(".dot");
    this.carouselElement = document.querySelector(".image-carousel");

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
/* BAGIAN 3.5: FUNGSI ANIMASI MENU (Blueprint animasi menu) - BARU    */
/* =================================================================== */
function setupMenuAnimation() {
  const menuItems = document.querySelectorAll(".menu-item");

  // Jika tidak ada menu items, skip
  if (menuItems.length === 0) {
    return;
  }

  // Langsung tambahkan animasi dengan delay bertahap
  menuItems.forEach((item, index) => {
    setTimeout(() => {
      item.classList.add("show");
    }, index * 300); // 150ms delay antar item
  });
}

/* =================================================================== */
/* BAGIAN 3.7: FUNGSI ANIMASI REVIEW (Blueprint animasi review) - BARU */
/* =================================================================== */
function setupReviewAnimation() {
  const reviewCards = document.querySelectorAll(".review-card");

  if (reviewCards.length === 0) {
    return;
  }

  const options = {
    threshold: 0.1, // Picu saat 10% elemen terlihat
    rootMargin: "0px 0px -50px 0px", // Memulai sedikit lebih awal
  };

  const observer = new IntersectionObserver((entries, observer) => {
    entries.forEach((entry) => {
      if (entry.isIntersecting) {
        // Tambahkan class 'show' dengan delay bertahap
        const index = Array.from(reviewCards).indexOf(entry.target);
        setTimeout(() => {
          entry.target.classList.add("show");
          observer.unobserve(entry.target); // Berhenti mengamati setelah muncul
        }, index * 300); // 100ms delay antar item
      }
    });
  }, options);

  reviewCards.forEach((card) => {
    // Awalnya sembunyikan elemen dengan class 'hide'
    card.classList.add('hide');
    observer.observe(card);
  });
}

/* =================================================================== */
/* BAGIAN 4: EKSEKUSI UTAMA (Setelah HTML dimuat)                      */
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

  //--- Animasi Menu - BARU ---
  // Panggil fungsi animasi menu
  setupMenuAnimation();

  //--- Animasi Review - BARU ---
  // Panggil fungsi animasi review
  setupReviewAnimation();

});

document.addEventListener('DOMContentLoaded', function () {
  const readMoreBtns = document.querySelectorAll('.read-more-btn');

  readMoreBtns.forEach(btn => {
    btn.addEventListener('click', function (e) {
      e.stopPropagation();

      const cardItem = this.closest('.card-item');
      const shortText = cardItem.querySelector('.news-short');
      const fullText = cardItem.querySelector('.news-full');
      const cardImage = cardItem.querySelector('.card-image');

      if (fullText.style.display === 'none' || fullText.style.display === '') {
        shortText.style.display = 'none';
        fullText.style.display = 'block';
        this.textContent = 'Tutup ↑';
        cardImage.classList.add('expanded');
      } else {
        shortText.style.display = 'block';
        fullText.style.display = 'none';
        this.textContent = 'Baca selengkapnya →';
        cardImage.classList.remove('expanded');
      }
    });
  });
});