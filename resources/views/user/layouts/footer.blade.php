<footer class="rts-footer site-footer-four" style="padding: 50px">
    <div class="container position-relative z-1">
        <div class="row">
            <!-- widget -->
            @php
            $existingSettings = App\Models\Generalsettings::first();
            $dynamicpages = App\Models\Dynamic::first();
        @endphp
        
        <div class="col-lg-3 col-md-6 rts-footer__widget--column">
            <div class="rts-footer__widget footer__widget w-230">
                <p class="brand-desc address">
                    @if($existingSettings && $existingSettings->logo != null)
                                <a class="navbar-brand coustem-navbar-brand" style="height: 100% ; margin:0px;" href="{{route('admin.dashboard')}}"> <img src="{{ asset('admin/generalSetting/'.$existingSettings->logo)}}" style="height: 29px "alt=""></span>
                                </a>
                            @endif
                </p>
                <div class="separator site-default-border"></div>
        
                <div class="contact-method">
                    <a href="tel:{{ $existingSettings->mobile ?? '' }}">
                        <span><i class="fa-regular fa-phone"></i></span>
                        {{ $existingSettings->mobile ?? '' }}
                    </a>
                    <a href="mailto:{{ $existingSettings->email ?? '' }}">
                        <span><i class="fa-regular fa-envelope-open"></i></span>
                        {{ $existingSettings->email ?? '' }}
                    </a>
                </div>
            </div>
        </div>
        
            <!-- widget end -->
            <!-- widget -->
            <div class="col-lg-3 col-md-3 col-sm-4 rts-footer__widget--column">
                <div class="rts-footer__widget footer__widget extra-padding">
                    <h5 class="widget-title mb-4">Quick Links</h5>
                    <hr style="border: 1px solid white; ">
                    <div class="rts-footer__widget--menu ">
                        <ul>
                            @if($dynamicpages != null)
                            <li><a href="{{ route('page', ['slug' => $dynamicpages->slug]) }}">About Us</a></li>
                            @endif
                            <li><a href="{{route('contact')}}">Contact</a></li>
                            <li><a href="{{route('pricing')}}">Pricing</a></li>
                            <li><a href="{{route('terms.condition')}}">Terms & Conditions</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <!-- widget end -->
            <!-- widget -->
            <div class="col-lg-3 col-md-3 col-sm-4 rts-footer__widget--column">
                <div class="rts-footer__widget footer__widget extra-padding">
                    <h5 class="widget-title mb-4">Quick Links</h5>
                    <hr style="border: 1px solid white; ">
                    <div class="rts-footer__widget--menu ">
                        <ul>
                            <li><a href="{{route('faqs')}}">Faq</a></li>
                            <li><a href="{{route('blog')}}">Blog</a></li>
                            <li><a href="#testimonial">Testimonials</a></li>
                            <li><a href="{{route('privecy-policy')}}">Privacy Policy</a></li>
                        </ul>
                    </div>
                </div>
            </div>
            <div class="col-lg-3 col-md-6 rts-footer__widget--column no-margin">
                <div class="rts-footer__widget footer__widget">
                    <div class="social__media">
                        <h5 class="widget-title mb-4">Social media</h5>
                        <hr style="border: 1px solid white; ">
                        <div class="social__media--list">
                            <a href="{{ $existingSettings->facebook ?? '' }}" class="media"><i class="fa-brands fa-facebook-f"></i></a>
                            <a href="{{ $existingSettings->instagram ?? '' }}" class="media"><i class="fa-brands fa-instagram"></i></a>
                            <a href="{{ $existingSettings->linkedin ?? '' }}" class="media"><i class="fa-brands fa-linkedin"></i></a>
                            <a href="{{ $existingSettings->twitter ?? '' }}" class="media"><i class="fa-brands fa-x-twitter"></i></a>
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
            <div class="rts-footer__copyright-two__wrapper" style="display: flex; justify-content: center; align-items: center; width: 100%; text-align: center;">
                <p class="copyright">&copy; Copyright 2024. All Rights Reserved.</p>
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
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.7.1/jquery.min.js"></script>

<!-- All Plugin -->
<script src="{{ asset('user-assets/js/plugins.min.js') }}"></script>
<!-- main js -->
<script src="{{ asset('user-assets/js/main.js') }}"></script>
<!-- sweetalert js -->
<script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>
<script src="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.min.js"></script>

<!-- bootstrap js -->
<script src="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/js/bootstrap.min.js"></script>
<link href="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/css/select2.min.css" rel="stylesheet" />
<script src="https://cdn.jsdelivr.net/npm/select2@4.1.0-rc.0/dist/js/select2.min.js"></script>
<script>
    $(document).ready(function() {
    // Destroy any existing instances first
    if ($('#languageSelect').hasClass('select2-hidden-accessible')) {
        $('#languageSelect').select2('destroy');
    }
    if ($('#languageSelect').next('.nice-select').length) {
        $('#languageSelect').next('.nice-select').remove();
    }

    // Initialize Select2 when modal is shown
    $('#dropZoneModal').on('shown.bs.modal', function() {
        $('#languageSelect').select2({
            dropdownParent: $('#dropZoneModal'),
            width: '100%',
            placeholder: "Select language",
        });
    });

    // Clean up when modal is hidden
    $('#dropZoneModal').on('hidden.bs.modal', function() {
        if ($('#languageSelect').hasClass('select2-hidden-accessible')) {
            $('#languageSelect').select2('destroy');
        }
    });
}); 
</script>
@include('sweetalert::alert')
@stack('script')
@stack('modal')

</body>

</html>