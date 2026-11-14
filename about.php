<?php
declare(strict_types=1);

$pageTitle = 'About Engineer Baah — Software Engineer & Designer | Kumasi, Ghana';
$pageDesc = 'Meet Engineer Baah (Isaac Brem Baah), a software engineer and creative designer crafting high-performance websites and visual systems in Kumasi, Ghana.';
$pageSlug = 'about';

require_once __DIR__ . '/includes/header.php';
?>

<!-- ==========================================================================
     PAGE HEADER — EDITORIAL INTRO
     ========================================================================== -->
<section class="hero-editorial" style="padding-bottom: clamp(2rem, 3.5vw, 3rem);">
  <div class="container">
    <div class="container-narrow" style="margin-inline: 0;">
      <span class="eyebrow">About // Background &amp; Approach</span>
      <h1 class="hero-headline hero-ready" style="font-size: var(--text-h1); margin-bottom: var(--space-md);">
        <span class="ln"><span style="--i:0">Engineering with a</span></span>
        <span class="ln"><span style="--i:1">designer&rsquo;s eye.</span></span>
      </h1>
      <p class="hero-lead" style="margin-bottom: var(--space-md); max-width: 58ch;">
        I am Isaac Brem Baah, known professionally as Engineer Baah. I build fast, dependable websites and business systems, and I design the visual identities that make them memorable.
      </p>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 1: EDITORIAL 3-PHOTO COLLAGE
     ========================================================================== -->
<section style="padding: 0 0 clamp(2rem, 4vw, 3.5rem);">
  <div class="container">
    <div class="about-collage">
      <figure class="c1">
        <picture>
          <source srcset="<?= asset_url('assets/images/baah-outside.webp') ?>" type="image/webp">
          <img
            src="<?= asset_url('assets/images/baah-outside.webp') ?>"
            alt="Engineer Baah at his engineering workstation"
            loading="eager"
            decoding="async"
            width="768"
            height="1115"
          >
        </picture>
      </figure>

      <figure class="c2">
        <picture>
          <source srcset="<?= asset_url('assets/images/engineer-baah-at-work.webp') ?>" type="image/webp">
          <img
            src="<?= asset_url('assets/images/engineer-baah-at-work.webp') ?>"
            alt="Engineer Baah seated comfortably"
            loading="lazy"
            decoding="async"
            width="800"
            height="900"
          >
        </picture>
      </figure>

      <figure class="c3">
        <picture>
          <source srcset="<?= asset_url('assets/images/baah-about.webp') ?>" type="image/webp">
          <img
            src="<?= asset_url('assets/images/baah-about.webp') ?>"
            alt="Engineer Baah outdoors"
            loading="lazy"
            decoding="async"
            width="600"
            height="800"
          >
        </picture>
      </figure>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 2: MONOGRAPH STORY & CURATED QUICK FACTS
     ========================================================================== -->
<section class="section" style="padding-top: 0;">
  <div class="container">
    <div class="about-story-layout">
      <!-- Left Column: Biography Narrative -->
      <div class="about-narrative">
        <span class="eyebrow">My Approach // The Creative Engineer</span>
        <h2>
          Technology is the tool. The business is the point.
        </h2>

        <p>
          Too often in digital projects, design and engineering live in completely different worlds. A design might look great in a presentation, but ends up slow, clumsy, and frustrating to use on a phone. On the other hand, software that is purely functional can feel confusing and uninviting for the customers trying to use it.
        </p>

        <p>
          I work across both disciplines so you don’t have to choose between a site that looks polished and one that actually works. When someone understands both sides, the result is clean: pages load in a flash, navigation makes intuitive sense, and your brand leaves a lasting, credible impression.
        </p>

        <p>
          Alongside independent client projects, I serve as IT Manager for SKB Construction Company Limited and its affiliated travel and real estate businesses in Kumasi. Managing day-to-day technology inside active companies keeps me grounded in practical reality: websites must bring in real customer enquiries, internal tools must save people time, and systems must simply work without constant babysitting.
        </p>
      </div>

      <!-- Right Column: Studio Dossier & Facts Card -->
      <aside class="about-dossier-card">
        <span class="eyebrow" style="margin-bottom: var(--space-xs);">Quick Overview</span>
        <h3 style="font-size: 1.25rem; font-family: var(--font-heading); font-weight: 800; color: var(--c-navy-deep); margin-bottom: var(--space-xs);">
          Key Facts &amp; Status
        </h3>

        <!-- Curated Quick Facts Table -->
        <dl class="facts-list">
          <div class="facts-item">
            <dt>Based in</dt>
            <dd>Kumasi, Ghana</dd>
          </div>
          <div class="facts-item">
            <dt>Building for web since</dt>
            <dd>September 2023</dd>
          </div>
          <div class="facts-item">
            <dt>Current Role</dt>
            <dd>IT Manager, SKB Group</dd>
          </div>
          <div class="facts-item">
            <dt>Core Services</dt>
            <dd>Web, Brand &amp; IT Systems</dd>
          </div>
          <div class="facts-item">
            <dt>Availability</dt>
            <dd style="color: #059669; font-weight: 700;">Open for Projects</dd>
          </div>
        </dl>

        <div class="about-quote-box">
          &ldquo;A great website isn&rsquo;t an expense. Done right, it&rsquo;s the hardest-working asset your business owns.&rdquo;
        </div>
      </aside>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 3: FOUR PRACTICAL COMMITMENTS (DARK NAVY SECTION)
     ========================================================================== -->
