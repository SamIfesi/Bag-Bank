<?= require_once __DIR__ . "/includes/check_auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/index.css">
    <link rel="stylesheet" href="public/assets/css/support-pages.css">
    <title>Pricing - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php">
                    <img src="public/logo.svg" alt="D'Bag Bank" />
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php#features">Features</a></li>
                <li><a href="pricing.php" class="active">Pricing</a></li>
                <li><a href="help-center.php">Help</a></li>
                <li><a href="contact. php">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="login.php" class="btn-login">Login</a>
                <a href="register.php" class="btn-signup">Sign Up</a>
            </div>
            <button class="mobile-menu-toggle" id="mobileMenuToggle">
                <i class="ti ti-menu-2"></i>
            </button>
        </div>
    </nav>

    <!-- Mobile Menu -->
    <div class="mobile-menu" id="mobileMenu">
        <button class="mobile-menu-close" id="mobileMenuClose">
            <i class="ti ti-x"></i>
        </button>
        <ul class="mobile-nav-links">
            <li><a href="index. php#features">Features</a></li>
            <li><a href="pricing.php">Pricing</a></li>
            <li><a href="help-center.php">Help</a></li>
            <li><a href="contact.php">Contact</a></li>
            <li><a href="login.php" class="mobile-login">Login</a></li>
            <li><a href="register.php" class="mobile-signup">Sign Up</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="page-hero">
        <div class="page-hero-content">
            <h1>Simple, Transparent Pricing</h1>
            <p>No hidden fees. No surprises. Just honest pricing</p>
        </div>
    </section>

    <!-- Pricing Cards -->
    <section class="pricing-section">
        <div class="section-container">
            <div class="pricing-grid">
                <!-- Free Plan -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Personal</h3>
                        <div class="price">
                            <span class="currency">₦</span>
                            <span class="amount">0</span>
                            <span class="period">/month</span>
                        </div>
                        <p class="plan-description">Perfect for individuals and personal use</p>
                    </div>

                    <ul class="features-list">
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Free account creation</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Unlimited internal transfers</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>₦5M daily transfer limit</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>24/7 customer support</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Mobile & web access</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Transaction history</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Real-time notifications</span>
                        </li>
                    </ul>

                    <a href="register.php" class="pricing-btn">Get Started Free</a>
                </div>

                <!-- Business Plan -->
                <div class="pricing-card featured">
                    <div class="popular-badge">Most Popular</div>
                    <div class="pricing-header">
                        <h3>Business</h3>
                        <div class="price">
                            <span class="currency">₦</span>
                            <span class="amount">5,000</span>
                            <span class="period">/month</span>
                        </div>
                        <p class="plan-description">For growing businesses and teams</p>
                    </div>

                    <ul class="features-list">
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Everything in Personal, plus: </span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>₦50M daily transfer limit</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Multi-user access</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Advanced analytics</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Priority support</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Custom reports</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>API access</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Bulk transfers</span>
                        </li>
                    </ul>

                    <a href="register.php" class="pricing-btn primary">Start Free Trial</a>
                </div>

                <!-- Enterprise Plan -->
                <div class="pricing-card">
                    <div class="pricing-header">
                        <h3>Enterprise</h3>
                        <div class="price">
                            <span class="amount-text">Custom</span>
                        </div>
                        <p class="plan-description">For large organizations with specific needs</p>
                    </div>

                    <ul class="features-list">
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Everything in Business, plus:</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Unlimited transfers</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Dedicated account manager</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Custom integrations</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>SLA guarantee</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>White-label options</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Advanced security features</span>
                        </li>
                        <li>
                            <i class="ti ti-check"></i>
                            <span>Custom workflows</span>
                        </li>
                    </ul>

                    <a href="contact.php" class="pricing-btn">Contact Sales</a>
                </div>
            </div>
        </div>
    </section>

    <!-- Transaction Fees -->
    <section class="fees-section">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Transparent Fees</span>
                <h2>Transaction Fees</h2>
                <p>Clear, straightforward pricing with no hidden charges</p>
            </div>

            <div class="fees-table">
                <div class="fee-row header">
                    <div class="fee-type">Transaction Type</div>
                    <div class="fee-amount">Fee</div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>Internal Transfers</h4>
                        <p>Between D'Bag Bank users</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>External Transfers</h4>
                        <p>To other Nigerian banks (under ₦5,000)</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>External Transfers</h4>
                        <p>To other Nigerian banks (₦5,000 - ₦50,000)</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>External Transfers</h4>
                        <p>To other Nigerian banks (above ₦50,000)</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>Account Maintenance</h4>
                        <p>Monthly account fee</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>Card Replacement</h4>
                        <p>Lost or damaged debit card</p>
                    </div>
                    <div class="fee-amount">₦500</div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>ATM Withdrawals</h4>
                        <p>From D'Bag Bank ATMs</p>
                    </div>
                    <div class="fee-amount">
                        <span class="free-badge">FREE</span>
                    </div>
                </div>

                <div class="fee-row">
                    <div class="fee-type">
                        <h4>ATM Withdrawals</h4>
                        <p>From other banks' ATMs</p>
                    </div>
                    <div class="fee-amount">₦35</div>
                </div>
            </div>
        </div>
    </section>

    <!-- Comparison Table -->
    <section class="comparison-section">
        <div class="section-container">
            <div class="section-header">
                <h2>Compare Plans</h2>
                <p>Find the perfect plan for your needs</p>
            </div>

            <div class="comparison-table-wrapper">
                <table class="comparison-table">
                    <thead>
                        <tr>
                            <th class="feature-col">Features</th>
                            <th>Personal</th>
                            <th class="highlight">Business</th>
                            <th>Enterprise</th>
                        </tr>
                    </thead>
                    <tbody>
                        <tr>
                            <td class="feature-col">Monthly Fee</td>
                            <td>Free</td>
                            <td class="highlight">₦5,000</td>
                            <td>Custom</td>
                        </tr>
                        <tr>
                            <td class="feature-col">Daily Transfer Limit</td>
                            <td>₦5M</td>
                            <td class="highlight">₦50M</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td class="feature-col">Number of Users</td>
                            <td>1</td>
                            <td class="highlight">Up to 10</td>
                            <td>Unlimited</td>
                        </tr>
                        <tr>
                            <td class="feature-col">API Access</td>
                            <td><i class="ti ti-x"></i></td>
                            <td class="highlight"><i class="ti ti-check"></i></td>
                            <td><i class="ti ti-check"></i></td>
                        </tr>
                        <tr>
                            <td class="feature-col">Priority Support</td>
                            <td><i class="ti ti-x"></i></td>
                            <td class="highlight"><i class="ti ti-check"></i></td>
                            <td><i class="ti ti-check"></i></td>
                        </tr>
                        <tr>
                            <td class="feature-col">Dedicated Manager</td>
                            <td><i class="ti ti-x"></i></td>
                            <td class="highlight"><i class="ti ti-x"></i></td>
                            <td><i class="ti ti-check"></i></td>
                        </tr>
                        <tr>
                            <td class="feature-col">Custom Integrations</td>
                            <td><i class="ti ti-x"></i></td>
                            <td class="highlight"><i class="ti ti-x"></i></td>
                            <td><i class="ti ti-check"></i></td>
                        </tr>
                    </tbody>
                </table>
            </div>
        </div>
    </section>

    <!-- FAQ -->
    <section class="pricing-faq">
        <div class="section-container">
            <div class="section-header">
                <h2>Pricing FAQs</h2>
            </div>

            <div class="faq-list">
                <div class="faq-item">
                    <button class="faq-question">
                        <span>Can I change my plan later?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes! You can upgrade or downgrade your plan at any time. Changes take effect immediately, and we'll pro-rate any charges.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Is there a free trial for Business plan?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>Yes! We offer a 30-day free trial for the Business plan. No credit card required to start your trial.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>Are there any setup fees?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>No setup fees! All plans are ready to use immediately after account creation with no hidden charges.</p>
                    </div>
                </div>

                <div class="faq-item">
                    <button class="faq-question">
                        <span>What payment methods do you accept?</span>
                        <i class="ti ti-chevron-down"></i>
                    </button>
                    <div class="faq-answer">
                        <p>We accept bank transfers, debit cards, and direct debit from your D'Bag Bank account.</p>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Get Started?</h2>
            <p>Join thousands of satisfied customers today</p>
            <div class="cta-actions">
                <a href="register.php" class="btn-primary large">
                    Create Free Account
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <?= require_once __DIR__ .  "/includes/components/footer.php"; ?>

    <script src="public/assets/js/pages. js"></script>
</body>

</html>