 <!-- BEGIN: sidebar Menu-->
 <div class="main-menu menu-fixed menu-light menu-accordion menu-shadow" data-scroll-to-active="true">
    <div class="navbar-header height-side-bar navbar-header-height">
        <ul class="nav navbar-nav flex-row h-100">
            <li class="nav-item me-auto h-100" style="margin: auto;">
                @php  $existingSettings = App\Models\Generalsettings::first(); @endphp
                @if($existingSettings && $existingSettings->logo != null)
                    <a class="navbar-brand" style="height: 100% ; margin:0px;" href="{{route('admin.dashboard')}}"> <img src="{{ asset('admin/generalSetting/'.$existingSettings->logo)}}" style="height: 50px "alt=""></span>
                        <h2 class="brand-text"></h2>
                    </a>
                @endif
            </li>
            <li class="nav-item nav-toggle">
                <a class="nav-link modern-nav-toggle pe-0" data-bs-toggle="collapse">
                    <i class="d-block d-xl-none text-primary toggle-icon font-medium-4" data-feather="x"></i>
                    <i class="d-none d-xl-block collapse-toggle-icon font-medium-4  text-primary" data-feather="disc" data-ticon="disc"></i>
                </a>
            </li>
        </ul>
    </div>
    <div class="shadow-bottom"></div>
    <div class="main-menu-content">
        <ul class="navigation navigation-main" id="main-menu-navigation" data-menu="menu-navigation">
            @can('admin.dashboard')
            <li class="@if ((request()->is('admin/dashboard'))) active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.dashboard') }}">
                    <i data-feather="home"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Dashboards')</span>
                </a>
            </li>
            @endcan

            <li class="@if ((request()->is('admin/customers')) || (request()->is('admin/customers/add')) || (request()->is('admin/customers/edit'))) active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.customers.list') }}">
                    <i class="fa-solid fa-users"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Customers">@lang('Customers')</span>
                </a>
            </li>

            <li class="@if ((request()->is('admin/proof-reader')) || (request()->is('admin/proof-reader/add')) || (request()->is('admin/proof-reader/edit'))) active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.proof-reader.list') }}">
                    <i class="fa-solid fa-chalkboard-user"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Proof Readers">@lang('Proof Readers')</span>
                </a>
            </li>

            <li class="@if ((request()->is('admin/package')) || (request()->is('admin/package/add')) || (request()->is('admin/package/edit'))) active @endif nav-item">
                <a class="d-flex align-items-center" href="{{ route('admin.package.list') }}">
                    <i class="fa-solid fa-cubes"></i>
                    <span class="menu-title text-truncate font-size-12px" data-i18n="Packages">@lang('Packages')</span>
                </a>
            </li>

            <li class=" nav-item">
                <a class="d-flex align-items-center" href="#">
                    <i data-feather="settings"></i>
                    <span class="menu-title text-truncate" data-i18n="Setting">Settings</span>
                </a>
                <ul class="menu-content">
                    <li class="@if (request()->is('admin/general-settings')) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.general.settings') }}">
                            <i data-feather="settings"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('General setting')</span>
                        </a>
                    </li>

                    <li class="@if ( (request()->is('admin/faq-list'))) active  @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.faq.list') }}">
                            <i data-feather="message-circle"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Faq">@lang('Faq')</span>
                        </a>
                    </li>
                    
                    <li class="@if (request()->is('admin/blog-list') || request()->is('admin/blog-form') || request()->is('admin/blog/edit*')) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.blog.list') }}">
                            <i data-feather="book"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Blog">@lang('Blog')</span>
                        </a>
                    </li>

                    <li class="@if ( (request()->is('admin/testimonial-list')) || (request()->is('admin/testimonial-form')) || (request()->is('admin/testimonial/edit*'))) active  @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.testimonial.list') }}">
                            <i data-feather="user"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Testimonial">@lang('Testimonial')</span>
                        </a>
                    </li>

                    <li class="@if ( (request()->is('admin/gallery-list'))) active  @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.gallery.list') }}">
                            <i data-feather="image"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Gallery">@lang('Gallery')</span>
                        </a>
                    </li>

                    <li class="@if ( (request()->is('admin/dynamic-list')) || (request()->is('admin/dynamic-add-form')) ||  (request()->is('admin/dynamic-edit*'))) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.dynamic.list') }}">
                            <i data-feather="square"></i>
                            <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Dynamic Content')</span>
                        </a>
                    </li>

                    <li class="@if (request()->is('admin/banner')) active @endif nav-item">
                        <a class="d-flex align-items-center" href="{{ route('admin.banner') }}">
                            <i class="fa fa-image"></i><span class="menu-title text-truncate font-size-12px" data-i18n="Banner">Banner</span>
                        </a>
                    </li>

                    <li class=" nav-item">
                        <a class="d-flex align-items-center" href="#">
                            <i data-feather="settings"></i>
                            <span class="menu-title text-truncate" data-i18n="Datatable">Setting permission</span>
                        </a>
                        <ul class="menu-content">
                            @can('admin.add-user-form')
                            <li class="@if (request()->is('admin/user-list') || request()->is('admin/add-user-form') || request()->is('admin/edit-user')) active @endif nav-item">
                                <a class="d-flex align-items-center" href="{{ route('admin.user-list') }}">
                                <i data-feather="user"></i>
                                <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Users')</span>
                                </a>
                            </li>
                            @endcan
        
                            @can('admin.roles')
                            <li class="@if (request()->is('admin/add-role*') || request()->is('admin/roles') || request()->is('admin/assign-permissions*')) active @endif nav-item">
                                <a class="d-flex align-items-center" href="{{ route('admin.roles') }}">
                                    <i data-feather="user-plus"></i>
                                    <span class="menu-title text-truncate font-size-12px" data-i18n="Dashboards">@lang('Roles')</span>
                                </a>
                            </li>
                            @endcan
                        </ul>
                    </li>
                </ul>
            </li>
        </ul>
    </div>
  </div>
   <!-- End: sidebar Menu-->
   