<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

$pageTitle = 'Packages & Pricing — Engineer Baah | Website Development, Branding & Digital Solutions';
$pageDesc = 'Transparent website development, e-commerce, brand identity packages, launch bundles, and custom digital solutions in Ghana by Engineer Baah (Isaac Brem Baah).';
$pageSlug = 'packages';

$pkgData = get_service_packages();

// Build OfferCatalog structured data for rich search snippets
$offers = [];
foreach (['business_websites', 'ecommerce_websites', 'branding_design'] as $groupKey) {
    foreach ($pkgData[$groupKey]['tiers'] as $tier) {
        $offers[] = [
            '@type' => 'Offer',
            'name' => $tier['name'],
            'description' => $tier['audience'],
            'price' => $tier['price_num'],
            'priceCurrency' => 'GHS',
            'url' => canonical_url('packages.php#' . $pkgData[$groupKey]['id'])
        ];
    }
}

$serviceSchema = [
    '@type' => 'Service',
    '@id' => canonical_url('packages.php') . '#service-packages',
    'name' => 'Website Development, Branding & Digital Solutions Packages',
    'description' => $pkgData['intro']['lead'],
    'provider' => [
        '@id' => PRODUCTION_ORIGIN . '/#person'
    ],
    'hasOfferCatalog' => [
        '@type' => 'OfferCatalog',
        'name' => 'Engineer Baah Service Packages',
        'itemListElement' => $offers
    ]
];

require_once __DIR__ . '/includes/header.php';
?>

<!-- ==========================================================================
     PACKAGES & PRICING HERO
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2rem, 3.5vw, 3rem);">
  <div class="container">
    <!-- Breadcrumbs -->
    <nav aria-label="Breadcrumb" style="margin-bottom: var(--space-md);">
      <ol style="list-style: none; display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--c-slate-600); padding: 0; margin: 0; flex-wrap: wrap;">
        <li><a href="<?= site_url() ?>" style="color: var(--c-slate-600); text-decoration: none;">Home</a></li>
        <li aria-hidden="true">&bull;</li>
        <li><a href="<?= site_url('capabilities.php') ?>" style="color: var(--c-slate-600); text-decoration: none;">Services</a></li>
        <li aria-hidden="true">&bull;</li>
        <li style="color: var(--c-navy-deep); font-weight: 600;" aria-current="page">Packages &amp; Pricing</li>
      </ol>
    </nav>

    <div class="container-narrow" style="margin-inline: 0; max-width: 78ch;">
      <span class="eyebrow">Transparent Scope &amp; Deliverables</span>
      <h1 class="hero-headline hero-ready" style="font-size: var(--text-h1); margin-bottom: var(--space-md);">
        <span class="ln"><span style="--i:0"><?= e($pkgData['intro']['title']) ?></span></span>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-sm);">
        <?= e($pkgData['intro']['lead']) ?>
      </p>
      <p style="font-size: 0.95rem; color: var(--c-slate-600); line-height: 1.65; margin-bottom: var(--space-lg); max-width: 65ch;">
        <?= e($pkgData['intro']['sublead']) ?>
      </p>

      <div style="display: flex; flex-wrap: wrap; gap: 12px;">
        <a href="#website-packages" class="btn btn-primary btn-pill">
          Explore Packages &darr;
        </a>
        <button
          type="button"
          class="btn btn-secondary btn-pill"
          data-open-enquiry="General Consultation / Other"
          data-enquiry-package="Custom Project Scope Assessment"
        >
          Request Custom Quote
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     STICKY QUICK-JUMP SECTION BAR
     ========================================================================== -->
<div class="packages-jump-bar" role="navigation" aria-label="Package sections">
  <div class="container">
    <div class="packages-jump-nav">
      <a href="#website-packages" class="packages-jump-pill">
        <span class="packages-jump-num">01</span>
        <span>Business Websites</span>
      </a>
      <a href="#ecommerce-packages" class="packages-jump-pill">
        <span class="packages-jump-num">02</span>
        <span>E-Commerce</span>
      </a>
      <a href="#branding-packages" class="packages-jump-pill">
        <span class="packages-jump-num">03</span>
        <span>Branding &amp; Design</span>
      </a>
      <a href="#launch-bundles" class="packages-jump-pill">
        <span class="packages-jump-num">04</span>
        <span>Launch Bundles</span>
      </a>
      <a href="#digital-solutions" class="packages-jump-pill">
        <span class="packages-jump-num">05</span>
        <span>Digital Solutions</span>
      </a>
      <a href="#additional-services" class="packages-jump-pill">
        <span class="packages-jump-num">06</span>
        <span>Additional Services</span>
      </a>
      <a href="#project-terms" class="packages-jump-pill">
        <span class="packages-jump-num">07</span>
        <span>Project Terms</span>
      </a>
    </div>
  </div>
