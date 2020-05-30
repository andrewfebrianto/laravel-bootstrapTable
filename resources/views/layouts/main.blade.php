<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1.0, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">
    <title>Laravel CoreUI - @yield("title")</title>

    <link rel="stylesheet" href="{{asset('css/coreui.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/free.min.css')}}">    
    <link rel="stylesheet" href="{{asset('css/sweetalert2.min.css')}}">
    <link rel="stylesheet" href="{{asset('fontawesome_5.12.1/css/all.min.css')}}">
    <link rel="stylesheet" href="{{asset('css/toastr.min.css')}}">
    @yield('cssLibrary')
    <link rel="stylesheet" href="{{asset('css/style.css')}}">
</head>

<body class="c-app">
    <!-- SIDEBAR -->
    <div class="c-sidebar c-sidebar-dark c-sidebar-fixed c-sidebar-lg-show" id="sidebar">
        <div class="c-sidebar-brand d-lg-down-none">
            <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                <use xlink:href="{{asset('img/coreui.svg#full')}}"></use>
            </svg>
            <svg class="c-sidebar-brand-minimized" width="46" height="46" alt="CoreUI Logo">
                <use xlink:href="{{asset('img/coreui.svg#signet')}}"></use>
            </svg>
        </div>
        <ul class="c-sidebar-nav">
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{ url('')}}">
                    <i class="c-sidebar-nav-icon cil-speedometer"></i> Dashboard
                </a>
            </li>
            <li class="c-sidebar-nav-title">Data Master</li>
            <li class="c-sidebar-nav-item">
                <a class="c-sidebar-nav-link" href="{{url('/products')}}">
                    <i class="c-sidebar-nav-icon cil-address-book"></i> Data Product
                </a>
            </li>
        </ul>
        <button class="c-sidebar-minimizer c-class-toggler" type="button" data-target="_parent"
            data-class="c-sidebar-minimized"></button>
    </div>
    <div class="c-wrapper">
        <!-- TOPBAR -->
        <header class="c-header c-header-light c-header-fixed c-header-with-subheader">
            <a class="c-header-brand d-lg-none pl-3" href="#">
                <svg class="c-sidebar-brand-full" width="118" height="46" alt="CoreUI Logo">
                    <use xlink:href="{{asset('img/coreui.svg#full')}}"></use>
                </svg>
            </a>

            <ul class="c-header-nav ml-auto mr-4">
                <li class="c-header-nav-item">
                    <button class="c-header-toggler c-class-toggler d-lg-none" type="button" data-target="#sidebar"
                        data-class="c-sidebar-show"><i class="cil-menu"></i>
                    </button>
                </li>
                <li class="c-header-nav-item dropdown">
                    <!-- PROFILE -->
                    <a class="c-header-nav-link" data-toggle="dropdown" href="#" role="button" aria-haspopup="true"
                        aria-expanded="false">
                        <div class="c-avatar"><img class="c-avatar-img" src="{{asset('img/6.jpg')}}"
                                alt="user@email.com"></div>
                    </a>
                    <div class="dropdown-menu dropdown-menu-right pt-0">
                        <div class="dropdown-header bg-light py-2">
                            <strong>Akun</strong>
                        </div>
                        <a class="dropdown-item" href="../myprofile/completed.html">
                            <i class="c-icon mfe-2 cil-user"></i>Profil
                        </a>
                        <a class="dropdown-item" href="../../admin/users/change_password.html">
                            <i class="c-icon mfe-2 cil-lock-locked"></i>Ubah Password
                        </a>
                        <a class="dropdown-item" href="../../select_role.html">
                            <i class="c-icon mfe-2  cil-swap-horizontal"></i>Ubah Hak akses
                        </a>
                        <div class="dropdown-divider"></div>
                        <a class="dropdown-item" href="../../index.html">
                            <i class="c-icon mfe-2 cil-account-logout"></i>Logout
                        </a>
                    </div>
                </li>
            </ul>
            <div class="c-subheader px-3">
                <!-- BREADCRUMB -->
                @yield("breadcrumb")
            </div>
        </header>

        <div class="c-body">
            <main class="c-main">
                <div class="container-fluid">
                    <div class="fade-in">
                        <!-- CONTENT -->
                        @yield("content")
                    </div>
                </div>
            </main>
        </div>

        <footer class="c-footer">
            <div><a href="https://coreui.io">CoreUI</a> &copy; 2020 creativeLabs.</div>
            <div class="ml-auto">Powered by&nbsp;<a href="https://coreui.io/">CoreUI</a></div>
        </footer>
    </div>

    <script src="{{asset('js/jquery-3.4.1.min.js')}}"></script>
    <script src="{{asset('js/coreui.bundle.min.js')}}"></script>
    <script src="{{asset('js/sweetalert2.min.js')}}"></script>
    <script src="{{asset('js/toastr.min.js')}}"></script>
    @yield("jsLibrary")
    <script src="{{asset('js/app.js')}}"></script>
    
    @if(session('success'))
        <script>toastr.success('{{ session('success') }}');</script>
    @endif
    
    @yield("scriptJS")
</body>

</html>
