<?php
declare(strict_types=1);
?>
<!-- Accessible Project Modal Dialog -->
<div
  id="project-modal-dialog"
  class="modal-dialog-overlay"
  role="dialog"
  aria-modal="true"
  aria-hidden="true"
  aria-labelledby="modal-project-title"
>
  <div class="modal-dialog-window">
    <button
      type="button"
      class="modal-close-btn"
      id="project-modal-close"
      aria-label="Close project details"
    >
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>
    <div class="modal-content-container" id="project-modal-content">
      <!-- Populated dynamically via JavaScript -->
    </div>
  </div>
</div>

