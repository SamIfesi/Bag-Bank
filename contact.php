<?php require_once __DIR__ . "/includes/check_auth.php"; ?>
<! DOCTYPE html>
    <html lang="en">

    <head>
        <meta charset="UTF-8" />
        <meta name="viewport" content="width=device-width, initial-scale=1.0" />
        <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
        <link rel="stylesheet" href="public/assets/css/index.css">
        <link rel="stylesheet" href="public/assets/css/support-pages.css">
        <title>Contact Us - D'Bag Bank</title>
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
                    <li><a href="index. php#features">Features</a></li>
                    <li><a href="pricing.php">Pricing</a></li>
                    <li><a href="help-center.php">Help</a></li>
                    <li><a href="contact.php" class="active">Contact</a></li>
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
                <li><a href="index.php#features">Features</a></li>
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="help-center.php">Help</a></li>
                <li><a href="contact.php">Contact</a></li>
                <li><a href="login. php" class="mobile-login">Login</a></li>
                <li><a href="register. php" class="mobile-signup">Sign Up</a></li>
            </ul>
        </div>

        <!-- Hero Section -->
        <section class="page-hero">
            <div class="page-hero-content">
                <h1>Get in Touch</h1>
                <p>We're here to help. Reach out to us anytime</p>
            </div>
        </section>

        <!-- Contact Methods -->
        <section class="contact-methods">
            <div class="section-container">
                <div class="contact-grid">
                    <div class="contact-method-card">
                        <div class="method-icon">
                            <i class="ti ti-mail"></i>
                        </div>
                        <h3>Email Us</h3>
                        <p>Our team typically responds within 24 hours</p>
                        <a href="mailto:support@dbagbank.com" class="method-link">support@dbagbank.com</a>
                    </div>

                    <div class="contact-method-card">
                        <div class="method-icon">
                            <i class="ti ti-phone"></i>
                        </div>
                        <h3>Call Us</h3>
                        <p>Monday - Friday, 8AM - 6PM WAT</p>
                        <a href="tel:+2341234567890" class="method-link">+234 123 456 7890</a>
                    </div>

                    <div class="contact-method-card">
                        <div class="method-icon">
                            <i class="ti ti-message-circle"></i>
                        </div>
                        <h3>Live Chat</h3>
                        <p>Chat with our support team in real-time</p>
                        <button class="method-link chat-btn">Start Chat</button>
                    </div>

                    <div class="contact-method-card">
                        <div class="method-icon">
                            <i class="ti ti-map-pin"></i>
                        </div>
                        <h3>Visit Us</h3>
                        <p>123 Banking Street, Victoria Island, Lagos</p>
                        <a href="#" class="method-link">Get Directions</a>
                    </div>
                </div>
            </div>
        </section>

        <!-- Contact Form -->
        <section class="contact-form-section">
            <div class="section-container">
                <div class="contact-form-wrapper">
                    <div class="form-info">
                        <h2>Send Us a Message</h2>
                        <p>Fill out the form and we'll get back to you as soon as possible</p>

                        <div class="info-list">
                            <div class="info-item">
                                <i class="ti ti-clock"></i>
                                <div>
                                    <h4>Response Time</h4>
                                    <p>Usually within 24 hours</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="ti ti-shield-check"></i>
                                <div>
                                    <h4>Secure</h4>
                                    <p>Your information is encrypted</p>
                                </div>
                            </div>
                            <div class="info-item">
                                <i class="ti ti-headset"></i>
                                <div>
                                    <h4>24/7 Support</h4>
                                    <p>We're always here to help</p>
                                </div>
                            </div>
                        </div>
                    </div>

                    <form class="contact-form" id="contactForm">
                        <div class="form-row">
                            <div class="form-group">
                                <label for="firstName">First Name</label>
                                <input type="text" id="firstName" name="firstName" required />
                            </div>
                            <div class="form-group">
                                <label for="lastName">Last Name</label>
                                <input type="text" id="lastName" name="lastName" required />
                            </div>
                        </div>

                        <div class="form-group">
                            <label for="email">Email Address</label>
                            <input type="email" id="email" name="email" required />
                        </div>

                        <div class="form-group">
                            <label for="phone">Phone Number (Optional)</label>
                            <input type="tel" id="phone" name="phone" />
                        </div>

                        <div class="form-group">
                            <label for="subject">Subject</label>
                            <select id="subject" name="subject" required>
                                <option value="">Select a subject</option>
                                <option value="account">Account Issues</option>
                                <option value="transaction">Transaction Problem</option>
                                <option value="technical">Technical Support</option>
                                <option value="feedback">Feedback</option>
                                <option value="other">Other</option>
                            </select>
                        </div>

                        <div class="form-group">
                            <label for="message">Message</label>
                            <textarea id="message" name="message" rows="5" required></textarea>
                        </div>

                        <button type="submit" class="btn-submit">
                            Send Message
                            <i class="ti ti-send"></i>
                        </button>
                    </form>
                </div>
            </div>
        </section>

        <!-- FAQ Quick Links -->
        <section class="faq-quick">
            <div class="section-container">
                <div class="section-header">
                    <h2>Quick Answers</h2>
                    <p>Find answers to common questions</p>
                </div>
                <div class="faq-grid">
                    <a href="help-center.php" class="faq-quick-card">
                        <i class="ti ti-help"></i>
                        <h3>Help Center</h3>
                        <p>Browse our knowledge base</p>
                    </a>
                    <a href="help-center.php#account" class="faq-quick-card">
                        <i class="ti ti-user"></i>
                        <h3>Account Help</h3>
                        <p>Manage your account</p>
                    </a>
                    <a href="help-center.php#security" class="faq-quick-card">
                        <i class="ti ti-shield-lock"></i>
                        <h3>Security</h3>
                        <p>Keep your account safe</p>
                    </a>
                    <a href="help-center.php#payments" class="faq-quick-card">
                        <i class="ti ti-credit-card"></i>
                        <h3>Payments</h3>
                        <p>Transaction support</p>
                    </a>
                </div>
            </div>
        </section>

        <?php require_once __DIR__ . "/includes/components/footer.php"; ?>

        <script src="public/assets/js/pages.js"></script>
    </body>

    </html>