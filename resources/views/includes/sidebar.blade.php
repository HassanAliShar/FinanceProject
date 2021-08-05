    <!-- BEGIN Left Aside -->
    <aside class="page-sidebar">
        <div class="page-logo">
            <a href="#" class="page-logo-link press-scale-down d-flex align-items-center position-relative" data-toggle="modal" data-target="#modal-shortcut">
                <img src="{{ asset('public/img/'.getLogo()) }}" alt="Akko Global Tech" aria-roledescription="logo">
                <span class="page-logo-text mr-1">{{ Auth::user()->name }}</span>
                <span class="position-absolute text-white opacity-50 small pos-top pos-right mr-2 mt-n2"></span>
            </a>
        </div>


    <!-- BEGIN PRIMARY NAVIGATION -->
    <nav id="js-primary-nav" class="primary-nav" role="navigation">
        <div class="nav-filter">
            <div class="position-relative">
                <input type="text" id="nav_filter_input" placeholder="Filter menu" class="form-control" tabindex="0">
                <a href="#" onclick="return false;" class="btn-primary btn-search-close js-waves-off" data-action="toggle" data-class="list-filter-active" data-target=".page-sidebar">
                    <i class="fal fa-chevron-up"></i>
                </a>
            </div>
        </div>
        {{--  --}}

        @if (Auth::user()->role_id == getDirectorRoleId())
            <ul id="js-nav-menu" class="nav-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        {{-- <i class="fal fa-backpack"></i> --}}
                        <i class="fal fa-home"></i>
                        <span class="nav-link-text" data-i18n="nav.Complaints Reports">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-clipboard-user"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Staff</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.staff') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.staff') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-user-cog"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Managers</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.manager') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.manager') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-album"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Borrower</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.borrower') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.borrower') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.borrower') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-envelope-open-text"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-hand-holding-usd"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Loans</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.loan') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.loan') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.loan') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-envelope-open-text"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested Loans</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.schdule') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-calendar-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested Schdules</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.payment') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-credit-card"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested Payments</span>
                            </a>
                        </li>

                    </ul>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-cog"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Settrings</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('setting.page') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-tools"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Site Settings</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('setting.db.backup') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-backpack"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Backup</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
        @if (Auth::user()->role_id == getManagerRoleId())
            <ul id="js-nav-menu" class="nav-menu">
                <li>
                    <a href="{{ route('admin.dashboard') }}" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-home"></i>
                        <span class="nav-link-text" data-i18n="nav.Complaints Reports">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-album"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Borrower</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.b.approve') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.b.approve') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.b.approve') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-envelope-open-text"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">My Requested</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <li>
                    <a href="#" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-hand-holding-usd"></i>
                        <span class="nav-link-text" data-i18n="nav.Vehicles Reports">Loan</span>
                    </a>
                    <ul>
                        <li>
                            <a href="{{ route('add.mg.loan') }}" title="General Complains" data-filter-tags="Vehicles Reports General Complains">
                                <i class="fal fa-plus-circle"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports General Complains">Add</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('manage.mg.loan') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-tasks-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Manage</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.mg.loan') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-envelope-open-text"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('requested.mg.schdule') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-calendar-alt"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested Schdules</span>
                            </a>
                        </li>
                        <li>
                            <a href="{{ route('request.mg.payment') }}" title="Customer Complains" data-filter-tags="Vehicles Reports Customer Complains">
                                <i class="fal fa-credit-card"></i>
                                <span class="nav-link-text" data-i18n="nav.Vehicles Reports Customer Complains">Requested Payment</span>
                            </a>
                        </li>
                    </ul>
                </li>
            </ul>
        @endif
        @if (Auth::user()->role_id == getStaffRoleId())
            <ul id="js-nav-menu" class="nav-menu">
                <li>
                    <a href="" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-home"></i>
                        <span class="nav-link-text" data-i18n="nav.Complaints Reports">Dashboard</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.borrower') }}" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-album"></i>
                        <span class="nav-link-text" data-i18n="nav.Complaints Reports">Borrowers</span>
                    </a>
                </li>
                <li>
                    <a href="{{ route('staff.loan.manage') }}" title="Complaints Reports" data-filter-tags="Complaints Reports">
                        <i class="fal fa-hand-holding-usd"></i>
                        <span class="nav-link-text" data-i18n="nav.Complaints Reports">Loans</span>
                    </a>
                </li>
            </ul>
        @endif


    </nav>
    </aside>


