 <!--HEADER INCLUDE-->
 @include('user.layouts.header')

 <!--TOPBAR INCLUDE-->
 @auth
    @include('user.layouts.navbar')
 @endauth

 <!--MAIN CONTENT -->
 @yield('content')

 <!--FOOTER INCLUDE-->
 @include('user.layouts.footer')