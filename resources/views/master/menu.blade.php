<aside id="layout-menu" class="layout-menu menu-vertical menu bg-menu-theme">
    <div class="app-brand demo">
        <a @if(session('student'))
               href="{{route('students')}}"
           @else
               href="{{route('home1')}}"
        @endif class="app-brand-link">
              <span class="app-brand-logo demo">
                <img
                    src="{{ asset("assets/img/elements/BKACAD.png") }}"
                    alt="Credit Card"
                    class="rounded"
                    width="130"
                    height="35"
                />

              </span>
{{--            <span class="app-brand-text demo menu-text fw-bolder ms-2">Sneat School</span>--}}
        </a>

        <a href="javascript:void(0);" class="layout-menu-toggle menu-link text-large ms-auto d-block d-xl-none">
            <i class="bx bx-chevron-left bx-sm align-middle"></i>
        </a>
    </div>

    <div class="menu-inner-shadow"></div>

    <ul class="menu-inner py-1">
        <!-- Dashboard -->
       @if(session('employee')||session('admin'))
        <li class="menu-item ">
            <a href="{{route('home1')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-home-circle"></i>
                <div data-i18n="Analytics">Dashboard</div>
            </a>
        </li>
        @endif

        <li class="menu-header small text-uppercase">
            <span class="menu-header-text">Classes</span>
        </li>
        <li class="menu-item ">
            <a href="{{route('mj')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-meteor"></i>
                <div data-i18n="Analytics">Majors</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{route('course')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-key"></i>
                <div data-i18n="Analytics">Course</div>
            </a>
        </li>
        <li class="menu-item ">
            <a href="{{route('class')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-group"></i>
                <div data-i18n="Analytics">Class</div>
            </a>
        </li>
        @if(session('admin'))
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Employee Management</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{route('employee')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Employees</div>
            </a>
        </li>
        @endif
        <!-- Components -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Student Management</span></li>
        <!-- Cards -->
        <li class="menu-item">
            <a href="{{route('students')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-user"></i>
                <div data-i18n="Basic">Students</div>
            </a>
        </li>
        @if(session('admin'))
        <li class="menu-item">
            <a href="{{route('scholarship')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-money"></i>
                <div data-i18n="Basic">Scholarship</div>
            </a>
        </li>
        @endif

        <!-- Forms & Tables -->
        <li class="menu-header small text-uppercase"><span class="menu-header-text">Tuition payment</span></li>
        <!-- Forms -->
{{--        <li class="menu-item">--}}
{{--            <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
{{--                <i class="menu-icon tf-icons bx bx-detail"></i>--}}
{{--                <div data-i18n="Form Elements">Form Elements</div>--}}
{{--            </a>--}}
{{--            <ul class="menu-sub">--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="../forms-basic-inputs.html" class="menu-link">--}}
{{--                        <div data-i18n="Basic Inputs">Basic Inputs</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="../forms-input-groups.html" class="menu-link">--}}
{{--                        <div data-i18n="Input groups">Input groups</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
{{--        <li class="menu-item">--}}
{{--            <a href="javascript:void(0);" class="menu-link menu-toggle">--}}
{{--                <i class="menu-icon tf-icons bx bx-detail"></i>--}}
{{--                <div data-i18n="Form Layouts">Form Layouts</div>--}}
{{--            </a>--}}
{{--            <ul class="menu-sub">--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="../form-layouts-vertical.html" class="menu-link">--}}
{{--                        <div data-i18n="Vertical Form">Vertical Form</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--                <li class="menu-item">--}}
{{--                    <a href="../form-layouts-horizontal.html" class="menu-link">--}}
{{--                        <div data-i18n="Horizontal Form">Horizontal Form</div>--}}
{{--                    </a>--}}
{{--                </li>--}}
{{--            </ul>--}}
{{--        </li>--}}
        <!-- Tables -->
        <li class="menu-item">
            <a href="{{route('invoice')}}" class="menu-link">
                <i class="menu-icon tf-icons bx bx-table"></i>
                <div data-i18n="Tables">Invoices</div>
            </a>
        </li>
        <!-- Misc -->
{{--        <li class="menu-header small text-uppercase"><span class="menu-header-text">Misc</span></li>--}}
{{--        <li class="menu-item">--}}
{{--            <a--}}
{{--                href="https://github.com/themeselection/sneat-html-admin-template-free/issues"--}}
{{--                target="_blank"--}}
{{--                class="menu-link"--}}
{{--            >--}}
{{--                <i class="menu-icon tf-icons bx bx-support"></i>--}}
{{--                <div data-i18n="Support">Support</div>--}}
{{--            </a>--}}
{{--        </li>--}}
{{--        <li class="menu-item">--}}
{{--            <a--}}
{{--                href="https://themeselection.com/demo/sneat-bootstrap-html-admin-template/documentation/"--}}
{{--                target="_blank"--}}
{{--                class="menu-link"--}}
{{--            >--}}
{{--                <i class="menu-icon tf-icons bx bx-file"></i>--}}
{{--                <div data-i18n="Documentation">Documentation</div>--}}
{{--            </a>--}}
{{--        </li>--}}
    </ul>
</aside>
<!-- / Menu -->

<!-- Layout container -->
<div class="layout-page">
    <!-- Navbar -->

    <nav
        class="layout-navbar container-xxl navbar navbar-expand-xl navbar-detached align-items-center bg-navbar-theme"
        id="layout-navbar"
    >
        <div class="layout-menu-toggle navbar-nav align-items-xl-center me-3 me-xl-0 d-xl-none">
            <a class="nav-item nav-link px-0 me-xl-4" href="javascript:void(0)">
                <i class="bx bx-menu bx-sm"></i>
            </a>
        </div>

        <div class="navbar-nav-right d-flex align-items-center" id="navbar-collapse">
            <!-- Search -->
            @if(session('student')&&session('search') == 6)
            @elseif(session('search') == 0)
            @else
            <div class="navbar-nav align-items-center">
                <div class="nav-item d-flex align-items-center">
                    <i class="bx bx-search fs-4 lh-0"></i>
                    <form action="{{route('search')}}" method="POST">
                        @csrf
                        <input type="hidden" name="_method" value="PUT">
                        <input
                            value=""
                            name="search"
                            type="text"
                            class="form-control border-0 shadow-none"
                            @if(session('search') == 1)
                                placeholder="Input name major.."
                            @elseif(session('search') == 2)
                                placeholder="Input name course.."
                            @elseif(session('search') == 3)
                                placeholder="Input name class.."
                            @elseif(session('search') == 4)
                                placeholder="Input name student.."
                            @elseif(session('search') == 5)
                                placeholder="Input Price.."
                            @elseif(session('search') == 6)
                                placeholder="Input name student.."
                            @elseif(session('search') == 7)
                                placeholder="Input name employee.."
                            @endif

                            aria-label="Search..."
                        />
                    </form>

                </div>
            </div>
            @endif
            <!-- /Search -->

            <ul class="navbar-nav flex-row align-items-center ms-auto">
                <!-- Place this tag where you want the button to render. -->


                <!-- User -->
                <li class="nav-item navbar-dropdown dropdown-user dropdown">
                    <a class="nav-link dropdown-toggle hide-arrow" href="javascript:void(0);" data-bs-toggle="dropdown">
                        <div class="avatar avatar-online">
                            <img src="{{asset("assets/img/avatars/img.png")}}" alt class="w-px-40 h-auto rounded-circle" />
                        </div>
                    </a>
                    <ul class="dropdown-menu dropdown-menu-end">
                        <li>
                            <a class="dropdown-item" href="#">
                                <div class="d-flex">
                                    <div class="flex-shrink-0 me-3">
                                        <div class="avatar avatar-online">
                                            <img src="{{asset("assets/img/avatars/img.png")}}" alt class="w-px-40 h-auto rounded-circle" />
                                        </div>
                                    </div>
                                    @if(session('employee'))
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block" value="">{{session('employee.e_Name')}}</span>
                                            <small class="text-muted">Employees</small>
                                        </div>
                                    @elseif(session('student'))
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block" value="">{{session('student.s_Name')}}</span>
                                            <small class="text-muted">Student</small>
                                        </div>
                                    @elseif(session('admin'))
                                        <div class="flex-grow-1">
                                            <span class="fw-semibold d-block" value="">{{session('admin.a_Name')}}</span>
                                            <small class="text-muted">Admin</small>
                                        </div>
                                    @endif
                                </div>
                            </a>
                        </li>
                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        @if(session('admin'))
                        @else
                            <li>

                                <a class="dropdown-item" href="{{route('profile')}}">
                                    <i class="bx bx-user me-2"></i>
                                    <span class="align-middle">My Profile</span>
                                </a>
                            </li>
                        @endif


                        <li>
                            <div class="dropdown-divider"></div>
                        </li>
                        <li>
                            <a class="dropdown-item" href="{{route('logout')}}">
                                <i class="bx bx-power-off me-2"></i>
                                <span class="align-middle">Log Out</span>
                            </a>
                        </li>
                    </ul>
                </li>
                <!--/ User -->
            </ul>
        </div>
    </nav>

    <!-- / Navbar -->

    <!-- Content wrapper -->
