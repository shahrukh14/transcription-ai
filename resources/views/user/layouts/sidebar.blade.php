 <!-- BEGIN: sidebar Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header height-side-bar navbar-header-height">
        <ul class="nav navbar-nav flex-row h-100">
            <li class="nav-item me-auto h-100" style="margin: auto;"><a class="navbar-brand" style="height: 100% ; margin:0px;" href="{{route('admin.dashboard')}}"> <img src="{{asset('assets/img/arud_logo.png')}}" style="height: 100px "alt=""></span>
                    <h2 class="brand-text"></h2>
                </a></li>
            <li class="nav-item nav-toggle"><a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse"><i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i><i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i></a></li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            <li class="@if ((request()->is('user/dashboard'))) active @endif nav-item"><a class="d-flex align-items-center" href="{{ route('user.dashboard') }}"><i data-feather="home"></i><span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Dashboards')</span></a></li>
        </ul>
        
    </div>
  </div>
   <!-- End: sidebar Menu-->
   