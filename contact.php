<?php
declare(strict_types=1);

$pageTitle = 'Contact — Engineer Baah | Creative Engineer';
$pageDesc = 'Contact Isaac Brem Baah, Creative Engineer in Kumasi, Ghana. Enquire about web engineering, brand identity design, digital marketing, and IT solutions.';
$pageSlug = 'contact';

require_once __DIR__ . '/includes/header.php';

$csrfToken = get_csrf_token();
$selectedService = $_GET['service'] ?? $_GET['discipline'] ?? '';
$prefilledMessage = $_GET['message'] ?? '';
$statusMessage = '';
$statusType = '';

if (isset($_GET['status'])) {
    switch ($_GET['status']) {
        case 'success':
        case 'sent':
            $statusType = 'is-success';
            $statusMessage = 'Thank you! Your message has been received. Engineer Baah will review your details and respond promptly.';
            break;
        case 'csrf_error':
            $statusType = 'is-error';
            $statusMessage = 'Your session security token expired. Please refresh and re-submit your message.';
            break;
        case 'rate_limited':
            $statusType = 'is-error';
            $statusMessage = 'Please wait a moment before submitting another message.';
            break;
        case 'invalid':
            $statusType = 'is-error';
            $statusMessage = 'Please ensure all required fields are accurately completed.';
            break;
        default:
            $statusType = 'is-error';
            $statusMessage = 'Submission error. Please email directly at engineerbaah25@gmail.com.';
            break;
    }
}
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2.5rem, 4vw, 3.5rem);">
  <div class="container">
    <div class="container-narrow" style="margin-inline: 0;">
      <span class="eyebrow">Let's Connect</span>
      <h1 class="hero-headline hero-ready" style="font-size: var(--text-h1); margin-bottom: var(--space-md);">
        <span class="ln"><span style="--i:0">Start a conversation</span></span>
        <span class="ln"><span style="--i:1">about your next project.</span></span>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-lg);">
        Whether you are planning a new website, developing a custom web portal, designing a brand identity, or improving your business systems, feel free to reach out.
      </p>
    </div>
  </div>
</section>

<!-- ==========================================================================
     CONTACT FORM & DIRECT CONTACT INFORMATION
     ========================================================================== -->
