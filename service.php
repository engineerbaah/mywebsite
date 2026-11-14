<?php
declare(strict_types=1);

require_once __DIR__ . '/includes/config.php';

// Accept slug from variable or GET parameter
$slug = $slug ?? ($_GET['slug'] ?? 'web-engineering-development');
$service = get_discipline_by_id($slug);

if (!$service) {
    header('Location: ' . site_url('capabilities.php'), true, 302);
    exit;
}

$pageTitle = $service['title'] . ' — Engineer Baah';
$pageDesc = $service['meta_description'] ?? ($service['tagline'] . ' ' . $service['description']);
$pageSlug = 'capabilities'; // Keeps "Services" active in primary navigation
$canonicalPath = 'services/' . $slug . '.php';
$canonicalUrl = canonical_url($canonicalPath);
$ogImage = canonical_url($service['image']);

// Breadcrumbs for Schema.org and SERP Rich Results
$breadcrumbItems = [
    ['name' => 'Home', 'url' => canonical_url()],
    ['name' => 'Services', 'url' => canonical_url('capabilities.php')],
    ['name' => $service['title'], 'url' => $canonicalUrl]
];

// Service Schema for Google Rich Results
$serviceSchema = [
    "@type" => "Service",
    "@id" => $canonicalUrl . "#service",
    "name" => $service['title'],
    "serviceType" => $service['tagline'],
    "description" => $service['meta_description'] ?? $service['description'],
    "provider" => [
        "@id" => PRODUCTION_ORIGIN . "/#business"
    ],
    "areaServed" => [
        ["@type" => "Country", "name" => "Ghana"],
        ["@type" => "AdministrativeArea", "name" => "Worldwide"]
    ]
];

require_once __DIR__ . '/includes/header.php';

// Retrieve matching portfolio projects if available
$allProjects = get_portfolio_projects();
$relevantProjects = [];
if (!empty($service['matching_projects'])) {
    foreach ($service['matching_projects'] as $projId) {
        if (isset($allProjects[$projId])) {
            $relevantProjects[] = $allProjects[$projId];
        }
    }
}
?>

<!-- ==========================================================================
     SERVICE HERO SECTION
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2.5rem, 4vw, 3.5rem);">
  <div class="container">
    <!-- Breadcrumb Trail -->
    <nav aria-label="Breadcrumb" style="margin-bottom: var(--space-md);">
      <ol style="list-style: none; display: flex; align-items: center; gap: 8px; font-size: 0.85rem; color: var(--c-slate-400); padding: 0; margin: 0;">
        <li><a href="<?= site_url() ?>" style="color: var(--c-slate-400); text-decoration: none;">Home</a></li>
        <li aria-hidden="true">&bull;</li>
        <li><a href="<?= site_url('capabilities.php') ?>" style="color: var(--c-slate-400); text-decoration: none;">Services</a></li>
        <li aria-hidden="true">&bull;</li>
        <li style="color: var(--c-navy-deep); font-weight: 600;" aria-current="page"><?= e($service['title']) ?></li>
      </ol>
    </nav>

    <div class="container-narrow" style="margin-inline: 0;">
      <span class="discipline-code" style="margin-bottom: var(--space-xs); display: inline-block;">
        <?= e($service['code']) ?>
      </span>
      <h1 class="hero-headline" style="font-size: var(--text-h1); margin-bottom: var(--space-sm);">
        <?= e($service['title']) ?>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-lg); font-size: 1.15rem; color: var(--c-navy); font-weight: 500;">
        <?= e($service['tagline']) ?>
      </p>

      <div style="display: flex; gap: 12px; align-items: center; flex-wrap: wrap;">
        <button
          type="button"
          class="btn btn-primary btn-pill"
          data-open-enquiry="<?= e($service['title']) ?>"
          aria-label="Enquire about <?= e($service['title']) ?>"
        >
          Enquire About This Service &rarr;
        </button>
        <a href="<?= site_url('capabilities.php') ?>" class="btn btn-secondary btn-pill">
          &larr; All Services
        </a>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     EXECUTIVE OVERVIEW & DETAILED SCOPE
     ========================================================================== -->
