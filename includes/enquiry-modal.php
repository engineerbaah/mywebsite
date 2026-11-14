<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
<!-- Accessible Enquiry Modal Dialog -->
<div
  id="enquiry-modal-dialog"
  class="modal-dialog-overlay"
  role="dialog"
  aria-modal="true"
  aria-hidden="true"
  aria-labelledby="enquiry-modal-title"
>
  <div class="modal-dialog-window enquiry-modal-window">
    <button
      type="button"
      class="modal-close-btn"
      id="enquiry-modal-close"
      aria-label="Close enquiry form"
    >
      <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
      </svg>
    </button>

    <div class="enquiry-modal-header">
      <span class="eyebrow" style="margin-bottom: 4px;">Get in Touch</span>
      <h2 id="enquiry-modal-title" class="modal-title" style="font-size: 1.625rem; font-weight: 800; color: var(--c-navy-deep); margin: 0 0 6px 0;">
        Start a Project
      </h2>
      <p style="font-size: 0.9375rem; color: var(--c-slate-600); line-height: 1.5; margin: 0;">
        Have a project or system you need designed or developed? Fill out the details below and I will get back to you promptly.
      </p>
    </div>

    <!-- Live Alert Feedback Area -->
    <div id="enquiry-alert-feedback" class="form-alert" style="display: none;" role="alert"></div>

    <form id="enquiry-modal-form" action="<?= site_url('process-contact.php') ?>" method="POST" class="enquiry-form-body">
      <input type="hidden" name="csrf_token" value="<?= get_csrf_token() ?>">
      <!-- Honeypot anti-spam field -->
      <div style="display:none;" aria-hidden="true">
        <label for="modal-website_hp">Leave this empty</label>
        <input type="text" id="modal-website_hp" name="website_hp" tabindex="-1" autocomplete="off">
      </div>

      <div class="form-row-grid">
        <div class="form-group">
          <label for="modal-enquiry-name" class="form-label">Full Name <span style="color:#ef4444;">*</span></label>
          <input
            type="text"
            id="modal-enquiry-name"
            name="name"
            class="form-input"
            placeholder="e.g. Samuel Mensah"
            required
            autocomplete="name"
          >
        </div>

        <div class="form-group">
          <label for="modal-enquiry-email" class="form-label">Email Address <span style="color:#ef4444;">*</span></label>
          <input
            type="email"
            id="modal-enquiry-email"
            name="email"
            class="form-input"
            placeholder="e.g. samuel@business.com"
            required
            autocomplete="email"
          >
        </div>
      </div>

      <div class="form-row-grid">
        <div class="form-group">
          <label for="modal-enquiry-phone" class="form-label">Phone or WhatsApp <span style="color:#ef4444;">*</span></label>
          <input
            type="tel"
            id="modal-enquiry-phone"
            name="phone"
            class="form-input"
            placeholder="e.g. 0535744202"
            required
            autocomplete="tel"
          >
        </div>

        <div class="form-group">
          <label for="modal-enquiry-service" class="form-label">Service of Interest</label>
          <select id="modal-enquiry-service" name="service" class="form-select">
            <option value="">Select a service...</option>
            <option value="Web Engineering & Development">Web Engineering &amp; Development</option>
            <option value="Brand Identity & Digital Experience Design">Brand Identity &amp; Digital Experience Design</option>
            <option value="Digital Strategy & Marketing">Digital Strategy &amp; Marketing</option>
            <option value="IT Solutions & Technology Management">IT Solutions &amp; Technology Management</option>
            <option value="General Consultation / Other">General Consultation / Other</option>
          </select>
        </div>
      </div>

      <div class="form-group">
        <label for="modal-enquiry-message" class="form-label">Project Details &amp; Requirements <span style="color:#ef4444;">*</span></label>
        <textarea
          id="modal-enquiry-message"
          name="message"
          class="form-textarea"
          rows="4"
          placeholder="Briefly describe what you want to build, key features needed, and your target timeline..."
          required
        ></textarea>
      </div>

      <div class="modal-form-actions" style="display: flex; align-items: center; justify-content: space-between; gap: var(--space-md); margin-top: var(--space-sm);">
        <span style="font-size: 0.8125rem; color: var(--c-slate-500);">
          <i class="fa-solid fa-location-dot" style="color: var(--c-sky); margin-right: 4px;"></i> Kumasi, Ghana &bull; Direct Response
        </span>

        <button type="submit" id="modal-enquiry-submit-btn" class="btn btn-primary btn-pill">
          <span>Send Enquiry</span>
          <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
        </button>
      </div>
    </form>
  </div>
</div>