</div>

<!-- ==========================================================================
     1. BUSINESS & PROFESSIONAL WEBSITE PACKAGES
     ========================================================================== -->
<?php
$tierGroups = [
    $pkgData['business_websites'],
    $pkgData['ecommerce_websites'],
    $pkgData['branding_design']
];

foreach ($tierGroups as $gIdx => $group):
    $sectionClass = ($gIdx % 2 === 1) ? 'section section-subtle' : 'section';
?>
<section id="<?= e($group['id']) ?>" class="<?= $sectionClass ?>" style="scroll-margin-top: 68px;">
  <div class="container">
    <div class="packages-section-head">
      <span class="discipline-code">SECTION <?= e($group['number']) ?></span>
      <h2 class="section-title" style="margin-bottom: 0;"><?= e($group['number']) ?>. <?= e($group['title']) ?></h2>
    </div>

    <div class="packages-tier-grid">
      <?php foreach ($group['tiers'] as $tier): ?>
        <article class="package-card <?= !empty($tier['featured']) ? 'is-featured' : '' ?>">
          <div class="package-card-top">
            <div class="package-badge-row">
              <span class="package-badge"><?= e($tier['badge']) ?></span>
              <?php if (!empty($tier['featured'])): ?>
                <span style="font-family: var(--font-mono); font-size: 0.7rem; font-weight: 700; color: var(--c-sky-deep);">★ Recommended</span>
              <?php endif; ?>
            </div>

            <h3 class="package-title"><?= e($tier['name']) ?></h3>
            <div class="package-price"><?= e($tier['price']) ?></div>
            <p class="package-audience"><?= e($tier['audience']) ?></p>

            <span class="package-includes-label"><?= e($tier['includes_label']) ?></span>

            <ul class="package-features">
              <?php foreach ($tier['features'] as $fIdx => $feature): ?>
                <li>
                  <svg class="package-check-icon" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" aria-hidden="true">
                    <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                  </svg>
                  <div>
                    <?php if ($fIdx === 0 && !empty($tier['subpages'])): ?>
                      <span>Up to 6 pages:</span>
                      <div class="package-subpages-pills" aria-label="Included pages">
                        <?php foreach ($tier['subpages'] as $sp): ?>
                          <span class="package-subpage-pill"><?= e($sp) ?></span>
                        <?php endforeach; ?>
                      </div>
                    <?php else: ?>
                      <span><?= e($feature) ?></span>
                    <?php endif; ?>
                  </div>
                </li>
              <?php endforeach; ?>
            </ul>
          </div>

          <div>
            <?php if (!empty($tier['not_included'])): ?>
              <div class="package-exclusion-box">
                <strong>Not included:</strong> <?= e($tier['not_included']) ?>
              </div>
            <?php endif; ?>

            <button
              type="button"
              class="btn <?= !empty($tier['featured']) ? 'btn-primary' : 'btn-secondary' ?> btn-pill"
              data-open-enquiry="<?= e($group['service_category']) ?>"
              data-enquiry-package="<?= e($tier['name'] . ' (' . $tier['price'] . ')') ?>"
              style="width: 100%;"
            >
              Select <?= e($tier['name']) ?> &rarr;
            </button>
          </div>
        </article>
      <?php endforeach; ?>
    </div>

    <?php if (!empty($group['note'])): ?>
      <div class="package-scope-note">
        <strong>Note:</strong> <?= e($group['note']) ?>
      </div>
    <?php endif; ?>
  </div>
</section>
<?php endforeach; ?>

<!-- ==========================================================================
     4. BRAND & WEBSITE LAUNCH BUNDLES
     ========================================================================== -->
