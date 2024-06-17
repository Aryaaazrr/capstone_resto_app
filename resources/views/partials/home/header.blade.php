    <!-- ======= Top Bar ======= -->
    <div id="topbar" class="d-flex align-items-center fixed-top">
        <div class="container d-flex justify-content-center justify-content-md-between">

            <div class="contact-info d-flex align-items-center">
                <i class="bi bi-phone d-flex align-items-center"><span>+62 899-9555-522</span></i>
                <i class="bi bi-clock d-flex align-items-center ms-4"><span> Open Every Day: 9AM - 12PM</span></i>
            </div>

            <div class="languages d-none d-md-flex align-items-center">

            </div>
        </div>
    </div>

    <!-- ======= Header ======= -->
    <header id="header" class="fixed-top d-flex align-items-cente">
        <div class="container-fluid container-xl d-flex align-items-center justify-content-lg-between">

            <h1 class="logo me-auto me-lg-0"><a href="">Raminten Resto</a></h1>
            <!-- Uncomment below if you prefer to use an image logo -->
            <!-- <a href="index.html" class="logo me-auto me-lg-0"><img src="assets/img/logo.png" alt="" class="img-fluid"></a>-->

            <nav id="navbar" class="navbar order-last order-lg-0">
                <ul>
                    @if (request()->is('dashboard') || request()->is('/'))
                        <li><a class="nav-link scrollto active" href="#hero">Beranda</a></li>
                        <li><a class="nav-link scrollto" href="#about">Tentang</a></li>
                        <li><a class="nav-link scrollto" href="#blog">Blog</a></li>
                        <li class="dropdown"><a class="nav-link scrollto" href="#menu"><span>Menu</span> <i
                                    class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li class="dropdown"><a href="#"><span>Menu Makanan</span> <i
                                            class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Menu Utama</a></li>
                                        <li><a href="#">Menu Dessert</a></li>
                                        <li><a href="#">Menu Lauk</a></li>
                                        <li><a href="#">Menu Snack</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>Menu Minuman</span> <i
                                            class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Juss & Smoothies</a></li>
                                        <li><a href="#">Dingin Menyegarkan</a></li>
                                        <li><a href="#">Panas Menghangatkan</a></li>
                                        <li><a href="#">Hot & Cold</a></li>
                                    </ul>
                                </li>
                                <li class="dropdown"><a href="#"><span>Menu Paket Raminten</span> <i
                                            class="bi bi-chevron-right"></i></a>
                                    <ul>
                                        <li><a href="#">Menu Paket Reguler</a></li>
                                        <li><a href="#">Menu Paket Reservasi</a></li>
                                    </ul>
                                </li>
                                <li><a href="#">Kaos Raminten</a></li>
                            </ul>
                        </li>
                        <li><a class="nav-link scrollto" href="#gallery">Galeri</a></li>
                    @endif
                    @if (Auth::user())
                        <li class="dropdown"><a class="nav-link scrollto" href="">
                                <span>{{ Auth::user()->name }}</span> <i class="bi bi-chevron-down"></i></a>
                            <ul>
                                <li><a href="{{ route('customer.index') }}">Home</a></li>
                                <li><a href="{{ route('customer.reservation') }}">Reservasi</a></li>
                                <li><a href="{{ route('customer.order') }}">Riwayat</a></li>
                                <li><a href="{{ route('logout') }}">Logout</a></li>
                            </ul>
                        </li>
                    @else
                        <li><a class="nav-link scrollto" href="{{ route('login') }}">Login</a></li>
                    @endif
                </ul>
                <i class="bi bi-list mobile-nav-toggle"></i>
            </nav>

        </div>
    </header><!-- End Header -->