<section class="section-dark-manifesto" aria-labelledby="principles-heading">
  <div class="container">
    <div class="section-header">
      <span class="eyebrow">How I Work</span>
      <h2 id="principles-heading" class="section-title">Four Practical Commitments</h2>
      <p class="section-desc">
        Simple standards that guide every website, interface, and line of code I deliver.
      </p>
    </div>

    <div class="manifesto-cards-grid">
      <div class="manifesto-card">
        <span class="manifesto-card-num">01 // HONEST COMMUNICATION</span>
        <h3 class="manifesto-card-title">Clear &amp; Transparent</h3>
        <p class="manifesto-card-desc">
          I explain what we are building, what it costs, and how long it will take in plain words. No technical jargon, no fabricated case studies, and no hidden surprises.
        </p>
      </div>

      <div class="manifesto-card">
        <span class="manifesto-card-num">02 // FUNCTION &amp; BEAUTY</span>
        <h3 class="manifesto-card-title">Works First, Looks Sharp</h3>
        <p class="manifesto-card-desc">
          Links must go somewhere, contact forms must deliver reliably, and pages must load instantly on mobile. Once functionality is rock-solid, the visual presentation gets the same meticulous attention.
        </p>
      </div>

      <div class="manifesto-card">
        <span class="manifesto-card-num">03 // BUSINESS FOCUS</span>
        <h3 class="manifesto-card-title">Built for Real Results</h3>
        <p class="manifesto-card-desc">
          I build around what your business actually needs: turning visitors into client enquiries, making your operations smoother, and giving you full ownership of your site.
        </p>
      </div>

      <div class="manifesto-card">
        <span class="manifesto-card-num">04 // DIRECT ACCOUNTABILITY</span>
        <h3 class="manifesto-card-title">One Reliable Partner</h3>
        <p class="manifesto-card-desc">
          You work directly with the person designing and engineering your product. Clear responsibility, direct communication, and prompt support when you need it.
        </p>
      </div>
    </div>
  </div>
</section>

<!-- ==========================================================================
     SECTION 4: CAPABILITIES & COLLABORATION (FOR CLIENTS, EMPLOYERS, COLLABORATORS)
     ========================================================================== -->
<section class="section">
  <div class="container">
    <div class="section-header section-header-split">
      <div>
        <span class="eyebrow">Collaboration &amp; Capabilities</span>
        <h2 class="section-title">How we can work together.</h2>
      </div>
      <p class="section-desc">
        Whether you are a business owner looking for a new platform, a hiring team seeking technical talent, or a fellow creative looking to collaborate.
      </p>
    </div>

    <div class="workbench-clusters-grid" style="grid-template-columns: repeat(auto-fit, minmax(min(100%, 300px), 1fr));">
      <!-- Card 1: For Business Owners & Clients -->
      <div class="workbench-card">
        <span class="eyebrow" style="margin-bottom: var(--space-xs);">For Clients &amp; Business Owners</span>
        <h3 class="workbench-card-title">Complete Digital Solutions</h3>
        <p class="workbench-card-desc">
          Custom corporate websites, online shops, booking platforms, and professional logos that give your company immediate credibility and turn visitors into paying customers.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
          <span class="capability-tag">Custom Websites</span>
          <span class="capability-tag">Online Stores</span>
          <span class="capability-tag">Brand Identity</span>
          <span class="capability-tag">Mobile Responsive</span>
          <span class="capability-tag">Fast Loading</span>
        </div>
      </div>

      <!-- Card 2: For Employers & Companies -->
      <div class="workbench-card">
        <span class="eyebrow" style="margin-bottom: var(--space-xs);">For Employers &amp; Companies</span>
        <h3 class="workbench-card-title">Engineering &amp; IT Leadership</h3>
        <p class="workbench-card-desc">
          Full-stack development, database architecture, and IT operations management. A dependable problem-solver who understands business operations and takes total ownership.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
          <span class="capability-tag">Full-Stack Web</span>
          <span class="capability-tag">PHP &amp; JavaScript</span>
          <span class="capability-tag">MySQL Databases</span>
          <span class="capability-tag">IT Management</span>
          <span class="capability-tag">Systems Security</span>
        </div>
      </div>

      <!-- Card 3: For Designers, Agencies & Collaborators -->
      <div class="workbench-card">
        <span class="eyebrow" style="margin-bottom: var(--space-xs);">For Designers &amp; Teams</span>
        <h3 class="workbench-card-title">Creative &amp; Technical Partner</h3>
        <p class="workbench-card-desc">
          A developer who speaks the language of design. I translate Figma mockups into pixel-perfect, accessible code with smooth animations, semantic markup, and zero friction.
        </p>
        <div style="display: flex; flex-wrap: wrap; gap: 6px;">
          <span class="capability-tag">Figma to Code</span>
          <span class="capability-tag">Design Systems</span>
          <span class="capability-tag">Clean Architecture</span>
          <span class="capability-tag">Smooth Animations</span>
          <span class="capability-tag">Accessible HTML/CSS</span>
        </div>
      </div>
    </div>
  </div>
</section>

<!-- Reusable Contact CTA Banner -->
<?php include __DIR__ . '/includes/contact-cta.php'; ?>

<?php require_once __DIR__ . '/includes/footer.php'; ?>
