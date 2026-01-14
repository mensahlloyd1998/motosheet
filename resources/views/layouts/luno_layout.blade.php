<!doctype html>
<html class="no-js " lang="en">
    <head>
        <meta charset="utf-8">
        <meta http-equiv="X-UA-Compatible" content="IE=Edge">
        <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
        <meta name="csrf-token" content="{{ csrf_token() }}">
        <title>{{ env('APP_NAME', 'SET_APP_NAME') }} | @yield('page_title')</title>
        
        <link rel="preconnect" href="https://fonts.googleapis.com">
        <link rel="preconnect" href="https://fonts.gstatic.com" crossorigin>
        <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.min.css">
        <link rel="icon" href="favicon.ico" type="image/x-icon"> <!-- Favicon-->
        <!-- Application vendor css url -->
        <link rel="stylesheet" href="{{ asset('/cssbundle/fullcalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/dataTables.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/jsgrid.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/summernote.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/dropify.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/select2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/sweetalert2.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/skedtape.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/cropper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/fancybox.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/daterangepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/bootstrapdatepicker.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/flatpickr.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/nouislider.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/rangeslider.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/jkanban.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/jquerysteps.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/x-editable.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/swiper.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/tuicalendar.min.css') }}">
        <link rel="stylesheet" href="{{ asset('/cssbundle/tabledragger.min.css') }}">
        <link rel="stylesheet" href="{{ asset('css/luno-style.css') }}">
        <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
        <!-- Jquery Core Js -->
        <script src="{{ asset('/js/plugins.js') }}"></script>
        <script src="https://cdn.jsdelivr.net/npm/sweetalert2@11"></script>

    </head>


    <body class="layout-1 gradient" data-luno="theme-orange">
        <!-- start: sidebar -->
        <div class="sidebar dark p-2 py-md-3 @@cardClass">
            <div class="container-fluid">
                <!-- sidebar: title-->
                <div class="title-text d-flex align-items-center mb-4 mt-1">
                    <h4 class="sidebar-title mb-0 flex-grow-1">
                        <img src="{{ asset('system_img/motosheet-logo.png') }}" width="200" alt="logo" class="logo-lg ">
                        <img src="{{ asset('system_img/motosheet-favicon.png') }}" alt="logo" class="logo-sm d-none ">
                    </h4>
                </div>
                
                <!-- sidebar: menu list -->
                    <div class="main-menu flex-grow-1">
                        <ul class="menu-list">
                            <li>
                                <a class="m-link" href="{{ route('dashboard') }}">
                                    <i class="bi bi-sliders2-vertical fs-6"></i>
                                    <span class="ms-2">Dashboard</span>
                                </a>
                            </li>

                            <li>
                                <a class="m-link" href="{{ route('cars.index') }}">
                                    <i class="bi bi-truck-front-fill fs-6"></i>
                                    <span class="ms-2">Vehicles</span>
                                </a>
                            </li>
