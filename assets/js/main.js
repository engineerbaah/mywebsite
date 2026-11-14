/**
 * ENGINEER BAAH — DIGITAL EXPERIENCE
 * Core Client-Side Interactions & Architecture
 * 
 * Standards:
 * - Zero external runtime dependencies (pure vanilla ES6+)
 * - WCAG 2.1 AA keyboard navigation, focus trapping & accessible states
 * - Universal Project Modal with full-view controlled image display
 * - Universal Enquiry Modal with smart service prefilling & AJAX transmission
 * - Asynchronous Contact Form Pipeline with CSRF & immediate user feedback
 */

(function () {
  'use strict';

  // Master Portfolio Data Object (injected via window.__PORTFOLIO_DATA__)
  let portfolioData = {};

  /* ==========================================================================
     1. ACCESSIBLE MOBILE NAVIGATION DRAWER
     ========================================================================== */
  function initMobileNav() {
    const toggleBtn = document.getElementById('nav-toggle-btn');
    const drawer = document.getElementById('mobile-nav-drawer');
    const backdrop = document.getElementById('mobile-nav-backdrop');
    const closeBtn = document.getElementById('mobile-nav-close');
    const drawerLinks = drawer ? drawer.querySelectorAll('.mobile-nav-link, .mobile-nav-footer a, .mobile-nav-footer button') : [];

    if (!toggleBtn || !drawer) return;

    function openNav() {
      drawer.classList.add('is-open');
      toggleBtn.setAttribute('aria-expanded', 'true');
      document.body.style.overflow = 'hidden';
      if (closeBtn) closeBtn.focus();
    }

    function closeNav() {
      drawer.classList.remove('is-open');
      toggleBtn.setAttribute('aria-expanded', 'false');
      document.body.style.overflow = '';
      toggleBtn.focus();
    }

    toggleBtn.addEventListener('click', function () {
      const isOpen = drawer.classList.contains('is-open');
      if (isOpen) {
        closeNav();
      } else {
        openNav();
      }
    });

    if (closeBtn) {
      closeBtn.addEventListener('click', closeNav);
    }

    if (backdrop) {
      backdrop.addEventListener('click', closeNav);
    }

    drawerLinks.forEach(function (link) {
      link.addEventListener('click', closeNav);
    });

    // Keyboard Trap and Escape Key
    document.addEventListener('keydown', function (e) {
      if (!drawer.classList.contains('is-open')) return;

      if (e.key === 'Escape') {
        closeNav();
        return;
      }

      if (e.key === 'Tab') {
        const focusable = drawer.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey) {
          if (document.activeElement === first) {
            e.preventDefault();
            last.focus();
          }
        } else {
          if (document.activeElement === last) {
            e.preventDefault();
            first.focus();
          }
        }
      }
    });
  }

  /* ==========================================================================
     2. PROJECT MODAL DIALOG ENGINE (Full view image, strictly controlled)
     ========================================================================== */
  let lastFocusedElement = null;

  function initProjectModal() {
    const modalOverlay = document.getElementById('project-modal-dialog');
    const modalContent = document.getElementById('project-modal-content');
    const modalCloseBtn = document.getElementById('project-modal-close');

    if (!modalOverlay || !modalContent) return;

    if (window.__PORTFOLIO_DATA__) {
      portfolioData = window.__PORTFOLIO_DATA__;
    }

    function openProjectModal(projectId) {
      const project = portfolioData[projectId];
      if (!project) return;

      lastFocusedElement = document.activeElement;

      const tagsHtml = (project.tags || []).map(function (t) {
        return `<span class="capability-tag">${t}</span>`;
      }).join(' ');

      const highlightsHtml = (project.highlights || []).map(function (h) {
        return `<li style="display:flex;align-items:flex-start;gap:8px;font-size:0.9rem;margin-bottom:6px;">
          <svg style="color:var(--c-sky-hover);flex-shrink:0;margin-top:4px;" width="16" height="16" fill="none" viewBox="0 0 24 24" stroke="currentColor">
            <path stroke-linecap="round" stroke-linejoin="round" stroke-width="2.5" d="M5 13l4 4L19 7"/>
          </svg>
          <span>${h}</span>
        </li>`;
      }).join('');

      const stackHtml = (project.stack || []).map(function (s) {
        return `<span class="capability-tag">${s}</span>`;
      }).join(' ');

      function resolveAssetUrl(path) {
        if (!path) return '';
        if (path.startsWith('http://') || path.startsWith('https://')) return path;
        const clean = path.replace(/^\//, '');
        const base = (window.__BASE_URL__ || '').replace(/\/$/, '');
        return base + '/' + clean;
      }

      const imgWebp = resolveAssetUrl(project.image);
      const imgFallback = resolveAssetUrl(project.image_fallback || project.image);

      // Controlled height with object-fit: contain to show the entire screenshot fully without cropping
      modalContent.innerHTML = `
        <div style="margin-bottom: var(--space-md);">
          <span class="eyebrow">${project.category || 'CASE STUDY'}</span>
          <h2 style="font-size: var(--text-h2); color: var(--c-navy-deep); margin-top: 4px;">${project.title}</h2>
          <p style="font-size: 1.05rem; color: var(--c-slate-600); margin-top: 4px;">${project.subtitle}</p>
        </div>

        <div style="margin-bottom: var(--space-lg); border-radius: var(--radius-md); overflow: hidden; border: 1px solid var(--border-line); background-color: var(--surface-subtle, #f8fafc); box-shadow: var(--shadow-card); text-align: center;">
          <picture>
            <source srcset="${imgWebp}" type="image/webp">
            <img
              src="${imgFallback}"
              alt="${project.title} Full Showcase"
              style="width: 100%; max-height: 380px; object-fit: contain; display: block; margin: 0 auto; background: var(--surface-subtle);"
              loading="eager"
            >
          </picture>
        </div>

        <div style="display: flex; flex-wrap: wrap; gap: 8px; margin-bottom: var(--space-lg);">
          ${tagsHtml}
        </div>

        <div style="display: grid; grid-template-columns: 1fr; gap: var(--space-lg); margin-bottom: var(--space-xl);">
          <div>
            <h3 style="font-size: 1.05rem; color: var(--c-navy-deep); margin-bottom: 6px; font-weight: 700;">The Challenge</h3>
            <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.6;">${project.challenge}</p>
          </div>

          <div>
            <h3 style="font-size: 1.05rem; color: var(--c-navy-deep); margin-bottom: 6px; font-weight: 700;">Engineering &amp; Design Solution</h3>
            <p style="font-size: 0.95rem; color: var(--text-body); line-height: 1.6;">${project.solution}</p>
          </div>
        </div>

        <div style="background-color: var(--surface-subtle); border: 1px solid var(--border-line); border-radius: var(--radius-md); padding: var(--space-md) var(--space-lg); margin-bottom: var(--space-xl);">
          <h4 style="font-size: 0.875rem; font-family: var(--font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--c-navy-deep); margin-bottom: var(--space-xs);">Verified Project Milestones</h4>
          <ul style="list-style: none; padding: 0; margin: 0;">
            ${highlightsHtml}
          </ul>
        </div>

        <div style="margin-bottom: var(--space-xl);">
          <h4 style="font-size: 0.8125rem; font-family: var(--font-heading); font-weight: 700; text-transform: uppercase; letter-spacing: 0.05em; color: var(--text-muted); margin-bottom: 8px;">Technology Stack</h4>
          <div style="display: flex; flex-wrap: wrap; gap: 6px;">
            ${stackHtml}
          </div>
        </div>

        <div style="display: flex; flex-wrap: wrap; align-items: center; justify-content: space-between; gap: var(--space-md); padding-top: var(--space-md); border-top: 1px solid var(--border-line);">
          <span style="font-family: var(--font-heading); font-weight: 700; font-size: 0.8rem; color: var(--text-muted);">Client: ${project.client || 'Verified Client'}</span>
          <button
            type="button"
            class="btn btn-primary btn-pill"
            data-open-enquiry="${project.service || project.title}"
            data-enquiry-service="${project.service || ''}"
            data-enquiry-project="${project.title || ''}"
            style="min-height: 40px; padding: 0.5rem 1.25rem;"
          >
            Start a Similar Project &rarr;
          </button>
        </div>
      `;

      modalOverlay.classList.add('is-active');
      modalOverlay.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      if (modalCloseBtn) modalCloseBtn.focus();
    }

    function closeModal() {
      modalOverlay.classList.remove('is-active');
      modalOverlay.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      if (lastFocusedElement) {
        lastFocusedElement.focus();
      }
    }

    document.addEventListener('click', function (e) {
      const trigger = e.target.closest('[data-project-trigger], [data-open-project]');
      if (trigger) {
        e.preventDefault();
        const projectId = trigger.getAttribute('data-project-trigger') || trigger.getAttribute('data-open-project');
        openProjectModal(projectId);
      }
    });

    if (modalCloseBtn) {
      modalCloseBtn.addEventListener('click', closeModal);
    }

    modalOverlay.addEventListener('click', function (e) {
      if (e.target === modalOverlay) {
        closeModal();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (!modalOverlay.classList.contains('is-active')) return;

      if (e.key === 'Escape') {
        closeModal();
        return;
      }

      if (e.key === 'Tab') {
        const focusable = modalOverlay.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey) {
          if (document.activeElement === first) {
            e.preventDefault();
            last.focus();
          }
        } else {
          if (document.activeElement === last) {
            e.preventDefault();
            first.focus();
          }
        }
      }
    });

    window.__closeProjectModal = closeModal;
  }

  /* ==========================================================================
     3. UNIVERSAL ENQUIRY MODAL (Triggered by CTAs & Service Cards)
     ========================================================================== */
  function initEnquiryModal() {
    const enquiryOverlay = document.getElementById('enquiry-modal-dialog');
    const enquiryCloseBtn = document.getElementById('enquiry-modal-close');
    const enquiryForm = document.getElementById('enquiry-modal-form');
    const serviceSelect = document.getElementById('modal-enquiry-service');
    const messageInput = document.getElementById('modal-enquiry-message');
    const alertBox = document.getElementById('enquiry-alert-feedback');
    const submitBtn = document.getElementById('modal-enquiry-submit-btn');

    if (!enquiryOverlay || !enquiryForm) return;

    let enquiryLastFocused = null;

    function openEnquiryModal(prefillValue, projectName) {
      // Close project modal if open
      if (window.__closeProjectModal) {
        window.__closeProjectModal();
      }

      enquiryLastFocused = document.activeElement;

      let targetService = prefillValue || '';
      let refProject = projectName || '';

      // Check if prefillValue is a project in portfolioData
      if (portfolioData) {
        for (const key in portfolioData) {
          const proj = portfolioData[key];
          if (key === prefillValue || (proj.title && proj.title.toLowerCase() === (prefillValue || '').toLowerCase())) {
            targetService = proj.service || targetService;
            refProject = refProject || proj.title;
            break;
          }
        }
      }

      // Handle service prefilling
      if (targetService && serviceSelect) {
        const valLower = targetService.toLowerCase();
        for (let i = 0; i < serviceSelect.options.length; i++) {
          const optText = serviceSelect.options[i].text.toLowerCase();
          const optVal = serviceSelect.options[i].value.toLowerCase();
          if (optVal && (optText.includes(valLower) || optVal.includes(valLower) ||
              (valLower.includes('web') && optVal.includes('web')) ||
              (valLower.includes('brand') && optVal.includes('brand')) ||
              ((valLower.includes('marketing') || valLower.includes('strategy')) && optVal.includes('marketing')) ||
              ((valLower.includes('it') || valLower.includes('tech')) && optVal.includes('it')))) {
            serviceSelect.selectedIndex = i;
            break;
          }
        }
      }

      // Prefill message if referencing a project
      if (refProject && messageInput) {
        messageInput.value = `Hello Engineer Baah, I am interested in building a project similar to "${refProject}". Here are my requirements:\n\n`;
      }

      enquiryOverlay.classList.add('is-active');
      enquiryOverlay.setAttribute('aria-hidden', 'false');
      document.body.style.overflow = 'hidden';

      const nameInput = document.getElementById('modal-enquiry-name');
      if (nameInput) {
        setTimeout(function () { nameInput.focus(); }, 100);
      } else if (enquiryCloseBtn) {
        enquiryCloseBtn.focus();
      }
    }

    function closeEnquiryModal() {
      enquiryOverlay.classList.remove('is-active');
      enquiryOverlay.setAttribute('aria-hidden', 'true');
      document.body.style.overflow = '';
      if (enquiryLastFocused) {
        enquiryLastFocused.focus();
      }
    }

    // Attach to any button/link with [data-open-enquiry]
    document.addEventListener('click', function (e) {
      const trigger = e.target.closest('[data-open-enquiry]');
      if (trigger) {
        e.preventDefault();
        const prefill = trigger.getAttribute('data-enquiry-service') || trigger.getAttribute('data-open-enquiry') || '';
        const project = trigger.getAttribute('data-enquiry-project') || '';
        openEnquiryModal(prefill, project);
      }
    });

    if (enquiryCloseBtn) {
      enquiryCloseBtn.addEventListener('click', closeEnquiryModal);
    }

    enquiryOverlay.addEventListener('click', function (e) {
      if (e.target === enquiryOverlay) {
        closeEnquiryModal();
      }
    });

    document.addEventListener('keydown', function (e) {
      if (!enquiryOverlay.classList.contains('is-active')) return;

      if (e.key === 'Escape') {
        closeEnquiryModal();
        return;
      }

      if (e.key === 'Tab') {
        const focusable = enquiryOverlay.querySelectorAll('button, [href], input, select, textarea, [tabindex]:not([tabindex="-1"])');
        if (focusable.length === 0) return;

        const first = focusable[0];
        const last = focusable[focusable.length - 1];

        if (e.shiftKey) {
          if (document.activeElement === first) {
            e.preventDefault();
            last.focus();
          }
        } else {
          if (document.activeElement === last) {
            e.preventDefault();
            first.focus();
          }
        }
      }
    });

    // Handle AJAX submission
    enquiryForm.addEventListener('submit', function (e) {
      e.preventDefault();

      if (alertBox) {
        alertBox.className = 'form-alert';
        alertBox.style.display = 'none';
        alertBox.textContent = '';
      }

      const nameField = document.getElementById('modal-enquiry-name');
      const emailField = document.getElementById('modal-enquiry-email');
      const phoneField = document.getElementById('modal-enquiry-phone');
      const msgField = document.getElementById('modal-enquiry-message');

      if (!nameField.value.trim() || !emailField.value.trim() || !phoneField.value.trim() || !msgField.value.trim()) {
        if (alertBox) {
          alertBox.className = 'form-alert is-error';
          alertBox.style.display = 'block';
          alertBox.textContent = 'Please fill in all required fields (Name, Email, Phone or WhatsApp, and Message).';
        }
        return;
      }

      const originalBtnHtml = submitBtn ? submitBtn.innerHTML : 'Send Enquiry';
      if (submitBtn) {
        submitBtn.disabled = true;
        submitBtn.innerHTML = `
          <svg style="width:16px;height:16px;margin-right:6px;display:inline-block;animation:spin 1s linear infinite;" viewBox="0 0 24 24" fill="none">
            <circle style="opacity:0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
            <path style="opacity:0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
          </svg>
          Sending...
        `;
      }

      const formData = new FormData(enquiryForm);

      fetch(enquiryForm.getAttribute('action') || 'process-contact.php', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(function (res) {
        return res.json().catch(function () {
          throw new Error('Server returned an unexpected response format.');
        });
      })
      .then(function (data) {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }

        if (data.success) {
          if (alertBox) {
            alertBox.className = 'form-alert is-success';
            alertBox.style.display = 'block';
            alertBox.innerHTML = `<strong>Enquiry Sent Successfully!</strong> ${data.message || 'Engineer Baah will review your details and respond promptly.'}`;
          }
          enquiryForm.reset();
        } else {
          if (alertBox) {
            alertBox.className = 'form-alert is-error';
            alertBox.style.display = 'block';
            alertBox.textContent = data.message || 'Submission could not be completed. Please check your entries.';
          }
        }
      })
      .catch(function () {
        if (submitBtn) {
          submitBtn.disabled = false;
          submitBtn.innerHTML = originalBtnHtml;
        }
        if (alertBox) {
          alertBox.className = 'form-alert is-error';
          alertBox.style.display = 'block';
          alertBox.textContent = 'Transmission error. Please reach out directly via engineerbaah25@gmail.com or WhatsApp (0535744202).';
        }
      });
    });
  }

  /* ==========================================================================
     4. ASYNCHRONOUS CONTACT FORM (Standalone Contact Page)
     ========================================================================== */
  function initContactForm() {
    const form = document.getElementById('contact-inquiry-form');
    if (!form) return;

    const submitBtn = form.querySelector('button[type="submit"]');
    const alertBox = document.getElementById('form-alert-feedback');

    form.addEventListener('submit', function (e) {
      e.preventDefault();

      if (alertBox) {
        alertBox.className = 'form-alert';
        alertBox.style.display = 'none';
        alertBox.textContent = '';
      }

      const nameInput = document.getElementById('contact-name');
      const emailInput = document.getElementById('contact-email');
      const phoneInput = document.getElementById('contact-phone');
      const messageInput = document.getElementById('contact-message');

      if (!nameInput.value.trim() || !emailInput.value.trim() || !phoneInput.value.trim() || !messageInput.value.trim()) {
        if (alertBox) {
          alertBox.className = 'form-alert is-error';
          alertBox.style.display = 'block';
          alertBox.textContent = 'Please complete all required fields (Name, Email, Phone or WhatsApp, and Message).';
        }
        return;
      }

      const originalBtnHtml = submitBtn.innerHTML;
      submitBtn.disabled = true;
      submitBtn.innerHTML = `
        <svg style="width:18px;height:18px;margin-right:8px;display:inline-block;animation:spin 1s linear infinite;" viewBox="0 0 24 24" fill="none">
          <circle style="opacity:0.25;" cx="12" cy="12" r="10" stroke="currentColor" stroke-width="4"></circle>
          <path style="opacity:0.75;" fill="currentColor" d="M4 12a8 8 0 018-8V0C5.373 0 0 5.373 0 12h4zm2 5.291A7.962 7.962 0 014 12H0c0 3.042 1.135 5.824 3 7.938l3-2.647z"></path>
        </svg>
        Sending Message...
      `;

      const formData = new FormData(form);

      fetch(form.getAttribute('action') || 'process-contact.php', {
        method: 'POST',
        body: formData,
        headers: {
          'X-Requested-With': 'XMLHttpRequest'
        }
      })
      .then(function (res) {
        return res.json().catch(function () {
          throw new Error('Server returned an unexpected response format.');
        });
      })
      .then(function (data) {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;

        if (data.success) {
          if (alertBox) {
            alertBox.className = 'form-alert is-success';
            alertBox.style.display = 'block';
            alertBox.innerHTML = `<strong>Message Received Successfully.</strong> ${data.message || 'Engineer Baah will review your details and respond promptly.'}`;
          }
          form.reset();
        } else {
          if (alertBox) {
            alertBox.className = 'form-alert is-error';
            alertBox.style.display = 'block';
            alertBox.textContent = data.message || 'Submission could not be completed. Please check your entries.';
          }
        }
      })
      .catch(function () {
        submitBtn.disabled = false;
        submitBtn.innerHTML = originalBtnHtml;

        if (alertBox) {
          alertBox.className = 'form-alert is-error';
          alertBox.style.display = 'block';
          alertBox.textContent = 'Transmission error. Please reach out directly via engineerbaah25@gmail.com.';
        }
      });
    });
  }

  /* ==========================================================================
     5. WORK FILTERING ENGINE
     ========================================================================== */
  function initWorkFilters() {
    const filterButtons = document.querySelectorAll('.filter-btn');
    const projectItems = document.querySelectorAll('.case-study-spread[data-category], .project-card[data-category]');

    if (filterButtons.length === 0 || projectItems.length === 0) return;

    filterButtons.forEach(function (btn) {
      btn.addEventListener('click', function () {
        const filter = btn.getAttribute('data-filter');

        filterButtons.forEach(function (b) { b.classList.remove('is-active'); });
        btn.classList.add('is-active');

        projectItems.forEach(function (item) {
          const cat = item.getAttribute('data-category');
          if (filter === 'all' || cat === filter) {
            item.style.display = '';
          } else {
            item.style.display = 'none';
          }
        });
      });
    });
  }

  /* ==========================================================================
     6. INTERACTIVE DISCIPLINE CATEGORY TILES (4 Disciplines)
     ========================================================================== */
  function initCategoryTiles() {
    const tiles = document.querySelectorAll('.category-tile[data-discipline-target]');
    const stages = document.querySelectorAll('.category-stage');

    if (tiles.length === 0 || stages.length === 0) return;

    tiles.forEach(function (tile) {
      tile.addEventListener('click', function () {
        const targetId = tile.getAttribute('data-discipline-target');

        // Update active tile
        tiles.forEach(function (t) {
          t.classList.remove('is-active');
          t.setAttribute('aria-selected', 'false');
        });
        tile.classList.add('is-active');
        tile.setAttribute('aria-selected', 'true');

        // Show target stage
        stages.forEach(function (stage) {
          if (stage.id === targetId) {
            stage.style.display = 'grid';
          } else {
            stage.style.display = 'none';
          }
        });
      });
    });
  }

  /* ==========================================================================
     7. CARD FAVORITE HEART TOGGLE
     ========================================================================== */
  function initHeartToggles() {
    const heartBtns = document.querySelectorAll('[data-heart-toggle]');
    heartBtns.forEach(function (btn) {
      btn.addEventListener('click', function (e) {
        e.stopPropagation();
        e.preventDefault();
        const isLiked = btn.classList.toggle('is-liked');
        btn.setAttribute('aria-pressed', isLiked ? 'true' : 'false');
      });
    });
  }

  /* ==========================================================================
     8. SMART AUTO-HIDING STICKY HEADER & READING PROGRESS LINE
     ========================================================================== */
  function initHeaderAndProgress() {
    const header = document.querySelector('.site-header');
    const progressBar = document.getElementById('scroll-progress');
    const mobileDrawer = document.getElementById('mobile-nav-drawer');

    if (!header && !progressBar) return;

    let lastScrollY = window.scrollY;
    let ticking = false;

    function onScroll() {
      const currentScrollY = window.scrollY;
      const docHeight = document.documentElement.scrollHeight - window.innerHeight;

      // Update reading progress bar
      if (progressBar) {
        const progress = docHeight > 0 ? Math.min(1, Math.max(0, currentScrollY / docHeight)) : 0;
        progressBar.style.transform = `scaleX(${progress})`;
      }

      // Auto-hide / reveal header (preserve if mobile drawer open)
      if (header) {
        const isDrawerOpen = mobileDrawer && mobileDrawer.classList.contains('is-open');
        if (!isDrawerOpen) {
          if (currentScrollY > lastScrollY && currentScrollY > 180) {
            header.classList.add('is-hidden');
          } else if (currentScrollY < lastScrollY || currentScrollY <= 100) {
            header.classList.remove('is-hidden');
          }
        }
      }

      lastScrollY = currentScrollY;
      ticking = false;
    }

    window.addEventListener('scroll', function () {
      if (!ticking) {
        ticking = true;
        window.requestAnimationFrame(onScroll);
      }
    }, { passive: true });

    onScroll();
  }

  /* ==========================================================================
     9. SECOND-BY-SECOND ACTIVE LIVE GMT CLOCK (Kumasi, Ghana)
     ========================================================================== */
  function initLiveClock() {
    const clockElements = document.querySelectorAll('.live-clock, #clock');
    if (clockElements.length === 0) return;

    try {
      const dtf = new Intl.DateTimeFormat('en-GB', {
        hour: '2-digit',
        minute: '2-digit',
        second: '2-digit',
        timeZone: 'Africa/Accra'
      });

      function updateClock() {
        const timeString = dtf.format(new Date()) + ' GMT';
        clockElements.forEach(function (el) {
          el.textContent = timeString;
        });
      }

      updateClock();
      setInterval(updateClock, 1000);
    } catch (e) {
      function fallbackClock() {
        const now = new Date();
        const timeString = now.toUTCString().slice(17, 25) + ' GMT';
        clockElements.forEach(function (el) {
          el.textContent = timeString;
        });
      }
      fallbackClock();
      setInterval(fallbackClock, 1000);
    }
  }

  /* ==========================================================================
     10. CURSOR-FOLLOWING HOVER PREVIEW (Desktop fine pointers only)
     ========================================================================== */
  function initHoverPeek() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    const isFinePointer = window.matchMedia('(hover: hover) and (pointer: fine)').matches;

    if (prefersReducedMotion || !isFinePointer) return;

    const peekContainers = document.querySelectorAll('[data-peek]');
    if (peekContainers.length === 0) return;

    // Create floating peek card element
    const peekCard = document.createElement('div');
    peekCard.className = 'hover-peek-card';
    peekCard.setAttribute('aria-hidden', 'true');
    peekCard.innerHTML = '<img src="" alt="" loading="lazy">';
    document.body.appendChild(peekCard);
    const peekImg = peekCard.querySelector('img');

    let targetX = 0;
    let targetY = 0;
    let currentX = 0;
    let currentY = 0;
    let isRunning = false;

    function getWidth() { return peekCard.offsetWidth || 300; }
    function getHeight() { return peekCard.offsetHeight || 190; }

    function animatePeek() {
      currentX += (targetX - currentX) * 0.16;
      currentY += (targetY - currentY) * 0.16;
      peekCard.style.transform = `translate3d(${currentX}px, ${currentY}px, 0)`;

      isRunning = peekCard.classList.contains('is-active') || Math.abs(targetX - currentX) > 0.5;
      if (isRunning) {
        window.requestAnimationFrame(animatePeek);
      }
    }

    peekContainers.forEach(function (container) {
      const rows = container.querySelectorAll('[data-img]');
      rows.forEach(function (row) {
        const imgSrc = row.getAttribute('data-img');
        if (!imgSrc) return;

        // Preload image
        const preloader = new Image();
        preloader.src = imgSrc;

        row.addEventListener('mouseenter', function (e) {
          peekImg.src = imgSrc;
          container.classList.add('is-dimmed');
          row.classList.add('is-hovered');

          if (!peekCard.classList.contains('is-active')) {
            currentX = targetX = e.clientX + 24;
            currentY = targetY = e.clientY - (getHeight() / 2);
          }
          peekCard.classList.add('is-active');

          if (!isRunning) {
            isRunning = true;
            window.requestAnimationFrame(animatePeek);
          }
        });

        row.addEventListener('mousemove', function (e) {
          let posX = e.clientX + 24;
          if (posX + getWidth() > window.innerWidth - 16) {
            posX = e.clientX - getWidth() - 24;
          }
          let posY = e.clientY - (getHeight() / 2);
          if (posY < 16) posY = 16;
          if (posY + getHeight() > window.innerHeight - 16) {
            posY = window.innerHeight - getHeight() - 16;
          }

          targetX = posX;
          targetY = posY;
        });

        row.addEventListener('mouseleave', function () {
          row.classList.remove('is-hovered');
          container.classList.remove('is-dimmed');
          peekCard.classList.remove('is-active');
        });
      });
    });
  }

  /* ==========================================================================
     11. STOLEN EDITORIAL ANIMATIONS & SCROLL REVEALS
     ========================================================================== */
  function initEditorialAnimations() {
    const prefersReducedMotion = window.matchMedia('(prefers-reduced-motion: reduce)').matches;
    if (prefersReducedMotion) return;

    // Stagger indices for staggered lists
    document.querySelectorAll('.stagger-list').forEach(function (list) {
      Array.from(list.children).forEach(function (child, i) {
        child.style.setProperty('--i', i);
      });
    });

    // Reveal on scroll (IntersectionObserver)
    const revealTargets = document.querySelectorAll('.rv, .clip');
    if (revealTargets.length > 0 && 'IntersectionObserver' in window) {
      const observer = new IntersectionObserver(function (entries) {
        entries.forEach(function (entry) {
          if (entry.isIntersecting) {
            entry.target.classList.add('is-in');
            observer.unobserve(entry.target);
          }
        });
      }, {
        threshold: 0.12,
        rootMargin: '0px 0px -40px 0px'
      });

      revealTargets.forEach(function (el) {
        observer.observe(el);
      });
    }

    // Hero title line reveals
    window.requestAnimationFrame(function () {
      window.requestAnimationFrame(function () {
        document.querySelectorAll('.hero-ready').forEach(function (el) {
          el.classList.add('ready');
        });
      });
    });
  }

  /* ==========================================================================
     INIT ON READY / DOM CONTENT LOADED
     ========================================================================== */
  function initAll() {
    initMobileNav();
    initProjectModal();
    initEnquiryModal();
    initContactForm();
    initWorkFilters();
    initCategoryTiles();
    initHeartToggles();
    initHeaderAndProgress();
    initLiveClock();
    initHoverPeek();
    initEditorialAnimations();
  }

  if (document.readyState === 'loading') {
    document.addEventListener('DOMContentLoaded', initAll);
  } else {
    initAll();
  }

})();
