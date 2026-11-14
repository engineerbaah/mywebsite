<?php
declare(strict_types=1);

/**
 * Engineer Baah — Digital Experience
 * Core Configuration & Shared Data Models
 */

// Start session securely if not already active
if (session_status() === PHP_SESSION_NONE) {
    $isSecure = (!empty($_SERVER['HTTPS']) && $_SERVER['HTTPS'] !== 'off') || (isset($_SERVER['SERVER_PORT']) && $_SERVER['SERVER_PORT'] == 443);
    session_set_cookie_params([
        'lifetime' => 0,
        'path' => '/',
        'domain' => '',
        'secure' => $isSecure,
        'httponly' => true,
        'samesite' => 'Lax'
    ]);
    session_start();
}

// Brand & Site Constants
define('SITE_NAME', 'Engineer Baah');
define('SITE_TAGLINE', 'Creative Engineer — Technology, Design & Execution');
define('SITE_ROLE', 'Creative Engineer');
define('SITE_BIO', 'A software engineer and digital creative combining technology, design and execution to create useful digital experiences.');
define('SITE_EMAIL', 'engineerbaah25@gmail.com');
define('SITE_PHONE', '0535744202 · 0573425734');
define('SITE_LOCATION', 'Kumasi, Ghana');
define('SITE_STATUS', 'Available for Select Projects & Consulting');

// Production Canonical Origin
define('PRODUCTION_ORIGIN', 'https://engineerbaah.com');

