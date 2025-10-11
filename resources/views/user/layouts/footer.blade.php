    <div class="sidenav-overlay"></div>
    <div class="drag-target"></div>

    <!-- BEGIN: Footer -->
    <footer class="footer footer-static footer-light py-3" style="box-shadow: 0 -5px 15px rgba(0, 0, 0, 0.1);">
        <div class="container">
            <div class="row">
                <!-- About section -->
                <div class="col-12 col-md-4 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-1">About TranScribe</h5>
                    <p class="text-muted">
                        TranScribe helps you easily transcribe, manage and organize your audio recordings into clear written content.
                    </p>
                </div>
    
                <!-- Quick Links -->
                <div class="col-6 col-md-4 mb-2 mb-md-0">
                    <h5 class="fw-bold mb-1">Quick Links</h5>
                    <ul class="list-unstyled">
                        <li><a href="{{ route('home') }}" class="text-decoration-none text-muted">Home</a></li>
                        <li><a href="{{ route('pricing') }}" class="text-decoration-none text-muted">Pricing</a></li>
                        <li><a href="{{ route('contact') }}" class="text-decoration-none text-muted">Contact Us</a></li>
                    </ul>
                </div>
    
                <!-- Contact Info -->
                <div class="col-6 col-md-4">
                    <h5 class="fw-bold mb-1">Contact</h5>
                    <ul class="list-unstyled">
                        <li class="text-muted">Email: support@transcribe.com</li>
                        <li class="text-muted">Phone: +91 9876543210</li>
                        <li class="text-muted">Address: India</li>
                    </ul>
                </div>
            </div>
    
            <hr class="mt-3 mb-2" />
    
            <div class="d-flex justify-content-between flex-wrap">
                <p class="mb-0 text-muted">
                    COPYRIGHT &copy; {{ date('Y') }}
                    <a class="ms-25 fw-bold text-decoration-none" href="{{ route('home') }}">TranScribe</a>,
                    All rights Reserved
                </p>
    
                <div class="mb-0">
                    <a href="#" class="text-muted me-1"><i data-feather="facebook"></i></a>
                    <a href="#" class="text-muted me-1"><i data-feather="twitter"></i></a>
                    <a href="#" class="text-muted"><i data-feather="instagram"></i></a>
                </div>
            </div>
        </div>
    </footer>
    <button class="btn btn-primary btn-icon scroll-top" type="button"><i class="fa-solid fa-arrow-up"></i></button>
    <!-- END: Footer-->

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>

    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/ui/jquery.sticky.js')}}"></script>
    {{-- <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script> --}}
    <script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/plyr.min.js')}}"></script>
    <script src="{{asset('app-assets/vendors/js/extensions/plyr.polyfilled.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

    <!-- BEGIN: Theme JS-->
    <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
    <script src="{{asset('app-assets/js/core/app.js')}}"></script>
    <!-- END: Theme JS-->

    <!-- BEGIN: Page JS-->
    <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/pages/page-pricing.js')}}"></script>
    <!-- END: Page JS-->

    <!-- BEGIN: Select2 JS-->
    <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-select2.js')}}"></script>
    <!-- END: Select2 JS-->
    <script src="{{asset('app-assets/js/scripts/extensions/ext-component-media-player.js')}}"></script>


    @include('sweetalert::alert')
    @stack('script')
    @stack('modal')
    
    <script>
        $(window).on('load', function() {
                      
            if (feather) {
                feather.replace({
                    width: 14,
                    height: 14
                });
            }
        })
    </script>
</body>
<!-- END: Body-->

</html>