<?php $bundles = $pkgData['launch_bundles']; ?>
<section id="<?= e($bundles['id']) ?>" class="section section-subtle" style="scroll-margin-top: 68px;">
  <div class="container">
    <div class="packages-section-head">
      <span class="discipline-code">SECTION <?= e($bundles['number']) ?></span>
      <h2 class="section-title" style="margin-bottom: 4px;"><?= e($bundles['number']) ?>. <?= e($bundles['title']) ?></h2>
      <p class="section-desc" style="max-width: 68ch;">
        <?= e($bundles['lead']) ?>
      </p>
    </div>

    <div class="bundles-table-wrap">
      <table class="bundles-table">
        <thead>
          <tr>
            <th scope="col">Bundle</th>
            <th scope="col">Website</th>
            <th scope="col">Branding</th>
            <th scope="col">Total</th>
            <th scope="col" style="text-align: right;">Action</th>
          </tr>
        </thead>
        <tbody>
          <?php foreach ($bundles['rows'] as $row): ?>
            <tr class="<?= !empty($row['featured']) ? 'is-featured-row' : '' ?>">
              <td>
                <strong style="font-family: var(--font-heading); font-size: 1.05rem; color: var(--c-navy-deep);">
                  <?= e($row['name']) ?>
                </strong>
                <?php if (!empty($row['featured'])): ?>
                  <span class="package-badge" style="margin-left: 8px; background: var(--c-navy-deep); color: #7dd3fc;">Popular</span>
                <?php endif; ?>
              </td>
              <td>
                <span style="font-weight: 700; color: var(--c-navy-deep);"><?= e($row['website_price']) ?></span>
                <span style="display: block; font-size: 0.78rem; color: var(--c-slate-600);"><?= e($row['website_tier']) ?></span>
              </td>
              <td>
                <span style="font-weight: 700; color: var(--c-navy-deep);"><?= e($row['branding_price']) ?></span>
                <span style="display: block; font-size: 0.78rem; color: var(--c-slate-600);"><?= e($row['branding_tier']) ?></span>
              </td>
              <td class="bundle-total-cell"><?= e($row['total']) ?></td>
              <td style="text-align: right;">
                <button
                  type="button"
                  class="btn <?= !empty($row['featured']) ? 'btn-primary' : 'btn-secondary' ?> btn-sm btn-pill"
                  data-open-enquiry="Web Engineering & Development"
                  data-enquiry-package="<?= e($row['name'] . ' Bundle (' . $row['total'] . ')') ?>"
                >
                  Select Bundle &rarr;
                </button>
              </td>
            </tr>
          <?php endforeach; ?>
        </tbody>
      </table>
    </div>

    <div class="package-scope-note" style="margin-top: var(--space-md);">
      <?php foreach ($bundles['notes'] as $nIdx => $bNote): ?>
        <p style="margin: <?= $nIdx === 0 ? '0 0 6px 0' : '0' ?>;"><?= e($bNote) ?></p>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==========================================================================
     5. DIGITAL SOLUTIONS (CUSTOM SYSTEMS & PORTALS)
     ========================================================================== -->
<?php $customSol = $pkgData['digital_solutions']; ?>
<section id="<?= e($customSol['id']) ?>" class="section" style="scroll-margin-top: 68px;">
  <div class="container">
    <div class="packages-section-head">
      <span class="discipline-code">SECTION <?= e($customSol['number']) ?></span>
      <h2 class="section-title" style="margin-bottom: 0;"><?= e($customSol['number']) ?>. <?= e($customSol['title']) ?></h2>
    </div>

    <div class="digital-solutions-dossier">
      <div>
        <span class="eyebrow eyebrow-inverse" style="margin-bottom: var(--space-xs);">Bespoke Engineering</span>
        <h3 style="font-family: var(--font-heading); font-size: clamp(1.6rem, 2.8vw, 2.25rem); font-weight: 800; color: var(--c-white); margin: 0 0 6px 0;">
          <?= e($customSol['headline']) ?>
        </h3>
        <div style="font-family: var(--font-heading); font-size: clamp(1.35rem, 2.2vw, 1.75rem); font-weight: 800; color: #7dd3fc; margin-bottom: var(--space-sm);">
          <?= e($customSol['starting_price']) ?>
        </div>
        <p style="font-size: 1rem; color: var(--c-slate-200); line-height: 1.6; margin-bottom: var(--space-md);">
          <?= e($customSol['audience']) ?>
        </p>
        <p style="font-size: 0.9rem; color: var(--c-slate-300); line-height: 1.65; margin-bottom: var(--space-lg); padding-left: 14px; border-left: 2px solid var(--c-sky);">
          <?= e($customSol['note']) ?>
        </p>

        <button
          type="button"
          class="btn btn-sky btn-pill"
          data-open-enquiry="Web Engineering & Development"
          data-enquiry-package="Custom Digital Solution (Starting from GH₵5,000)"
        >
          Discuss a Custom Digital Solution &rarr;
        </button>
      </div>

      <div>
        <span style="font-family: var(--font-heading); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: #7dd3fc; display: block; margin-bottom: var(--space-sm);">
          Possible solutions include:
        </span>
        <ul class="digital-solutions-grid">
          <?php foreach ($customSol['solutions'] as $sol): ?>
            <li class="digital-solutions-item">
              <svg width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor" style="color: #38bdf8; flex-shrink: 0;" aria-hidden="true">
                <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
              </svg>
              <span><?= e($sol) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     6. ADDITIONAL SERVICES & CUSTOM PROJECTS + 7. PROJECT TERMS
     ========================================================================== -->
