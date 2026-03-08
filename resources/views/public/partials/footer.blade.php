<style>
    /* Footer background with subtle dark shade */
    .site-footer-white {
        background-color: rgba(0, 0, 0, 0.05); /* subtle black shade */
        color: #000; /* text color, dark */
    }
    
    .site-footer-white a {
        color: #000; /* links color */
        text-decoration: none;
    }
    
    .site-footer-white a:hover {
        color: #444; /* hover color slightly darker */
    }
    
    .footer-divider {
        border-color: rgba(0,0,0,0.1); /* subtle divider */
    }
    </style>
    
   
   {{-- footer --}}
    <footer class="site-footer-white py-5" style="  overflow-x: hidden; ">
        <div class="container">
            <div class="row">
    
                <!-- About / Logo -->
                <div class="col-lg-4 col-md-6 mb-4">
                    <h3 class="footer-logo mb-3"><a href="{{ route('home') }}">Zyra Atelier</a></h3>
                    <p>Elegant traditional suits & premium wear. Explore our latest collection and enjoy seamless shopping.</p>
                </div>
    
                <!-- Quick Links -->
                <div class="col-lg-2 col-md-6 mb-4">
                    <h5 class="footer-title">Quick Links</h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="{{ route('home') }}">Home</a></li>
                        <li><a href="{{ route('shopPage') }}">Shop</a></li>
                        <li><a href="{{ route('about') }}">About Us</a></li>
                        <li><a href="{{ route('contact') }}">Contact</a></li>
                    </ul>
                </div>
    
                <!-- Support -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Support</h5>
                    <ul class="footer-links list-unstyled">
                        <li><a href="tel:+923001234567"><i class="bi bi-telephone-fill me-1"></i>0300-1234567</a></li>
                        <li><a href="mailto:info@mywebsite.com"><i class="bi bi-envelope-fill me-1"></i>info@mywebsite.com</a></li>
                        <li><a href="{{ route('contact') }}">FAQ</a></li>
                        <li><a href="{{ route('contact') }}">Returns</a></li>
                    </ul>
                </div>
    
                <!-- Social -->
                <div class="col-lg-3 col-md-6 mb-4">
                    <h5 class="footer-title">Follow Us</h5>
                    <div class="footer-social d-flex gap-3">
                        <a href="https://facebook.com" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-facebook"></i></a>
                        <a href="https://instagram.com" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-instagram"></i></a>
                        <a href="https://x.com" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-twitter-x"></i></a>
                        <a href="https://wa.me/923001234567" class="social-icon" target="_blank" rel="noopener"><i class="bi bi-whatsapp"></i></a>
                    </div>
                </div>
    
            </div>
    
            <hr class="footer-divider">

            <div class="text-center mt-3">
                <p>&copy; 2026 <a href="{{ route('home') }}">Zyra Atelier</a>. All Rights Reserved.</p>
            </div>
        </div>
    </footer>
