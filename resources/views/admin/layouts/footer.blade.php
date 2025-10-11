
<div class="sidenav-overlay"></div>
<div class="drag-target"></div>
<!-- END: Body-->

<!-- BEGIN: Footer-->
<footer class="footer footer-static footer-light text-center">
  <p class="clearfix mb-0"><span class="d-block d-md-inline-block mt-25">COPYRIGHT &copy; {{ date('Y') }}<a class="ms-25" href="" target="_blank">
    HealthEquations</a><span class="d-none d-sm-inline-block">, All rights Reserved</span></span></p>
</footer>
<button class="btn btn-primary btn-icon scroll-top" type="button"><i data-feather="arrow-up"></i></button>
<!-- END: Footer-->

<!-- BEGIN: Vendor JS-->
<script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
<!-- BEGIN Vendor JS-->

{{-- Begin Jquery --}}
{{-- <script src="{{asset('assets/jquery.min.js')}}"></script> --}}
<script src="https://ajax.googleapis.com/ajax/libs/jqueryui/1.13.0/jquery-ui.min.js"></script>
<!-- BEGIN: Page Vendor JS-->
{{-- <script src="{{asset('app-assets/vendors/js/charts/apexcharts.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/toastr.min.js')}}"></script> --}}
<!-- END: Page Vendor JS-->

<!-- BEGIN: Theme JS-->
<script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
<script src="{{asset('app-assets/js/core/app.js')}}"></script>
<!-- END: Theme JS-->
 <!-- CKEditor CDN -->
<script src="https://cdn.ckeditor.com/ckeditor5/41.4.2/classic/ckeditor.js"></script>
<!-- BEGIN: Page JS-->
{{-- <script src="{{asset('app-assets/js/scripts/pages/dashboard-ecommerce.js')}}"></script> --}}
<!-- END: Page JS-->

<!-- BEGIN: fontawesome JS-->
<script src="{{asset('assets/all.min.js')}}"></script>
<script src="{{asset('assets/popper.min.js')}}"></script>
<!-- END: fontawesome JS-->
<script src="{{asset('app-assets/js/scripts/forms/form-validation.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/pickers/flatpickr/flatpickr.min.js')}}"></script>

<!-- BEGIN:Custom Page JS-->
<script src="{{asset('assets/js/scripts.js')}}"></script>
<script src="{{asset('assets/js/graph.js')}}"></script>
<script src="{{asset('assets/js/chart.min.js')}}"></script> 
<script src="{{asset('app-assets/vendors/js/extensions/plyr.min.js')}}"></script>
<script src="{{asset('app-assets/vendors/js/extensions/plyr.polyfilled.min.js')}}"></script> 

<!-- END:Custom Page JS-->
<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
  <!-- BEGIN: Select2 JS-->
 <script src="{{asset('app-assets/vendors/js/forms/select/select2.full.min.js')}}"></script>
 <script src="{{asset('app-assets/js/scripts/forms/form-select2.js')}}"></script>
 <!-- END: Select2 JS-->
 <script src="{{asset('app-assets/vendors/js/forms/spinner/jquery.bootstrap-touchspin.js')}}"></script>
 <script src="{{asset('app-assets/js/scripts/pages/app-ecommerce-checkout.js')}}"></script>
 <script src="{{asset('app-assets/vendors/js/forms/repeater/jquery.repeater.min.js')}}"></script>
 <script src="{{asset('app-assets/js/scripts/forms/form-repeater.js')}}"></script>
 {{-- <script src="{{asset('app-assets/js/scripts/charts/chart-chartjs.js')}}"></script> --}}
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
</script>
@stack('modal')
<script src="https://cdnjs.cloudflare.com/ajax/libs/sweetalert/2.1.0/sweetalert.min.js"></script>
@include('sweetalert::alert')
@stack('script')
</body>
<!-- END: Body-->

</html>     

