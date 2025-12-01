<!-- HTML Structure -->
<section class="navbar">
  <div class="header-left">
    <div class="restaurant-logo">
      <img src="../../Source/Logo.png" alt="restaurant-logo" />
    </div>
    <div class="restaurant-name">AYAM GORENG MONAS</div>
  </div>
  <div class="search-bar">
    <input type="text" placeholder="Search..." />
  </div>
  <div class="header-right">
    <div class="setting-button">
      <a href="../konten_Web/manage_konten.php">
        <i data-feather="settings" class="setting-btn"></i>
      </a>
    </div>
    <div class="profile" id="profileBtn">
      <img src="../../Source/admin.png" alt="admin-profile" />
    </div>
  </div>
</section>

<!-- Modal Logout -->
<div class="modal-overlay" id="logoutModal">
  <div class="modal-content modal-logout">
    <div class="modal-icon">
      <svg xmlns="http://www.w3.org/2000/svg" width="40" height="40" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
        <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
        <polyline points="16 17 21 12 16 7"></polyline>
        <line x1="21" y1="12" x2="9" y2="12"></line>
      </svg>
    </div>
    <h2 class="modal-title">Konfirmasi Logout</h2>
    <p class="modal-message">Apakah Anda yakin ingin keluar dari akun Anda?</p>
    <p class="modal-warning">Anda harus login kembali untuk mengakses dashboard.</p>
    <div class="modal-actions">
      <button class="btn-cancel" id="cancelLogout">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <line x1="18" y1="6" x2="6" y2="18"></line>
          <line x1="6" y1="6" x2="18" y2="18"></line>
        </svg>
        Batal
      </button>
      <button class="btn-delete" id="confirmLogout">
        <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <path d="M9 21H5a2 2 0 0 1-2-2V5a2 2 0 0 1 2-2h4"></path>
          <polyline points="16 17 21 12 16 7"></polyline>
          <line x1="21" y1="12" x2="9" y2="12"></line>
        </svg>
        Logout
      </button>
    </div>
  </div>
</div>

<script>
// Ambil elemen
const profileBtn = document.getElementById('profileBtn');
const logoutModal = document.getElementById('logoutModal');
const cancelLogout = document.getElementById('cancelLogout');
const confirmLogout = document.getElementById('confirmLogout');

// Buka modal ketika profile diklik
profileBtn.addEventListener('click', function() {
  logoutModal.classList.add('show');
  document.body.style.overflow = 'hidden'; // Disable scroll
});

// Tutup modal ketika tombol batal diklik
cancelLogout.addEventListener('click', function() {
  logoutModal.classList.remove('show');
  document.body.style.overflow = 'auto'; // Enable scroll
});

// Tutup modal ketika klik di luar modal
logoutModal.addEventListener('click', function(e) {
  if (e.target === logoutModal) {
    logoutModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  }
});

confirmLogout.addEventListener('click', function() {
  // Redirect ke halaman logout atau login
  window.location.href = '../auth/logout.php'; // Sesuaikan dengan path logout Anda
  
  // Atau jika menggunakan AJAX:
  // fetch('logout.php')
  //   .then(() => window.location.href = 'login.php');
});

document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && logoutModal.classList.contains('show')) {
    logoutModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  }
});
</script>

<style>

.modal-overlay {
  display: flex;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
}

.modal-overlay.show {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

.modal-logout {
  max-width: 420px;
}

.modal-logout .modal-icon {
  background: linear-gradient(135deg, #DBEAFE, #BFDBFE);
}

.modal-logout .modal-icon svg {
  color: #DC2626;
}

@keyframes modalSlideIn {
  from {
    transform: scale(0.9) translateY(-20px);
    opacity: 0;
  }
  to {
    transform: scale(1) translateY(0);
    opacity: 1;
  }
}

.modal-overlay.show .modal-content {
  animation: modalSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}
</style>