// Custom Modal Confirmation untuk Delete
function showDeleteConfirmation(id, itemName, type = 'review') {
  // Tentukan jenis item yang akan dihapus
  let itemType = '';
  let itemLabel = '';
  
  switch(type) {
    case 'menu':
      itemType = 'menu';
      itemLabel = 'menu';
      break;
    case 'berita':
      itemType = 'berita';
      itemLabel = 'berita';
      break;
    case 'review':
    default:
      itemType = 'review';
      itemLabel = 'review';
      break;
  }
  
  // Create modal overlay
  const overlay = document.createElement('div');
  overlay.className = 'modal-overlay';
  overlay.id = 'deleteModal';
  
  // Create modal content dengan pesan yang dinamis
  overlay.innerHTML = `
    <div class="modal-content">
      <div class="modal-icon">
        <svg xmlns="http://www.w3.org/2000/svg" width="64" height="64" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
          <circle cx="12" cy="12" r="10"></circle>
          <line x1="12" y1="8" x2="12" y2="12"></line>
          <line x1="12" y1="16" x2="12.01" y2="16"></line>
        </svg>
      </div>
      <h2 class="modal-title">Konfirmasi Hapus</h2>
      <p class="modal-message">
        Apakah Anda yakin ingin menghapus ${itemLabel} <strong>${itemName}</strong>?
      </p>
      <p class="modal-warning">
        Tindakan ini tidak dapat dibatalkan!
      </p>
      <div class="modal-actions">
        <button class="btn-cancel" onclick="closeDeleteModal()">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <line x1="18" y1="6" x2="6" y2="18"></line>
            <line x1="6" y1="6" x2="18" y2="18"></line>
          </svg>
          Batal
        </button>
        <button class="btn-delete" onclick="confirmDelete(${id})">
          <svg xmlns="http://www.w3.org/2000/svg" width="18" height="18" viewBox="0 0 24 24" fill="none" stroke="currentColor" stroke-width="2" stroke-linecap="round" stroke-linejoin="round">
            <polyline points="3 6 5 6 21 6"></polyline>
            <path d="M19 6v14a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2V6m3 0V4a2 2 0 0 1 2-2h4a2 2 0 0 1 2 2v2"></path>
            <line x1="10" y1="11" x2="10" y2="17"></line>
            <line x1="14" y1="11" x2="14" y2="17"></line>
          </svg>
          Ya, Hapus
        </button>
      </div>
    </div>
  `;
  
  document.body.appendChild(overlay);
  
  // Add animation
  setTimeout(() => {
    overlay.classList.add('show');
  }, 10);
}

function closeDeleteModal() {
  const modal = document.getElementById('deleteModal');
  if (modal) {
    modal.classList.remove('show');
    setTimeout(() => {
      modal.remove();
    }, 300);
  }
}

function confirmDelete(id) {
  // Redirect to delete URL
  window.location.href = `?hapus=${id}`;
}

// Close modal when clicking outside
document.addEventListener('click', function(event) {
  const modal = document.getElementById('deleteModal');
  if (modal && event.target === modal) {
    closeDeleteModal();
  }
});

document.addEventListener('keydown', function(event) {
  if (event.key === 'Escape') {
    closeDeleteModal();
  }
});

document.addEventListener('DOMContentLoaded', function() {
  if (typeof feather !== 'undefined') {
    feather.replace();
  }
  
const searchInput = document.querySelector('.search-menu');

if (searchInput) {
  searchInput.addEventListener('input', function (e) {
    const searchTerm = e.target.value.toLowerCase();
    const tableRows = document.querySelectorAll('table tbody tr');

    tableRows.forEach(row => {
      const text = row.textContent.toLowerCase();
      row.style.display = text.includes(searchTerm) ? '' : 'none';
    });
  });
}
});