<section class="section">
  <div class="container">
    <div class="inquiry-layout-grid">
      <!-- Contact Form Column -->
      <div>
        <div class="section-header" style="margin-bottom: var(--space-lg);">
          <span class="eyebrow">Send a Message</span>
          <h2 class="section-title">Direct Enquiry Form</h2>
          <p class="section-desc">
            Fill in the form below and I will get back to you promptly.
          </p>
        </div>

        <!-- Alert Feedback Box -->
        <div id="form-alert-feedback" class="form-alert <?= e($statusType) ?>" <?= empty($statusMessage) ? 'style="display:none;"' : '' ?> role="alert">
          <?= e($statusMessage) ?>
        </div>

        <form id="contact-inquiry-form" action="<?= site_url('process-contact.php') ?>" method="POST" novalidate>
          <input type="hidden" name="csrf_token" value="<?= e($csrfToken) ?>">
          <div class="hp-field" aria-hidden="true" style="display:none;">
            <label for="eb-website-hp">Leave this field blank</label>
            <input type="text" id="eb-website-hp" name="_eb_hp_website" tabindex="-1" autocomplete="off">
          </div>

          <div class="form-row-2col">
            <!-- Full Name -->
            <div class="form-group">
              <label for="contact-name" class="form-label">
                Your Full Name <span class="form-required" style="color: #ef4444;">*</span>
              </label>
              <input
                type="text"
                id="contact-name"
                name="name"
                class="form-input"
                required
                autocomplete="name"
                placeholder="e.g. Samuel Mensah"
              >
            </div>

            <!-- Email Address -->
            <div class="form-group">
              <label for="contact-email" class="form-label">
                Email Address <span class="form-required" style="color: #ef4444;">*</span>
              </label>
              <input
                type="email"
                id="contact-email"
                name="email"
                class="form-input"
                required
                autocomplete="email"
                placeholder="e.g. samuel@business.com"
              >
            </div>
          </div>

          <div class="form-row-2col">
            <!-- Organization -->
            <div class="form-group">
              <label for="contact-org" class="form-label">Company or Organization</label>
              <input
                type="text"
                id="contact-org"
                name="organization"
                class="form-input"
                autocomplete="organization"
                placeholder="e.g. Enterprise Ltd"
              >
            </div>

            <!-- Phone / WhatsApp -->
            <div class="form-group">
              <label for="contact-phone" class="form-label">Phone or WhatsApp <span style="color:#ef4444;">*</span></label>
              <input
                type="tel"
                id="contact-phone"
                name="phone"
                class="form-input"
                autocomplete="tel"
                placeholder="e.g. 0535744202"
                required
              >
            </div>
          </div>

          <!-- Service of Interest -->
          <div class="form-group">
            <label for="contact-discipline" class="form-label">Service of Interest</label>
            <select id="contact-discipline" name="service" class="form-select">
              <option value="">Select a service area...</option>
              <option value="Web Engineering & Development" <?= strpos($selectedService, 'Web') !== false ? 'selected' : '' ?>>Web Engineering &amp; Development</option>
              <option value="Brand Identity & Digital Experience Design" <?= strpos($selectedService, 'Brand') !== false ? 'selected' : '' ?>>Brand Identity &amp; Digital Experience Design</option>
              <option value="Digital Strategy & Marketing" <?= strpos($selectedService, 'Marketing') !== false || strpos($selectedService, 'Strategy') !== false ? 'selected' : '' ?>>Digital Strategy &amp; Marketing</option>
              <option value="IT Solutions & Technology Management" <?= strpos($selectedService, 'IT') !== false || strpos($selectedService, 'Technology') !== false ? 'selected' : '' ?>>IT Solutions &amp; Technology Management</option>
              <option value="General Consultation / Other" <?= strpos($selectedService, 'General') !== false ? 'selected' : '' ?>>General Consultation / Other</option>
            </select>
          </div>

          <!-- Message -->
          <div class="form-group">
            <label for="contact-message" class="form-label">
              Project Details &amp; Message <span class="form-required" style="color: #ef4444;">*</span>
            </label>
            <textarea
              id="contact-message"
              name="message"
              class="form-textarea"
              rows="5"
              required
              placeholder="Tell me about what you would like to build, your goals, key features, and your target timeline..."
            ><?= e($prefilledMessage) ?></textarea>
          </div>

          <button type="submit" class="btn btn-primary btn-pill" style="min-width: 200px;">
            Send Message
            <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
          </button>
        </form>
      </div>

      <!-- Studio Direct Contact Details Sidebar -->
      <aside aria-label="Direct Contact Details">
        <div style="background-color: var(--surface-subtle); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-xl); position: sticky; top: 100px;">
          <span class="eyebrow">Let's Connect</span>
          <h3 style="font-size: 1.35rem; font-weight: 800; color: var(--c-navy); margin-bottom: var(--space-md);">
            Direct Details
          </h3>

          <div style="display: flex; flex-direction: column; gap: var(--space-lg);">
            <div>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 2px;">Phone Numbers</span>
              <div style="display: flex; flex-direction: column; gap: 3px;">
                <a href="tel:0535744202" style="font-size: 0.95rem; font-weight: 700; color: var(--c-navy);">
                  0535744202
                </a>
                <a href="tel:0573425734" style="font-size: 0.95rem; font-weight: 700; color: var(--c-navy);">
                  0573425734
                </a>
              </div>
            </div>

            <div>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 2px;">Email Address</span>
              <a href="mailto:engineerbaah25@gmail.com" style="font-size: 0.95rem; font-weight: 700; color: var(--c-navy); word-break: break-all;">
                engineerbaah25@gmail.com
              </a>
              <span style="display: block; font-size: 0.75rem; color: var(--c-slate-500); margin-top: 2px;">Direct inbox &bull; quick response</span>
            </div>

            <div>
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 2px;">Location Base &bull; Live Time</span>
              <p style="font-size: 0.95rem; color: var(--c-slate-800); font-weight: 600; margin: 0;">
                Kumasi, Ghana &bull; <strong id="contact-clock" class="live-clock" style="color: var(--c-navy-deep);">--:--:-- GMT</strong>
              </p>
              <span style="display: block; font-size: 0.75rem; color: var(--c-slate-500); margin-top: 2px;">Available for projects locally and remotely worldwide</span>
            </div>

            <!-- Social Media Profiles -->
            <div style="padding-top: var(--space-md); border-top: 1px solid var(--border-line);">
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 8px;">Find Me Online</span>
              <div class="footer-social-row" style="margin-top: 0;">
                <a href="https://www.linkedin.com/in/baah-isaac-brem-218808324/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="LinkedIn"><i class="fa-brands fa-linkedin"></i></a>
                <a href="https://github.com/engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="GitHub"><i class="fa-brands fa-github"></i></a>
                <a href="https://www.facebook.com/engineerbaah/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="Facebook"><i class="fa-brands fa-facebook"></i></a>
                <a href="https://www.instagram.com/engineer.baah/" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="Instagram"><i class="fa-brands fa-instagram"></i></a>
                <a href="https://www.tiktok.com/@engineer.baah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="TikTok"><i class="fa-brands fa-tiktok"></i></a>
                <a href="https://x.com/engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="X"><i class="fa-brands fa-x-twitter"></i></a>
                <a href="https://www.youtube.com/@engineerbaah" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="YouTube"><i class="fa-brands fa-youtube"></i></a>
                <a href="https://wa.me/233535744202" target="_blank" rel="noopener me" class="footer-social-icon" aria-label="WhatsApp"><i class="fa-brands fa-whatsapp"></i></a>
              </div>
            </div>
          </div>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