<?php
$addServices = $pkgData['additional_services'];
$projTerms = $pkgData['project_terms'];
?>
<section class="section section-subtle">
  <div class="container">
    <div class="packages-governance-grid">
      <!-- Section 6: Additional Services & Custom Projects -->
      <div id="<?= e($addServices['id']) ?>" class="governance-card" style="scroll-margin-top: 68px;">
        <span class="discipline-code">SECTION <?= e($addServices['number']) ?></span>
        <h2 style="font-family: var(--font-heading); font-size: clamp(1.35rem, 2.2vw, 1.75rem); font-weight: 800; color: var(--c-navy-deep); margin: 4px 0 var(--space-xs) 0;">
          <?= e($addServices['number']) ?>. <?= e($addServices['title']) ?>
        </h2>
        <p style="font-size: 0.92rem; color: var(--c-slate-600); margin-bottom: var(--space-md);">
          <?= e($addServices['lead']) ?>
        </p>

        <ul class="package-features" style="margin-bottom: var(--space-lg);">
          <?php foreach ($addServices['items'] as $item): ?>
            <li>
              <span style="display: inline-block; width: 6px; height: 6px; border-radius: 50%; background: var(--c-sky-deep); margin-top: 8px; flex-shrink: 0;" aria-hidden="true"></span>
              <span><?= e($item) ?></span>
            </li>
          <?php endforeach; ?>
        </ul>

        <div style="display: flex; flex-direction: column; gap: var(--space-sm); border-top: 1px solid var(--border-line); padding-top: var(--space-md);">
          <?php foreach ($addServices['highlights'] as $hl): ?>
            <div style="background: var(--surface-alt); border: 1px solid var(--border-line); border-radius: var(--radius-xs); padding: 12px 14px;">
              <strong style="font-family: var(--font-heading); color: var(--c-navy-deep); font-size: 0.9rem;"><?= e($hl['label']) ?>:</strong>
              <span style="font-size: 0.875rem; color: var(--text-body);"> <?= e($hl['detail']) ?></span>
            </div>
          <?php endforeach; ?>
        </div>
      </div>

      <!-- Section 7: Project Terms -->
      <div id="<?= e($projTerms['id']) ?>" class="governance-card" style="scroll-margin-top: 68px;">
        <span class="discipline-code">SECTION <?= e($projTerms['number']) ?></span>
        <h2 style="font-family: var(--font-heading); font-size: clamp(1.35rem, 2.2vw, 1.75rem); font-weight: 800; color: var(--c-navy-deep); margin: 4px 0 var(--space-md) 0;">
          <?= e($projTerms['number']) ?>. <?= e($projTerms['title']) ?>
        </h2>

        <ol class="terms-ordered-list">
          <?php foreach ($projTerms['terms'] as $term): ?>
            <li><span><?= e($term) ?></span></li>
          <?php endforeach; ?>
        </ol>

        <div class="commitment-banner">
          <strong><?= e($projTerms['commitment_label']) ?></strong>
          <?= e($projTerms['commitment_text']) ?>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Reusable Contact CTA Banner -->
<?php include __DIR__ . '/includes/contact-cta.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
