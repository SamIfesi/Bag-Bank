<?php
require_once __DIR__ . "/includes/check_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/index.css">
    <link rel="stylesheet" href="public/assets/css/pages.css">
    <title>Careers - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <?= require_once __DIR__ . "/includes/components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="page-hero-content">
            <h1>Join Our Team</h1>
            <p>Build the future of banking with us</p>
        </div>
    </section>

    <!-- Why Work Here -->
    <section class="why-work">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Why D'Bag Bank</span>
                <h2>Why Work With Us?</h2>
            </div>
            <div class="benefits-grid">
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-rocket"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>Work on cutting-edge technology that's reshaping Nigeria's financial landscape.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-chart-line"></i>
                    </div>
                    <h3>Growth</h3>
                    <p>Continuous learning opportunities and clear career progression paths.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-users-group"></i>
                    </div>
                    <h3>Culture</h3>
                    <p>Collaborative, inclusive environment where everyone's voice matters.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-briefcase"></i>
                    </div>
                    <h3>Flexibility</h3>
                    <p>Remote work options and flexible hours to maintain work-life balance.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-heart-plus"></i>
                    </div>
                    <h3>Health & Wellness</h3>
                    <p>Comprehensive health insurance and wellness programs for you and your family.</p>
                </div>
                <div class="benefit-card">
                    <div class="benefit-icon">
                        <i class="ti ti-piggy-bank"></i>
                    </div>
                    <h3>Compensation</h3>
                    <p>Competitive salary, equity options, and performance bonuses.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Open Positions -->
    <section class="jobs-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Open Positions</span>
                <h2>Current Openings</h2>
                <p>Find your next opportunity</p>
            </div>

            <!-- Job Filters -->
            <div class="job-filters">
                <button class="filter-btn active" data-filter="all">All</button>
                <button class="filter-btn" data-filter="engineering">Engineering</button>
                <button class="filter-btn" data-filter="product">Product</button>
                <button class="filter-btn" data-filter="design">Design</button>
                <button class="filter-btn" data-filter="operations">Operations</button>
            </div>

            <!-- Jobs List -->
            <div class="jobs-list">
                <div class="job-card" data-category="engineering">
                    <div class="job-header">
                        <div>
                            <h3>Senior Backend Engineer</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Lagos, Nigeria</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> Remote</span>
                            </div>
                        </div>
                        <span class="job-badge">Engineering</span>
                    </div>
                    <p class="job-description">
                        Build scalable backend systems for our banking platform using PHP, MySQL, and modern web technologies.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>

                <div class="job-card" data-category="product">
                    <div class="job-header">
                        <div>
                            <h3>Product Manager</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Lagos, Nigeria</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> Hybrid</span>
                            </div>
                        </div>
                        <span class="job-badge">Product</span>
                    </div>
                    <p class="job-description">
                        Lead product strategy and execution for our mobile banking features.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>

                <div class="job-card" data-category="design">
                    <div class="job-header">
                        <div>
                            <h3>UI/UX Designer</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Lagos, Nigeria</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> Remote</span>
                            </div>
                        </div>
                        <span class="job-badge">Design</span>
                    </div>
                    <p class="job-description">
                        Create beautiful, intuitive interfaces that delight our users.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>

                <div class="job-card" data-category="engineering">
                    <div class="job-header">
                        <div>
                            <h3>Frontend Developer</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Abuja, Nigeria</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> On-site</span>
                            </div>
                        </div>
                        <span class="job-badge">Engineering</span>
                    </div>
                    <p class="job-description">
                        Build responsive, performant web applications using modern JavaScript frameworks.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>

                <div class="job-card" data-category="operations">
                    <div class="job-header">
                        <div>
                            <h3>Customer Success Manager</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Lagos, Nigeria</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> Hybrid</span>
                            </div>
                        </div>
                        <span class="job-badge">Operations</span>
                    </div>
                    <p class="job-description">
                        Ensure our customers have exceptional experiences and help them achieve their financial goals.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>

                <div class="job-card" data-category="operations">
                    <div class="job-header">
                        <div>
                            <h3>DevOps Engineer</h3>
                            <div class="job-meta">
                                <span><i class="ti ti-map-pin"></i> Remote</span>
                                <span><i class="ti ti-briefcase"></i> Full-time</span>
                                <span><i class="ti ti-clock"></i> Remote</span>
                            </div>
                        </div>
                        <span class="job-badge">Operations</span>
                    </div>
                    <p class="job-description">
                        Maintain and improve our infrastructure, ensuring 99.9% uptime.
                    </p>
                    <a href="#" class="job-apply-btn">Apply Now <i class="ti ti-arrow-right"></i></a>
                </div>
            </div>

            <div class="no-jobs-message" style="display: none;">
                <i class="ti ti-briefcase-off"></i>
                <p>No positions found in this category</p>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-container">
            <h2>Don't See Your Role? </h2>
            <p>We're always looking for talented people. Send us your resume! </p>
            <div class="cta-actions">
                <a href="mailto:careers@dbagbank.com" class="btn-primary large">
                    Contact Us
                    <i class="ti ti-mail"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . "/includes/components/footer.php"; ?>

    <script src="public/assets/js/pages.js"></script>
</body>

</html>