<section class="section">
  <div class="container">
    <div class="service-detail-grid">
      <!-- Left Column: Scope & Overview Narrative -->
      <div>
        <span class="eyebrow">Service Scope</span>
        <h2 style="font-size: var(--text-h2); color: var(--c-navy-deep); margin-bottom: var(--space-md);">
          Overview &amp; Deliverables
        </h2>
        <p style="font-size: 1.05rem; color: var(--text-body); line-height: 1.7; margin-bottom: var(--space-lg);">
          <?= e($service['description']) ?>
        </p>

        <!-- Client Self-Qualification Anchor -->
        <?php if (!empty($service['good_fit'])): ?>
          <div class="good-fit-callout" style="margin-bottom: var(--space-xl);">
            <strong class="good-fit-label">Good fit for:</strong>
            <span class="good-fit-text"><?= e($service['good_fit']) ?></span>
          </div>
        <?php endif; ?>

        <!-- Detailed Capability Blocks -->
        <div style="display: flex; flex-direction: column; gap: var(--space-md);">
          <?php if (!empty($service['detailed_capabilities'])): ?>
            <?php foreach ($service['detailed_capabilities'] as $cap): ?>
              <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-md) var(--space-lg); box-shadow: var(--shadow-sm);">
                <div style="display: flex; align-items: center; gap: 10px; margin-bottom: 6px;">
                  <span style="display: inline-flex; align-items: center; justify-content: center; width: 22px; height: 22px; border-radius: 50%; background: var(--c-sky-light); color: var(--c-sky); flex-shrink: 0;">
                    <i class="fa-solid fa-check" style="font-size: 0.7rem;"></i>
                  </span>
                  <h3 style="font-size: 1.05rem; font-weight: 700; color: var(--c-navy-deep); margin: 0;">
                    <?= e($cap['title']) ?>
                  </h3>
                </div>
                <p style="font-size: 0.92rem; color: var(--text-body); line-height: 1.6; margin: 0; padding-left: 32px;">
                  <?= e($cap['desc']) ?>
                </p>
              </div>
            <?php endforeach; ?>
          <?php else: ?>
            <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--space-xs); padding: 0;">
              <?php foreach ($service['capabilities'] as $cap): ?>
                <li style="display: flex; align-items: center; gap: 10px; font-size: 0.95rem; color: var(--text-body);">
                  <i class="fa-solid fa-check" style="color: var(--c-sky);"></i>
                  <span><?= e($cap) ?></span>
                </li>
              <?php endforeach; ?>
            </ul>
          <?php endif; ?>
        </div>
      </div>

      <!-- Right Column: Deliverables Dossier & Technology Stack -->
      <div style="display: flex; flex-direction: column; gap: var(--space-lg); position: sticky; top: 90px;">
        <!-- Visual Accent Image -->
        <div style="border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-line); box-shadow: var(--shadow-md);">
          <img
            src="<?= asset_url($service['image']) ?>"
            alt="<?= e($service['title']) ?>"
            style="width: 100%; height: auto; display: block; object-fit: cover;"
            loading="lazy"
          >
        </div>

        <!-- Deliverables Summary -->
        <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
          <span style="font-family: var(--font-heading); font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-400); display: block; margin-bottom: 6px;">
            Standard Deliverables
          </span>
          <p style="font-size: 0.95rem; font-weight: 700; color: var(--c-navy-deep); line-height: 1.5; margin-bottom: var(--space-md);">
            <?= e($service['deliverables']) ?>
          </p>

          <span style="font-family: var(--font-heading); font-weight: 700; font-size: 0.72rem; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-400); display: block; margin-bottom: 8px;">
            Tools &amp; Environment
          </span>
          <div style="display: flex; flex-wrap: wrap; gap: 6px; margin-bottom: var(--space-lg);">
            <?php foreach ($service['tools'] as $tool): ?>
              <span class="capability-tag"><?= e($tool) ?></span>
            <?php endforeach; ?>
          </div>

          <button
            type="button"
            class="btn btn-primary btn-pill"
            data-open-enquiry="<?= e($service['title']) ?>"
            style="width: 100%;"
          >
            Enquire About This Service &rarr;
          </button>
        </div>

        <!-- Direct Contact Card -->
        <div style="border: 1px dashed var(--border-line); border-radius: var(--radius-md); padding: var(--space-md); background: var(--surface-alt);">
          <div style="font-size: 0.85rem; font-weight: 600; color: var(--c-navy-deep); margin-bottom: 4px;">
            Need a tailored scope or quotation?
          </div>
          <p style="font-size: 0.8rem; color: var(--text-body); line-height: 1.5; margin-bottom: var(--space-xs);">
            Every business requirement is distinct. Get in touch directly to discuss your project parameters.
          </p>
          <a href="https://wa.me/233535744202" target="_blank" rel="noopener" style="font-size: 0.82rem; font-weight: 600; color: var(--c-sky); text-decoration: none; display: inline-flex; align-items: center; gap: 6px;">
            <i class="fa-brands fa-whatsapp"></i> Chat directly on WhatsApp &rarr;
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     EXECUTION PROCESS (4-STEP WORKFLOW)
     ========================================================================== -->
