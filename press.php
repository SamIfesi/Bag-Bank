<?php require_once __DIR__ . "/includes/check_auth.php"; ?>
<! DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
        <link rel="stylesheet" href="public/assets/css/index.css">
        <link rel="stylesheet" href="public/assets/css/pages.css">
        <title>Press - D'Bag Bank</title>
    </head>

    <body class="page-body">
        <!-- Navigation -->
        <?= require_once __DIR__ . "/includes/components/navbar.php"; ?>

        <!-- Hero Section -->
        <section class="page-hero">
            <div class="page-hero-content">
                <h1>Press & Media</h1>
                <p>Latest news, press releases, and media resources</p>
            </div>
        </section>

        <!-- Press Kit -->
        <section class="press-kit">
            <div class="section-container">
                <div class="press-kit-content">
                    <div class="press-kit-info">
                        <h2>Press Kit</h2>
                        <p>
                            Download our complete press kit including logos, brand guidelines,
                            company information, and high-resolution images.
                        </p>
                        <a href="#" class="btn-primary">
                            <i class="ti ti-download"></i>
                            Download Press Kit
                        </a>
                    </div>
                    <div class="press-kit-items">
                        <div class="kit-item">
                            <i class="ti ti-file-text"></i>
                            <span>Company Info</span>
                        </div>
                        <div class="kit-item">
                            <i class="ti ti-palette"></i>
                            <span>Brand Assets</span>
                        </div>
                        <div class="kit-item">
                            <i class="ti ti-photo"></i>
                            <span>Images & Logos</span>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Latest News -->
        <section class="press-releases">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-badge">Latest News</span>
                    <h2>Press Releases</h2>
                </div>

                <div class="press-list">
                    <article class="press-item">
                        <div class="press-date">
                            <span class="date-day">15</span>
                            <span class="date-month">JAN</span>
                        </div>
                        <div class="press-content">
                            <h3>D'Bag Bank Announces Major Platform Upgrade</h3>
                            <p>
                                New features include enhanced security, faster transactions, and improved user interface
                                designed to provide the best digital banking experience in Nigeria.
                            </p>
                            <div class="press-meta">
                                <span class="press-category">Product Launch</span>
                                <a href="#" class="press-link">Read Full Release <i class="ti ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="press-item">
                        <div class="press-date">
                            <span class="date-day">10</span>
                            <span class="date-month">JAN</span>
                        </div>
                        <div class="press-content">
                            <h3>D'Bag Bank Surpasses 10,000 Active Users</h3>
                            <p>
                                Milestone achieved just 6 months after launch, demonstrating strong market demand
                                for innovative digital banking solutions in Nigeria.
                            </p>
                            <div class="press-meta">
                                <span class="press-category">Company News</span>
                                <a href="#" class="press-link">Read Full Release <i class="ti ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="press-item">
                        <div class="press-date">
                            <span class="date-day">05</span>
                            <span class="date-month">JAN</span>
                        </div>
                        <div class="press-content">
                            <h3>Partnership with Leading Security Provider</h3>
                            <p>
                                Strategic partnership announced to enhance platform security and provide
                                industry-leading fraud protection for all users.
                            </p>
                            <div class="press-meta">
                                <span class="press-category">Partnership</span>
                                <a href="#" class="press-link">Read Full Release <i class="ti ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>

                    <article class="press-item">
                        <div class="press-date">
                            <span class="date-day">28</span>
                            <span class="date-month">DEC</span>
                        </div>
                        <div class="press-content">
                            <h3>D'Bag Bank Featured in TechCrunch Africa</h3>
                            <p>
                                Recognition as one of the most innovative fintech startups disrupting
                                traditional banking in Nigeria.
                            </p>
                            <div class="press-meta">
                                <span class="press-category">Media Coverage</span>
                                <a href="#" class="press-link">Read Full Release <i class="ti ti-arrow-right"></i></a>
                            </div>
                        </div>
                    </article>
                </div>
            </div>
        </section>

        <!-- Media Coverage -->
        <section class="media-coverage">
            <div class="section-container">
                <div class="section-header">
                    <span class="section-badge">In the News</span>
                    <h2>Media Coverage</h2>
                    <p>What people are saying about D'Bag Bank</p>
                </div>

                <div class="coverage-grid">
                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ti ti-news"></i>
                        </div>
                        <p class="coverage-quote">
                            "D'Bag Bank is revolutionizing digital banking in Nigeria with its user-friendly
                            platform and innovative features."
                        </p>
                        <p class="coverage-source">— TechCrunch Africa</p>
                    </div>

                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ti ti-news"></i>
                        </div>
                        <p class="coverage-quote">
                            "A game-changer for financial inclusion, making banking accessible to millions
                            of previously underserved Nigerians."
                        </p>
                        <p class="coverage-source">— Disrupt Africa</p>
                    </div>

                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ti ti-news"></i>
                        </div>
                        <p class="coverage-quote">
                            "Setting new standards for security and user experience in the Nigerian
                            fintech landscape."
                        </p>
                        <p class="coverage-source">— Ventureburn</p>
                    </div>

                    <div class="coverage-card">
                        <div class="coverage-logo">
                            <i class="ti ti-news"></i>
                        </div>
                        <p class="coverage-quote">
                            "D'Bag Bank's rapid growth demonstrates the massive potential of digital
                            banking in Africa."
                        </p>
                        <p class="coverage-source">— Financial Times</p>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Press -->
        <section class="press-contact">
            <div class="section-container">
                <div class="press-contact-content">
                    <h2>Media Inquiries</h2>
                    <p>For press inquiries, interviews, or additional information, please contact our media team</p>
                    <div class="contact-info">
                        <div class="contact-item">
                            <div>
                                <i class="ti ti-mail"></i>
                                <p class="contact-label">EMAIL</p>
                            </div>
                            <a href="mailto:press@dbagbank.com">press@dbagbank.com</a>
                        </div>
                        <div class="contact-item">
                            <div>
                                <i class="ti ti-phone"></i>
                                <p class="contact-label">PHONE</p>
                            </div>
                            <a href="tel:+2341234567890">+234 123 456 7890</a>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <!-- Footer -->
        <?php require_once __DIR__ . "/includes/components/footer.php"; ?>

        <script src="public/assets/js/pages.js"></script>
    </body>

    </html>