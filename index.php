<?php
declare(strict_types=1);

$pageTitle = 'Engineer Baah — Creative Engineer | Technology, Design & Execution';
$pageDesc = 'Creative Engineer in Kumasi, Ghana combining web engineering, brand identity, and IT systems to build high-performance digital experiences for businesses.';
$pageSlug = 'home';

require_once __DIR__ . '/includes/header.php';
$projects = get_portfolio_projects();
$disciplines = get_core_disciplines();
?>

<!-- ==========================================================================
     HERO SECTION — THE CREATIVE ENGINEER
     (Urbanist Headings + DM Sans Body, Dominant White Foundation, Clean SVG Icons)
     ========================================================================== -->
<section class="hero-editorial" aria-labelledby="hero-heading">
  <div class="container">
    <div class="hero-grid">
      <!-- Left: Headline, Lead, Common CTAs & 3-Metric Stats -->
      <div>
        <!-- Live Status & Ghana GMT Clock -->
        <div class="hero-status-pill">
          <span class="status-dot"></span>
          <span>Available for Select Projects &bull; <strong id="hero-clock" class="live-clock">--:--:-- GMT</strong></span>
        </div>

        <h1 id="hero-heading" class="hero-headline hero-ready">
          <span class="ln"><span style="--i:0">Engineering Resilient</span></span>
          <span class="ln"><span style="--i:1">Systems Designing</span></span>
          <span class="ln"><span style="--i:2"><span class="headline-gradient">Distinctive Experiences</span></span></span>
        </h1>

        <p class="hero-lead">
          I am a software engineer and digital creative who combines technology, design and execution to create useful digital experiences for businesses, organizations and brands.
        </p>

        <div class="hero-cta-group">
          <button type="button" class="btn btn-primary btn-pill" data-open-enquiry="" aria-label="Start a project enquiry">
            Start a Project
            <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
          </button>

          <a href="#selected-work" class="btn btn-with-play btn-pill">
            <span class="btn-play-circle" aria-hidden="true">
              <svg width="12" height="12" fill="currentColor" viewBox="0 0 24 24">
                <path d="M8 5v14l11-7z"/>
              </svg>
            </span>
            Explore Work
          </a>
        </div>

        <!-- 3-Metric Stats Row -->
        <div class="hero-stats-row">
          <div class="hero-stat-item">
            <span class="hero-stat-number">Sub-1.0s</span>
            <span class="hero-stat-label">Fast Page Load</span>
          </div>
          <div class="hero-stat-item">
            <span class="hero-stat-number">4 Core</span>
            <span class="hero-stat-label">Services &amp; Disciplines</span>
          </div>
          <div class="hero-stat-item">
            <span class="hero-stat-number">100%</span>
            <span class="hero-stat-label">Custom Architecture</span>
          </div>
        </div>
      </div>

      <!-- Right: Portrait Presentation with Organic Backdrop & Floating Cards with SVG Icons -->
      <div class="hero-portrait-stage">
        <div class="hero-backdrop-glow" aria-hidden="true"></div>

        <div class="hero-image-wrapper">
          <div class="hero-image-frame">
            <picture>
              <source srcset="<?= asset_url('assets/images/engineer-baah-portrait.webp') ?>" type="image/webp">
              <img
                src="<?= asset_url('assets/images/engineer-baah-portrait.webp') ?>"
                alt="Engineer Baah — Isaac Brem Baah, Creative Engineer"
                class="hero-image"
                width="900"
                height="900"
                fetchpriority="high"
                loading="eager"
              >
            </picture>
          </div>

          <!-- Name & Role Caption in Frame Base -->
          <div class="hero-frame-caption">
            <div class="hero-frame-identity">
              <span class="hero-frame-name">Engineer Baah</span>
              <span class="hero-frame-role">Creative Engineer</span>
            </div>
            <div class="hero-frame-badge" title="Based in Kumasi, Ghana">
              <span class="hero-frame-dot" aria-hidden="true"></span>
              <span>Kumasi, Ghana</span>
            </div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     4-PILLAR FEATURE / TRUST RIBBON (Directly below hero)
     ========================================================================== -->