<section class="section section-subtle">
  <div class="container">
    <div class="section-header" style="text-align: center; max-width: 600px; margin-inline: auto; margin-bottom: var(--space-2xl);">
      <span class="eyebrow">Methodology</span>
      <h2 class="section-title">How Projects Are Delivered</h2>
      <p class="section-lead">A disciplined, transparent execution cycle designed to eliminate friction, respect deadlines, and ensure production quality.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(240px, 1fr)); gap: var(--space-lg);">
      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
        <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--c-sky); display: block; margin-bottom: var(--space-xs);">01</span>
        <h3 style="font-size: 1.1rem; color: var(--c-navy-deep); font-weight: 700; margin-bottom: var(--space-xs);">Discovery &amp; Scope</h3>
        <p style="font-size: 0.875rem; color: var(--text-body); line-height: 1.6; margin: 0;">
          Clarifying business goals, audience expectations, technical prerequisites, and establishing a realistic timeline.
        </p>
      </div>

      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
        <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--c-sky); display: block; margin-bottom: var(--space-xs);">02</span>
        <h3 style="font-size: 1.1rem; color: var(--c-navy-deep); font-weight: 700; margin-bottom: var(--space-xs);">Architecture &amp; Design</h3>
        <p style="font-size: 0.875rem; color: var(--text-body); line-height: 1.6; margin: 0;">
          Creating wireframes, system schematics, interface layouts, and asset guidelines for review before development begins.
        </p>
      </div>

      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
        <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--c-sky); display: block; margin-bottom: var(--space-xs);">03</span>
        <h3 style="font-size: 1.1rem; color: var(--c-navy-deep); font-weight: 700; margin-bottom: var(--space-xs);">Engineering &amp; Build</h3>
        <p style="font-size: 0.875rem; color: var(--text-body); line-height: 1.6; margin: 0;">
          Clean, modular implementation with semantic code, mobile optimization, and integration of required business services.
        </p>
      </div>

      <div style="background: var(--surface-canvas); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-lg); box-shadow: var(--shadow-sm);">
        <span style="font-family: var(--font-heading); font-size: 1.5rem; font-weight: 800; color: var(--c-sky); display: block; margin-bottom: var(--space-xs);">04</span>
        <h3 style="font-size: 1.1rem; color: var(--c-navy-deep); font-weight: 700; margin-bottom: var(--space-xs);">Testing &amp; Deployment</h3>
        <p style="font-size: 0.875rem; color: var(--text-body); line-height: 1.6; margin: 0;">
          Rigorous cross-device testing, performance audits, DNS/email verification, followed by direct handover and documentation.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     RELEVANT SELECTED WORKS (PROOF OF EXECUTION)
     ========================================================================== -->
