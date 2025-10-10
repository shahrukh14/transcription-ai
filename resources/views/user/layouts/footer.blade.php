    <footer class="rts-footer site-footer-four">
        <div class="container position-relative z-1">
            <div class="row">
                <!-- widget -->
                <div class="col-lg-3 col-md-6 rts-footer__widget--column">
                    <div class="rts-footer__widget footer__widget w-230">
                        <a href="#" class="footer__logo">
                            <img src="{{ asset('user-assets/images/logo/footer__four__logo.svg') }}" alt="">
                        </a>
                        <p class="brand-desc address">1811 Silverside Rd, Wilmington <br> DE 19810, USA</p>
                        <div class="separator site-default-border"></div>

                        <div class="contact-method">
                            <a href="tel:8060008899"><span><i class="fa-regular fa-phone"></i></span>+806 (000) 88 99</a>
                            <a href="mailto:info@hostie.com"><span><i class="fa-light fa-envelope"></i></span>info@hostie.com</a>
                        </div>
                    </div>
                </div>
                <!-- widget end -->
                <!-- widget -->
                <div class="col-lg-2 col-md-3 col-sm-4 rts-footer__widget--column">
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Company</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="about.php">About Us</a></li>
                                <li><a href="blog.php">News Feed</a></li>
                                <li><a href="contact.php">Contact</a></li>
                                <li><a href="affiliate.php">Affiliate Program</a></li>
                                <li><a href="technology.php">Our Technology</a></li>
                                <li><a href="knowledgebase.php">Knowledgebase</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- widget end -->
                <!-- widget -->
                <div class="col-lg-2 col-md-3 col-sm-4 rts-footer__widget--column">
                    <div class="rts-footer__widget footer__widget extra-padding">
                        <h5 class="widget-title">Feature</h5>
                        <div class="rts-footer__widget--menu ">
                            <ul>
                                <li><a href="domain-checker.php">Domain Checker</a></li>
                                <li><a href="domain-transfer.php">Domain Transfer</a></li>
                                <li><a href="domain-registration.php">Domain Registration</a></li>
                                <li><a href="data-centers.php">Data Centers</a></li>
                                <li><a href="whois.php">Whois</a></li>
                                <li><a href="support.php">Support</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- widget end -->
                <!-- widget -->
                <div class="col-lg-2 col-md-6 col-sm-4 rts-footer__widget--column no-margin xs-margin">
                    <div class="rts-footer__widget footer__widget">
                        <h5 class="widget-title">Hosting</h5>
                        <div class="rts-footer__widget--menu">
                            <ul>
                                <li><a href="shared-hosting.php">Shared Hosting</a></li>
                                <li><a href="wordpress-hosting.php">Wordpress Hosting</a></li>
                                <li><a href="vps-hosting.php">VPS Hosting</a></li>
                                <li><a href="reseller-hosting.php">Reseller Hosting</a></li>
                                <li><a href="dedicated-hosting.php">Dedicated Hosting</a></li>
                                <li><a href="cloud-hosting.php">Cloud Hosting</a></li>
                            </ul>
                        </div>
                    </div>
                </div>
                <!-- widget end -->
                <!-- widget -->
                <div class="col-lg-3 col-md-6 rts-footer__widget--column no-margin">
                    <div class="rts-footer__widget footer__widget">
                        <h5 class="widget-title">Join Our Newsletter</h5>
                        <p>We'll send you news and offers.</p>
                        <form action="#" class="newsletter">
                            <input type="email" name="email" placeholder="Enter mail" required>
                            <span class="icon"><i class="fa-regular fa-envelope-open"></i></span>
                            <button type="submit"><i class="fa-regular fa-arrow-right"></i></button>
                        </form>
                        <div class="social__media">
                            <h5>social media</h5>
                            <div class="social__media--list">
                                <a href="#" class="media"><i class="fa-brands fa-facebook-f"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-instagram"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-linkedin"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-x-twitter"></i></a>
                                <a href="#" class="media"><i class="fa-brands fa-behance"></i></a>
                            </div>
                        </div>
                    </div>
                </div>
                <!-- widget end -->
            </div>
        </div>
    </footer>
    <div class="rts-footer__copyright-two style-four">
        <div class="container">
            <div class="row">
                <div class="rts-footer__copyright-two__wrapper">
                    <p class="copyright">&copy; Copyright 2024. All Rights Reserved.</p>
                    <div class="payment__method">
                        <ul>
                            <li><img src="{{ asset('user-assets/images/payment/visa.svg') }}" alt=""></li>
                            <li><img src="{{ asset('user-assets/images/payment/master-card.svg') }}" alt=""></li>
                            <li><img src="{{ asset('user-assets/images/payment/paypal.svg') }}" alt=""></li>
                            <li><img src="{{ asset('user-assets/images/payment/american-express.svg') }}" alt=""></li>
                            <li><img src="{{ asset('user-assets/images/payment/wise.svg') }}" alt=""></li>
                        </ul>
                    </div>
                </div>
            </div>
        </div>
    </div>



    <div id="anywhere-home" class=""></div>
    <div class="loader-wrapper">
        <div class="loader"></div>
        <div class="loader-section section-left"></div>
        <div class="loader-section section-right"></div>
    </div>

    <div class="progress-wrap">
        <svg class="progress-circle svg-content" width="100%" height="100%" viewBox="-1 -1 102 102">
            <path d="M50,1 a49,49 0 0,1 0,98 a49,49 0 0,1 0,-98" style="transition: stroke-dashoffset 10ms linear 0s; stroke-dasharray: 307.919, 307.919; stroke-dashoffset: 307.919;"></path>
        </svg>
    </div>

    <!-- All Plugin -->
    <script defer src="{{ asset('user-assets/js/plugins.min.js') }}"></script>
    <!-- main js -->
    <script defer src="{{ asset('user-assets/js/main.js') }}"></script>

</body>
</html>