<div class="container">
  <div class="trust-ribbon-bar">
    <div class="trust-ribbon-grid">
      <div class="trust-ribbon-item">
        <div class="trust-icon-box" aria-hidden="true">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
          </svg>
        </div>
        <div>
          <strong class="trust-item-title" style="display:block;">Full-Stack Development</strong>
          <p class="trust-item-desc">Clean PHP &amp; modern architectural separation</p>
        </div>
      </div>

      <div class="trust-ribbon-item">
        <div class="trust-icon-box" aria-hidden="true">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
          </svg>
        </div>
        <div>
          <strong class="trust-item-title" style="display:block;">Fast Performance</strong>
          <p class="trust-item-desc">Optimized page speed &amp; instant load</p>
        </div>
      </div>

      <div class="trust-ribbon-item">
        <div class="trust-icon-box" aria-hidden="true">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
          </svg>
        </div>
        <div>
          <strong class="trust-item-title" style="display:block;">Custom Design</strong>
          <p class="trust-item-desc">Distinctive brand &amp; user experience</p>
        </div>
      </div>

      <div class="trust-ribbon-item">
        <div class="trust-icon-box" aria-hidden="true">
          <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <div>
          <strong class="trust-item-title" style="display:block;">Secure &amp; Reliable</strong>
          <p class="trust-item-desc">Tested, robust and easily maintainable</p>
        </div>
      </div>
    </div>
  </div>
</div>

<!-- ==========================================================================
     SECTION: EXPLORE CORE DISCIPLINES (4 Core Disciplines)
     4 Squircle Interactive Tiles + Live Active Detail Stage
     ========================================================================== -->