<?php if (!empty($relevantProjects)): ?>
<section class="section">
  <div class="container">
    <div class="section-header">
      <span class="eyebrow">Case Studies</span>
      <h2 class="section-title">Relevant Client Work</h2>
      <p class="section-lead">Real digital systems and platforms delivered within this discipline.</p>
    </div>

    <div style="display: grid; grid-template-columns: repeat(auto-fit, minmax(320px, 1fr)); gap: var(--space-xl);">
      <?php foreach ($relevantProjects as $project): ?>
        <article class="portfolio-card">
          <div class="portfolio-card-media" data-project-trigger="<?= e($project['id']) ?>" style="position: relative; cursor: pointer;">
            <img
              src="<?= asset_url($project['image']) ?>"
              alt="<?= e($project['title']) ?>"
              loading="lazy"
              style="width: 100%; height: auto; display: block; aspect-ratio: 16/10; object-fit: cover;"
            >
            <span class="discipline-code" style="position: absolute; top: 12px; left: 12px; background: rgba(13, 20, 36, 0.85); backdrop-filter: blur(4px);">
              <?= e($project['category']) ?>
            </span>
          </div>

          <div class="portfolio-card-body" style="padding: var(--space-lg);">
            <h3 style="font-size: 1.25rem; font-weight: 700; color: var(--c-navy-deep); margin-bottom: 4px;">
              <?= e($project['title']) ?>
            </h3>
            <p style="font-size: 0.875rem; color: var(--c-slate-500); margin-bottom: var(--space-md); line-height: 1.5;">
              <?= e($project['subtitle']) ?>
            </p>

            <a
              href="<?= site_url('work.php#' . e($project['id'])) ?>"
              class="btn btn-secondary btn-sm btn-pill"
              data-project-trigger="<?= e($project['id']) ?>"
              aria-label="View Project Specification for <?= e($project['title']) ?>"
              style="width: 100%; text-align: center; display: inline-block;"
            >
              View Project Specification &rarr;
            </a>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>
<?php endif; ?>

<!-- ==========================================================================
     FINAL BOTTOM CTA
     ========================================================================== -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div style="background: linear-gradient(135deg, var(--c-navy-deep) 0%, var(--c-navy) 100%); border-radius: var(--radius-lg); padding: clamp(2rem, 5vw, 4rem); color: var(--c-white); text-align: center; position: relative; overflow: hidden;">
      <div style="max-width: 650px; margin-inline: auto; position: relative; z-index: 1;">
        <span style="font-family: var(--font-heading); font-weight: 700; font-size: 0.75rem; text-transform: uppercase; letter-spacing: 0.1em; color: var(--c-sky); display: block; margin-bottom: var(--space-xs);">
          Ready to Begin?
        </span>
        <h2 style="font-size: clamp(1.75rem, 3.5vw, 2.5rem); color: #fff; margin-bottom: var(--space-sm);">
          Start your <?= e($service['short_title']) ?> project today.
        </h2>
        <p style="color: var(--c-slate-300); font-size: 1.05rem; line-height: 1.6; margin-bottom: var(--space-xl);">
          Send an enquiry with your timeline and requirements to receive a structured scope review and quotation.
        </p>

        <div style="display: flex; gap: 12px; justify-content: center; flex-wrap: wrap;">
          <button
            type="button"
            class="btn btn-primary btn-pill"
            data-open-enquiry="<?= e($service['title']) ?>"
            style="background: var(--c-sky); color: #fff; border-color: var(--c-sky);"
          >
            Start Project Enquiry &rarr;
          </button>
          <a
            href="https://wa.me/233535744202"
            target="_blank"
            rel="noopener"
            class="btn btn-secondary btn-pill"
            style="background: rgba(255, 255, 255, 0.1); color: #fff; border-color: rgba(255, 255, 255, 0.2);"
          >
            <i class="fa-brands fa-whatsapp"></i> Chat on WhatsApp
          </a>
        </div>
      </div>
    </div>
  </div>
</section>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
