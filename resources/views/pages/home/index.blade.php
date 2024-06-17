@extends('layouts.home.app')

@section('title', 'Dashboard')

@section('content')
    <!-- ======= Hero Section ======= -->
    <section id="hero" class="d-flex align-items-center">
        <div class="container position-relative text-center text-lg-start" data-aos="zoom-in" data-aos-delay="100">
            <div class="row">
                <div class="col-lg-8">
                    <h1>Selamat Datang di <span>The House Of Raminten</span></h1>
                    <h2>Memberikan makanan enak selama lebih dari 16 tahun!</h2>

                    <div class="btns">
                        <a href="#menu" class="btn-menu animated fadeInUp scrollto">Menu</a>
                        <a href="{{ route('customer.reservation') }}"
                            class="btn-book animated fadeInUp scrollto">Reservasi</a>
                    </div>
                </div>
                <div class="col-lg-4 d-flex align-items-center justify-content-center position-relative" data-aos="zoom-in"
                    data-aos-delay="200">
                    <a href="https://youtu.be/ECy7W-6TReU?si=nMjZvy_9oXM67W3E" class="glightbox play-btn"></a>
                </div>

            </div>
        </div>
    </section><!-- End Hero -->

    <main id="main">

        <!-- ======= About Section ======= -->
        <section id="about" class="about">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>Tentang</h2>
                    <p>Sejarah Raminten</p>
                </div>

                <div class="row">
                    <div class="col-lg-6 order-1 order-lg-2" data-aos="zoom-in" data-aos-delay="100">
                        <div class="about-img">
                            <img src="{{ asset('home/assets/img/tentang.jpg') }}" alt="">
                        </div>
                    </div>
                    <div class="col-lg-6 pt-4 pt-lg-0 order-2 order-lg-1 content">
                        <h3></h3>
                        <p class="fst-italic">
                            Nama Raminten di ambil dari sebuah peran Hamzah Sulaiman dalam acara komedi situasi di
                            sebuah stasiun televisi local (Jogja TV). Beliau memerankan sosok perempuan Jawa yg lengkap
                            dengan busana Jawa; berkebaya, memakai jarik dan berkonde. Dari peran itulah beliau memulai
                            dengan nama Raminten dan sosok yang sudah di kenal masyarakat saat ini.
                        </p>
                        <ul>
                            <li><i class="bi bi-check-circle"></i> Visinya adalah memberikan lapangan kerja, dalam hal
                                ini bergerak di dunia kuliner yang diharapkan meningkatkan kesejahteraan keluarga besar
                                The House of Raminten dalam semangat kekeluargaan.</li>
                            <li><i class="bi bi-check-circle"></i> Misinya turut serta memajukan pariwisata terutama
                                wisata kuliner di Yogyakarta. Dengan tetap berkonsisten mempertahankan budaya
                                tradisional khususnya jawa.</li>
                        </ul>
                    </div>
                </div>

            </div>
        </section><!-- End About Section -->

        <!-- ======= Blog Section ======= -->
        <section id="blog" class="blog">
            <div class="container" data-aos="fade-up">

                <div class="section-title">
                    <h2>The House Of Raminten</h2>
                    <p>Mengapa memilih restoran kami</p>
                </div>

                <div class="row">

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/1.jpg') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Destinasi Wisata Kuliner</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/patung1.png') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Patung Raminten</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/3.png') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Suasana Estetik</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/4.png') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Busana Waiter & Waiters</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/51.png') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Menu dan nama yang unik</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                    <div class="col-lg-4 col-md-6">
                        <div class="member" data-aos="zoom-in" data-aos-delay="100">
                            <img src="{{ asset('home/assets/img/6.png') }}" class="img-fluid" alt="">
                            <div class="member-info">
                                <div class="member-info-content">
                                    <h4>Nuansa budaya jawa</h4>
                                </div>
                                <div class="social">
                                    <a href="">Baca Selengkapnya</a>
                                </div>
                            </div>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Blog Section -->

        <!-- ======= Menu Section ======= -->
        <section id="menu" class="menu section-bg">
            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Daftar Menu</h2>
                    <p>Menu Spesial Kami</p>
                </div>

                <div class="row" data-aos="fade-up" data-aos-delay="100">
                    <div class="col-lg-12 d-flex justify-content-center">
                        <ul id="menu-flters">
                            <li data-filter="*" class="filter-active">Semua</li>
                            @foreach ($subcategory as $item)
                                <li data-filter=".filter-{{ $item->id_subcategory }}">{{ $item->name }}</li>
                            @endforeach
                        </ul>
                    </div>
                </div>

                <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
                    @foreach ($product as $item)
                        <div class="col-lg-6 menu-item filter-{{ $item->id_subcategory }}">
                            <img src="{{ asset('uploads/menu/' . $item->image) }}" class="menu-img" alt="">
                            <div class="menu-content">
                                <a href="#">{{ $item->name }}</a>
                                <span>Rp {{ number_format($item->price, 2, ',', '.') }}</span>
                            </div>
                            <div class="menu-ingredients">
                                {{ $item->description }}
                            </div>
                        </div>
                    @endforeach
                </div>


                {{-- <div class="menu-container tab-content" data-aos="fade-up" data-aos-delay="200">
                    <div class="row tab-pane fade show active" id="all" role="tabpanel" aria-labelledby="all-tab">
                        @foreach ($product as $item)
                            <div class="col-lg-6 col-md-6 col-sm-12 menu-item">
                                <img src="{{ asset('uploads/menu/' . $item->image) }}" class="menu-img" alt="">
                                <div class="menu-content">
                                    <a href="#">{{ $item->name }}</a><span>Rp.
                                        {{ number_format($item->price) }}</span>
                                </div>
                                <div class="menu-ingredients">
                                    {{ $item->description }}
                                </div>
                            </div>
                        @endforeach
                    </div>
                    <div class="tab-content">
                        @foreach ($subcategory as $item)
                            <div class="tab-pane fade" id="{{ $item->name }}" role="tabpanel"
                                aria-labelledby="{{ $item->name }}-tab">
                                <div class="row" style="padding: 0 15px">
                                    @foreach ($product as $product_item)
                                        @if ($product_item->subcategory->name === $item->name)
                                            <div class="col-lg-6 col-md-6 col-sm-12 mt-5">
                                                <img src="{{ asset('uploads/menu/' . $product_item->image) }}"
                                                    class="menu-img" alt="">
                                                <div class="menu-content">
                                                    <a href="#">{{ $product_item->name }}</a><span>Rp.
                                                        {{ number_format($product_item->price) }}</span>
                                                </div>
                                                <div class="menu-ingredients">
                                                    {{ $product_item->description }}
                                                </div>
                                            </div>
                                        @endif
                                    @endforeach
                                </div>
                            </div>
                        @endforeach
                    </div>

                </div> --}}
            </div>

            </div>
        </section><!-- End Menu Section -->

        <!-- ======= Gallery Section ======= -->
        <section id="gallery" class="gallery">

            <div class="container" data-aos="fade-up">
                <div class="section-title">
                    <h2>Gallery</h2>
                    <p>Some photos from Our Restaurant</p>
                </div>
            </div>

            <div class="container-fluid" data-aos="fade-up" data-aos-delay="100">

                <div class="row g-0">

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/3-1536x864.jpg') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/3-1536x864.jpg') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/6-1536x864.jpg.webp') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/6-1536x864.jpg.webp') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/2-1536x864.jpg.webp') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/2-1536x864.jpg.webp') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/5-1536x864.jpg.webp') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/5-1536x864.jpg.webp') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/4-1536x864.jpg.webp') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/4-1536x864.jpg.webp') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/7-1536x864.jpg.webp') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/7-1536x864.jpg.webp') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/3.jpg') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/3.jpg') }}" alt="" class="img-fluid">
                            </a>
                        </div>
                    </div>

                    <div class="col-lg-3 col-md-4">
                        <div class="gallery-item">
                            <a href="{{ asset('home/assets/img/gallery/3-1536x864.jpg') }}" class="gallery-lightbox"
                                data-gall="gallery-item">
                                <img src="{{ asset('home/assets/img/gallery/3-1536x864.jpg') }}" alt=""
                                    class="img-fluid">
                            </a>
                        </div>
                    </div>

                </div>

            </div>
        </section><!-- End Gallery Section -->

    </main><!-- End #main -->

    <script>
        document.addEventListener('DOMContentLoaded', function() {
            const menuTabs = document.querySelectorAll('#menu-tabs .nav-link');

            menuTabs.forEach(function(tab) {
                tab.addEventListener('click', function(event) {
                    event.preventDefault();
                    const tabId = this.getAttribute('href').substr(1);
                    const activeTabs = document.querySelectorAll('.tab-pane.show');

                    activeTabs.forEach(function(activeTab) {
                        activeTab.classList.remove('show', 'active');
                    });

                    document.getElementById(tabId).classList.add('show', 'active');
                    menuTabs.forEach(function(menuTab) {
                        menuTab.classList.remove('active');
                    });
                    this.classList.add('active');
                });
            });
        });
    </script>
@endsection