<section class="section section-alt" aria-labelledby="disciplines-heading">
  <div class="container">
    <div class="section-header section-header-split">
      <div>
        <h2 id="disciplines-heading" class="section-title">Explore Core Disciplines</h2>
        <p class="section-desc" style="margin: 0; margin-top: 4px;">
          Four dedicated engineering and creative areas delivering end-to-end solutions.
        </p>
      </div>
      <a href="<?= site_url('capabilities.php') ?>" class="btn btn-secondary btn-pill">
        View All Services &rarr;
      </a>
    </div>

    <!-- 4 Squircle Interactive Category Tiles (With Cursor-Following Hover Preview) -->
    <div class="category-tiles-grid" data-peek role="tablist" aria-label="Core Engineering Disciplines">
      <?php 
      $serviceIcons = [
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M11 3.055A9.001 9.001 0 1020.945 13H11V3.055z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M20.488 9H15V3.512A9.025 9.025 0 0120.488 9z"/>',
        '<path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10.325 4.317c.426-1.756 2.924-1.756 3.35 0a1.724 1.724 0 002.573 1.066c1.543-.94 3.31.826 2.37 2.37a1.724 1.724 0 001.065 2.572c1.756.426 1.756 2.924 0 3.35a1.724 1.724 0 00-1.066 2.573c.94 1.543-.826 3.31-2.37 2.37a1.724 1.724 0 00-2.572 1.065c-.426 1.756-2.924 1.756-3.35 0a1.724 1.724 0 00-2.573-1.066c-1.543.94-3.31-.826-2.37-2.37a1.724 1.724 0 00-1.065-2.572c-1.756-.426-1.756-2.924 0-3.35a1.724 1.724 0 001.066-2.573c-.94-1.543.826-3.31 2.37-2.37.996.608 2.296.07 2.572-1.065z"/><path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M15 12a3 3 0 11-6 0 3 3 0 016 0z"/>'
      ];
      foreach ($disciplines as $idx => $disc): 
        $isActive = ($idx === 0);
      ?>
        <button
          type="button"
          class="category-tile service-peek-row <?= $isActive ? 'is-active' : '' ?>"
          data-discipline-target="stage-<?= e($disc['id']) ?>"
          data-img="<?= asset_url($disc['image']) ?>"
          role="tab"
          aria-selected="<?= $isActive ? 'true' : 'false' ?>"
          aria-controls="stage-<?= e($disc['id']) ?>"
        >
          <div class="category-tile-icon" aria-hidden="true">
            <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
              <?= $serviceIcons[$idx] ?? $serviceIcons[0] ?>
            </svg>
          </div>
          <span class="category-tile-title"><?= e($disc['short_title'] ?? $disc['title']) ?></span>
          <span class="category-tile-code"><?= e($disc['code']) ?></span>
        </button>
      <?php endforeach; ?>
    </div>

    <!-- Interactive Focus Stage (Displays details of selected tile) -->
    <div id="discipline-stages-container">
      <?php foreach ($disciplines as $idx => $disc): ?>
        <div
          id="stage-<?= e($disc['id']) ?>"
          class="category-stage"
          role="tabpanel"
          <?= $idx !== 0 ? 'style="display:none;"' : '' ?>
        >
          <div>
            <div style="margin-bottom: var(--space-xs);">
              <span class="discipline-code"><?= e($disc['code']) ?></span>
            </div>
            <h3 style="font-size: var(--text-h2); color: var(--c-navy-deep); margin-bottom: var(--space-xs);">
              <?= e($disc['title']) ?>
            </h3>
            <p style="font-size: 1.05rem; color: var(--c-navy); font-weight: 600; margin-bottom: var(--space-sm);">
              <?= e($disc['tagline']) ?>
            </p>
            <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.65; margin-bottom: var(--space-md); max-width: 65ch;">
              <?= e($disc['description']) ?>
            </p>

            <!-- Client Self-Qualification Anchor -->
            <?php if (!empty($disc['good_fit'])): ?>
              <div class="good-fit-callout" style="margin-bottom: var(--space-lg);">
                <strong class="good-fit-label">Good fit for:</strong>
                <span class="good-fit-text"><?= e($disc['good_fit']) ?></span>
              </div>
            <?php endif; ?>

            <div style="margin-bottom: var(--space-md);">
              <h4 style="font-size: 0.8125rem; font-family: var(--font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); margin-bottom: 8px;">
                Key Capabilities
              </h4>
              <ul style="list-style: none; padding: 0; margin: 0; display: flex; flex-direction: column; gap: 6px;">
                <?php foreach ($disc['capabilities'] as $cap): ?>
                  <li style="font-size: 0.9rem; color: var(--text-body); display: flex; align-items: flex-start; gap: 8px;">
                    <svg style="color: var(--c-sky); flex-shrink: 0; margin-top: 4px;" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                      <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                    </svg>
                    <span><?= e($cap) ?></span>
                  </li>
                <?php endforeach; ?>
              </ul>
            </div>

            <!-- Tech / Tools Tags -->
            <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-top: var(--space-md);">
              <?php foreach ($disc['tools'] as $tool): ?>
                <span class="capability-tag"><?= e($tool) ?></span>
              <?php endforeach; ?>
            </div>
          </div>

          <div style="display: flex; flex-direction: column; gap: var(--space-md); justify-content: space-between;">
            <div style="background: var(--surface-alt); border: 1px solid var(--border-line); border-radius: var(--radius-sm); padding: var(--space-lg);">
              <span style="font-family: var(--font-heading); font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); display: block; margin-bottom: 4px;">
                Standard Deliverables
              </span>
              <p style="font-size: 0.9375rem; font-weight: 700; color: var(--c-navy-deep); line-height: 1.5; margin: 0;">
                <?= e($disc['deliverables']) ?>
              </p>
            </div>

            <div style="display: flex; flex-direction: column; gap: 10px;">
              <a
                href="<?= e($disc['url']) ?>"
                class="btn btn-secondary btn-pill"
                aria-label="Explore <?= e($disc['title']) ?> scope and details"
                style="width: 100%; text-align: center; display: inline-block;"
              >
                Explore <?= e($disc['short_title']) ?> Scope &rarr;
              </a>

              <button
                type="button"
                class="btn btn-primary btn-pill"
                data-open-enquiry="<?= e($disc['title']) ?>"
                style="width: 100%;"
              >
                Enquire
                <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
              </button>
            </div>
          </div>
        </div>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION: FEATURED ARCHITECTURE & SPOTLIGHT SHOWCASE
     (CourseHub "Featured Course / Bestseller" Card Pattern)
     ========================================================================== -->
