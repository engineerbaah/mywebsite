<?php
declare(strict_types=1);

require_once __DIR__ . '/config.php';

$pageTitle = $pageTitle ?? SITE_NAME . ' — ' . SITE_TAGLINE;
$pageDesc = $pageDesc ?? SITE_BIO;
$pageSlug = $pageSlug ?? 'home';

// Absolute Canonical Production URL
if (!isset($canonicalUrl)) {
    if (!empty($canonicalPath)) {
        $canonicalUrl = canonical_url($canonicalPath);
    } else {
        $canonicalUrl = canonical_url($pageSlug === 'home' ? '' : $pageSlug . '.php');
    }
}

// Ensure OpenGraph Image is an absolute URL
if (!isset($ogImage)) {
    $ogImage = canonical_url('assets/images/og-default.jpg');
} elseif (!preg_match('#^https?://#i', $ogImage)) {
    $ogImage = canonical_url(ltrim($ogImage, '/'));
}
?>
<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <script>document.documentElement.classList.add('js');</script>
  <title><?= e($pageTitle) ?></title>
  <meta name="description" content="<?= e($pageDesc) ?>">
  <link rel="canonical" href="<?= e($canonicalUrl) ?>">
<?php if (!empty($noindex) || $pageSlug === '404'): ?>
  <meta name="robots" content="noindex, follow">
<?php else: ?>
  <meta name="robots" content="index, follow, max-image-preview:large, max-snippet:-1, max-video-preview:-1">
