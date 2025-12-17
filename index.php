<?php
require_once __DIR__ .  "/includes/check_auth.php";
?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="src/index.css">
    <title>D'Bag Bank - Your Digital Banking Partner</title>
</head>

<body class="landing-body">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <img src="public/logo.svg" alt="D'Bag Bank" />
            </div>
            <ul class="nav-links">
                <li><a href="#features">Features</a></li>
                <li><a href="#how-it-works">How It Works</a></li>
                <li><a href="#security">Security</a></li>
                <li><a href="#contact">Contact</a></li>
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
            <li><a href="#features">Features</a></li>
            <li><a href="#how-it-works">How It Works</a></li>
            <li><a href="#security">Security</a></li>
            <li><a href="#contact">Contact</a></li>
            <li><a href="login. php" class="mobile-login">Login</a></li>
            <li><a href="register.php" class="mobile-signup">Sign Up</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="hero">
        <div class="hero-container">
            <div class="hero-content">
                <div class="hero-badge">
                    <i class="ti ti-sparkles"></i>
                    <span>Fast, Secure & Reliable</span>
                </div>
                <h1 class="hero-title">
                    Banking Made <span class="gradient-text">Simple</span> and <span class="gradient-text">Smart</span>
                </h1>
                <p class="hero-description">
                    Experience seamless digital banking with instant transfers, secure transactions,
                    and 24/7 access to your finances. Join thousands of users who trust D'Bag Bank.
                </p>
                <div class="hero-actions">
                    <a href="register.php" class="btn-primary">
                        Get Started Free
                        <i class="ti ti-arrow-right"></i>
                    </a>
                    <a href="#how-it-works" class="btn-secondary">
                        <i class="ti ti-player-play"></i>
                        Watch Demo
                    </a>
                </div>
                <div class="hero-stats">
                    <div class="stat-item">
                        <h3>10K+</h3>
                        <p>Active Users</p>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <h3>₦5B+</h3>
                        <p>Transactions</p>
                    </div>
                    <div class="stat-divider"></div>
                    <div class="stat-item">
                        <h3>99.9%</h3>
                        <p>Uptime</p>
                    </div>
                </div>
            </div>
            <div class="hero-image">
                <div class="floating-card card-1">
                    <i class="ti ti-trending-up"></i>
                    <div class="card-content">
                        <p class="card-label">Total Balance</p>
                        <h4 class="card-value">₦850,000.00</h4>
                    </div>
                </div>
                <div class="floating-card card-2">
                    <i class="ti ti-check-circle"></i>
                    <div class="card-content">
                        <p class="card-label">Transaction Success</p>
                        <h4 class="card-value success">+₦25,000</h4>
                    </div>
                </div>
                <div class="floating-card card-3">
                    <i class="ti ti-shield-check"></i>
                    <div class="card-content">
                        <p class="card-label">Security</p>
                        <h4 class="card-value">Protected</h4>
                    </div>
                </div>
                <div class="hero-main-image">
                    <div class="phone-mockup">
                        <img src="public/logo-icon.svg" alt="D'Bag Bank App" />
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- Features Section -->
    <section class="features" id="features">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">Features</span>
                <h2 class="section-title">Everything You Need for Modern Banking</h2>
                <p class="section-description">
                    Powerful features designed to make your banking experience effortless
                </p>
            </div>

            <div class="features-grid">
                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-bolt"></i>
                    </div>
                    <h3>Instant Transfers</h3>
                    <p>Send and receive money instantly to any bank account with zero delays. </p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-shield-lock"></i>
                    </div>
                    <h3>Bank-Level Security</h3>
                    <p>Your data is protected with 256-bit encryption and multi-factor authentication.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-clock-24"></i>
                    </div>
                    <h3>24/7 Access</h3>
                    <p>Access your account anytime, anywhere from any device.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-receipt"></i>
                    </div>
                    <h3>Transaction History</h3>
                    <p>Track all your transactions with detailed receipts and statements.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-bell"></i>
                    </div>
                    <h3>Real-time Notifications</h3>
                    <p>Get instant alerts for every transaction on your account.</p>
                </div>

                <div class="feature-card">
                    <div class="feature-icon">
                        <i class="ti ti-headset"></i>
                    </div>
                    <h3>Customer Support</h3>
                    <p>Our support team is always ready to help you with any issues.</p>
                </div>
            </div>
        </div>
    </section>

    <!-- How It Works Section -->
    <section class="how-it-works" id="how-it-works">
        <div class="section-container">
            <div class="section-header">
                <span class="section-badge">How It Works</span>
                <h2 class="section-title">Get Started in 3 Simple Steps</h2>
            </div>

            <div class="steps-container">
                <div class="step">
                    <div class="step-number">01</div>
                    <div class="step-icon">
                        <i class="ti ti-user-plus"></i>
                    </div>
                    <h3>Create Account</h3>
                    <p>Sign up in minutes with just your email and phone number. No paperwork required.</p>
                </div>

                <div class="step-connector"></div>

                <div class="step">
                    <div class="step-number">02</div>
                    <div class="step-icon">
                        <i class="ti ti-id"></i>
                    </div>
                    <h3>Verify Identity</h3>
                    <p>Complete a quick verification process to secure your account.</p>
                </div>

                <div class="step-connector"></div>

                <div class="step">
                    <div class="step-number">03</div>
                    <div class="step-icon">
                        <i class="ti ti-rocket"></i>
                    </div>
                    <h3>Start Banking</h3>
                    <p>Fund your account and start sending money, paying bills, and more! </p>
                </div>
            </div>
        </div>
    </section>

    <!-- Security Section -->
    <section class="security" id="security">
        <div class="section-container">
            <div class="security-content">
                <div class="security-text">
                    <span class="section-badge">Security First</span>
                    <h2 class="section-title">Your Money is Safe with Us</h2>
                    <p class="security-description">
                        We use industry-leading security measures to protect your account and transactions.
                    </p>

                    <div class="security-features">
                        <div class="security-item">
                            <i class="ti ti-lock"></i>
                            <div>
                                <h4>End-to-End Encryption</h4>
                                <p>All data is encrypted with 256-bit SSL technology</p>
                            </div>
                        </div>

                        <div class="security-item">
                            <i class="ti ti-fingerprint"></i>
                            <div>
                                <h4>Biometric Authentication</h4>
                                <p>Secure login with fingerprint or face recognition</p>
                            </div>
                        </div>

                        <div class="security-item">
                            <i class="ti ti-shield-check"></i>
                            <div>
                                <h4>Fraud Detection</h4>
                                <p>AI-powered monitoring for suspicious activities</p>
                            </div>
                        </div>

                        <div class="security-item">
                            <i class="ti ti-device-mobile"></i>
                            <div>
                                <h4>Two-Factor Authentication</h4>
                                <p>Extra layer of security with 2FA verification</p>
                            </div>
                        </div>
                    </div>
                </div>

                <div class="security-image">
                    <div class="security-badge badge-1">
                        <i class="ti ti-shield-check"></i>
                        <span>Secure</span>
                    </div>
                    <div class="security-badge badge-2">
                        <i class="ti ti-lock"></i>
                        <span>Encrypted</span>
                    </div>
                    <div class="security-badge badge-3">
                        <i class="ti ti-check"></i>
                        <span>Verified</span>
                    </div>
                </div>
            </div>
        </div>
    </section>

    <!-- CTA Section -->
    <section class="cta">
        <div class="cta-container">
            <h2>Ready to Start Your Digital Banking Journey?</h2>
            <p>Join thousands of satisfied customers and experience banking done right.</p>
            <div class="cta-actions">
                <a href="register.php" class="btn-primary large">
                    Create Free Account
                    <i class="ti ti-arrow-right"></i>
                </a>
            </div>
        </div>
    </section>

    <!-- Footer -->
    <footer class="footer" id="contact">
        <div class="footer-container">
            <div class="footer-section">
                <img src="public/logo-stacked.svg" alt="D'Bag Bank" class="footer-logo" />
                <p class="footer-about">
                    Making banking simple, secure, and accessible for everyone.
                </p>
                <div class="social-links">
                    <a href="#"><i class="ti ti-brand-twitter"></i></a>
                    <a href="#"><i class="ti ti-brand-facebook"></i></a>
                    <a href="#"><i class="ti ti-brand-instagram"></i></a>
                    <a href="#"><i class="ti ti-brand-linkedin"></i></a>
                </div>
            </div>

            <div class="footer-section">
                <h4>Product</h4>
                <ul>
                    <li><a href="#features">Features</a></li>
                    <li><a href="#security">Security</a></li>
                    <li><a href="#">Pricing</a></li>
                    <li><a href="#">API</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Company</h4>
                <ul>
                    <li><a href="#">About Us</a></li>
                    <li><a href="#">Careers</a></li>
                    <li><a href="#">Blog</a></li>
                    <li><a href="#">Press</a></li>
                </ul>
            </div>

            <div class="footer-section">
                <h4>Support</h4>
                <ul>
                    <li><a href="#">Help Center</a></li>
                    <li><a href="#">Contact Us</a></li>
                    <li><a href="#">Privacy Policy</a></li>
                    <li><a href="#">Terms of Service</a></li>
                </ul>
            </div>
        </div>

        <div class="footer-bottom">
            <p>&copy; 2025 D'Bag Bank. All rights reserved.</p>
        </div>
    </footer>

    <script src="src/index.js"></script>
</body>

</html>