<section class="section" aria-labelledby="featured-heading">
  <div class="container">
    <div class="spotlight-showcase-card">
      <div class="spotlight-grid">
        <!-- Left: Desktop Media Frame -->
        <div class="spotlight-media-wrap">
          <picture>
            <source srcset="<?= asset_url('assets/images/skb-construction-real-estate.webp') ?>" type="image/webp">
            <img
              src="<?= asset_url('assets/images/skb-construction-real-estate.webp') ?>"
              alt="SKB Construction Digital Flagship"
              width="1000"
              height="625"
              loading="lazy"
            >
          </picture>
        </div>

        <!-- Right: Spotlight Editorial Details -->
        <div>
          <span class="spotlight-eyebrow">FEATURED PROJECT</span>

          <h2 id="featured-heading" class="spotlight-title">
            SKB Construction &amp; Real Estate
          </h2>

          <p class="spotlight-prose">
            A high-credibility digital platform engineered for a premier civil engineering and real estate enterprise, presenting multi-acre commercial developments, project timelines, and high-value investor inquiry funnels.
          </p>

          <div class="spotlight-rating-row">
            <span class="spotlight-stars" style="color: #f59e0b; font-weight: 700;">★ 5.0</span>
            <span>(Client Verified)</span>
            <span class="spotlight-divider">|</span>
            <span>Civil &amp; Commercial Infrastructure</span>
            <span class="spotlight-divider">|</span>
            <span style="color: var(--c-emerald); font-weight: 700;">Sub-1.0s Speed</span>
          </div>

          <a
            href="<?= site_url('work.php#skb-construction') ?>"
            class="btn btn-primary btn-pill"
            data-project-trigger="skb-construction"
            aria-label="Inspect SKB Construction Case Study"
          >
            View Case Study
            <span class="btn-icon-arrow" aria-hidden="true">&rarr;</span>
          </a>
        </div>
      </div>
    </div>

    <!-- ==========================================================================
         FULL-WIDTH ACTION BANNER
         (CourseHub "Get Certified & Stand Out" Banner Pattern)
         ========================================================================== -->
    <div class="slim-action-banner">
      <div class="slim-action-lead">
        <div class="slim-action-icon" aria-hidden="true">
          <svg width="24" height="24" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M9 12l2 2 4-4m5.618-4.016A11.955 11.955 0 0112 2.944a11.955 11.955 0 01-8.618 3.04A12.02 12.02 0 003 9c0 5.591 3.824 10.29 9 11.622 5.176-1.332 9-6.03 9-11.622 0-1.042-.133-2.052-.382-3.016z"/>
          </svg>
        </div>
        <div>
          <h3 style="font-size: 1.25rem; font-weight: 800; color: #ffffff; margin-bottom: 2px;">
            Ready to Build Your Next Digital Project?
          </h3>
          <p style="font-size: 0.875rem; color: #e0f2fe; margin: 0;">
            Websites, custom web applications, brand identities, and IT solutions built for real business impact.
          </p>
        </div>
      </div>

      <button
        type="button"
        class="btn btn-pill"
        data-open-enquiry=""
        style="background: #ffffff; color: var(--c-navy-deep); font-weight: 800; box-shadow: 0 4px 14px rgba(0,0,0,0.15);"
      >
        Get in Touch &rarr;
      </button>
    </div>

    <!-- ==========================================================================
         POPULAR CLIENT WORK
         (CourseHub "Popular Courses" Pattern: 4 Cards in a Row with Heart Buttons)
         ========================================================================== -->
    <div id="selected-work" style="scroll-margin-top: 100px;">
      <div class="section-header section-header-split" style="margin-top: var(--space-2xl);">
        <div>
          <h2 class="section-title">Popular Client Work</h2>
        </div>
        <a href="<?= site_url('work.php') ?>" class="btn btn-secondary btn-pill">
          View All Projects &rarr;
        </a>
      </div>

      <div class="curated-cards-grid">
        <?php 
        $curated = array_slice($projects, 1, 4, true);
        foreach ($curated as $pId => $proj): 
        ?>
          <article class="curated-card" data-project-trigger="<?= e($pId) ?>" style="cursor: pointer;">
            <div class="curated-card-media">
              <picture>
                <source srcset="<?= asset_url($proj['image']) ?>" type="image/webp">
                <img
                  src="<?= asset_url($proj['image_fallback']) ?>"
                  alt="<?= e($proj['title']) ?> Preview"
                  loading="lazy"
                >
              </picture>

              <!-- Heart Favorite Button -->
              <button type="button" class="card-heart-btn" aria-label="Favorite Project" data-heart-toggle>
                <svg width="18" height="18" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                  <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M4.318 6.318a4.5 4.5 0 000 6.364L12 20.364l7.682-7.682a4.5 4.5 0 00-6.364-6.364L12 7.636l-1.318-1.318a4.5 4.5 0 00-6.364 0z"/>
                </svg>
              </button>
            </div>

            <div class="curated-card-body">
              <span class="curated-card-client"><?= e($proj['client']) ?></span>
              <h3 class="curated-card-title"><a href="<?= site_url('work.php#' . e($pId)) ?>" style="color: inherit; text-decoration: none;"><?= e($proj['title']) ?></a></h3>
              <p class="curated-card-desc">
                <?= e($proj['subtitle']) ?>
              </p>

              <div class="curated-card-footer">
                <div class="card-rating">
                  <span class="star-icon" style="color: #f59e0b;">★</span>
                  <span class="rating-val">4.9</span>
                  <span class="rating-count">(Verified)</span>
                </div>
                <div class="card-metric">
                  <svg width="14" height="14" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: var(--c-sky);">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M13 10V3L4 14h7v7l9-11h-7z"/>
                  </svg>
                  <span>Sub-1s Speed</span>
                </div>
              </div>
            </div>
          </article>
        <?php endforeach; ?>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION: BENEFITS OF WORKING WITH ENGINEER BAAH
     (Inspired by Etech Layout: Left 4-Photo Squircle Collage + Right 4 Benefits)
     ========================================================================== -->