<?php endif; ?>

  <!-- Open Graph / Meta -->
  <meta property="og:type" content="website">
  <meta property="og:url" content="<?= e($canonicalUrl) ?>">
  <meta property="og:title" content="<?= e($pageTitle) ?>">
  <meta property="og:description" content="<?= e($pageDesc) ?>">
  <meta property="og:image" content="<?= e($ogImage) ?>">

  <!-- Twitter Meta -->
  <meta name="twitter:card" content="summary_large_image">
  <meta name="twitter:title" content="<?= e($pageTitle) ?>">
  <meta name="twitter:description" content="<?= e($pageDesc) ?>">
  <meta name="twitter:image" content="<?= e($ogImage) ?>">

  <!-- Official Brand Favicons -->
  <link rel="icon" type="image/png" href="<?= asset_url('assets/images/logo-sky.png') ?>">
  <link rel="apple-touch-icon" href="<?= asset_url('assets/images/logo.png') ?>">

  <!-- Google Fonts: Urbanist (Headings/Display/Brand) & DM Sans (Body) -->
  <link rel="preconnect" href="https://fonts.googleapis.com">
  <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
  <link href="https://fonts.googleapis.com/css2?family=DM+Sans:ital,opsz,wght@0,9..40,400;0,9..40,500;0,9..40,600;0,9..40,700;1,9..40,400&family=Urbanist:ital,wght@0,400;0,500;0,600;0,700;0,800;1,400;1,700&display=swap" rel="stylesheet">

  <!-- Font Awesome 6 Icons (Asynchronously Loaded to Eliminate Render-Blocking Overhead) -->
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css" integrity="sha512-DTOQO9RWCH3ppGqcWaEA1BIZOC6xxalwEsw9c2QQeAIftl+Vegovlnee1c9QX4TctnWMn13TZye+giMm8e2LwA==" crossorigin="anonymous" referrerpolicy="no-referrer" media="print" onload="this.media='all'">
  <noscript>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.5.1/css/all.min.css">
  </noscript>

  <!-- Master Stylesheet -->
  <link rel="stylesheet" href="<?= asset_url('assets/css/main.css') ?>">

  <!-- JSON-LD Structured Data (Google Search Essentials & Schema.org Compliant) -->
  <?php
  // Default Breadcrumbs for subpages if not explicitly provided
  if (!isset($breadcrumbItems) && $pageSlug !== 'home') {
      $friendlyName = match ($pageSlug) {
          'capabilities' => 'Services & Disciplines',
          'work' => 'Selected Work',
          'about' => 'About Engineer Baah',
          'contact' => 'Contact',
          'privacy' => 'Privacy Policy',
          'terms' => 'Terms & Conditions',
          default => trim(strip_tags(explode('—', $pageTitle)[0]))
      };
      $breadcrumbItems = [
          ['name' => 'Home', 'url' => canonical_url()],
          ['name' => $friendlyName, 'url' => $canonicalUrl]
      ];
  }

  $schemaGraph = [
      [
          "@type" => "WebSite",
          "@id" => PRODUCTION_ORIGIN . "/#website",
          "url" => PRODUCTION_ORIGIN . "/",
          "name" => SITE_NAME,
          "description" => SITE_BIO,
          "publisher" => [
              "@id" => PRODUCTION_ORIGIN . "/#person"
          ]
      ],
      [
          "@type" => "Person",
          "@id" => PRODUCTION_ORIGIN . "/#person",
          "name" => "Engineer Baah",
          "alternateName" => "Isaac Brem Baah",
          "jobTitle" => "Creative Engineer",
          "description" => SITE_BIO,
          "url" => PRODUCTION_ORIGIN . "/",
          "image" => canonical_url('assets/images/baah-portrait.webp'),
          "email" => SITE_EMAIL,
          "telephone" => "+233535744202",
          "address" => [
              "@type" => "PostalAddress",
              "addressLocality" => "Kumasi",
              "addressRegion" => "Ashanti Region",
              "addressCountry" => "GH"
          ],
          "sameAs" => [
              "https://www.linkedin.com/in/baah-isaac-brem-218808324/",
              "https://github.com/engineerbaah",
              "https://www.facebook.com/engineerbaah/",
              "https://www.instagram.com/engineer.baah/",
              "https://www.tiktok.com/@engineer.baah",
              "https://x.com/engineerbaah",
              "https://www.youtube.com/@engineerbaah"
          ],
          "knowsAbout" => [
              "Web Engineering & Development",
              "Brand Identity & Digital Experience Design",
              "Digital Strategy & Marketing",
              "IT Solutions & Technology Management",
              "Full-Stack Web Architecture",
              "UI/UX Design Systems"
          ]
      ],
      [
          "@type" => "ProfessionalService",
          "@id" => PRODUCTION_ORIGIN . "/#business",
          "name" => "Engineer Baah",
          "url" => PRODUCTION_ORIGIN . "/",
          "logo" => canonical_url('assets/images/logo.png'),
          "image" => canonical_url('assets/images/og-default.jpg'),
          "telephone" => "+233535744202",
          "email" => SITE_EMAIL,
          "priceRange" => "$$",
          "address" => [
              "@type" => "PostalAddress",
              "addressLocality" => "Kumasi",
              "addressRegion" => "Ashanti Region",
              "addressCountry" => "GH"
          ],
          "founder" => [
              "@id" => PRODUCTION_ORIGIN . "/#person"
          ],
          "areaServed" => [
              [
                  "@type" => "Country",
                  "name" => "Ghana"
              ],
              [
                  "@type" => "AdministrativeArea",
                  "name" => "Worldwide"
              ]
          ]
      ]
  ];

  if (!empty($breadcrumbItems)) {
      $itemList = [];
      foreach ($breadcrumbItems as $idx => $bc) {
          $itemList[] = [
              "@type" => "ListItem",
              "position" => $idx + 1,
              "name" => $bc['name'],
              "item" => $bc['url']
          ];
      }
      $schemaGraph[] = [
          "@type" => "BreadcrumbList",
          "@id" => $canonicalUrl . "#breadcrumb",
          "itemListElement" => $itemList
      ];
  }

  if (!empty($serviceSchema)) {
      $schemaGraph[] = $serviceSchema;
  }
  ?>
  <script type="application/ld+json">
  <?= json_encode([
      "@context" => "https://schema.org",
      "@graph" => $schemaGraph
  ], JSON_UNESCAPED_SLASHES | JSON_UNESCAPED_UNICODE | JSON_PRETTY_PRINT) ?>
  </script>
