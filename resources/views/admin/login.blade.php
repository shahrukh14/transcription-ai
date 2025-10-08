<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta http-equiv="Content-Type" content="text/html; charset=UTF-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <title>Login Page </title>
    <link rel="apple-touch-icon" href="{{asset('app-assets/images/ico/apple-icon-120.png')}}">
    @php
    $existingSettings = App\Models\Generalsettings::first(); 
    @endphp
    @if($existingSettings && $existingSettings->icon != null)
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('admin/icon/'.$existingSettings->icon) }}">
    @endif
    <link href="https://fonts.googleapis.com/css2?family=Montserrat:ital,wght@0,300;0,400;0,500;0,600;1,400;1,500;1,600" rel="stylesheet">

     <!-- BEGIN: Vendor CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset('app-assets/vendors/css/vendors.min.css')}}">
     <!-- END: Vendor CSS-->

      <!-- BEGIN: Theme CSS-->
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/bootstrap-extended.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/colors.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/components.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/dark-layout.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/bordered-layout.css')}}">
      <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/themes/semi-dark-layout.css')}}">
      
      <!-- BEGIN: Page CSS-->
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/core/menu/menu-types/vertical-menu.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/plugins/forms/form-validation.css')}}">
    <link rel="stylesheet" type="text/css" href="{{asset('app-assets/css/pages/authentication.css')}}">
    <!-- END: Page CSS-->

     <!-- BEGIN: Custom CSS-->
     <link rel="stylesheet" type="text/css" href="{{asset('assets/css/style.css')}}">
     <!-- END: Custom CSS-->

</head>
<!-- END: Head-->

<!-- BEGIN: Body-->

<body class="vertical-layout vertical-menu-modern blank-page navbar-floating footer-static  " data-open="click" data-menu="vertical-menu-modern" data-col="blank-page">
    <!-- BEGIN: Content-->
    <div class="app-content content ">
        <div class="content-overlay"></div>
        <div class="header-navbar-shadow"></div>
        <div class="content-wrapper">
            <div class="content-header row">
            </div>
            <div class="content-body">
                <div class="auth-wrapper auth-cover">
                    <div class="auth-inner row m-0">
                        <!-- Brand logo--><a class="brand-logo" href="/">
                        @if($existingSettings && $existingSettings->logo != null)
                         <img src="{{ asset('admin/generalSetting/'.$existingSettings->logo)}}" class="d-none d-lg-block d-xl-block" style="height:90px" alt="">
                        @endif
                        </a>
                        <!-- /Brand logo-->
                        <!-- Left Text-->
                        <div class="d-none d-lg-flex col-lg-8 align-items-center p-5">
                            <div class="w-100 d-lg-flex align-items-center justify-content-center px-5"><img class="img-fluid" src="{{asset('app-assets/images/pages/login-v2.svg')}}" alt="Login V2" /></div>
                        </div>
                        <!-- /Left Text-->
                        <!-- Login-->
                        <div class="d-flex col-lg-4 align-items-center auth-bg px-2 p-lg-5">
                            <div class="col-12 col-sm-8 col-md-6 col-lg-12 px-xl-2 mx-auto">
                                {{-- <h3 class="card-title fw-bold mb-1">Welcome to ARUD</h3> --}}
                                @if(Session::has('message'))
                                <p class="alert {{ Session::get('alert-class', 'alert-info') }} text-center fs-3" >{{ Session::get('message') }}</p>
                                @endif
                                <div class="d-flex justify-content-center align-items-center mb-3">
                                @if($existingSettings && $existingSettings->logo != null)
                                    <img src="{{ asset('admin/generalSetting/'.$existingSettings->logo)}}" class="m-auto" style="height:120px" alt="">
                                @endif
                                </div>
                                <h2 class="card-text mb-2">ADMIN LOGIN</h2>

                                {{-- Form Start --}}
                                @error('failed')
                                <div class="alert alert-danger">  </div>
                                @enderror
                                <form  action="{{route('admin.login-details-submit')}}" method="POST" novalidate>
                                  @csrf
                                    <div class="mb-1">
                                        <label class="form-label" for="email">Email</label>
                                        <input class="form-control"   id="login-email" type="email" name="email" aria-describedby="login-email" autofocus="" tabindex="1" required />
                                    </div>
                                    <div class="mb-1">
                                        <div class="d-flex justify-content-between">
                                            <label class="form-label" for="login-password" >Password</label><a href="{{route('admin.forgot.password')}}"><small>Forgot Password?</small></a>
                                        </div>
                                        <div class="input-group input-group-merge form-password-toggle">
                                            <input class="form-control form-control-merge" id="login-password" type="password" name="password" placeholder="" aria-describedby="login-password" tabindex="2" required/><span class="input-group-text cursor-pointer"><i data-feather="eye" ></i></span>
                                        </div>
                                    </div>
                                      {{-- dropdown start --}}
                                      <!-- <div class="mb-1">
                                        <label class="form-label" for="role">Choose Your Role</label>
                                        <select class="form-select" id="role" name="roles" onchange="choosedrole(value)" required>
                                          <option value>Select Role</option>
                                          <option value="1">Admin</option>
                                          <option value="2">User</option>
                                        </select>
                                      </div> -->
                                     
                                    {{-- dropdown end --}}
                                    <div class="mb-1">
                                        <!-- <div class="form-check">
                                            <input class="form-check-input" name="remember_me" value="1" id="remember-me" type="checkbox" tabindex="3" />
                                            <label class="form-check-label" for="remember-me"> Remember Me</label>
                                        </div> -->
                                    </div>
                              
                                    <button class="btn btn-primary custom-bg-color w-100"  type="submit" tytabindex="4">Sign in</button>
                                    
                                </form>
                               {{-- Form End --}}
                               
                              
                            </div>
                        </div>
                        <!-- /Login-->
                    </div>
                </div>
            </div>
        </div>
    </div>
    <!-- END: Content-->


    <!-- BEGIN: Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/vendors.min.js')}}"></script>
    <!-- BEGIN Vendor JS-->

    
    <!-- BEGIN: Page Vendor JS-->
    <script src="{{asset('app-assets/vendors/js/forms/validation/jquery.validate.min.js')}}"></script>
    <!-- END: Page Vendor JS-->

     <!-- BEGIN: Theme JS-->
     <script src="{{asset('app-assets/js/core/app-menu.js')}}"></script>
     <script src="{{asset('app-assets/js/core/app.js')}}"></script>
     <!-- END: Theme JS-->
     
 <!-- BEGIN: Form Validation  JS-->
    <script src="{{asset('app-assets/js/scripts/pages/auth-login.js')}}"></script>
    <script src="{{asset('app-assets/js/scripts/forms/form-validation.js')}}"></script>
    <!-- END: Form validation JS-->


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

    <script>
        // function choosedrole(rolevalue) {
        //     if (rolevalue==1) {
        //         $("form").attr("action","/adminlogin");
        //     }
        //     else if (rolevalue==2){
        //         $("form").attr("action","/cliniclogin");
        //     }
        //     else if (rolevalue==3){
        //         $("form").attr("action","/clinicstafflogin");
        //     }
        //     else {
        //         $("form").attr("action","");
        //     }
        // }
    </script>
    @include('sweetalert::alert')
</body>
<!-- END: Body-->

</html>