<?php require_once __DIR__ . "/../includes/check_auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="../public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="../public/assets/css/index.css">
    <link rel="stylesheet" href="../public/assets/css/legal-pages.css">
    <title>Privacy Policy - D'Bag Bank</title>
</head>

<body class="page-body">
    <!-- Navigation -->
    <nav class="navbar">
        <div class="nav-container">
            <div class="nav-logo">
                <a href="index.php">
                    <img src="../public/logo.svg" alt="D'Bag Bank" />
                </a>
            </div>
            <ul class="nav-links">
                <li><a href="index.php#features">Features</a></li>
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="help-center.php">Help</a></li>
                <li><a href="contact.php">Contact</a></li>
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
            <li><a href="login.php" class="mobile-login">Login</a></li>
            <li><a href="register.php" class="mobile-signup">Sign Up</a></li>
        </ul>
    </div>

    <!-- Hero Section -->
    <section class="legal-hero">
        <div class="legal-hero-content">
            <h1>Privacy Policy</h1>
            <p class="last-updated">Last Updated: January 20, 2025</p>
        </div>
    </section>

    <!-- Table of Contents -->
    <section class="legal-toc">
        <div class="section-container">
            <div class="toc-card">
                <h3>Table of Contents</h3>
                <ul class="toc-list">
                    <li><a href="#introduction">1. Introduction</a></li>
                    <li><a href="#information-we-collect">2. Information We Collect</a></li>
                    <li><a href="#how-we-use">3. How We Use Your Information</a></li>
                    <li><a href="#information-sharing">4. Information Sharing</a></li>
                    <li><a href="#data-security">5. Data Security</a></li>
                    <li><a href="#your-rights">6. Your Rights</a></li>
                    <li><a href="#cookies">7. Cookies and Tracking</a></li>
                    <li><a href="#data-retention">8. Data Retention</a></li>
                    <li><a href="#children">9. Children's Privacy</a></li>
                    <li><a href="#changes">10. Changes to This Policy</a></li>
                    <li><a href="#contact">11. Contact Us</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="legal-content">
        <div class="section-container">
            <div class="content-wrapper">
                <!-- Introduction -->
                <article id="introduction" class="legal-section">
                    <h2>1. Introduction</h2>
                    <p>
                        Welcome to D'Bag Bank. We respect your privacy and are committed to protecting your personal data.
                        This privacy policy will inform you about how we look after your personal data when you visit our
                        website or use our services and tell you about your privacy rights and how the law protects you.
                    </p>
                    <p>
                        D'Bag Bank ("we", "us", or "our") operates the digital banking platform accessible at
                        www.dbagbank.com (the "Service"). This page informs you of our policies regarding the collection,
                        use, and disclosure of personal data when you use our Service and the choices you have associated
                        with that data.
                    </p>
                </article>

                <!-- Information We Collect -->
                <article id="information-we-collect" class="legal-section">
                    <h2>2. Information We Collect</h2>

                    <h3>2.1 Personal Information</h3>
                    <p>We collect several types of information from and about users of our Service, including:</p>
                    <ul>
                        <li><strong>Identity Data:</strong> First name, last name, username, date of birth, and government-issued ID</li>
                        <li><strong>Contact Data:</strong> Email address, phone number, and physical address</li>
                        <li><strong>Financial Data:</strong> Bank account details, transaction history, and payment information</li>
                        <li><strong>Technical Data:</strong> IP address, browser type, device information, and operating system</li>
                        <li><strong>Usage Data:</strong> Information about how you use our Service, including access times and pages viewed</li>
                    </ul>

                    <h3>2.2 Information We Collect Automatically</h3>
                    <p>
                        When you access our Service, we automatically collect certain information about your device,
                        including information about your web browser, IP address, time zone, and some of the cookies
                        installed on your device.
                    </p>

                    <h3>2.3 Information from Third Parties</h3>
                    <p>
                        We may receive information about you from third parties such as credit reference agencies,
                        fraud prevention agencies, and ../publicly available sources to verify your identity and prevent fraud.
                    </p>
                </article>

                <!-- How We Use Information -->
                <article id="how-we-use" class="legal-section">
                    <h2>3. How We Use Your Information</h2>
                    <p>We use the information we collect for various purposes, including:</p>
                    <ul>
                        <li>To provide, maintain, and improve our Service</li>
                        <li>To process your transactions and manage your account</li>
                        <li>To verify your identity and prevent fraud</li>
                        <li>To send you technical notices, updates, and security alerts</li>
                        <li>To respond to your comments, questions, and customer service requests</li>
                        <li>To communicate with you about products, services, and promotional offers</li>
                        <li>To monitor and analyze trends, usage, and activities in connection with our Service</li>
                        <li>To detect, prevent, and address technical issues and fraudulent activity</li>
                        <li>To comply with legal obligations and regulatory requirements</li>
                    </ul>
                </article>

                <!-- Information Sharing -->
                <article id="information-sharing" class="legal-section">
                    <h2>4. Information Sharing and Disclosure</h2>
                    <p>We may share your personal information in the following circumstances:</p>

                    <h3>4.1 With Service Providers</h3>
                    <p>
                        We may share your information with third-party service providers who perform services on our behalf,
                        such as payment processing, data analysis, email delivery, hosting services, and customer service.
                    </p>

                    <h3>4.2 For Legal Reasons</h3>
                    <p>We may disclose your information if required to do so by law or in response to valid requests by ../public authorities.</p>

                    <h3>4.3 Business Transfers</h3>
                    <p>
                        In the event of a merger, acquisition, or sale of assets, your personal information may be
                        transferred to the acquiring entity.
                    </p>

                    <h3>4.4 With Your Consent</h3>
                    <p>We may share your information with third parties when you give us your explicit consent to do so.</p>

                    <div class="important-notice">
                        <i class="ti ti-alert-circle"></i>
                        <div>
                            <h4>Important: </h4>
                            <p>We never sell your personal information to third parties for marketing purposes.</p>
                        </div>
                    </div>
                </article>

                <!-- Data Security -->
                <article id="data-security" class="legal-section">
                    <h2>5. Data Security</h2>
                    <p>
                        We implement appropriate technical and organizational measures to protect your personal data against
                        unauthorized or unlawful processing, accidental loss, destruction, or damage. These measures include:
                    </p>
                    <ul>
                        <li>256-bit SSL encryption for all data transmission</li>
                        <li>Secure servers with regular security audits</li>
                        <li>Two-factor authentication for account access</li>
                        <li>Regular employee training on data protection</li>
                        <li>Access controls limiting who can view your data</li>
                        <li>Regular backups and disaster recovery procedures</li>
                    </ul>
                    <p>
                        However, please note that no method of transmission over the Internet or electronic storage is 100% secure.
                        While we strive to use commercially acceptable means to protect your personal data, we cannot guarantee its absolute security.
                    </p>
                </article>

                <!-- Your Rights -->
                <article id="your-rights" class="legal-section">
                    <h2>6. Your Privacy Rights</h2>
                    <p>You have the following rights regarding your personal data:</p>

                    <div class="rights-grid">
                        <div class="right-card">
                            <i class="ti ti-eye"></i>
                            <h4>Right to Access</h4>
                            <p>You can request a copy of the personal data we hold about you.</p>
                        </div>
                        <div class="right-card">
                            <i class="ti ti-edit"></i>
                            <h4>Right to Rectification</h4>
                            <p>You can request that we correct any inaccurate or incomplete data. </p>
                        </div>
                        <div class="right-card">
                            <i class="ti ti-trash"></i>
                            <h4>Right to Erasure</h4>
                            <p>You can request that we delete your personal data under certain circumstances.</p>
                        </div>
                        <div class="right-card">
                            <i class="ti ti-ban"></i>
                            <h4>Right to Restrict</h4>
                            <p>You can request that we restrict the processing of your data. </p>
                        </div>
                        <div class="right-card">
                            <i class="ti ti-download"></i>
                            <h4>Right to Portability</h4>
                            <p>You can request a copy of your data in a machine-readable format.</p>
                        </div>
                        <div class="right-card">
                            <i class="ti ti-x"></i>
                            <h4>Right to Object</h4>
                            <p>You can object to our processing of your personal data.</p>
                        </div>
                    </div>

                    <p class="rights-note">
                        To exercise any of these rights, please contact us at <a href="mailto:privacy@dbagbank.com">privacy@dbagbank.com</a>.
                        We will respond to your request within 30 days.
                    </p>
                </article>

                <!-- Cookies -->
                <article id="cookies" class="legal-section">
                    <h2>7. Cookies and Tracking Technologies</h2>
                    <p>
                        We use cookies and similar tracking technologies to track activity on our Service and hold certain information.
                        Cookies are files with a small amount of data that may include an anonymous unique identifier.
                    </p>

                    <h3>7.1 Types of Cookies We Use</h3>
                    <ul>
                        <li><strong>Essential Cookies:</strong> Required for the operation of our Service</li>
                        <li><strong>Functional Cookies:</strong> Enable enhanced functionality and personalization</li>
                        <li><strong>Analytics Cookies:</strong> Help us understand how visitors interact with our Service</li>
                        <li><strong>Marketing Cookies:</strong> Used to deliver relevant advertisements</li>
                    </ul>

                    <h3>7.2 Managing Cookies</h3>
                    <p>
                        You can instruct your browser to refuse all cookies or to indicate when a cookie is being sent.
                        However, if you do not accept cookies, you may not be able to use some portions of our Service.
                    </p>
                </article>

                <!-- Data Retention -->
                <article id="data-retention" class="legal-section">
                    <h2>8. Data Retention</h2>
                    <p>
                        We will retain your personal data only for as long as necessary to fulfill the purposes for which
                        we collected it, including for the purposes of satisfying any legal, accounting, or reporting requirements.
                    </p>
                    <p>
                        To determine the appropriate retention period, we consider the amount, nature, and sensitivity of the
                        personal data, the potential risk of harm from unauthorized use or disclosure, the purposes for which
                        we process your data, and applicable legal requirements.
                    </p>
                    <ul>
                        <li><strong>Account Data:</strong> Retained for the duration of your account plus 7 years</li>
                        <li><strong>Transaction Data:</strong> Retained for 7 years for regulatory compliance</li>
                        <li><strong>Marketing Data:</strong> Retained until you opt-out or request deletion</li>
                        <li><strong>Technical Data:</strong> Retained for 2 years for security purposes</li>
                    </ul>
                </article>

                <!-- Children's Privacy -->
                <article id="children" class="legal-section">
                    <h2>9. Children's Privacy</h2>
                    <p>
                        Our Service is not intended for use by children under the age of 18. We do not knowingly collect
                        personal information from children under 18. If you are a parent or guardian and believe your child
                        has provided us with personal data, please contact us immediately.
                    </p>
                    <p>
                        If we become aware that we have collected personal data from a child under 18 without verification of
                        parental consent, we will take steps to remove that information from our servers.
                    </p>
                </article>

                <!-- Changes to Policy -->
                <article id="changes" class="legal-section">
                    <h2>10. Changes to This Privacy Policy</h2>
                    <p>
                        We may update our Privacy Policy from time to time. We will notify you of any changes by posting
                        the new Privacy Policy on this page and updating the "Last Updated" date at the top of this policy.
                    </p>
                    <p>
                        You are advised to review this Privacy Policy periodically for any changes. Changes to this Privacy
                        Policy are effective when they are posted on this page. Your continued use of the Service after we
                        post any modifications will constitute your acknowledgment of the modifications and your consent to
                        abide and be bound by the modified Privacy Policy.
                    </p>
                </article>

                <!-- Contact -->
                <article id="contact" class="legal-section">
                    <h2>11. Contact Us</h2>
                    <p>If you have any questions about this Privacy Policy, please contact us: </p>

                    <div class="contact-methods">
                        <div class="contact-item">
                            <i class="ti ti-mail"></i>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:privacy@dbagbank.com">privacy@dbagbank.com</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="ti ti-phone"></i>
                            <div>
                                <h4>Phone</h4>
                                <a href="tel:+2341234567890">+234 123 456 7890</a>
                            </div>
                        </div>
                        <div class="contact-item">
                            <i class="ti ti-map-pin"></i>
                            <div>
                                <h4>Address</h4>
                                <p>123 Banking Street, Victoria Island, Lagos, Nigeria</p>
                            </div>
                        </div>
                    </div>
                </article>
            </div>

            <!-- Sidebar -->
            <aside class="legal-sidebar">
                <div class="sidebar-card">
                    <h4>Quick Links</h4>
                    <ul class="sidebar-links">
                        <li><a href="terms-of-service. php">Terms of Service</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="help-center.php">Help Center</a></li>
                    </ul>
                </div>

                <div class="sidebar-card highlight">
                    <i class="ti ti-shield-check"></i>
                    <h4>Your Privacy Matters</h4>
                    <p>We are committed to protecting your personal information and your right to privacy. </p>
                </div>

                <div class="sidebar-card">
                    <h4>Download PDF</h4>
                    <p>Download a copy of our Privacy Policy for your records.</p>
                    <a href="#" class="download-btn">
                        <i class="ti ti-download"></i>
                        Download PDF
                    </a>
                </div>
            </aside>
        </div>
    </section>

    <?php require_once __DIR__ . "/../includes/components/footer.php"; ?>

    <script src="../public/assets/js/legal-pages.js"></script>
</body>

</html>