</head>
<body>

  <!-- Scroll-Driven Reading Progress Line -->
  <div id="scroll-progress" class="scroll-progress-bar" aria-hidden="true"></div>

  <!-- Accessible Skip Link -->
  <a href="#main-content" class="skip-link">Skip to main content</a>

  <!-- Global Header -->
  <header class="site-header" role="banner">
    <div class="container site-header-inner">
      <!-- Official Brand Logo & Identity -->
      <a href="<?= site_url() ?>" class="brand-identity" aria-label="Engineer Baah — Creative Engineer Homepage">
        <img
          src="<?= asset_url('assets/images/logo.webp') ?>"
          alt="Engineer Baah Logo"
          class="brand-logo"
          width="36"
          height="31"
          loading="eager"
        >
        <div class="brand-details">
          <span class="brand-name">Engineer Baah</span>
          <span class="brand-role">Creative Engineer</span>
        </div>
      </a>

      <!-- Desktop Navigation -->
      <nav class="desktop-nav" aria-label="Main Navigation">
        <ul class="nav-list">
          <li><a href="<?= site_url() ?>" <?= is_active($pageSlug, 'home') ?>>Overview</a></li>
          <li><a href="<?= site_url('capabilities.php') ?>" <?= is_active($pageSlug, 'capabilities') ?>>Services</a></li>
          <li><a href="<?= site_url('work.php') ?>" <?= is_active($pageSlug, 'work') ?>>Selected Work</a></li>
          <li><a href="<?= site_url('about.php') ?>" <?= is_active($pageSlug, 'about') ?>>About</a></li>
          <li><a href="<?= site_url('contact.php') ?>" <?= is_active($pageSlug, 'contact') ?>>Contact</a></li>
        </ul>
      </nav>

      <!-- Header Actions -->
      <div class="header-actions">
        <button type="button" class="btn btn-primary btn-sm header-cta" data-open-enquiry="" aria-label="Start a project">
          Start a Project
        </button>

        <!-- Mobile Toggle Button -->
        <button
          type="button"
          class="nav-toggle-btn"
          id="nav-toggle-btn"
          aria-expanded="false"
          aria-controls="mobile-nav-drawer"
          aria-label="Toggle navigation menu"
        >
          <span class="nav-toggle-icon" aria-hidden="true">
            <span></span>
            <span></span>
            <span></span>
          </span>
        </button>
      </div>
    </div>
  </header>

  <!-- Accessible Mobile Navigation Drawer -->
  <div id="mobile-nav-drawer" class="mobile-nav-drawer" role="dialog" aria-modal="true" aria-label="Mobile Navigation Menu">
    <div class="mobile-nav-backdrop" id="mobile-nav-backdrop"></div>
    <div class="mobile-nav-panel">
      <div class="mobile-nav-header">
        <div class="brand-identity">
          <img
            src="<?= asset_url('assets/images/logo.webp') ?>"
            alt="Engineer Baah Logo"
            class="brand-logo"
            width="34"
            height="29"
          >
          <div class="brand-details">
            <span class="brand-name" style="font-size: 1rem;">Engineer Baah</span>
            <span class="brand-role">Creative Engineer</span>
          </div>
        </div>
        <button type="button" class="mobile-nav-close" id="mobile-nav-close" aria-label="Close menu">
          <svg width="20" height="20" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M6 18L18 6M6 6l12 12"/>
          </svg>
        </button>
      </div>

      <div class="mobile-nav-body">
        <!-- <span class="eyebrow">Navigation</span> -->
        <ul class="mobile-nav-list">
          <li><a href="<?= site_url() ?>" class="mobile-nav-link <?= $pageSlug === 'home' ? 'is-active' : '' ?>">Overview</a></li>
          <li><a href="<?= site_url('capabilities.php') ?>" class="mobile-nav-link <?= $pageSlug === 'capabilities' ? 'is-active' : '' ?>">Services</a></li>
          <li><a href="<?= site_url('work.php') ?>" class="mobile-nav-link <?= $pageSlug === 'work' ? 'is-active' : '' ?>">Selected Work</a></li>
          <li><a href="<?= site_url('about.php') ?>" class="mobile-nav-link <?= $pageSlug === 'about' ? 'is-active' : '' ?>">About</a></li>
          <li><a href="<?= site_url('contact.php') ?>" class="mobile-nav-link <?= $pageSlug === 'contact' ? 'is-active' : '' ?>">Contact</a></li>
        </ul>
      </div>

      <div class="mobile-nav-footer">
        <!-- <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; color: var(--text-muted); text-transform: uppercase;">Direct Line &bull; Kumasi, Ghana</span>
        <a href="mailto:<?= e(SITE_EMAIL) ?>" style="font-size: 0.9rem; font-weight: 600; color: var(--c-navy-deep);"><?= e(SITE_EMAIL) ?></a>
        <a href="tel:0535744202" style="font-size: 0.85rem; color: var(--c-slate-600);"><?= e(SITE_PHONE) ?></a> -->
        <button type="button" class="btn btn-sky" data-open-enquiry="" style="margin-top: var(--space-xs); width: 100%;">
          Start a Project
        </button>
      </div>
    </div>
  </div>

  <main id="main-content">