<!-- 

                            <li>
                                <a class="m-link" href="{{ route('cars.index') }}">
                                    <i class="bi bi-cash fs-6"></i>
                                    <span class="ms-2">Offers</span>
                                </a>
                            </li> -->
                            
                        </ul>
                    </div>
                </div>
            </div>
        <!-- start: body area -->
        <div class="wrapper">
            <!-- start: page header -->
            <header class="page-header mb-0 sticky-top px-xl-4 px-sm-2 px-0 py-lg-2 py-1">
                <div class="container-fluid">
                    <nav class="navbar">
                        <!-- start: toggle btn -->
                        <div class="d-flex">
                            <button type="button" class="btn btn-link d-none d-xl-block sidebar-mini-btn p-0 text-primary">
                            <span class="hamburger-icon">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                            </span>
                            </button>
                            <button type="button" class="btn btn-link d-block d-xl-none menu-toggle p-0 text-primary">
                                <span class="hamburger-icon">
                                <span class="line"></span>
                                <span class="line"></span>
                                <span class="line"></span>
                                </span>
                            </button>
                        </div>
                        <!-- start: search area -->
                        <div class="header-left px-3 flex-grow-1 d-none d-md-block">
                            <h4>Business</h4>
                        </div>
                        <div class="ps-4 mx-auto d-md-none">
                            <img src="{{ asset('system_img/motosheet-logo.png') }}" width="100px" alt="logo">
                        </div>
                    <!-- start: link -->
                    <ul class="header-right justify-content-end d-flex align-items-center mb-0">
                        
                        <!-- start: Language dropdown-menu -->
                        <li class="d-none d-xl-inline-block">
                            <div class="dropdown morphing scale-left Language mx-sm-2">
                                <a class="nav-link dropdown-toggle after-none" href="#" role="button" data-bs-toggle="dropdown">
                                    <svg viewBox="0 0 16 16" width="18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                        <path class="fill-secondary" d="M4.545 6.714 4.11 8H3l1.862-5h1.284L8 8H6.833l-.435-1.286H4.545zm1.634-.736L5.5 3.956h-.049l-.679 2.022H6.18z" />
                                        <path d="M0 2a2 2 0 0 1 2-2h7a2 2 0 0 1 2 2v3h3a2 2 0 0 1 2 2v7a2 2 0 0 1-2 2H7a2 2 0 0 1-2-2v-3H2a2 2 0 0 1-2-2V2zm2-1a1 1 0 0 0-1 1v7a1 1 0 0 0 1 1h7a1 1 0 0 0 1-1V2a1 1 0 0 0-1-1H2zm7.138 9.995c.193.301.402.583.63.846-.748.575-1.673 1.001-2.768 1.292.178.217.451.635.555.867 1.125-.359 2.08-.844 2.886-1.494.777.665 1.739 1.165 2.93 1.472.133-.254.414-.673.629-.89-1.125-.253-2.057-.694-2.82-1.284.681-.747 1.222-1.651 1.621-2.757H14V8h-3v1.047h.765c-.318.844-.74 1.546-1.272 2.13a6.066 6.066 0 0 1-.415-.492 1.988 1.988 0 0 1-.94.31z" />
                                    </svg>
                                </a>
                                <div class="dropdown-menu rounded-4 shadow border-0 p-0" data-bs-popper="none">
                                    <div class="card">
                                        <div class="list-group list-group-custom" style="width: 200px;">
                                        <a href="#" class="list-group-item"><span class="flag-icon flag-icon-gb me-2"></span>UK English</a>
                                        <a href="#" class="list-group-item"><span class="flag-icon flag-icon-us me-2"></span>US English</a>
                                        <a href="#" class="list-group-item"><span class="flag-icon flag-icon-de me-2"></span>Germany</a>
                                        <a href="#" class="list-group-item"><span class="flag-icon flag-icon-in me-2"></span>Hindi</a>
                                        <a href="#" class="list-group-item"><span class="flag-icon flag-icon-sa me-2"></span>Saudi Arabia</a>
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </li>
                        
                        <!-- start: My notes toggle modal -->
                        <li class="d-none d-sm-inline-block d-xl-none">
                            <a class="nav-link" href="#" data-bs-toggle="modal" data-bs-target="#MynotesModal">
                                <svg viewBox="0 0 16 16" width="18px" fill="currentColor" xmlns="http://www.w3.org/2000/svg">
                                    <path class="fill-secondary" d="M1.5 0A1.5 1.5 0 0 0 0 1.5V13a1 1 0 0 0 1 1V1.5a.5.5 0 0 1 .5-.5H14a1 1 0 0 0-1-1H1.5z" />
                                    <path d="M3.5 2A1.5 1.5 0 0 0 2 3.5v11A1.5 1.5 0 0 0 3.5 16h6.086a1.5 1.5 0 0 0 1.06-.44l4.915-4.914A1.5 1.5 0 0 0 16 9.586V3.5A1.5 1.5 0 0 0 14.5 2h-11zM3 3.5a.5.5 0 0 1 .5-.5h11a.5.5 0 0 1 .5.5V9h-4.5A1.5 1.5 0 0 0 9 10.5V15H3.5a.5.5 0 0 1-.5-.5v-11zm7 11.293V10.5a.5.5 0 0 1 .5-.5h4.293L10 14.793z" />
                                </svg>
                            </a>
                        </li>
                        <!-- start: Recent Chat toggle modal -->
                        
                        <!-- start: quick light dark -->
                        
                        <!-- start: User dropdown-menu -->
                        <li>
                            <div class="dropdown morphing scale-left user-profile mx-lg-3 mx-2">
                                <a class="nav-link dropdown-toggle rounded-circle after-none p-0" href="#" role="button" data-bs-toggle="dropdown">
                                    <img class="avatar img-thumbnail rounded-circle shadow" src="{{ asset('system_img/user_placeholder.jpg') }}" alt="">
                                </a>
                                <div class="dropdown-menu border-0 rounded-4 shadow p-0">
                                    <div class="card border-0 w240">
                                        <div class="card-body border-bottom d-flex">
                                        <img class="avatar rounded-circle" src="{{ asset('system_img/user_placeholder.jpg') }}" alt="">
                                        <div class="flex-fill ms-3">
                                            <h6 class="card-title mb-0">{{ auth()->user()->name }}</h6>
                                            <span class="text-muted cstm-fs-12 fw-light">{{ auth()->user()->email }}</span>
                                        </div>
                                        </div>
                                        <div class="list-group m-2 mb-3">
                                        <a class="list-group-item list-group-item-action border-0" href="{{ route('profile.edit') }}">
                                            <i class="bi bi-gear fs-6 me-3"></i>Account Settings
                                        </a>
                                        </div>
                                        <a href="{{ route('logout') }}" onclick="event.preventDefault();document.getElementById('logout-form').submit();" class="btn bg-secondary text-light text-uppercase rounded-0">Sign out</a>
                                    </div>
                                </div>
                            </div>
                        </li>
                    </ul>
                    </nav>
                </div>
            </header>
            <!-- start: page toolbar -->
            
            <div class="page-toolbar px-xl-4 px-sm-2 px-0  pt-3">
                <div class="container-fluid">

                    <div class="row g-3 mb-3 align-items-center">
                    @yield('breadcrumb')
                    </div> <!-- .row end -->
                    <div class="row align-items-center">
                    @yield('page_details')
                    </div> <!-- .row end -->
                </div>
            </div>
            <!-- start: page body -->
            <div class="page-body px-xl-4 px-sm-2 px-0 py-lg-2 py-1 mt-0">
                <div class="container-fluid mt-0">

                @yield('content')
                
                </div>
            </div>
            <!-- start: page footer -->
            <footer class="page-footer px-xl-4 px-sm-2 px-0 py-3">
                <div class="container-fluid d-flex flex-wrap justify-content-between align-items-center">
                    <!--<p class="col-md-4 mb-0 text-muted">tendledger
                    <a href="#" class="col-md-4 d-flex align-items-center justify-content-center my-3 my-lg-0 me-lg-auto">
                    
                    </a>-->
                    <ul class="nav col-md-4 justify-content-center justify-content-lg-end">
                    <!--<li class="nav-item"><a href="https://themeforest.net/user/wrraptheme/portfolio" target="_blank" class="nav-link px-2 text-muted">Portfolio</a></li>
                    <li class="nav-item"><a href="https://themeforest.net/licenses/standard" target="_blank" class="nav-link px-2 text-muted">licenses</a></li>
                    <li class="nav-item"><a href="https://help.market.envato.com/hc/en-us" target="_blank" class="nav-link px-2 text-muted">Support</a></li>
                    <li class="nav-item"><a href="https://themeforest.net/licenses/faq" target="_blank" class="nav-link px-2 text-muted">FAQs</a></li>-->
                    </ul>
                </div>
            </footer>
        </div>
    
        @yield('modals')
        
        <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
        @csrf
        </form>
        <!-- Jquery Core Js -->
        <script src="{{ asset('/js/theme.js') }}"></script>
        @yield('scripts')

    </body>


</html>