<?php require_once __DIR__ . "/includes/check_auth.php"; ?>
<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link rel="shortcut icon" href="public/favicon.svg" type="image/svg" />
    <link rel="stylesheet" href="public/assets/css/index.css">
    <link rel="stylesheet" href="public/assets/css/legal-pages.css">
    <title>Terms of Service - D'Bag Bank</title>
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
                <li><a href="pricing.php">Pricing</a></li>
                <li><a href="help-center.php">Help</a></li>
                <li><a href="contact.php">Contact</a></li>
            </ul>
            <div class="nav-actions">
                <a href="login.php" class="btn-login">Login</a>
                <a href="register. php" class="btn-signup">Sign Up</a>
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
            <h1>Terms of Service</h1>
            <p class="last-updated">Last Updated: January 20, 2025</p>
        </div>
    </section>

    <!-- Table of Contents -->
    <section class="legal-toc">
        <div class="section-container">
            <div class="toc-card">
                <h3>Table of Contents</h3>
                <ul class="toc-list">
                    <li><a href="#agreement">1. Agreement to Terms</a></li>
                    <li><a href="#eligibility">2. Eligibility</a></li>
                    <li><a href="#account">3. Account Registration</a></li>
                    <li><a href="#services">4. Services</a></li>
                    <li><a href="#fees">5. Fees and Charges</a></li>
                    <li><a href="#prohibited">6. Prohibited Activities</a></li>
                    <li><a href="#liability">7. Limitation of Liability</a></li>
                    <li><a href="#termination">8. Termination</a></li>
                    <li><a href="#disputes">9. Dispute Resolution</a></li>
                    <li><a href="#governing-law">10. Governing Law</a></li>
                    <li><a href="#modifications">11. Modifications</a></li>
                    <li><a href="#contact-tos">12. Contact Information</a></li>
                </ul>
            </div>
        </div>
    </section>

    <!-- Legal Content -->
    <section class="legal-content">
        <div class="section-container">
            <div class="content-wrapper">
                <!-- Agreement -->
                <article id="agreement" class="legal-section">
                    <h2>1. Agreement to Terms</h2>
                    <p>
                        These Terms of Service ("Terms") constitute a legally binding agreement between you and D'Bag Bank 
                        ("Company", "we", "us", or "our") concerning your access to and use of the D'Bag Bank website and 
                        mobile application (collectively, the "Service").
                    </p>
                    <p>
                        By accessing or using the Service, you agree that you have read, understood, and agree to be bound 
                        by these Terms. If you do not agree with these Terms, you must not access or use the Service.
                    </p>
                    <div class="important-notice">
                        <i class="ti ti-alert-circle"></i>
                        <div>
                            <h4>Important Notice: </h4>
                            <p>
                                These Terms contain provisions that limit our liability to you and require you to resolve 
                                disputes with us through arbitration on an individual basis, not as part of any class or representative action.
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Eligibility -->
                <article id="eligibility" class="legal-section">
                    <h2>2. Eligibility</h2>
                    <p>To use our Service, you must: </p>
                    <ul>
                        <li>Be at least 18 years of age</li>
                        <li>Be a legal resident of Nigeria</li>
                        <li>Have the legal capacity to enter into a binding contract</li>
                        <li>Not be barred from using the Service under applicable law</li>
                        <li>Provide accurate and complete information during registration</li>
                        <li>Maintain the security of your account credentials</li>
                    </ul>
                    <p>
                        By using the Service, you represent and warrant that you meet all of the foregoing eligibility requirements.  
                        If you do not meet these requirements, you must not access or use the Service.
                    </p>
                </article>

                <!-- Account Registration -->
                <article id="account" class="legal-section">
                    <h2>3. Account Registration and Security</h2>
                    
                    <h3>3.1 Account Creation</h3>
                    <p>To access certain features of the Service, you must register for an account. You agree to: </p>
                    <ul>
                        <li>Provide accurate, current, and complete information</li>
                        <li>Maintain and promptly update your account information</li>
                        <li>Maintain the security of your password</li>
                        <li>Accept all responsibility for activity that occurs under your account</li>
                        <li>Notify us immediately of any unauthorized use of your account</li>
                    </ul>

                    <h3>3.2 Account Verification</h3>
                    <p>
                        We may require you to verify your identity by providing government-issued identification, 
                        proof of address, or other documentation.  Failure to provide requested information may result 
                        in account limitations or closure.
                    </p>

                    <h3>3.3 Account Security</h3>
                    <p>You are responsible for maintaining the confidentiality of your account credentials. You must:</p>
                    <ul>
                        <li>Use a strong, unique password</li>
                        <li>Enable two-factor authentication</li>
                        <li>Never share your password with others</li>
                        <li>Log out after each session</li>
                        <li>Report any suspicious activity immediately</li>
                    </ul>
                </article>

                <!-- Services -->
                <article id="services" class="legal-section">
                    <h2>4. Services</h2>
                    
                    <h3>4.1 Services Provided</h3>
                    <p>D'Bag Bank provides the following services:</p>
                    <ul>
                        <li>Digital wallet and account management</li>
                        <li>Money transfers (internal and external)</li>
                        <li>Transaction history and statements</li>
                        <li>Bill payment services</li>
                        <li>Account notifications and alerts</li>
                    </ul>

                    <h3>4.2 Service Modifications</h3>
                    <p>
                        We reserve the right to modify, suspend, or discontinue any aspect of the Service at any time, 
                        with or without notice. We will not be liable to you or any third party for any modification, 
                        suspension, or discontinuation of the Service.
                    </p>

                    <h3>4.3 Transaction Limits</h3>
                    <p>We may impose limits on: </p>
                    <ul>
                        <li>Daily transaction amounts</li>
                        <li>Number of transactions per day</li>
                        <li>Account balance limits</li>
                        <li>Withdrawal limits</li>
                    </ul>
                    <p>These limits may vary based on your account type and verification status.</p>
                </article>

                <!-- Fees -->
                <article id="fees" class="legal-section">
                    <h2>5. Fees and Charges</h2>
                    
                    <h3>5.1 Service Fees</h3>
                    <p>
                        Certain features of the Service may be subject to fees. Current fees are available on our 
                        <a href="pricing.php">Pricing Page</a>. We reserve the right to change our fees at any time 
                        with 30 days' notice. 
                    </p>

                    <h3>5.2 Third-Party Fees</h3>
                    <p>
                        You may incur fees charged by third parties in connection with your use of the Service, 
                        including but not limited to fees charged by your mobile carrier or internet service provider. 
                        You are solely responsible for such fees. 
                    </p>

                    <h3>5.3 Payment Authorization</h3>
                    <p>
                        By providing payment information, you authorize us to charge all applicable fees to your 
                        designated payment method. You are responsible for maintaining valid payment information. 
                    </p>
                </article>

                <!-- Prohibited Activities -->
                <article id="prohibited" class="legal-section">
                    <h2>6. Prohibited Activities</h2>
                    <p>You agree not to:</p>
                    
                    <div class="prohibited-grid">
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Fraud</h4>
                            <p>Use the Service for any fraudulent or illegal activity</p>
                        </div>
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Money Laundering</h4>
                            <p>Use the Service to launder money or finance terrorism</p>
                        </div>
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Unauthorized Access</h4>
                            <p>Attempt to gain unauthorized access to any account</p>
                        </div>
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Interference</h4>
                            <p>Interfere with or disrupt the Service or servers</p>
                        </div>
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Impersonation</h4>
                            <p>Impersonate any person or entity</p>
                        </div>
                        <div class="prohibited-item">
                            <i class="ti ti-ban"></i>
                            <h4>Data Mining</h4>
                            <p>Use automated systems to collect user data</p>
                        </div>
                    </div>

                    <p>
                        Violation of these prohibitions may result in immediate termination of your account and 
                        may subject you to civil and criminal liability.
                    </p>
                </article>

                <!-- Liability -->
                <article id="liability" class="legal-section">
                    <h2>7. Limitation of Liability</h2>
                    <p>
                        TO THE MAXIMUM EXTENT PERMITTED BY LAW, D'BAG BANK SHALL NOT BE LIABLE FOR ANY INDIRECT, INCIDENTAL, 
                        SPECIAL, CONSEQUENTIAL, OR PUNITIVE DAMAGES, OR ANY LOSS OF PROFITS OR REVENUES, WHETHER INCURRED 
                        DIRECTLY OR INDIRECTLY, OR ANY LOSS OF DATA, USE, GOODWILL, OR OTHER INTANGIBLE LOSSES. 
                    </p>
                    <p>
                        Our total liability to you for any damages arising out of or related to these Terms or the Service 
                        shall not exceed the amount you have paid us in the twelve (12) months prior to the event giving rise to liability.
                    </p>
                    <div class="important-notice warning">
                        <i class="ti ti-alert-triangle"></i>
                        <div>
                            <h4>Disclaimer: </h4>
                            <p>
                                THE SERVICE IS PROVIDED "AS IS" AND "AS AVAILABLE" WITHOUT WARRANTIES OF ANY KIND, 
                                EITHER EXPRESS OR IMPLIED. WE DO NOT WARRANT THAT THE SERVICE WILL BE UNINTERRUPTED, 
                                SECURE, OR ERROR-FREE. 
                            </p>
                        </div>
                    </div>
                </article>

                <!-- Termination -->
                <article id="termination" class="legal-section">
                    <h2>8. Termination</h2>
                    
                    <h3>8.1 Termination by You</h3>
                    <p>
                        You may terminate your account at any time by contacting customer support. Upon termination, 
                        you must withdraw any remaining balance in accordance with our procedures.
                    </p>

                    <h3>8.2 Termination by Us</h3>
                    <p>We may terminate or suspend your account immediately, without prior notice, if:</p>
                    <ul>
                        <li>You breach these Terms</li>
                        <li>We suspect fraudulent or illegal activity</li>
                        <li>Required by law or regulatory authority</li>
                        <li>Your account has been inactive for an extended period</li>
                    </ul>

                    <h3>8.3 Effect of Termination</h3>
                    <p>
                        Upon termination, your right to use the Service will immediately cease. All provisions of these 
                        Terms which by their nature should survive termination shall survive, including ownership provisions, 
                        warranty disclaimers, and limitations of liability.
                    </p>
                </article>

                <!-- Disputes -->
                <article id="disputes" class="legal-section">
                    <h2>9. Dispute Resolution</h2>
                    
                    <h3>9.1 Informal Resolution</h3>
                    <p>
                        Most disputes can be resolved informally.  Before initiating formal proceedings, please contact us at 
                        <a href="mailto:disputes@dbagbank.com">disputes@dbagbank.com</a> to attempt to resolve the matter.
                    </p>

                    <h3>9.2 Arbitration</h3>
                    <p>
                        If we cannot resolve a dispute informally, any dispute arising out of or relating to these Terms 
                        or the Service will be resolved through binding arbitration in accordance with the Arbitration and 
                        Conciliation Act of Nigeria.
                    </p>

                    <h3>9.3 Class Action Waiver</h3>
                    <p>
                        You agree to resolve disputes with us on an individual basis only, and not as part of any class, 
                        consolidated, or representative action or proceeding.
                    </p>
                </article>

                <!-- Governing Law -->
                <article id="governing-law" class="legal-section">
                    <h2>10. Governing Law</h2>
                    <p>
                        These Terms shall be governed by and construed in accordance with the laws of the Federal Republic 
                        of Nigeria, without regard to its conflict of law provisions. 
                    </p>
                    <p>
                        You agree to submit to the personal and exclusive jurisdiction of the courts located in Lagos, Nigeria, 
                        for the resolution of any disputes not subject to arbitration.
                    </p>
                </article>

                <!-- Modifications -->
                <article id="modifications" class="legal-section">
                    <h2>11. Modifications to Terms</h2>
                    <p>
                        We reserve the right to modify these Terms at any time. We will provide notice of material changes 
                        by email or through the Service. Your continued use of the Service after such modifications constitutes 
                        your acceptance of the updated Terms.
                    </p>
                    <p>
                        If you do not agree to the modified Terms, you must stop using the Service and may terminate your account.
                    </p>
                </article>

                <!-- Contact -->
                <article id="contact-tos" class="legal-section">
                    <h2>12. Contact Information</h2>
                    <p>If you have any questions about these Terms, please contact us:</p>
                    
                    <div class="contact-methods">
                        <div class="contact-item">
                            <i class="ti ti-mail"></i>
                            <div>
                                <h4>Email</h4>
                                <a href="mailto:legal@dbagbank.com">legal@dbagbank.com</a>
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
                        <li><a href="privacy-policy.php">Privacy Policy</a></li>
                        <li><a href="contact.php">Contact Us</a></li>
                        <li><a href="help-center.php">Help Center</a></li>
                    </ul>
                </div>

                <div class="sidebar-card highlight">
                    <i class="ti ti-file-text"></i>
                    <h4>Read Carefully</h4>
                    <p>These terms govern your use of our Service. Please read them carefully. </p>
                </div>

                <div class="sidebar-card">
                    <h4>Download PDF</h4>
                    <p>Download a copy of our Terms of Service for your records.</p>
                    <a href="#" class="download-btn">
                        <i class="ti ti-download"></i>
                        Download PDF
                    </a>
                </div>

                <div class="sidebar-card">
                    <h4>Questions?</h4>
                    <p>If you have any questions about these terms, please contact our legal team.</p>
                    <a href="contact.php" class="contact-link">Contact Legal Team</a>
                </div>
            </aside>
        </div>
    </section>

    <!-- Footer -->
    <?php require_once __DIR__ .  "/includes/components/footer.php"; ?>

    <script src="public/assets/js/legal-pages.js"></script>
</body>

</html>