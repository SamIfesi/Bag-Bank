 <footer class="footer" id="contact">
     <div class="footer-container">
         <div class="footer-section">
             <img src="../public/logo-stacked.svg" alt="D'Bag Bank" class="footer-logo" />
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
                 <li><a href="../index.php#features">Features</a></li>
                 <li><a href="../index.php#security">Security</a></li>
                 <li><a href="pricing.php">Pricing</a></li>
                 <li><a href="#">API</a></li>
             </ul>
         </div>

         <div class="footer-section">
             <h4>Company</h4>
             <ul>
                 <li><a href="about_us.php">About Us</a></li>
                 <li><a href="careers.php">Careers</a></li>
                 <li><a href="blog.php">Blog</a></li>
                 <li><a href="press.php">Press</a></li>
             </ul>
         </div>

         <div class="footer-section">
             <h4>Support</h4>
             <ul>
                 <li><a href="help-center.php">Help Center</a></li>
                 <li><a href="contact.php">Contact Us</a></li>
                 <li><a href="privacy-policy.php">Privacy Policy</a></li>
                 <li><a href="terms-of-service.php">Terms of Service</a></li>
             </ul>
         </div>
     </div>

     <div class="footer-bottom">
         <p>&copy; 2025 D'Bag Bank. All rights reserved.</p>
     </div>
 </footer>
 <script>
     const createProgressBar = () => {
         const progressBar = document.createElement("div");
         progressBar.id = "reading-progress";
         progressBar.style.cssText = `
            position: fixed;
            top: 0;
            left: 0;
            width: 0%;
            height: 0.25rem;
            background: linear-gradient(135deg, #5200a3 0%, #6c5ce7 100%);
            z-index: 9999;
            transition: width 0.1s ease;
        `;
         document.body.appendChild(progressBar);

         window.addEventListener("scroll", () => {
             const windowHeight = window.innerHeight;
             const documentHeight = document.documentElement.scrollHeight - windowHeight;
             const scrolled = window.scrollY;
             const progress = (scrolled / documentHeight) * 100;

             progressBar.style.width = `${Math.min(progress, 100)}%`;
         });
     };
     createProgressBar();
 </script>