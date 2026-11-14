<?php
declare(strict_types=1);

http_response_code(404);

$pageTitle = 'Page Not Found (404) — Engineer Baah | Creative Engineer';
$pageDesc = 'The page you requested could not be found or has moved.';
$pageSlug = '404';
$canonicalPath = '404.php';

require_once __DIR__ . '/includes/header.php';
?>

<section class="section-404" style="min-height: 70vh; display: flex; align-items: center; padding: clamp(4rem, 8vw, 7rem) 0; position: relative;">
  <div class="container" style="text-align: center; position: relative; z-index: 2;">
    <div style="max-width: 680px; margin-inline: auto;">
      
      <!-- Eyebrow Badge -->
      <span class="eyebrow" style="margin-bottom: var(--space-xs); display: inline-block;">
        ERROR 404
      </span>

      <!-- Bold 404 Numerical Display -->
      <div class="display-404" aria-hidden="true">
        404
      </div>

      <!-- Main Headline -->
      <h1 class="hero-headline" style="font-size: clamp(2rem, 5vw, 3.2rem); margin-bottom: var(--space-sm); line-height: 1.15;">
        The page you requested could not be found or has moved.
      </h1>

      <!-- Supporting Body Copy -->
      <p class="hero-lead" style="font-size: clamp(1rem, 1.8vw, 1.2rem); color: var(--text-muted); margin-bottom: var(--space-xl); line-height: 1.6; max-width: 52ch; margin-inline: auto;">
        The link you followed may be outdated or mistyped. Choose an option below to return to the website or explore services and past engineering projects.
      </p>

      <!-- Action Buttons -->
      <div class="error-actions" style="display: flex; flex-wrap: wrap; gap: var(--space-sm); justify-content: center; align-items: center;">
        <a href="<?= site_url() ?>" class="btn btn-primary" style="min-width: 190px;">
          <i class="fa-solid fa-arrow-left" aria-hidden="true" style="margin-right: 6px;"></i> Return to Homepage
        </a>
        <a href="<?= site_url('work.php') ?>" class="btn btn-secondary" style="min-width: 170px;">
          <i class="fa-solid fa-briefcase" aria-hidden="true" style="margin-right: 6px;"></i> View Projects
        </a>
        <a href="<?= site_url('capabilities.php') ?>" class="btn btn-secondary" style="min-width: 170px;">
          <i class="fa-solid fa-layer-group" aria-hidden="true" style="margin-right: 6px;"></i> View Services
        </a>
      </div>

    </div>
  </div>
</section>

<?php
require_once __DIR__ . '/includes/footer.php';
?>

