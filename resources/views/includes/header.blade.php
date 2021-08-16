<!-- BEGIN Page Header -->
<header class="page-header" role="banner">
    <!-- we need this logo when user switches to nav-function-top -->
    <div class="page-logo">
        <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
            <img src="{{ asset('img/png-01-01.png') }}" alt="SmartAdmin WebApp" aria-roledescription="logo">
            <span class="page-logo-text mr-1">MicroFinance</span>
            <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            <i class="fal fa-angle-down d-inline-block ml-1 fs-lg color-primary-300"></i>
        </a>
    </div>
    <!-- DOC: nav menu layout change shortcut -->
    <div class="hidden-md-down dropdown-icon-menu position-relative">
        <a href="#" class="header-btn btn js-waves-off" data-action="toggle" data-class="nav-function-hidden" title="Hide Navigation">
            <i class="ni ni-menu"></i>
        </a>
        <ul>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-minify" title="Minify Navigation">
                    <i class="ni ni-minify-nav"></i>
                </a>
            </li>
            <li>
                <a href="#" class="btn js-waves-off" data-action="toggle" data-class="nav-function-fixed" title="Lock Navigation">
                    <i class="ni ni-lock-nav"></i>
                </a>
            </li>
        </ul>
    </div>
    <!-- DOC: mobile button appears during mobile width -->
    <div class="hidden-lg-up">
        <a href="#" class="header-btn btn press-scale-down" data-action="toggle" data-class="mobile-nav-on">
            <i class="ni ni-menu"></i>
        </a>
    </div>
    <div class="ml-auto d-flex">
        <!-- activate app search icon (mobile) -->
        <div class="hidden-sm-up">
            <a href="#" class="header-icon" data-action="toggle" data-class="mobile-search-on" data-focus="search-field" title="Search">
                <i class="fal fa-search"></i>
            </a>
        </div>
        <div>

            <a href="#" data-toggle="dropdown" title="{{ Auth::user()->email }}" class="header-icon d-flex align-items-center justify-content-center ml-2">
                <img src="{{ asset('img/user-avatars-thumbnail.png') }}" class="profile-image rounded-circle" alt="Dr. Codex Lantern">
                <!-- you can also add username next to the avatar with the codes below:
                <span class="ml-1 mr-1 text-truncate text-truncate-header hidden-xs-down">Me</span>
                <i class="ni ni-chevron-down hidden-xs-down"></i> -->
            </a>
            <div class="dropdown-menu dropdown-menu-animated dropdown-lg">
                <div class="dropdown-header bg-trans-gradient d-flex flex-row py-4 rounded-top">
                    <div class="d-flex flex-row align-items-center mt-1 mb-1 color-white">
                        <span class="mr-2">
                            <img src="{{ asset('img/user-avatars-thumbnail.png') }}" class="rounded-circle profile-image" alt="Akko Global Tech">
                        </span>
                        <div class="info-card-text">
                            <nav class="navbar navbar-expand-md navbar-light">

                                <a> {{ Auth::user()->name }} </a>
                                {{-- <div class="container">
                                    <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                                        <span class="navbar-toggler-icon"></span>
                                    </button> --}}

                                    {{-- <div class="collapse navbar-collapse" id="navbarSupportedContent">
                                        <!-- Left Side Of Navbar -->
                                        <ul class="navbar-nav mr-auto">

                                        </ul>
                                        <!-- Right Side Of Navbar -->
                                        <ul class="navbar-nav ml-auto">
                                            <!-- Authentication Links -->

                                                <li class="nav-item dropdown">
                                                    <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                                        {{ Auth::user()->name }}
                                                    </a> --}}
                                                    {{-- <div class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">

                                                        @if (Auth::user()->role_id == getAdminRoleId())
                                                        <a class="dropdown-item" href="{{ route('category.index') }}">
                                                            Category
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('subCategory.index') }}">
                                                            SubCategory
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('insurance.index') }}">
                                                            Insurance
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('role.index') }}">
                                                            Role
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('user.index') }}">
                                                            User
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('customer.index') }}">
                                                            Customer
                                                        </a>
                                                        <a class="dropdown-item" href="{{ route('vehicle.index') }}">
                                                            vehicle
                                                        </a>
                                                        @endif

                                                            @if (Auth::user()->role->rights("category"))
                                                            <a class="dropdown-item" href="{{ route('category.index') }}">
                                                                Category
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->role->rights("subCategory"))
                                                            <a class="dropdown-item" href="{{ route('subCategory.index') }}">
                                                                SubCategory
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->role->rights("insurance"))
                                                            <a class="dropdown-item" href="{{ route('insurance.index') }}">
                                                                Insurance
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->role->rights("role"))
                                                            <a class="dropdown-item" href="{{ route('role.index') }}">
                                                                Role
                                                            </a>
                                                        @endif
                                                        @if (Auth::user()->role->rights("user"))
                                                            <a class="dropdown-item" href="{{ route('user.index') }}">
                                                                User
                                                            </a>
                                                        @endif
                                                        <a class="dropdown-item" href="{{ route('logout') }}"
                                                            onclick="event.preventDefault();
                                                                            document.getElementById('logout-form').submit();">
                                                            {{ __('Logout') }}
                                                        </a>

                                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                                            @csrf
                                                        </form>
                                                    </div> --}}
                                                {{-- </li>
                                        </ul>
                                    </div>
                                </div> --}}
                            </nav>
                            {{-- <div class="fs-lg text-truncate text-truncate-lg">Dr. Codex Lantern</div>
                            <span class="text-truncate text-truncate-md opacity-80">drlantern@gotbootstrap.com</span> --}}
                        </div>
                    </div>
                </div>

                {{-- <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-reset">
                    <span data-i18n="drpdwn.reset_layout">Reset Layout</span>
                </a>
                <a href="#" class="dropdown-item" data-toggle="modal" data-target=".js-modal-settings">
                    <span data-i18n="drpdwn.settings">Settings</span>
                </a>
                <div class="dropdown-divider m-0"></div>
                <a href="#" class="dropdown-item" data-action="app-fullscreen">
                    <span data-i18n="drpdwn.fullscreen">Fullscreen</span>
                    <i class="float-right text-muted fw-n">F11</i>
                </a>
                <a href="#" class="dropdown-item" data-action="app-print">
                    <span data-i18n="drpdwn.print">Print</span>
                    <i class="float-right text-muted fw-n">Ctrl + P</i>
                </a>
                <div class="dropdown-multilevel dropdown-multilevel-left">
                    <div class="dropdown-item">
                        Language
                    </div>
                    <div class="dropdown-menu">
                        <a href="#?lang=fr" class="dropdown-item" data-action="lang" data-lang="fr">Français</a>
                        <a href="#?lang=en" class="dropdown-item active" data-action="lang" data-lang="en">English (US)</a>
                        <a href="#?lang=es" class="dropdown-item" data-action="lang" data-lang="es">Español</a>
                        <a href="#?lang=ru" class="dropdown-item" data-action="lang" data-lang="ru">Русский язык</a>
                        <a href="#?lang=jp" class="dropdown-item" data-action="lang" data-lang="jp">日本語</a>
                        <a href="#?lang=ch" class="dropdown-item" data-action="lang" data-lang="ch">中文</a>
                    </div>
                </div> --}}
                {{-- <div class="dropdown-divider m-0"></div> --}}

                <a class="dropdown-item fw-500 pt-3 pb-3" href="{{ route('logout') }}"
                onclick="event.preventDefault();
                                document.getElementById('logout-form').submit();">
                {{ __('Logout') }}
                </a>

            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                @csrf
            </form>

            </div>
        </div>
    </div>
</header>
<!-- END Page Header -->
