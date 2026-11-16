<?php
declare(strict_types=1);

$pageTitle = 'Services & Disciplines — Engineer Baah | Creative Engineering';
$pageDesc = 'Explore the four core engineering disciplines by Isaac Brem Baah: Web Development, Brand Identity Design, Digital Strategy, and IT Technology Management.';
$pageSlug = 'capabilities';

require_once __DIR__ . '/includes/header.php';
$disciplines = get_core_disciplines();
?>

<!-- ==========================================================================
     PAGE HEADER
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2.5rem, 4vw, 3.5rem);">
  <div class="container">
    <div class="container-narrow" style="margin-inline: 0;">
      <span class="eyebrow">Professional Services</span>
      <h1 class="hero-headline hero-ready" style="font-size: var(--text-h1); margin-bottom: var(--space-md);">
        <span class="ln"><span style="--i:0">Disciplines grounded in</span></span>
        <span class="ln"><span style="--i:1">software engineering, design and execution.</span></span>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-lg);">
        Every service represents a focused discipline designed to help your business establish its online presence, operate efficiently, reach the right audience, and grow with confidence.
      </p>

      <div style="display: flex; flex-wrap: wrap; gap: 12px;">
        <a href="<?= site_url('packages.php') ?>" class="btn btn-primary btn-pill">
          View Packages &amp; Pricing &rarr;
        </a>
        <button type="button" class="btn btn-secondary btn-pill" data-open-enquiry="">
          Start a Project Enquiry
        </button>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     CAPABILITIES DETAIL MATRIX (The 4 Official Disciplines)
     ========================================================================== -->
<section class="section">
  <div class="container">
    <div data-peek style="display: flex; flex-direction: column; gap: var(--space-2xl);">
      <?php foreach ($disciplines as $idx => $disc): ?>
        <article id="<?= e($disc['id']) ?>" class="capabilities-spec-card service-peek-row" data-img="<?= asset_url($disc['image']) ?>">
          <div class="capabilities-spec-header">
            <div>
              <span class="discipline-code" style="font-size: 0.9rem;"><?= e($disc['code']) ?></span>
            </div>
            <div style="display: flex; gap: 10px; align-items: center; flex-wrap: wrap;">
              <a href="<?= e($disc['url']) ?>" class="btn btn-secondary btn-sm btn-pill" aria-label="Explore <?= e($disc['title']) ?> scope and details">
                Explore <?= e($disc['short_title']) ?> &rarr;
              </a>
              <button type="button" class="btn btn-primary btn-sm btn-pill" data-open-enquiry="<?= e($disc['title']) ?>">
                Enquire
              </button>
            </div>
          </div>

          <div class="capabilities-spec-grid">
            <!-- Left / Main: Title & Narrative -->
            <div>
              <h2 style="font-size: var(--text-h2); color: var(--c-navy-deep); margin-bottom: var(--space-xs);">
                <?= e($disc['title']) ?>
              </h2>
              <p style="font-size: 1.1rem; color: var(--c-navy); font-weight: 600; line-height: 1.5; margin-bottom: var(--space-md);">
                <?= e($disc['tagline']) ?>
              </p>
              <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.7; margin-bottom: var(--space-md); max-width: 65ch;">
                <?= e($disc['description']) ?>
              </p>

              <!-- Client Self-Qualification Anchor -->
              <?php if (!empty($disc['good_fit'])): ?>
                <div class="good-fit-callout" style="margin-bottom: var(--space-lg);">
                  <strong class="good-fit-label">Good fit for:</strong>
                  <span class="good-fit-text"><?= e($disc['good_fit']) ?></span>
                </div>
              <?php endif; ?>

              <div>
                <h3 style="font-family: var(--font-heading); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-500); margin-bottom: var(--space-sm);">
                  Core Capabilities
                </h3>
                <ul style="list-style: none; display: flex; flex-direction: column; gap: var(--space-xs); padding: 0; margin: 0;">
                  <?php foreach ($disc['capabilities'] as $cap): ?>
                    <li style="display: flex; align-items: flex-start; gap: var(--space-xs); font-size: 0.9rem; color: var(--text-body);">
                      <svg style="color: var(--c-sky); flex-shrink: 0; margin-top: 3px;" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
                        <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
                      </svg>
                      <span><?= e($cap) ?></span>
                    </li>
                  <?php endforeach; ?>
                </ul>
              </div>

              <!-- Tools and Technologies -->
              <div style="margin-top: var(--space-lg);">
                <h4 style="font-family: var(--font-heading); font-size: 0.75rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-500); margin-bottom: var(--space-xs);">
                  Tools &amp; Technologies
                </h4>
                <div style="display: flex; flex-wrap: wrap; gap: 8px;">
                  <?php foreach ($disc['tools'] as $tool): ?>
                    <span class="capability-tag"><?= e($tool) ?></span>
                  <?php endforeach; ?>
                </div>
              </div>
            </div>

            <!-- Right: Deliverables & Action Dossier -->
            <div style="display: flex; flex-direction: column; gap: var(--space-md); justify-content: space-between;">
              <div style="display: flex; flex-direction: column; gap: var(--space-md);">
                <div style="background-color: var(--surface-alt); border: 1px solid var(--border-line); border-radius: var(--radius-sm); padding: var(--space-lg);">
                  <div style="font-family: var(--font-heading); font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); margin-bottom: 6px;">
                    Standard Deliverables
                  </div>
                  <div style="font-size: 0.9375rem; color: var(--c-navy-deep); font-weight: 700; line-height: 1.5;">
                    <?= e($disc['deliverables']) ?>
                  </div>
                </div>

                <div style="border: 1px dashed var(--border-line); border-radius: var(--radius-sm); padding: var(--space-md);">
                  <div style="font-family: var(--font-heading); font-size: 0.6875rem; font-weight: 700; text-transform: uppercase; letter-spacing: 0.08em; color: var(--c-slate-600); margin-bottom: 6px;">
                    Quality Assurance
                  </div>
                  <p style="font-size: 0.8125rem; color: var(--text-body); line-height: 1.5; margin: 0;">
                    Complete code and asset ownership, responsive mobile-tested layouts, clean documentation, and direct developer support.
                  </p>
                </div>
              </div>

              <div style="display: flex; flex-direction: column; gap: 10px;">
                <a href="<?= e($disc['url']) ?>" class="btn btn-secondary btn-pill" style="width: 100%; text-align: center;">
                  View Scope &amp; Details &rarr;
                </a>
                <button type="button" class="btn btn-primary btn-pill" data-open-enquiry="<?= e($disc['title']) ?>" style="width: 100%;">
                  Enquire About This Service
                </button>
              </div>
            </div>
          </div>
        </article>
      <?php endforeach; ?>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SERVICE ADVANTAGE COMPARISON
     ========================================================================== -->
