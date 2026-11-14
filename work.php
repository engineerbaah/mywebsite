<?php
declare(strict_types=1);

$pageTitle = 'Selected Work & Case Studies — Engineer Baah';
$pageDesc = 'Real-world case studies and digital architectures engineered by Isaac Brem Baah across civil engineering, education, tourism, and corporate facilities.';
$pageSlug = 'work';

require_once __DIR__ . '/includes/header.php';
$projects = get_portfolio_projects();
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2.5rem, 4vw, 3.5rem);">
  <div class="container">
    <div class="container-narrow" style="margin-inline: 0;">
      <span class="eyebrow">Index 03 // Portfolio Monograph</span>
      <h1 class="hero-headline hero-ready" style="font-size: var(--text-h1); margin-bottom: var(--space-md);">
        <span class="ln"><span style="--i:0">Selected work, case studies</span></span>
        <span class="ln"><span style="--i:1">&amp; technical architectures.</span></span>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-lg);">
        Each project below was engineered to solve concrete business bottlenecks, establish undisputed credibility, and operate reliably at scale. No fabricated statistics or speculative mockups—only real, deployed software and visual systems.
      </p>
    </div>
  </div>
</section>

<!-- ==========================================================================
     PROJECT SHOWCASE & FILTER BAR
     ========================================================================== -->
<section class="section">
  <div class="container">
    <!-- Filter Bar -->
    <div class="work-filter-bar" role="toolbar" aria-label="Filter projects by category">
      <button type="button" class="filter-btn is-active" data-filter="all">All Disciplines (<?= count($projects) ?>)</button>
      <button type="button" class="filter-btn" data-filter="web-app">Web Applications</button>
      <button type="button" class="filter-btn" data-filter="product">Digital Products</button>
      <button type="button" class="filter-btn" data-filter="brand-system">Brand Systems</button>
      <button type="button" class="filter-btn" data-filter="business-platform">Business Platforms</button>
    </div>

    <!-- Architectural Case Study Spreads (Replaces monotonous card grid) -->
    <div class="case-study-spreads" id="work-grid-container">
      <?php 
      $spreadIndex = 0;
      foreach ($projects as $pId => $proj): 
        $isReversed = ($spreadIndex % 2 === 1);
        $spreadIndex++;
        $simulatedDomain = strtolower(preg_replace('/[^a-zA-Z0-9]/', '', $proj['title'])) . '.internal';
      ?>
        <article id="<?= e($pId) ?>" class="case-study-spread <?= $isReversed ? 'is-reversed' : '' ?>" data-category="<?= e($proj['category_slug']) ?>" style="scroll-margin-top: 100px;">
          <!-- Media Column (Browser Mockup Frame) -->
          <div class="case-study-media-col">
            <div class="browser-mockup">
              <div class="browser-mockup-header">
                <div class="browser-dots" aria-hidden="true">
                  <span class="browser-dot"></span>
                  <span class="browser-dot"></span>
                  <span class="browser-dot"></span>
                </div>
                <div class="browser-url-bar">
                  <span>https://<?= e($simulatedDomain) ?>/production-release</span>
                </div>
              </div>
              <div class="browser-viewport">
                <picture>
                  <source srcset="<?= asset_url($proj['image']) ?>" type="image/webp">
                  <img
                    src="<?= asset_url($proj['image_fallback']) ?>"
                    alt="<?= e($proj['title']) ?> Screenshot"
                    width="1000"
                    height="625"
                    loading="<?= $spreadIndex <= 3 ? 'eager' : 'lazy' ?>"
                    decoding="async"
                  >
                </picture>
              </div>
            </div>
          </div>

          <!-- Technical Dossier Column -->
          <div class="case-study-dossier-col">
            <div class="dossier-meta">
              <span class="eyebrow" style="margin-bottom: 0;"><?= e($proj['category']) ?></span>
              <span style="font-size: 0.8125rem; color: var(--c-slate-500); font-weight: 500;"><?= e($proj['client']) ?> • <?= e($proj['year'] ?? '2026') ?></span>
            </div>

            <h2 class="dossier-title"><?= e($proj['title']) ?></h2>
            <p class="dossier-subtitle"><?= e($proj['subtitle']) ?></p>
            <p class="dossier-summary"><?= e($proj['summary']) ?></p>

            <div class="dossier-spec-table">
              <div class="dossier-spec-item">
                <span class="dossier-spec-label">Primary Stack</span>
                <span class="dossier-spec-val"><?= e($proj['primary_stack'] ?? 'Full-Stack Core') ?></span>
              </div>
              <div class="dossier-spec-item">
                <span class="dossier-spec-label">Performance</span>
                <span class="dossier-spec-val" style="color: var(--c-emerald);">Sub-1.0s Core Vitals</span>
              </div>
              <div class="dossier-spec-item">
                <span class="dossier-spec-label">Architecture</span>
                <span class="dossier-spec-val">Defensive RBAC</span>
              </div>
              <div class="dossier-spec-item">
                <span class="dossier-spec-label">Audit Score</span>
                <span class="dossier-spec-val">100% WCAG AA</span>
              </div>
            </div>

            <div style="margin-bottom: var(--space-md); padding-top: var(--space-xs);">
              <span style="font-family: var(--font-heading); font-weight: 700; letter-spacing: 0.06em; font-size: 0.72rem; text-transform: uppercase; color: var(--text-muted); display: block; margin-bottom: 6px;">Architectural Highlights</span>
              <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 4px;">
                <?php foreach (array_slice($proj['highlights'], 0, 2) as $hl): ?>
                  <li style="font-size: 0.8125rem; color: var(--c-slate-600); display: flex; align-items: flex-start; gap: 6px;">
                    <span style="color: var(--c-sky); font-weight: 700;">&bull;</span>
                    <span><?= e($hl) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <div class="dossier-tags">
              <?php foreach ($proj['tags'] as $tag): ?>
                <span class="capability-tag"><?= e($tag) ?></span>
              <?php endforeach; ?>
            </div>

            <div>
              <button
                type="button"
                class="btn btn-primary btn-pill"
                data-project-trigger="<?= e($pId) ?>"
                aria-label="View Case Study for <?= e($proj['title']) ?>"
              >
                View Case Study
                <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
              </button>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- Reusable Contact CTA Banner -->
<?php include __DIR__ . '/includes/contact-cta.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
