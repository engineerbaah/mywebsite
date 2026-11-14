<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';
$portfolioData = get_portfolio_projects();
?>
  </main>

  <!-- Global Footer -->
  <footer class="site-footer" role="contentinfo">
    <div class="container">
      <div class="footer-grid">
        <!-- Col 1: Brand & Philosophy -->
        <div class="footer-col-brand">
          <div class="brand-identity" style="margin-bottom: var(--space-2xs);">
            <img
              src="<?= asset_url('assets/images/logo-sky.webp') ?>"
              alt="Engineer Baah Logo"
              class="brand-logo"
              width="38"
              height="31"
              loading="lazy"
            >
            <div class="brand-details">
              <span class="brand-name" style="color: var(--c-white);">Engineer Baah</span>
              <span class="brand-role" style="color: var(--c-sky);">Creative Engineer</span>
            </div>
          </div>
          <p style="font-size: 0.875rem; color: var(--c-slate-400); max-width: 38ch; line-height: 1.6; margin-bottom: var(--space-sm);">
            Combining engineering rigor, creative intelligence, and business execution to craft durable, high-performing digital products and systems.
          </p>

          <!-- 8 Social Media Profiles -->
          <div class="footer-social-row" aria-label="Social media profiles">
            <a href="https://www.linkedin.com/in/baah-isaac-brem-218808324/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
            <a href="https://github.com/engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
            <a href="https://www.facebook.com/engineerbaah/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
            <a href="https://www.instagram.com/engineer.baah/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
            <a href="https://www.tiktok.com/@engineer.baah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
            <a href="https://x.com/engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
            <a href="https://www.youtube.com/@engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
            <!-- <a href="https://wa.me/233535744202" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a> -->
          </div>
        </div>

        <!-- Col 2: Navigation Index -->
        <div>
          <h4 class="footer-title">Navigation</h4>
          <ul class="footer-links">
            <li><a href="<?= site_url() ?>" class="footer-link">Overview</a></li>
            <li><a href="<?= site_url('capabilities.php') ?>" class="footer-link">Services &amp; Disciplines</a></li>
            <li><a href="<?= site_url('work.php') ?>" class="footer-link">Selected Work</a></li>
            <li><a href="<?= site_url('about.php') ?>" class="footer-link">Approach &amp; About</a></li>
            <li><a href="<?= site_url('contact.php') ?>" class="footer-link">Contact</a></li>
          </ul>
        </div>

        <!-- Col 3: Disciplines -->
        <div>
          <h4 class="footer-title">Disciplines</h4>
          <ul class="footer-links">
            <li><a href="<?= site_url('services/web-engineering-development.php') ?>" class="footer-link">Web Engineering &amp; Development</a></li>
            <li><a href="<?= site_url('services/brand-identity-digital-experience-design.php') ?>" class="footer-link">Brand Identity &amp; Experience Design</a></li>
            <li><a href="<?= site_url('services/digital-strategy-marketing.php') ?>" class="footer-link">Digital Strategy &amp; Marketing</a></li>
            <li><a href="<?= site_url('services/it-solutions-technology-management.php') ?>" class="footer-link">IT Solutions &amp; Tech Management</a></li>
          </ul>
        </div>

        <!-- Col 4: Direct Communication -->
        <div>
          <h4 class="footer-title">Direct Inquiries</h4>
          <ul class="footer-links" style="gap: var(--space-xs);">
            <li>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-size: 0.72rem; color: var(--c-slate-400); display: block;">Email</span>
              <a href="mailto:<?= e(SITE_EMAIL) ?>" class="footer-link" style="color: var(--c-sky); font-weight: 500;"><?= e(SITE_EMAIL) ?></a>
            </li>
            <li>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-size: 0.72rem; color: var(--c-slate-400); display: block;">Phone / WhatsApp</span>
              <a href="tel:0535744202" class="footer-link"><?= e(SITE_PHONE) ?></a>
            </li>
            <li>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; text-transform: uppercase; font-size: 0.72rem; color: var(--c-slate-400); display: block;">Studio Base</span>
              <span style="color: var(--c-slate-300); font-size: 0.85rem;"><?= e(SITE_LOCATION) ?></span>
            </li>
          </ul>
        </div>
      </div>

      <!-- Footer Bottom -->
      <div class="footer-bottom">
        <p class="footer-copyright">
          &copy; 2026 ENGINEER BAAH &mdash; Crafted with <i class="fa-solid fa-heart" style="color: #ef4444;" aria-hidden="true"></i> in Kumasi, Ghana &middot; <a href="<?= site_url('privacy.php') ?>" class="footer-policy-link">Privacy Policy</a> &middot; <a href="<?= site_url('terms.php') ?>" class="footer-policy-link">Terms</a>
        </p>
        <div class="footer-time-badge">
          <i class="fa-regular fa-clock" aria-hidden="true" style="color: var(--c-sky); margin-right: 5px;"></i>
          <span>Local Time:</span> <strong id="clock" class="live-clock">--:--:-- GMT</strong>
        </div>
      </div>
    </div>

    <!-- Outlined Footer Watermark (Restrained, refined proportion) -->
    <div class="footer-watermark" aria-hidden="true">
      ENGINEER BAAH
    </div>
  </footer>

  <!-- Reusable Accessible Modal Components -->
  <?php include __DIR__ . '/project-modal.php'; ?>
  <?php include __DIR__ . '/enquiry-modal.php'; ?>

  <!-- Injected Portfolio Data & Client-Side Configuration -->
  <script>
    window.__PORTFOLIO_DATA__ = <?= json_encode($portfolioData, JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE) ?>;
    window.__CONTACT_URL__ = "<?= site_url('contact.php') ?>";
    window.__BASE_URL__ = "<?= BASE_URL ?>";
  </script>

  <!-- Master JavaScript -->
  <script src="<?= asset_url('assets/js/main.js') ?>" defer></script>
</body>
</html>