<section class="section section-subtle">
  <div class="container">
    <div class="section-header">
      <span class="eyebrow">The Standard</span>
      <h2 class="section-title">The Creative Engineering Advantage</h2>
      <p class="section-desc">
        How an integrated Creative Engineer delivers greater clarity, reliability, and speed compared to fragmented teams or generic templates.
      </p>
    </div>

    <div style="overflow-x: auto; -webkit-overflow-scrolling: touch;">
      <table style="width: 100%; border-collapse: collapse; min-width: 600px; background: var(--surface-canvas); border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-line); box-shadow: var(--shadow-subtle);">
        <thead>
          <tr style="background-color: var(--surface-muted); border-bottom: 2px solid var(--border-line); text-align: left;">
            <th style="padding: var(--space-md); font-family: var(--font-heading); font-weight: 700; font-size: 0.8125rem; color: var(--c-navy);">Dimension</th>
            <th style="padding: var(--space-md); font-family: var(--font-heading); font-weight: 700; font-size: 0.8125rem; color: var(--c-slate-500);">Generic Website Template</th>
            <th style="padding: var(--space-md); font-family: var(--font-heading); font-weight: 700; font-size: 0.8125rem; color: var(--c-navy); background: rgba(56, 189, 248, 0.08);">Engineer Baah Standard</th>
          </tr>
        </thead>
        <tbody style="font-size: 0.9rem;">
          <tr style="border-bottom: 1px solid var(--border-line);">
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy);">Architecture &amp; Code Quality</td>
            <td style="padding: var(--space-md); color: var(--c-slate-600);">Heavy page builders, bloated plugins, fragile dependencies.</td>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy); background: rgba(56, 189, 248, 0.04);">Pure Core architecture, zero unnecessary libraries, clean separation.</td>
          </tr>
          <tr style="border-bottom: 1px solid var(--border-line);">
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy);">Speed &amp; Performance</td>
            <td style="padding: var(--space-md); color: var(--c-slate-600);">Slow mobile speeds, high bounce rates, clunky interactions.</td>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy); background: rgba(56, 189, 248, 0.04);">Sub-1.0s fast loading, smooth responsive transitions, optimized assets.</td>
          </tr>
          <tr style="border-bottom: 1px solid var(--border-line);">
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy);">Visual Identity &amp; Design</td>
            <td style="padding: var(--space-md); color: var(--c-slate-600);">Generic layouts, off-the-shelf clipart, inconsistent typography.</td>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy); background: rgba(56, 189, 248, 0.04);">Bespoke brand system, crisp vector assets, professional visual identity.</td>
          </tr>
          <tr style="border-bottom: 1px solid var(--border-line);">
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy);">Security &amp; Maintenance</td>
            <td style="padding: var(--space-md); color: var(--c-slate-600);">Outdated plugins, unvalidated inputs, frequent breakdowns.</td>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy); background: rgba(56, 189, 248, 0.04);">CSRF protection, input sanitation, secure headers, reliable hosting.</td>
          </tr>
          <tr>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy);">Communication</td>
            <td style="padding: var(--space-md); color: var(--c-slate-600);">Junior handoffs, delayed responses, misaligned expectations.</td>
            <td style="padding: var(--space-md); font-weight: 600; color: var(--c-navy); background: rgba(56, 189, 248, 0.04);">Direct communication with the engineer designing and building your product.</td>
          </tr>
        </tbody>
      </table>
    </div>
  </div>
</section>

<!-- Reusable Contact CTA Banner -->
<?php include __DIR__ . '/includes/contact-cta.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
