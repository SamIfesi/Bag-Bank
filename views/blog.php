<?php
require_once __DIR__ . "/../includes/check_auth.php";
 ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/index.css">
    <link rel="stylesheet" href="../public/assets/css/pages.css">
    <title>Blog - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <?= require_once __DIR__ . "/../includes/components/navbar.php"; ?>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="page-hero-content">
            <h1>D'Bag Bank Blog</h1>
            <p>Insights, tips, and news about digital banking and finance</p>
        </div>
    </section>

    <!-- Featured Post -->
    <section class="featured-post">
        <div class="section-container">
            <div class="featured-content">
                <span class="featured-badge">Featured</span>
                <h2>The Future of Digital Banking in Nigeria</h2>
                <div class="post-meta">
                    <span><i class="ti ti-user"></i> By Sarah Johnson</span>
                    <span><i class="ti ti-calendar"></i> January 15, 2025</span>
                    <span><i class="ti ti-clock"></i> 5 min read</span>
                </div>
                <p>
                    Explore how digital banking is transforming Nigeria's financial landscape and
                    what it means for millions of Nigerians seeking accessible banking solutions...
                </p>
                <a href="#" class="btn-primary">Read More <i class="ti ti-arrow-right"></i></a>
            </div>
        </div>
    </section>

    <!-- Blog Categories -->
    <section class="blog-section">
        <div class="section-container">
            <div class="blog-filters">
                <button class="filter-btn active" data-filter="all">All Posts</button>
                <button class="filter-btn" data-filter="fintech">Fintech</button>
                <button class="filter-btn" data-filter="security">Security</button>
                <button class="filter-btn" data-filter="tips">Tips & Guides</button>
                <button class="filter-btn" data-filter="company">Company News</button>
            </div>

            <!-- Blog Grid -->
            <div class="blog-grid">
                <article class="blog-card" data-category="tips">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-bulb"></i>
                        </div>
                        <span class="category-badge">Tips & Guides</span>
                    </div>
                    <div class="blog-content">
                        <h3>10 Tips to Secure Your Online Banking</h3>
                        <p>Learn essential security practices to protect your digital wallet and transactions.</p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Jan 12, 2025</span>
                            <span><i class="ti ti-clock"></i> 4 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-category="fintech">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-chart-line"></i>
                        </div>
                        <span class="category-badge">Fintech</span>
                    </div>
                    <div class="blog-content">
                        <h3>How Blockchain is Changing Banking</h3>
                        <p>Discover the revolutionary impact of blockchain technology on modern banking systems.</p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Jan 10, 2025</span>
                            <span><i class="ti ti-clock"></i> 6 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-category="security">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-shield-lock"></i>
                        </div>
                        <span class="category-badge">Security</span>
                    </div>
                    <div class="blog-content">
                        <h3>Understanding Two-Factor Authentication</h3>
                        <p>Why 2FA is crucial for your account security and how to set it up properly.</p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Jan 8, 2025</span>
                            <span><i class="ti ti-clock"></i> 3 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-category="company">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-news"></i>
                        </div>
                        <span class="category-badge">Company News</span>
                    </div>
                    <div class="blog-content">
                        <h3>D'Bag Bank Reaches 10,000 Users Milestone</h3>
                        <p>Celebrating this incredible achievement with our amazing community. </p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Jan 5, 2025</span>
                            <span><i class="ti ti-clock"></i> 2 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-category="tips">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-coin"></i>
                        </div>
                        <span class="category-badge">Tips & Guides</span>
                    </div>
                    <div class="blog-content">
                        <h3>Smart Money Management for Beginners</h3>
                        <p>Essential budgeting tips to help you take control of your finances.</p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Jan 3, 2025</span>
                            <span><i class="ti ti-clock"></i> 5 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>

                <article class="blog-card" data-category="fintech">
                    <div class="blog-image">
                        <div class="blog-placeholder">
                            <i class="ti ti-device-mobile"></i>
                        </div>
                        <span class="category-badge">Fintech</span>
                    </div>
                    <div class="blog-content">
                        <h3>The Rise of Mobile Banking in Africa</h3>
                        <p>How smartphones are driving financial inclusion across the continent.</p>
                        <div class="post-meta">
                            <span><i class="ti ti-calendar"></i> Dec 30, 2024</span>
                            <span><i class="ti ti-clock"></i> 7 min read</span>
                        </div>
                        <a href="#" class="read-link">Read Article <i class="ti ti-arrow-right"></i></a>
                    </div>
                </article>
            </div>

            <!-- Pagination -->
            <div class="pagination">
                <button class="page-btn" disabled><i class="ti ti-chevron-left"></i></button>
                <button class="page-btn active">1</button>
                <button class="page-btn">2</button>
                <button class="page-btn">3</button>
                <button class="page-btn"><i class="ti ti-chevron-right"></i></button>
            </div>
        </div>
    </section>

    <!-- Newsletter Signup -->
    <section class="newsletter-section">
        <div class="section-container">
            <div class="newsletter-content">
                <div class="newsletter-icon">
                    <i class="ti ti-mail"></i>
                </div>
                <h2>Subscribe to Our Newsletter</h2>
                <p>Get the latest news, tips, and insights delivered to your inbox</p>
                <form class="newsletter-form">
                    <input type="email" placeholder="Enter your email" id="email" required />
                    <button type="submit">Subscribe</button>
                </form>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ . "/../includes/components/footer.php"; ?>

    <script src="../public/assets/js/pages.js"></script>
</body>

</html>