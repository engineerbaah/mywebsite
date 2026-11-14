<?php
declare(strict_types=1);
require_once __DIR__ . '/config.php';
?>
<!-- Reusable Editorial Contact & Commission Banner -->
<section class="cta-banner" aria-labelledby="cta-banner-heading">
  <div class="container">
    <div class="cta-banner-grid">
      <div>
        <span class="eyebrow eyebrow-inverse">Next Steps</span>
        <h2 id="cta-banner-heading" class="cta-banner-title">
          Ready to build your next digital project?
        </h2>
        <p class="cta-banner-desc">
          Whether you need a bespoke web application, a distinctive brand identity, or dependable IT management, I bring technical rigor and creative design to every build.
        </p>
      </div>

      <div class="cta-banner-actions">
        <button type="button" class="btn btn-sky" data-open-enquiry="" aria-label="Start a project enquiry">
          Start a Project
          <span class="btn-icon-arrow" aria-hidden="true">
            <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M14 5l7 7m0 0l-7 7m7-7H3"/>
            </svg>
          </span>
        </button>
        <a href="<?= site_url('contact.php') ?>" class="btn btn-ghost-inverse">
          Direct Contact Form &rarr;
        </a>
      </div>
    </div>
  </div>
</section>
