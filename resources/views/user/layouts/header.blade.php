<!DOCTYPE html>
<html class="loading" lang="en" data-textdirection="ltr">
<!-- BEGIN: Head-->


<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width,initial-scale=1.0,user-scalable=0,minimal-ui">
    <meta name="description"
        content="Vuexy admin is super flexible, powerful, clean &amp; modern responsive bootstrap 4 admin template with unlimited possibilities.">
    <meta name="keywords"
        content="admin template, Vuexy admin template, dashboard template, flat admin template, responsive admin template, web app">
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

    <title>Hostie - Web Hosting & WHMCS Template</title>
    <!-- Preconnect to Google Fonts and Google Fonts Static -->
    <link rel="preconnect" href="https://fonts.googleapis.com">
    <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>

    <!-- Importing Google Fonts -->
    <link href="https://fonts.googleapis.com/css2?family=Inter:wght@200;300;400;500;600;700;800&display=swap" rel="stylesheet">
    <link href="https://fonts.googleapis.com/css2?family=Plus+Jakarta+Sans:ital,wght@0,500;0,600;0,700;1,400;1,800&display=swap" rel="stylesheet">
    <!-- all styles -->
    <link rel="preload stylesheet" href="{{ asset('user-assets/css/plugins.min.css') }}" as="style">
    <!-- fontawesome css -->
    <link rel="preload stylesheet" href="{{ asset('user-assets/css/plugins/fontawesome.min.css') }}" as="style">
    <!-- Custom css -->
    <link rel="preload stylesheet" href="{{ asset('user-assets/css/style.css') }}" as="style">
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
                        <div class="rts-header__logo">
                            <a href="{{ route('home') }}" class="site-logo">
                                <img class="logo-white" src="{{ asset('user-assets/images/logo/logo-1.svg') }}" alt="Hostie">
                                <img class="logo-dark" src="{{ asset('user-assets/images/logo/logo-4.svg') }}" alt="Hostie">
                            </a>
                        </div>
                        <!-- FOR NAVIGATION MENU -->

                        <nav class="rts-header__menu" id="mobile-menu">
                            <div class="hostie-menu">
                                <ul class="list-unstyled hostie-desktop-menu">
                                    <li class="menu-item">
                                        <a href="{{ route('pricing') }}" class="hostie-dropdown-main-element">Pricing</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('faqs') }}" class="hostie-dropdown-main-element">FAQs</a>
                                    </li>
                                    <li class="menu-item">
                                        <a href="{{ route('blog') }}" class="hostie-dropdown-main-element">Blog</a>
                                    </li>

                                </ul>
                            </div>
                        </nav>
                        <!-- FOR HEADER RIGHT -->
                        <div class="rts-header__right">
                            <a href="{{ route('sign.in') }}" class="login__btn">Sign In</a>
                            <button id="menu-btn" class="mobile__active menu-btn"><i class="fa-sharp fa-solid fa-bars"></i></button>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </header>