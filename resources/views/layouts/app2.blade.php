<!doctype html>
<html lang="en">

<head>

    <!-- Required meta tags -->
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1, shrink-to-fit=no">
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>@yield('title')</title>

    <!-- Bootstrap CSS-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/bootstrap/css/bootstrap.css') }}">
    <!-- Style CSS (White)-->
    <link rel="stylesheet" href="{{ asset('/assets/css/White.css') }}">
    <!-- Style CSS (Dark)-->
    <link rel="stylesheet" href="{{ asset('/assets/css/Dark.css') }}">
    <!-- FontAwesome CSS-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/fontawesome/css/all.css') }}">
    <!-- Icon LineAwesome CSS-->
    <link rel="stylesheet" href="{{ asset('/assets/vendors/lineawesome/css/line-awesome.min.css') }}">

    <link  href="https://cdn.datatables.net/1.10.16/css/jquery.dataTables.min.css" rel="stylesheet">

</head>

<body>

    <!--Topbar -->
    <div class="topbar transition" style="z-index: 1">
        <div class="bars">
            <button type="button" class="btn transition" id="sidebar-toggle">
                <i class="las la-bars"></i>
            </button>
        </div>
        <div class="menu">

            <ul>

                <li>
                    <div class="theme-switch-wrapper">
                        <label class="theme-switch" for="checkbox">
                            <input type="checkbox" id="checkbox" title="Dark Or White" />
                            <div class="slider round"></div>
                        </label>
                    </div>
                </li>

                <li>
                    <a href="notifications.html" class="transition">
                        <i class="las la-bell"></i>
                        <span class="badge badge-danger notif">5</span>
                    </a>
                </li>

                <li>
                    <div class="dropdown">
                        <div class="dropdown-toggle" id="dropdownProfile" data-toggle="dropdown" aria-haspopup="true"
                            aria-expanded="false">
                            <img src="{{ asset('/assets/images/avatar/avatar-2.png') }}" alt="Profile">
                        </div>
                        <div class="dropdown-menu" aria-labelledby="dropdownProfile">

                            <a class="dropdown-item" href="{{ route('profil.admin') }}">
                                <i class="las la-user mr-2"></i> My Profile
                            </a>

                            <a class="dropdown-item" href="activity-log.html">
                                <i class="las la-list-alt mr-2"></i> Activity Log
                            </a>

                            <div class="dropdown-divider"></div>
                            <a class="dropdown-item" href="{{ route('logout') }}""
                                onclick=" event.preventDefault(); document.getElementById('logout-form').submit();">

                                <i class="las la-sign-out-alt mr-2"></i> Sign Out
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                @csrf
                            </form>
                        </div>
                    </div>
                </li>
            </ul>
        </div>
    </div>

    <!--Sidebar-->
    <div class="sidebar transition overlay-scrollbars">
        <div class="logo">
            <h2 style="font-weight: 700;" class="mb-0">DW<span style="font-weight: 500;">Admin</span></h2>
        </div>

        <div class="sidebar-items">
            <div class="accordion" id="sidebar-items">
                <ul>

                    <p class="menu">Menu</p>

                    <li>
                        <a href="{{ route('dashboard.admin') }}" class="items">
                            <i class="fa fa-tachometer-alt"></i>
                            <span>Dashboard</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pemesanan.admin') }}" class="items">
                            <i class="fa fa-clipboard"></i>
                            <span>Pemesanan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kendaraan.admin') }}" class="items">
                            <i class="fa fa-car-alt"></i>
                            <span>Kendaraan</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('kategori.admin') }}" class="items">
                            <i class="fa fa-list-alt"></i>
                            <span>Kategori</span>
                        </a>
                    </li>
                    <li>
                        <a href="{{ route('pengguna.admin') }}" class="items">
                            <i class="fa fa-user-alt"></i>
                            <span>Pengguna</span>
                        </a>
                    </li>
                    <li id="headingTwo">
                        <a href="onclick();" class="submenu-items" data-toggle="collapse" data-target="#collapseTwo"
                            aria-expanded="true" aria-controls="collapseTwo">
                            <i class="fas fa-book"></i>
                            <span>Laporan</span>
                            <i class="fas la-angle-right"></i>
                        </a>
                    </li>
                    <div id="collapseTwo" class="collapse submenu" aria-labelledby="headingTwo"
                        data-parent="#sidebar-items">
                        <ul>
                            <li>
                                <a href="{{ route('laporankendaraan.admin') }}">Kendaraan</a>
                            </li>

                            <li>
                                <a href="components-badge.html">Pemesanan</a>
                            </li>
                        </ul>
                    </div>

                    @role('super admin')
                    <li>
                        <a href="{{ route('admin.admin') }}" class="items">
                            <i class="fa fa-user"></i>
                            <span>Admin</span>
                        </a>
                    </li>


                    <p class="menu">Pengaturan</p>

                    <li id="headingOne">
                        <a href="onclick();" class="submenu-items" data-toggle="collapse" data-target="#collapseOne"
                            aria-expanded="true" aria-controls="collapseOne">
                            <i class="fas la-cog"></i>
                            <span>Pengaturan</span>
                            <i class="fas la-angle-right"></i>
                        </a>
                    </li>
                    <div id="collapseOne" class="collapse submenu" aria-labelledby="headingOne"
                    data-parent="#sidebar-items">
                    <ul>

                        <li>
                            <a href="{{ route('wa-index.admin') }}">Whatsapp</a>
                        </li>

                    </ul>
                </div>
                @endrole
                </ul>
            </div>
        </div>
    </div>

    <div class="sidebar-overlay"></div>

    <main>
        @yield('dashboard')
    </main>



    <!-- Footer -->
    <div class="footer transition">
        <hr>
        <p>
            &copy; 2020 All Right Reserved by <a href="#" target="_blank">DWAdmin</a>
        </p>
    </div>

    <!-- Loader -->
    <div class="loader">
        <div class="spinner-border text-light" role="status">
            <span class="sr-only">Loading...</span>
        </div>
    </div>

    <div class="loader-overlay"></div>

    <script src="https://unpkg.com/sweetalert/dist/sweetalert.min.js"></script>
    @include('sweet::alert')

    <!-- Library Javascipt-->
    <script src="{{ asset('assets/vendors/bootstrap/js/jquery.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/bootstrap.bundle.min.js') }}"></script>
    <script src="{{ asset('assets/vendors/bootstrap/js/popper.min.js') }}"></script>
    <script src="{{ asset('assets/js/script.js') }}"></script>
    <script src="{{ asset('assets/js/custom.js') }}"></script>
    <script src="https://cdn.datatables.net/1.10.16/js/jquery.dataTables.min.js"></script>
    <script src="https://code.jquery.com/ui/1.12.1/jquery-ui.min.js" integrity="sha256-VazP97ZCwtekAsvgPBSUwPFKdrwD3unUfSGVYrahUqU=" crossorigin="anonymous"></script>
</body>

</html>