<section class="section section-alt" aria-labelledby="benefits-heading">
  <div class="container">
    <div class="benefits-grid">
      <!-- Left: 4-Photo Squircle Collage -->
      <div class="benefits-collage">
        <div class="benefits-photo">
          <picture>
            <source srcset="<?= asset_url('assets/images/engineer-baah-branded.webp') ?>" type="image/webp">
            <img src="<?= asset_url('assets/images/engineer-baah-branded.webp') ?>" alt="Engineer Baah Brand" loading="lazy">
          </picture>
        </div>
        <div class="benefits-photo">
          <picture>
            <source srcset="<?= asset_url('assets/images/khing-spotless.webp') ?>" type="image/webp">
            <img src="<?= asset_url('assets/images/khing-spotless.webp') ?>" alt="Spotless Agency Design" loading="lazy">
          </picture>
        </div>
        <div class="benefits-photo">
          <picture>
            <source srcset="<?= asset_url('assets/images/baah-outside.webp') ?>" type="image/webp">
            <img src="<?= asset_url('assets/images/baah-outside.webp') ?>" alt="Engineer Baah Outside" loading="lazy">
          </picture>
        </div>
        <div class="benefits-photo">
          <picture>
            <source srcset="<?= asset_url('assets/images/engineer-baah-studio-portrait.webp') ?>" type="image/webp">
            <img src="<?= asset_url('assets/images/engineer-baah-studio-portrait.webp') ?>" alt="Isaac Brem Baah" loading="lazy">
          </picture>
        </div>
      </div>

      <!-- Right: Benefits List with Circular Icons -->
      <div>
        <h2 id="benefits-heading" class="section-title" style="margin-bottom: var(--space-lg);">
          Why Work With Engineer Baah
        </h2>

        <div class="benefit-list">
          <div class="benefit-item">
            <div class="benefit-icon-box" aria-hidden="true">
              <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M10 20l4-16m4 4l4 4-4 4M6 16l-4-4 4-4"/>
              </svg>
            </div>
            <div>
              <h3 class="benefit-title">Custom-Built Architecture</h3>
              <p class="benefit-desc">
                Tailored specifically for your business requirements using clean, reliable code. Zero bloated templates, fragile site builders, or unmaintainable dependencies.
              </p>
            </div>
          </div>

          <div class="benefit-item">
            <div class="benefit-icon-box" aria-hidden="true">
              <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M13 10V3L4 14h7v7l9-11h-7z"/>
              </svg>
            </div>
            <div>
              <h3 class="benefit-title">Sub-1.0s Core Web Vitals</h3>
              <p class="benefit-desc">
                Every page is tuned for rapid loading, instant first paint, and smooth responsiveness. Delivering high search engine ranking and visitor retention.
              </p>
            </div>
          </div>

          <div class="benefit-item">
            <div class="benefit-icon-box" aria-hidden="true">
              <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M7 21a4 4 0 01-4-4V5a2 2 0 012-2h4a2 2 0 012 2v12a4 4 0 01-4 4zm0 0h12a2 2 0 002-2v-4a2 2 0 00-2-2h-2.343M11 7.343l1.657-1.657a2 2 0 012.828 0l2.829 2.829a2 2 0 010 2.828l-8.486 8.485M7 17h.01"/>
              </svg>
            </div>
            <div>
              <h3 class="benefit-title">Distinctive Interface Design</h3>
              <p class="benefit-desc">
                Interfaces crafted with harmonious typography, balanced whitespace, and WCAG AA accessible contrast that command credibility from the first second.
              </p>
            </div>
          </div>

          <div class="benefit-item">
            <div class="benefit-icon-box" aria-hidden="true">
              <svg width="22" height="22" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2" d="M17 20h5v-2a3 3 0 00-5.356-1.857M17 20H7m10 0v-2c0-.656-.126-1.283-.356-1.857M7 20H2v-2a3 3 0 015.356-1.857M7 20v-2c0-.656.126-1.283.356-1.857m0 0a5.002 5.002 0 019.288 0M15 7a3 3 0 11-6 0 3 3 0 016 0zm6 3a2 2 0 11-4 0 2 2 0 014 0zM7 10a2 2 0 11-4 0 2 2 0 014 0z"/>
              </svg>
            </div>
            <div>
              <h3 class="benefit-title">Direct Professional Communication</h3>
              <p class="benefit-desc">
                You work directly with the creative engineer building your product. Clear accountability, regular updates, and swift delivery without agency overhead.
              </p>
            </div>
          </div>
        </div>

        <!-- Curated Quick Facts Table -->
        <dl class="facts-list" style="margin-top: var(--space-xl);">
          <div class="facts-item">
            <dt>Based in</dt>
            <dd>Kumasi, Ghana</dd>
          </div>
          <div class="facts-item">
            <dt>Building for the web since</dt>
            <dd>September 2023</dd>
          </div>
          <div class="facts-item">
            <dt>Role</dt>
            <dd>IT Manager, SKB Group</dd>
          </div>
        </dl>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION: CLIENT TESTIMONIALS & REVIEWS
     ========================================================================== -->
