<!-- HTML Structure -->
<section class="navbar">
  <div class="header-left">
    <div class="restaurant-logo">
      <img src="../../Source/Logo.png" alt="restaurant-logo" />
    </div>
    <div class="restaurant-name">AYAM GORENG MONAS</div>
  </div>
  <div class="search-bar">
    <input type="text" placeholder="Mau cari apa hari ini?" />
  </div>
  <div class="header-right">
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

<style>
.modal-overlay {
  position: fixed;
  top: 0;
  left: 0;
  width: 100%;
  height: 100%;
  background: rgba(0, 0, 0, 0.5);
  display: flex;
  align-items: center;
  justify-content: center;
  z-index: 9999;
  opacity: 0;
  visibility: hidden;
  pointer-events: none;
  transition: all 0.3s ease;
}

.modal-overlay.show {
  opacity: 1;
  visibility: visible;
  pointer-events: all;
}

.modal-content {
  background: white;
  padding: 30px;
  border-radius: 16px;
  text-align: center;
  max-width: 90%;
  transform: scale(0.9);
  transition: transform 0.3s ease;
}

.modal-overlay.show .modal-content {
  transform: scale(1);
  animation: modalSlideIn 0.3s cubic-bezier(0.34, 1.56, 0.64, 1);
}

.modal-logout {
  max-width: 420px;
}

.modal-icon {
  width: 80px;
  height: 80px;
  margin: 0 auto 20px;
  background: linear-gradient(135deg, #FEE2E2, #FECACA);
  border-radius: 50%;
  display: flex;
  align-items: center;
  justify-content: center;
}

.modal-icon svg {
  color: #DC2626;
}

.modal-title {
  font-size: 24px;
  font-weight: 700;
  color: #111827;
  margin-bottom: 12px;
}

.modal-message {
  font-size: 16px;
  color: #4B5563;
  margin-bottom: 8px;
}

.modal-warning {
  font-size: 14px;
  color: #DC2626;
  margin-bottom: 24px;
}

.modal-actions {
  display: flex;
  gap: 12px;
  justify-content: center;
}

.btn-cancel,
.btn-delete {
  padding: 12px 24px;
  border: none;
  border-radius: 8px;
  font-size: 15px;
  font-weight: 600;
  cursor: pointer;
  display: flex;
  align-items: center;
  gap: 8px;
  transition: all 0.3s ease;
}

.btn-cancel {
  background: #F3F4F6;
  color: #374151;
}

.btn-cancel:hover {
  background: #E5E7EB;
}

.btn-delete {
  background: linear-gradient(135deg, #DC2626, #F97316);
  color: white;
}

.btn-delete:hover {
  transform: translateY(-2px);
  box-shadow: 0 4px 12px rgba(220, 38, 38, 0.3);
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
</style>

<script>
// Ambil elemen
const profileBtn = document.getElementById('profileBtn');
const logoutModal = document.getElementById('logoutModal');
const cancelLogout = document.getElementById('cancelLogout');
const confirmLogout = document.getElementById('confirmLogout');

// Buka modal ketika profile diklik
if (profileBtn) {
  profileBtn.addEventListener('click', function() {
    logoutModal.classList.add('show');
    document.body.style.overflow = 'hidden'; // Disable scroll
  });
}

// Tutup modal ketika tombol batal diklik
if (cancelLogout) {
  cancelLogout.addEventListener('click', function() {
    logoutModal.classList.remove('show');
    document.body.style.overflow = 'auto'; // Enable scroll
  });
}

// Tutup modal ketika klik di luar modal
if (logoutModal) {
  logoutModal.addEventListener('click', function(e) {
    if (e.target === logoutModal) {
      logoutModal.classList.remove('show');
      document.body.style.overflow = 'auto';
    }
  });
}

// Proses logout
if (confirmLogout) {
  confirmLogout.addEventListener('click', function() {
    // Redirect ke halaman logout
    window.location.href = '../auth/logout.php';
  });
}

// Tutup modal dengan tombol ESC
document.addEventListener('keydown', function(e) {
  if (e.key === 'Escape' && logoutModal && logoutModal.classList.contains('show')) {
    logoutModal.classList.remove('show');
    document.body.style.overflow = 'auto';
  }
});
</script>