// Determine base URL dynamically relative to web server document root
$appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..') ?: dirname(__DIR__));
$docRoot = !empty($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']) : '';

$basePath = '';
if (!empty(getenv('VERCEL')) || !empty($_SERVER['VERCEL'])) {
    // Vercel serverless functions execute at root origin
    $basePath = '';
} elseif ($docRoot !== '' && strpos($appRoot, $docRoot) === 0) {
    $basePath = substr($appRoot, strlen($docRoot));
} elseif (!empty($_SERVER['SCRIPT_NAME'])) {
    $scriptDir = str_replace('\\', '/', dirname($_SERVER['SCRIPT_NAME']));
    $basePath = preg_replace('#/(services|includes|api)$#i', '', $scriptDir);
}
$basePath = rtrim(str_replace('\\', '/', $basePath), '/');
define('BASE_URL', $basePath === '/' ? '' : $basePath);

/**
 * Helper to construct relative site URLs
 */
function site_url(string $path = ''): string {
    $cleanPath = ltrim($path, '/');
    if ($cleanPath === '') {
        return BASE_URL ?: '/';
    }
    return (BASE_URL ? BASE_URL : '') . '/' . $cleanPath;
}

/**
 * Helper to construct absolute canonical production URLs
 */
function canonical_url(string $path = ''): string {
    $cleanPath = ltrim($path, '/');
    if ($cleanPath === '' || $cleanPath === 'index.php') {
        return PRODUCTION_ORIGIN . '/';
    }
    return PRODUCTION_ORIGIN . '/' . $cleanPath;
}

/**
 * Resolve secure storage path for inquiry records strictly outside the public web document root
 */
function get_inquiry_storage_path(): ?string {
    // 1. Explicit environment variable
    $envPath = getenv('EB_STORAGE_PATH');
    if ($envPath && is_string($envPath) && trim($envPath) !== '') {
        $clean = rtrim(str_replace('\\', '/', trim($envPath)), '/');
        if (!is_dir($clean)) {
            @mkdir($clean, 0750, true);
        }
        if (is_dir($clean) && is_writable($clean)) {
            return $clean . '/inquiries.jsonl';
        }
    }

    // 2. Explicit constant if defined
    if (defined('EB_STORAGE_PATH') && is_string(constant('EB_STORAGE_PATH')) && trim(constant('EB_STORAGE_PATH')) !== '') {
        $clean = rtrim(str_replace('\\', '/', trim(constant('EB_STORAGE_PATH'))), '/');
        if (!is_dir($clean)) {
            @mkdir($clean, 0750, true);
        }
        if (is_dir($clean) && is_writable($clean)) {
            return $clean . '/inquiries.jsonl';
        }
    }

    // 3. Serverless cloud environment detection (Vercel, AWS Lambda, ephemeral /tmp)
    if (!empty(getenv('VERCEL')) || !empty($_SERVER['VERCEL'])) {
        $tmp = rtrim(str_replace('\\', '/', sys_get_temp_dir()), '/');
        if (is_dir($tmp) && is_writable($tmp)) {
            return $tmp . '/inquiries.jsonl';
        }
    }

    // 4. Dynamic resolution: strictly outside DOCUMENT_ROOT and outside public app root
    $appRoot = str_replace('\\', '/', realpath(__DIR__ . '/..') ?: dirname(__DIR__));
    $docRoot = !empty($_SERVER['DOCUMENT_ROOT']) ? str_replace('\\', '/', realpath($_SERVER['DOCUMENT_ROOT']) ?: $_SERVER['DOCUMENT_ROOT']) : '';

    $candidates = [];

    // Candidate A: Dedicated storage directory outside web root
    if ($docRoot !== '') {
        $parentDoc = dirname($docRoot);
        if (in_array(strtolower(basename($parentDoc)), ['htdocs', 'public', 'public_html'], true)) {
            $parentDoc = dirname($parentDoc);
        }
        if ($parentDoc !== '' && $parentDoc !== $docRoot) {
            $candidates[] = $parentDoc . '/storage/engineerbaah';
            $candidates[] = $parentDoc . '/eb-storage';
        }
    }

    // Candidate B: Dedicated storage directory sibling to app root or grandparent
    $parentApp = dirname($appRoot);
    if (in_array(strtolower(basename($parentApp)), ['htdocs', 'public', 'public_html'], true)) {
        $parentApp = dirname($parentApp);
    }
    if ($parentApp !== '' && $parentApp !== $appRoot) {
        $candidates[] = $parentApp . '/storage/engineerbaah';
        $candidates[] = $parentApp . '/eb-storage';
    }

    // Candidate C: Secure system application data directory (fallback for environments with strict open_basedir)
    $sysTemp = str_replace('\\', '/', sys_get_temp_dir());
    $candidates[] = $sysTemp . '/engineerbaah_storage';

    foreach ($candidates as $dir) {
        // Enforce boundary: candidate must NEVER be inside docRoot
        if ($docRoot !== '' && (strpos($dir, $docRoot) === 0 || $dir === $docRoot)) {
            continue;
        }
        // Candidate must NEVER be inside appRoot
        if (strpos($dir, $appRoot) === 0 || $dir === $appRoot) {
            continue;
        }

        if (!is_dir($dir)) {
            @mkdir($dir, 0750, true);
        }
        if (is_dir($dir) && is_writable($dir)) {
            return $dir . '/inquiries.jsonl';
        }
    }

    return null;
}

/**
 * Helper to construct asset URLs with cache busting
 */
function asset_url(string $path): string {
    $cleanPath = ltrim($path, '/');
    $fullPath = __DIR__ . '/../' . $cleanPath;
    $version = file_exists($fullPath) ? (string)filemtime($fullPath) : '2.0';
    return site_url($cleanPath) . '?v=' . $version;
}

/**
 * Helper for images specifically inside assets/images/
 */
function image_url(string $filename): string {
    return asset_url('assets/images/' . ltrim($filename, '/'));
}

/**
 * Escape output for HTML context
 */
function e(?string $value): string {
    return htmlspecialchars((string)$value, ENT_QUOTES | ENT_HTML5, 'UTF-8');
}

/**
 * Generate or retrieve CSRF token
 */
function get_csrf_token(): string {
    if (empty($_SESSION['csrf_token'])) {
        $_SESSION['csrf_token'] = bin2hex(random_bytes(32));
    }
    return $_SESSION['csrf_token'];
}

/**
 * Verify CSRF token
 */
function verify_csrf_token(?string $token): bool {
    if (empty($_SESSION['csrf_token']) || empty($token)) {
        return false;
    }
    return hash_equals($_SESSION['csrf_token'], $token);
}

/**
 * Active navigation item helper
 */
function is_active(string $currentSlug, string $targetSlug): string {
    return ($currentSlug === $targetSlug) ? 'aria-current="page" class="nav-link is-active"' : 'class="nav-link"';
}

/**
 * Real, verified portfolio projects built from available assets inside assets/images/
 */
function get_portfolio_projects(): array {
    return [
        'skb-construction' => [
            'id' => 'skb-construction',
            'title' => 'SKB Construction & Real Estate',
            'subtitle' => 'Commercial Property & Civil Infrastructure Platform',
            'service' => 'Web Engineering & Development',
            'category' => 'Web Application',
            'category_slug' => 'web-app',
            'client' => 'SKB Construction & Real Estate Ltd',
            'year' => '2026',
            'deliverables' => [
                'Responsive Web Architecture',
                'Property Portfolio Showcase',
                'Inquiry Routing Pipeline',
                'Performance Optimization'
            ],
            'tags' => ['Full-Stack Development', 'UI/UX Architecture', 'Property Showcase', 'Performance'],
            'image' => 'assets/images/skb-construction-real-estate.webp',
            'image_fallback' => 'assets/images/skb-construction-real-estate.webp',
            'summary' => 'A high-credibility digital platform engineered for a premier civil engineering and real estate enterprise, presenting multi-acre commercial developments, project timelines, and high-value investor inquiry funnels.',
            'challenge' => 'SKB Construction needed a digital footprint that reflected the scale and engineering precision of their civil infrastructure and commercial real estate projects, replacing an unstructured web presence with an authoritative, responsive, and performance-tuned platform.',
            'solution' => 'Architected a modular web platform prioritizing visual clarity, structural hierarchy, and rapid asset delivery. Created dedicated project showcase schemas, structural service categorization, and streamlined direct inquiry channels for institutional and private investors.',
            'stack' => ['Core PHP 8.2', 'Vanilla Modern CSS', 'Modular JavaScript', 'Semantic HTML5', 'Image Optimization Pipeline'],
            'highlights' => [
                'Sub-1.2s first contentful paint across mobile and desktop viewports',
                'Optimized architectural project galleries with zero cumulative layout shift',
                'Direct multi-channel inquiry routing for property buyers'
            ]
        ],
        'jwils-digital' => [
            'id' => 'jwils-digital',
            'title' => 'Jwils Digital Ecosystem',
            'subtitle' => 'Institutional Learning & Corporate Operations Portal',
            'service' => 'Web Engineering & Development',
            'category' => 'Digital Product',
            'category_slug' => 'product',
            'client' => 'Jwils Educational & Corporate Systems',
            'year' => '2026',
            'deliverables' => [
                'Systems Architecture',
                'Portal User Experience',
                'Resource Management',
                'Modular Web Layout'
            ],
            'tags' => ['Systems Architecture', 'Web Portal', 'Interface Design', 'Enterprise'],
            'image' => 'assets/images/jwils-digital-ecosystem.webp',
            'image_fallback' => 'assets/images/jwils-digital-ecosystem.webp',
            'summary' => 'A unified web infrastructure connecting institutional learning resources, corporate administration, and digital service delivery into a coherent user-centric ecosystem.',
            'challenge' => 'Educational institutions and corporate service groups frequently suffer from fractured digital tools—fragmented portals, disconnected learning resources, and clumsy student/client interfaces that hamper adoption.',
            'solution' => 'Engineered a clean, cohesive digital portal structure with an intuitive information architecture. Designed modular dashboard layouts, rapid resource discovery, and responsive interaction patterns tailored for varied user roles.',
            'stack' => ['PHP Systems Layer', 'Custom CSS Architecture', 'Responsive Layout Grids', 'Access Gateways'],
            'highlights' => [
                'Structured role-based navigation and intuitive resource categorisation',
                'WCAG 2.1 AA compliant contrast and typographic legibility',
                'Zero external runtime dependencies for maximum operational resilience'
            ]
        ],
        'khing-spotless' => [
            'id' => 'khing-spotless',
            'title' => 'Spotless Digital Agency',
            'subtitle' => 'Creative Agency Brand Identity & Digital Flagship',
            'service' => 'Brand Identity & Digital Experience Design',
            'category' => 'Brand System',
            'category_slug' => 'brand-system',
            'client' => 'Spotless Digital / Khing Spotless',
            'year' => '2026',
            'deliverables' => [
                'Brand Identity System',
                'Visual Art Direction',
                'Agency Flagship Website',
                'Content Architecture'
            ],
            'tags' => ['Brand Identity', 'Creative Direction', 'Typography', 'Frontend Engineering'],
            'image' => 'assets/images/khing-spotless.webp',
            'image_fallback' => 'assets/images/khing-spotless.webp',
            'summary' => 'Complete brand identity architecture and digital flagship engineered for a forward-thinking creative agency, balancing typographic rigor with engaging visual rhythm.',
            'challenge' => 'Spotless needed to cut through a crowded market of generic agency templates with a distinctive, high-craft brand identity and an authentic digital experience that demonstrated both creative courage and engineering execution.',
            'solution' => 'Crafted a bespoke visual identity system featuring custom vector marks, disciplined typographic scales, and an editorial web architecture that highlights agency case studies, creative strategy, and client workflows.',
            'stack' => ['Design Systems', 'Vector Identity Design', 'Modern Semantic HTML5', 'Custom CSS Transitions'],
            'highlights' => [
                'Harmonic typographic hierarchy with fluid clamp scales',
                'Tailored vector brand assets engineered for scalable multi-medium deployment',
                'Distinctive editorial layout breaking away from standard agency templates'
            ]
        ],
        'new-land-travel' => [
            'id' => 'new-land-travel',
            'title' => 'New Land Travel Consult',
            'subtitle' => 'International Travel Advisory & Visa Services Platform',
            'service' => 'Web Engineering & Development',
            'category' => 'Web Application',
            'category_slug' => 'web-app',
            'client' => 'New Land Travel Consult Ltd',
            'year' => '2026',
            'deliverables' => [
                'Client Onboarding Funnel',
                'Consultation Booking Engine',
                'Service Directory',
                'Mobile-First Layout'
            ],
            'tags' => ['Web Development', 'Booking Funnel', 'Mobile UX', 'Conversion Architecture'],
            'image' => 'assets/images/new-land-travel-consult.webp',
            'image_fallback' => 'assets/images/new-land-travel-consult.webp',
            'summary' => 'A streamlined, client-friendly consultation platform engineered for an international travel and visa consultancy, structuring complex visa categories into frictionless inquiry funnels.',
            'challenge' => 'International travel and immigration requirements are notoriously intricate. The client needed a platform that simplified multi-country visa programs, reduced client hesitation, and converted prospective travelers into booked consultations.',
            'solution' => 'Designed an intuitive service categorization framework with dynamic country/service filters, clear documentation roadmaps, and an integrated consultation scheduling funnel optimized for mobile users.',
            'stack' => ['PHP Application Layer', 'Vanilla JavaScript Validation', 'Responsive CSS', 'SEO Optimization'],
            'highlights' => [
                'Simplified multi-step consultation pathway with instant client validation',
                'Rapid mobile loading over cellular connections across Ghana and West Africa',
                'Integrated WhatsApp direct messaging and structured form routing'
            ]
        ],
        'excellent-cleaning' => [
            'id' => 'excellent-cleaning',
            'title' => 'Excellent Cleaning Ltd',
            'subtitle' => 'Facility Services Booking & Operations Web Platform',
            'service' => 'IT Solutions & Technology Management',
            'category' => 'Business Platform',
            'category_slug' => 'business-platform',
            'client' => 'Excellent Cleaning Services Ltd',
            'year' => '2026',
            'deliverables' => [
                'Service Booking System',
                'Commercial & Residential Quoting',
                'Interactive Scope Selector',
                'Operations Integration'
            ],
            'tags' => ['Business Systems', 'Interactive Quoting', 'UI/UX Design', 'Full-Stack'],
            'image' => 'assets/images/excellent-cleaning-ltd.webp',
            'image_fallback' => 'assets/images/excellent-cleaning-ltd.webp',
            'summary' => 'A purpose-built digital operations and booking platform for commercial and residential cleaning services, featuring an interactive service estimator and scheduling engine.',
            'challenge' => 'Traditional service businesses struggle with telephone quoting bottlenecks, missed client calls, and ambiguous scope definitions that lead to billing friction.',
            'solution' => 'Engineered an interactive service scope configurator allowing residential and commercial clients to select frequency, square footage, specialized treatments, and receive instant transparent quote parameters before booking.',
            'stack' => ['Core PHP', 'Modern CSS Component Tokens', 'Interactive JavaScript Engine', 'Lead Logging Pipeline'],
            'highlights' => [
                'Dynamic interactive cost and scope estimation without page reload',
                'Reduced back-and-forth quoting time by structuring incoming requests upfront',
                'Touch-friendly mobile booking experience with instant visual feedback'
            ]
        ]
    ];
}

/**
 * Core Disciplines / Services Matrix (The 4 Official Disciplines)
 */
function get_core_disciplines(): array {
    return [
        [
            'id' => 'web-engineering-development',
            'code' => 'DISCIPLINE 01',
            'short_title' => 'Web Engineering',
            'title' => 'Web Engineering & Development',
            'tagline' => 'Websites and web applications built around specific business requirements.',
            'meta_description' => 'Custom web applications, e-commerce platforms, and corporate websites engineered for performance, security, and business growth by Engineer Baah in Ghana.',
            'description' => 'I design and develop websites and web applications that help businesses establish their online presence, serve customers and manage their operations. From corporate websites and e-commerce platforms to custom portals and business management systems, I build solutions around specific requirements.',
            'capabilities' => [
                'Business and corporate website development',
                'Custom web applications and business portals',
                'E-commerce websites and online stores',
                'Admin dashboards and content management systems'
            ],
            'detailed_capabilities' => [
                [
                    'title' => 'Business & Corporate Websites',
                    'desc' => 'High-credibility web platforms engineered to communicate your business value clearly, build client trust, and capture high-intent inquiries.'
                ],
                [
                    'title' => 'Custom Web Applications & Portals',
                    'desc' => 'Tailored software solutions designed around your exact business logic to streamline internal operations, client reporting, and staff productivity.'
                ],
                [
                    'title' => 'E-Commerce & Online Stores',
                    'desc' => 'Conversion-focused online shops with product catalogs, shopping carts, mobile money/card payments, and order fulfillment workflows.'
                ],
                [
                    'title' => 'Admin Dashboards & CMS',
                    'desc' => 'Intuitive administrative backends that allow you and your team to manage content, inventory, and user inquiries without touching code.'
                ],
                [
                    'title' => 'Database Design & API Integrations',
                    'desc' => 'Robust relational databases (MySQL) and third-party integrations (payment gateways, WhatsApp API, notifications) that connect your business systems.'
                ],
                [
                    'title' => 'Maintenance, Performance & Security',
                    'desc' => 'Fast loading times, SSL encryption, regular data backups, and technical optimization to keep your web infrastructure secure and dependable.'
                ]
            ],
            'tools' => ['PHP', 'JavaScript', 'React', 'MySQL', 'WordPress'],
            'good_fit' => 'A business that needs a site or system that does real work, not only a brochure.',
            'deliverables' => 'Full-stack applications, responsive corporate sites, database schemas, and content management systems.',
            'url' => site_url('services/web-engineering-development.php'),
            'path' => 'services/web-engineering-development.php',
            'image' => 'assets/images/service-web-development.webp',
            'image_fallback' => 'assets/images/service-web-development.webp',
            'matching_projects' => ['skb-construction', 'jwils-digital', 'new-land-travel']
        ],
        [
            'id' => 'brand-identity-digital-experience-design',
            'code' => 'DISCIPLINE 02',
            'short_title' => 'Brand Identity',
            'title' => 'Brand Identity & Digital Experience Design',
            'tagline' => 'Visual identities and digital designs that establish consistent, professional recognition.',
            'meta_description' => 'Memorable brand identities, logos, and UI/UX design systems crafted to establish professional credibility and visual recognition across digital and print media.',
            'description' => 'Your brand influences how people recognise and perceive your business. I create visual identities and digital designs that give businesses a consistent, professional appearance across their marketing materials, websites and digital platforms.',
            'capabilities' => [
                'Logo design and brand identity development',
                'Brand colours, typography and visual guidelines',
                'Business cards, letterheads and company profiles',
                'Flyers, brochures and promotional graphics'
            ],
            'detailed_capabilities' => [
                [
                    'title' => 'Logo & Core Visual Identity',
                    'desc' => 'Distinctive vector logotypes, marks, and icons crafted to establish an authoritative and memorable visual presence.'
                ],
                [
                    'title' => 'Brand Guidelines & Design Tokens',
                    'desc' => 'Comprehensive rules for color palettes, typography scales, spacing, and logo usage across print and digital media.'
                ],
                [
                    'title' => 'Corporate Stationery & Profiles',
                    'desc' => 'Executive business cards, letterheads, invoice templates, and branded company profile documents ready for corporate presentation.'
                ],
                [
                    'title' => 'Marketing & Promotional Collateral',
                    'desc' => 'Brochures, flyers, event banners, and digital marketing materials that maintain consistent brand presentation across every touchpoint.'
                ],
                [
                    'title' => 'UI/UX Design Systems',
                    'desc' => 'Modular Figma interface design systems with reusable components, responsive breakpoints, and documented accessibility standards.'
                ]
            ],
            'tools' => ['Figma', 'Canva Pro', 'Adobe Creative Suite', 'Vector Design'],
            'good_fit' => 'A business with a good service and a look that doesn’t yet match it.',
            'deliverables' => 'Scalable vector logos, comprehensive brand guidelines, corporate stationery, and digital design systems.',
            'url' => site_url('services/brand-identity-digital-experience-design.php'),
            'path' => 'services/brand-identity-digital-experience-design.php',
            'image' => 'assets/images/service-brand-identity.webp',
            'image_fallback' => 'assets/images/service-brand-identity.webp',
            'matching_projects' => ['khing-spotless', 'skb-construction']
        ],
        [
            'id' => 'digital-strategy-marketing',
            'code' => 'DISCIPLINE 03',
            'short_title' => 'Digital Strategy',
            'title' => 'Digital Strategy & Marketing',
            'tagline' => 'Reaching the right audience, communicating value, and turning interest into inquiries.',
            'meta_description' => 'Strategic digital marketing, Meta advertising campaigns, and audience growth strategies that turn online attention into qualified business conversations.',
            'description' => 'Having a digital presence is only the beginning. Businesses also need a clear way to communicate their value, reach the right audience and turn interest into enquiries. I help businesses plan and manage their digital marketing activities across relevant platforms.',
            'capabilities' => [
                'Digital presence and marketing strategy',
                'Social media account management',
                'Content planning and creation',
                'Facebook and Instagram advertising'
            ],
            'detailed_capabilities' => [
                [
                    'title' => 'Digital Presence & Growth Strategy',
                    'desc' => 'Structured action plans identifying target customer segments, positioning your business clearly, and choosing the most effective digital channels.'
                ],
                [
                    'title' => 'Social Media Account Management',
                    'desc' => 'Consistent brand curation and audience interaction across Facebook, Instagram, LinkedIn, TikTok, and YouTube.'
                ],
                [
                    'title' => 'Content Planning & Creative Production',
                    'desc' => 'Strategic editorial calendars, informative visual graphics, product highlights, and customer testimonials that engage and convert.'
                ],
                [
                    'title' => 'Meta Advertising Campaigns',
                    'desc' => 'Laser-targeted Facebook and Instagram ad funnels engineered for direct inquiries, consultation bookings, and measurable lead generation.'
                ],
                [
                    'title' => 'Lead Attribution & Performance Tracking',
                    'desc' => 'Google Analytics and WhatsApp Business integration to track incoming inquiries, understand customer intent, and refine marketing spend.'
                ]
            ],
            'tools' => ['Meta Ads Manager', 'Google Analytics', 'Google Search Console', 'WhatsApp Business', 'Social Media Platforms'],
            'good_fit' => 'An owner who is posting regularly but can’t see it turning into conversations.',
            'deliverables' => 'Targeted advertising campaigns, strategic content plans, social management, and growth analytics.',
            'url' => site_url('services/digital-strategy-marketing.php'),
            'path' => 'services/digital-strategy-marketing.php',
            'image' => 'assets/images/service-digital-marketing.webp',
            'image_fallback' => 'assets/images/service-digital-marketing.webp',
            'matching_projects' => ['new-land-travel', 'excellent-cleaning']
        ],
        [
            'id' => 'it-solutions-technology-management',
            'code' => 'DISCIPLINE 04',
            'short_title' => 'IT Solutions',
            'title' => 'IT Solutions & Technology Management',
            'tagline' => 'Reliable digital systems, hosting, and workflow improvements for everyday operations.',
            'meta_description' => 'Reliable IT infrastructure, secure cloud hosting, business email, and workflow automation systems to keep your business operations dependable and efficient.',
            'description' => 'Businesses depend on technology for communication, information management and everyday operations. I help set up, manage and maintain the digital systems that keep those activities running, while identifying practical ways to improve existing processes.',
            'capabilities' => [
                'IT management and technology support',
                'Domain, hosting and business email configuration',
                'Business software and productivity tools',
                'Workflow improvements and automation'
            ],
            'detailed_capabilities' => [
                [
                    'title' => 'Domain, Hosting & DNS Infrastructure',
                    'desc' => 'Rock-solid hosting configuration, DNS record management via Cloudflare, and automated SSL encryption for high uptime and security.'
                ],
                [
                    'title' => 'Professional Business Email Setup',
                    'desc' => 'Configuring professional custom email accounts on Google Workspace, Microsoft 365, or cPanel with SPF, DKIM, and DMARC delivery protection.'
                ],
                [
                    'title' => 'IT Management & Technology Support',
                    'desc' => 'Direct technical assistance, troubleshooting, software deployment, and expert technology advisory to keep your office operations smooth.'
                ],
                [
                    'title' => 'Workflow Improvements & Automation',
                    'desc' => 'Connecting software tools, eliminating repetitive manual entry, and automating notification alerts between your website, email, and WhatsApp.'
                ],
                [
                    'title' => 'Data Management & Digital Security',
                    'desc' => 'Cloud backup protocols, digital access permission auditing, and safe file management across your business organization.'
                ]
            ],
            'tools' => ['cPanel', 'DNS', 'Cloudflare', 'Microsoft 365', 'Google Workspace'],
            'good_fit' => 'An organisation whose tools have grown without anyone owning them.',
            'deliverables' => 'Configured server infrastructure, custom business email setups, automated workflows, and IT support.',
            'url' => site_url('services/it-solutions-technology-management.php'),
            'path' => 'services/it-solutions-technology-management.php',
            'image' => 'assets/images/service-it-management.webp',
            'image_fallback' => 'assets/images/service-it-management.webp',
            'matching_projects' => ['jwils-digital', 'excellent-cleaning']
        ]
    ];
}

/**
 * Retrieve a specific discipline by ID
 */
function get_discipline_by_id(string $id): ?array {
    foreach (get_core_disciplines() as $disc) {
        if ($disc['id'] === $id) {
            return $disc;
        }
    }
    return null;
}