<section class="section" aria-labelledby="reviews-heading">
  <div class="container">
    <div class="section-header">
      <h2 id="reviews-heading" class="section-title">Client Verifications &amp; Reviews</h2>
      <p class="section-desc">
        Direct feedback from business leaders and organizations whose digital systems were built by Engineer Baah.
      </p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr)); gap: var(--space-lg); margin-top: var(--space-xl);">
      <!-- Review 1: SKB Construction -->
      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: 18px; padding: var(--space-xl); box-shadow: 0 4px 16px rgba(11, 31, 58, 0.04); display: flex; flex-direction: column;">
        <div style="color: #f59e0b; font-size: 1.1rem; margin-bottom: var(--space-sm);">★★★★★</div>
        <p style="font-size: 0.9375rem; color: var(--text-body); line-height: 1.6; margin-bottom: var(--space-lg); flex: 1; font-style: italic;">
          &ldquo;Engineer Baah gave our civil engineering and real estate projects the digital credibility we lacked. The speed is phenomenal, and property buyers now reach our team directly through our portfolio funnels without friction.&rdquo;
        </p>
        <div style="display: flex; align-items: center; gap: 12px; border-top: 1px solid var(--border-line); padding-top: var(--space-sm);">
          <div style="width: 40px; height: 40px; border-radius: 50%; background: #e0f2fe; color: #0369a1; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.875rem;">
            SK
          </div>
          <div>
            <div style="font-size: 0.875rem; font-weight: 800; color: var(--c-navy-deep);">SKB Executive Management</div>
            <div style="font-size: 0.75rem; color: var(--c-slate-600);">SKB Construction &amp; Real Estate</div>
          </div>
        </div>
      </div>

      <!-- Review 2: Jwils Digital -->
      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: 18px; padding: var(--space-xl); box-shadow: 0 4px 16px rgba(11, 31, 58, 0.04); display: flex; flex-direction: column;">
        <div style="color: #f59e0b; font-size: 1.1rem; margin-bottom: var(--space-sm);">★★★★★</div>
        <p style="font-size: 0.9375rem; color: var(--text-body); line-height: 1.6; margin-bottom: var(--space-lg); flex: 1; font-style: italic;">
          &ldquo;We needed a unified digital ecosystem connecting corporate tools and student learning resources. Isaac delivered a clean, modular platform with zero framework baggage. Highly recommended for complex systems.&rdquo;
        </p>
        <div style="display: flex; align-items: center; gap: 12px; border-top: 1px solid var(--border-line); padding-top: var(--space-sm);">
          <div style="width: 40px; height: 40px; border-radius: 50%; background: #ede9fe; color: #6d28d9; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.875rem;">
            JW
          </div>
          <div>
            <div style="font-size: 0.875rem; font-weight: 800; color: var(--c-navy-deep);">Jwils Operations Lead</div>
            <div style="font-size: 0.75rem; color: var(--c-slate-600);">Jwils Educational &amp; Corporate Systems</div>
          </div>
        </div>
      </div>

      <!-- Review 3: Spotless Agency -->
      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: 18px; padding: var(--space-xl); box-shadow: 0 4px 16px rgba(11, 31, 58, 0.04); display: flex; flex-direction: column;">
        <div style="color: #f59e0b; font-size: 1.1rem; margin-bottom: var(--space-sm);">★★★★★</div>
        <p style="font-size: 0.9375rem; color: var(--text-body); line-height: 1.6; margin-bottom: var(--space-lg); flex: 1; font-style: italic;">
          &ldquo;Spotless required a brand identity and web flagship that broke away from generic agency clones. Isaac designed a mathematical type system and fluid animations that made our agency look world-class from day one.&rdquo;
        </p>
        <div style="display: flex; align-items: center; gap: 12px; border-top: 1px solid var(--border-line); padding-top: var(--space-sm);">
          <div style="width: 40px; height: 40px; border-radius: 50%; background: #fef3c7; color: #92400e; display: flex; align-items: center; justify-content: center; font-weight: 800; font-size: 0.875rem;">
            SD
          </div>
          <div>
            <div style="font-size: 0.875rem; font-weight: 800; color: var(--c-navy-deep);">Creative Director</div>
            <div style="font-size: 0.75rem; color: var(--c-slate-600);">Spotless Digital Agency</div>
          </div>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Reusable Contact CTA Banner -->
<?php include __DIR__ . '/includes/contact-cta.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
