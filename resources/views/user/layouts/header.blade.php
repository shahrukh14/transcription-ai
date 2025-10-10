<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->

<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description" content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords" content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
    <meta name="author" content="PIXINVENT">
    <link rel="canonical" href="https://html.themewant.com/hostie">
    <meta name="robots" content="index, follow">
    <!-- for open graph social media -->
    <meta property="og:title" content="Hostie - Web Hosting & WHMCS Template">
    <meta property="og:description" content="Your Ultimate Solution for Web Hosting & WHMCS">
    <meta property="og:image" content="https://www.example.com/image.jpg">
    <meta property="og:url" content="https://html.themewant.com/hostie/">
    <!-- for twitter sharing -->
    <meta name="twitter:card" content="summary_large_image">
    <meta name="twitter:title" content="Hostie - Web Hosting & WHMCS Template">
    <meta name="twitter:description" content="Your Ultimate Solution for Web Hosting & WHMCS">
    <meta name="twitter:image" content="https://html.themewant.com/hostie/landing/assets/images/banner/slider-img-01.webp">
    <!-- favicon -->
    <link rel="shortcut icon" type="image/x-icon" href="{{ asset('user-assets/images/fav.png') }}">

    <title>@yield('title')</title>
    <!-- Preconnect to Google Fonts and Google Fonts Static -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,600;0,700;1,400;1,800&display=swap" rel="stylesheet">
    <!-- all styles -->
    <link rel="preload stylesheet" href="{{ asset('user-assets/css/plugins.min.css') }}" as="style">
    <!-- fontawesome css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/6.7.2/css/all.min.css" />

    <link href="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.13/css/select2.min.css" rel="stylesheet" />
    <!-- Bootstrap css -->
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/bootstrap/5.3.3/css/bootstrap.min.css" />
    <!-- Custom css -->
    <link rel="preload stylesheet" href="{{ asset('user-assets/css/style.css') }}" as="style">
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick.css" />
    <link rel="stylesheet" type="text/css" href="https://cdn.jsdelivr.net/npm/slick-carousel@1.8.1/slick/slick-theme.css" />
    <meta name="csrf-token" content="{{ csrf_token() }}" />

    <style>
        .swal2-popup.swal2-modal {
            font-size: 14px;
        }


      
        /* Style the visible select */
        .select2-selection {
            height: 38px !important;
            padding: 5px 10px !important;
            border: 1px solid #ced4da !important;
            border-radius: 4px !important;
        }


        /* Fix dropdown positioning */
        .select2-dropdown {
            z-index: 99999 !important;
        }
        #languageSelect .nice-select{
            display: none !important;
        }
    </style>
    @stack('style')
</head>
<!-- END: Head-->
<!-- BEGIN: Body-->

<body>
    <header class="rts-header header__with__bg header__default">
        <!-- HEADER TOP AREA END -->
        <div class="rts-menu">
            <div class="container">
                <div class="row">
                    <div class="rts-header__wrapper">
                        <!-- FOR LOGO -->
                        @php
                        $dynamicpages = App\Models\Dynamic::first();
                        $existingSettings = App\Models\Generalsettings::first();
                        @endphp
                        <div class="rts-header__logo mt-5">
                            <a href="{{ route('home') }}" class="site-logo">
                                @if($existingSettings && $existingSettings->logo != null)
                                <a class="navbar-brand coustem-navbar-brand" style="height: 100% ; margin:0px;" href="{{route('admin.dashboard')}}"> <img src="{{ asset('admin/generalSetting/'.$existingSettings->logo)}}" style="height: 29px " alt=""></span>
                                    <h2 class="brand-text"></h2>
                                </a>
                                @endif

                            </a>
                        </div>
                        <!-- FOR NAVIGATION MENU -->
                        <nav class="rts-header__menu" id="mobile-menu">
                            <div class="hostie-menu">
                                <ul class="list-unstyled hostie-desktop-menu">
                                    <li class="menu-item">
                                        <a href="{{ route('home') }}" class="hostie-dropdown-main-element">Home</a>
                                    </li>
                                    @if($dynamicpages != null)
                                    <li class="menu-item">
                                        <a href="{{ route('page', ['slug' => $dynamicpages->slug]) }}" class="hostie-dropdown-main-element">About Us</a>
                                    </li>
                                    @endif
                                    <li class="menu-item">
                                        <a href="{{ route('pricing') }}" class="hostie-dropdown-main-element">Pricing</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('faqs') }}" class="hostie-dropdown-main-element">FAQs</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('blog') }}" class="hostie-dropdown-main-element">Blog</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('contact') }}" class="hostie-dropdown-main-element">Contact Us</a>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                        <!-- FOR HEADER RIGHT -->
                        <div class="rts-header__right">
                            @auth
                            <a href="{{ route('user.logout') }}" class="login__btn">Logout</a>
                            @else
                            <a href="{{ route('login') }}" class="login__btn">Sign In</a>
                            @endauth
                            <button id="menu-btn" class="mobile__active menu-btn"><i class="fa-sharp fa-solid fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>