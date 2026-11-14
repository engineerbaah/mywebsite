<?php
declare(strict_types=1);

$pageTitle = 'Terms & Conditions — Engineer Baah';
$pageDesc = 'Terms and Conditions governing the use of the Engineer Baah website, portfolio content, intellectual property, and professional service inquiries.';
$pageSlug = 'terms';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2rem, 3.5vw, 3rem);">
  <div class="container">
    <div class="container-narrow" style="margin-inline: 0;">
      <!-- Breadcrumbs -->
      <nav aria-label="Breadcrumb" style="margin-bottom: var(--space-md);">
        <ol style="list-style: none; display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--c-slate-600); padding: 0; margin: 0;">
          <li><a href="<?= site_url() ?>" style="color: var(--c-slate-600); text-decoration: none;">Home</a></li>
          <li aria-hidden="true">&bull;</li>
          <li style="color: var(--c-navy-deep); font-weight: 600;" aria-current="page">Terms &amp; Conditions</li>
        </ol>
      </nav>

      <span class="eyebrow">Legal &amp; Operating Standards</span>
      <h1 class="hero-headline" style="font-size: var(--text-h1); margin-bottom: var(--space-xs);">
        Terms &amp; Conditions
      </h1>
      <p class="hero-lead" style="font-size: 1.05rem; color: var(--text-body); max-width: 60ch;">
        Last updated: January 2026. Please review these terms governing the use of this website, project portfolio materials, and professional service communications.
      </p>
    </div>
  </div>
</section>

<!-- ==========================================================================
     TERMS CONTENT
     ========================================================================== -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="legal-layout-grid">
      <!-- Main Terms Narrative -->
      <article style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: clamp(1.5rem, 4vw, 3rem); box-shadow: var(--shadow-sm); line-height: 1.75; color: var(--text-body);">
        
        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: 0; margin-bottom: var(--space-xs);">
          1. Acceptance of Terms
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          By accessing and browsing the website of <strong>Isaac Brem Baah</strong> (operating under the professional title <strong>ENGINEER BAAH</strong>), you acknowledge that you have read, understood, and agreed to be bound by these Terms and Conditions and the accompanying <a href="<?= site_url('privacy.php') ?>" style="color: var(--c-sky); text-decoration: underline;">Privacy Policy</a>. If you do not agree with any part of these terms, please do not use this site.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          2. Permitted Use &amp; Acceptable Conduct
        </h2>
        <p style="margin-bottom: var(--space-sm);">
          This platform is provided to share information regarding professional capabilities, display selected engineering and design works, and facilitate legitimate business communication. You agree that you will not:
        </p>
        <ul style="padding-left: var(--space-lg); margin-bottom: var(--space-lg); display: flex; flex-direction: column; gap: 6px;">
          <li>Attempt unauthorized access to the underlying server, databases, or administration endpoints.</li>
          <li>Transmit malicious scripts, automated bot inquiries, or unsolicited commercial spam through the contact mechanisms.</li>
          <li>Circumvent or tamper with security headers, token verifications, or operational rate limits.</li>
          <li>Use automated scrapers or crawlers in a manner that degrades system performance or breaches intellectual property rights.</li>
        </ul>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          3. Intellectual Property Rights
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          Unless expressly stated otherwise, all website architecture, custom codebase, styling, visual layouts, written content, photography, and the <strong>ENGINEER BAAH</strong> name and emblem are the exclusive intellectual property of Isaac Brem Baah. No portion of this site may be duplicated, modified, republished, distributed, or reverse engineered for commercial sale without prior written authorization.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          4. Portfolio Works &amp; Client Trademarks
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          Case studies and project summaries showcased across this portfolio demonstrate past design and development solutions. All trademarks, commercial brand names, and company logos featured within client projects (such as SKB Construction, Spotless Agency, Jwils, etc.) remain the registered property of their respective owners. Their inclusion serves solely to illustrate completed technical and design scope and does not constitute a formal corporate endorsement.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          5. Inquiries &amp; Service Engagements
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          Submitting a project enquiry or message through this website does not form a legally binding contract or obligate Engineer Baah to undertake work. All client engagements require a separate, mutually agreed written proposal, specification document, formal contract, and verified deposit before work commences.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          6. External Links
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          This website contains hyperlinks to external third-party services and social media platforms (such as GitHub, LinkedIn, WhatsApp, Meta). Engineer Baah has no direct control over the content, uptime, or privacy standards of external websites and accepts no liability for third-party practices.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          7. Disclaimer &amp; Limitation of Liability
        </h2>
        <p style="margin-bottom: var(--space-lg);">
          This website is provided on an &ldquo;as is&rdquo; and &ldquo;as available&rdquo; basis without warranties of any kind, whether express or implied. To the maximum extent permitted under applicable law, Engineer Baah disclaims liability for any direct, indirect, incidental, or consequential damages resulting from the use of, or inability to use, this website or its resources.
        </p>

        <h2 style="font-size: 1.35rem; color: var(--c-navy-deep); font-weight: 700; margin-top: var(--space-xl); margin-bottom: var(--space-xs);">
          8. Governing Law &amp; Jurisdiction
        </h2>
        <p style="margin-bottom: 0;">
          These Terms and Conditions are governed by and construed in accordance with the laws of the <strong>Republic of Ghana</strong>. Any disputes arising in connection with these terms or the use of this website shall be subject to the exclusive jurisdiction of the competent courts of Ghana.
        </p>
      </article>

      <!-- Sidebar Dossier -->
      <aside style="display: flex; flex-direction: column; gap: var(--space-lg); position: sticky; top: 90px;">
        <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
          <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); display: block; margin-bottom: 8px;">
            Principal Contact
          </span>
          <p style="font-size: 0.95rem; font-weight: 700; color: var(--c-navy-deep); margin: 0 0 4px;">Isaac Brem Baah</p>
          <p style="font-size: 0.85rem; color: var(--c-slate-600); margin: 0 0 12px;">ENGINEER BAAH &bull; Kumasi, Ghana</p>

          <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); display: block; margin-bottom: 4px;">
            Direct Email
          </span>
          <a href="mailto:engineerbaah25@gmail.com" style="font-size: 0.875rem; color: var(--c-sky-deep); text-decoration: none; word-break: break-all; display: block; margin-bottom: 12px;">
            engineerbaah25@gmail.com
          </a>

          <span style="font-family: var(--font-heading); font-size: 0.72rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); display: block; margin-bottom: 4px;">
            Direct Telephone
          </span>
          <p style="font-size: 0.875rem; color: var(--c-navy-deep); font-weight: 600; margin: 0;">
            0535744202 &bull; 0573425734
          </p>
        </div>

        <div style="background: var(--surface-alt); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-md);">
          <div style="font-size: 0.875rem; font-weight: 700; color: var(--c-navy-deep); margin-bottom: 6px;">Privacy Policy</div>
          <p style="font-size: 0.8125rem; color: var(--text-body); line-height: 1.5; margin-bottom: 10px;">
            Review our data governance standards, enquiry logging protocols, and data deletion guidelines.
          </p>
          <a href="<?= site_url('privacy.php') ?>" class="btn btn-secondary btn-sm btn-pill" style="width: 100%; text-align: center;">
            View Privacy Policy &rarr;
          </a>
        </div>
      </aside>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
