<?php require_once __DIR__ . "/../includes/check_auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/index.css">
    <link rel="stylesheet" href="../public/assets/css/pages.css">
    <title>About Us - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <?= require_once __DIR__ . "/../includes/components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="page-hero-content">
            <h1>About D'Bag Bank</h1>
            <p>We're on a mission to make banking accessible, simple, and secure for everyone</p>
        </div>
    </section>

    <!-- Story Section -->
    <section class="story-section">
        <div class="section-container">
            <div class="story-content">
                <div class="story-text">
                    <span class="section-badge">Our Story</span>
                    <h2 class="section-title">Building the Future of Banking</h2>
                    <p class="section-description">
                        Founded in 2024, D'Bag Bank was born from a simple idea: banking should be easy,
                        transparent, and accessible to everyone. We saw how traditional banking was failing
                        to meet the needs of modern users, and we knew we could do better.
                    </p>
                    <p class="section-description">
                        Today, we serve thousands of customers across Nigeria, providing them with fast,
                        secure, and reliable banking services. Our team of passionate innovators works
                        tirelessly to ensure that every transaction is smooth and every customer is satisfied.
                    </p>
                    <div class="story-stats">
                        <div class="stat">
                            <h3>10,000+</h3>
                            <p>Active Users</p>
                        </div>
                        <div class="stat">
                            <h3>₦5B+</h3>
                            <p>Processed</p>
                        </div>
                        <div class="stat">
                            <h3>99. 9%</h3>
                            <p>Uptime</p>
                        </div>
                        <div class="stat">
                            <h3>24/7</h3>
                            <p>Support</p>
                        </div>
                    </div>
                </div>
                <div class="story-image">
                    <div class="image-placeholder">
                        <i class="ti ti-building-bank"></i>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Mission & Vision -->
    <section class="mission-vision">
        <div class="section-container">
            <div class="mv-grid">
                <div class="mv-card">
                    <div class="mv-icon">
                        <i class="ti ti-target"></i>
                    </div>
                    <h3>Our Mission</h3>
                    <p>
                        To revolutionize banking in Nigeria by providing innovative, secure, and
                        user-friendly financial services that empower individuals and businesses
                        to achieve their financial goals.
                    </p>
                </div>
                <div class="mv-card">
                    <div class="mv-icon">
                        <i class="ti ti-telescope"></i>
                    </div>
                    <h3>Our Vision</h3>
                    <p>
                        To become Nigeria's most trusted digital bank, known for exceptional
                        customer service, cutting-edge technology, and unwavering commitment
                        to financial inclusion.
                    </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Values Section -->
    <section class="values-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Our Values</span>
                <h2>What We Stand For</h2>
            </div>
            <div class="values-grid">
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-shield-check"></i>
                    </div>
                    <h3>Security First</h3>
                    <p>Your security is our top priority. We use industry-leading encryption and security measures. </p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-users"></i>
                    </div>
                    <h3>Customer-Centric</h3>
                    <p>Everything we do is designed with our customers in mind. Your satisfaction drives us.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-bulb"></i>
                    </div>
                    <h3>Innovation</h3>
                    <p>We constantly push boundaries to bring you the latest in financial technology.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-heart-handshake"></i>
                    </div>
                    <h3>Transparency</h3>
                    <p>We believe in open, honest communication with no hidden fees or surprises.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-accessible"></i>
                    </div>
                    <h3>Accessibility</h3>
                    <p>Banking should be available to everyone, everywhere, at any time.</p>
                </div>
                <div class="value-card">
                    <div class="value-icon">
                        <i class="ti ti-leaf"></i>
                    </div>
                    <h3>Sustainability</h3>
                    <p>We're committed to building a sustainable future for our community and planet.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- Team Section -->
    <section class="team-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Our Team</span>
                <h2>Meet the People Behind D'Bag Bank</h2>
                <p>A diverse team of passionate individuals committed to your financial success</p>
            </div>
            <div class="team-grid">
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <h3>John Doe</h3>
                    <p class="team-role">Chief Executive Officer</p>
                    <p class="team-bio">Passionate about financial inclusion and technology innovation. </p>
                    <div class="team-social">
                        <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                        <a href="#"><i class="ti ti-brand-twitter"></i></a>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <h3>Jane Smith</h3>
                    <p class="team-role">Chief Technology Officer</p>
                    <p class="team-bio">15+ years building secure, scalable financial platforms.</p>
                    <div class="team-social">
                        <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                        <a href="#"><i class="ti ti-brand-twitter"></i></a>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <h3>Michael Chen</h3>
                    <p class="team-role">Head of Product</p>
                    <p class="team-bio">Creating delightful user experiences that customers love.</p>
                    <div class="team-social">
                        <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                        <a href="#"><i class="ti ti-brand-twitter"></i></a>
                    </div>
                </div>
                <div class="team-card">
                    <div class="team-avatar">
                        <i class="ti ti-user"></i>
                    </div>
                    <h3>Sarah Johnson</h3>
                    <p class="team-role">Head of Customer Success</p>
                    <p class="team-bio">Ensuring every customer has an exceptional experience.</p>
                    <div class="team-social">
                        <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                        <a href="#"><i class="ti ti-brand-twitter"></i></a>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Join Thousands of Satisfied Customers? </h2>
            <p>Experience the future of banking today</p>
            <div class="cta-actions">
                <a href="register.php" class="btn-primary">
                    Get Started Free
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ .  "/../includes/components/footer.php"; ?>

    <script src="../public/assets/js/pages.js"></script>
</body>

</html>