@extends('layouts.home.app')

@section('title', 'Reservasi')

@section('content')
    <main id="main">
        <section class="breadcrumbs">
            <div class="container">

                <div class="d-flex justify-content-between align-items-center">
                    <h2>Reservasi</h2>
                    <ol>
                        @if (Auth::user())
                            <li><a href="{{ route('customer.index') }}">Home</a></li>
                        @else
                            <li><a href="{{ route('home') }}">Home</a></li>
                        @endif
                        <li>Reservasi</li>
                    </ol>
                </div>

            </div>
        </section>

        <section class="inner-page">
            <!-- ======= Menu Section ======= -->
            <section id="menu" class="menu section-bg">
                <div class="container" data-aos="fade-up">

                    <div class="section-title">
                        <h2>Daftar Menu</h2>
                        <p>Menu Paket Reservasi</p>
                    </div>

                    <div class="row" data-aos="fade-up" data-aos-delay="100">
                        <div class="col-lg-12 d-flex justify-content-center">
                            <ul id="menu-flters">
                                <li data-filter="*" class="filter-active">Semua</li>
                                <li data-filter=".filter-ijen">Paket Ijen</li>
                                <li data-filter=".filter-kembulan">Paket Kembulan</li>
                            </ul>
                        </div>
                    </div>

                    <div class="row menu-container" data-aos="fade-up" data-aos-delay="200">
                        @foreach ($products as $item)
                            <div
                                class="col-lg-6 menu-item {{ $item->packageType == 'Paket Ijen' ? 'filter-ijen' : ($item->packageType == 'Paket Kembulan' ? 'filter-kembulan' : '') }}">
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

                </div>
            </section><!-- End Menu Section -->

            <div class="container">
                <form action="{{ route('customer.reservation.process') }}" method="POST" id="reservation-form">
                    @csrf
                    <!-- ======= Why Us Section ======= -->
                    <section id="why-us" class="why-us">
                        <div class="container" data-aos="fade-up">

                            <div class="section-title">
                                <h2>Paket Reservasi</h2>
                                <p>Silahkan pilih menu dari kami</p>
                            </div>

                            <div class="row">
                                <div class="col-md-6 d-flex justify-content-center">
                                    <div data-aos="zoom-in" data-aos-delay="100">
                                        <h3 class="text-center mb-4">Paket Ijen</h3>
                                        <div class="col">
                                            @foreach ($products as $item)
                                                @if ($item->packageType == 'Paket Ijen')
                                                    <div class="form-group d-flex justify-content-between my-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $item->id_product }}" id="flexCheckDefault"
                                                                name="paket_{{ $item->id_product }}">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $item->name }}
                                                            </label>
                                                            <input class="form-control-sm bl-4" type="number"
                                                                min="10" name="qty_{{ $item->id_product }}"
                                                                placeholder="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>

                                <div class="col-md-6 d-flex justify-content-center">
                                    <div data-aos="zoom-in" data-aos-delay="100">
                                        <h3 class="text-center mb-4">Paket Kembul</h3>
                                        <div class="col">
                                            @foreach ($products as $item)
                                                @if ($item->packageType == 'Paket Kembulan')
                                                    <div class="form-group d-flex justify-content-between my-2">
                                                        <div class="form-check">
                                                            <input class="form-check-input" type="checkbox"
                                                                value="{{ $item->id_product }}" id="flexCheckDefault"
                                                                name="paket_{{ $item->id_product }}">
                                                            <label class="form-check-label" for="flexCheckDefault">
                                                                {{ $item->name }}
                                                            </label>
                                                            <input class="form-control-sm bl-4" type="number"
                                                                min="1" name="qty_{{ $item->id_product }}"
                                                                placeholder="0">
                                                        </div>
                                                    </div>
                                                @endif
                                            @endforeach
                                        </div>
                                    </div>
                                </div>
                            </div>
                        </div>
                    </section><!-- End Why Us Section -->

                    <!-- ======= Book A Table Section ======= -->
                    <section id="book-a-table" class="book-a-table">
                        <div class="container" data-aos="fade-up">

                            <div class="section-title">
                                <h2>Reservasi</h2>
                                <p>Pesan Meja</p>
                            </div>


                            <div class="row">
                                <div class="col-lg-4 col-md-6 form-group">
                                    <input type="text" name="name" class="form-control" id="name"
                                        placeholder="Nama" data-rule="minlen:4"
                                        data-msg="Silakan masukkan setidaknya 4 karakter" value="{{ Auth::user()->name }}"
                                        readonly required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                                    <input type="email" class="form-control" name="email" id="email"
                                        placeholder="Email" data-rule="email" data-msg="Tolong masukkan email yang benar"
                                        value="{{ Auth::user()->email }}" readonly required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3 mt-md-0">
                                    <input type="text" class="form-control" name="phone" id="phone"
                                        placeholder="No. WhatsApp" data-rule="minlen:9"
                                        data-msg="Silakan masukkan setidaknya 9 karakter" required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="date" name="date" class="form-control" id="date"
                                        placeholder="Date" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                        required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="time" class="form-control" name="time" id="time"
                                        placeholder="Time" data-rule="minlen:4" data-msg="Please enter at least 4 chars"
                                        required>
                                    <div class="validate"></div>
                                </div>
                                <div class="col-lg-4 col-md-6 form-group mt-3">
                                    <input type="number" class="form-control" name="people" id="people"
                                        placeholder="# of people" min="1" data-rule="minlen:1"
                                        data-msg="Please enter at least 1 chars" required>
                                    <div class="validate"></div>
                                </div>
                            </div>
                            <div class="form-group mt-3">
                                <textarea class="form-control" name="message" rows="5" placeholder="Message"></textarea>
                                <div class="validate"></div>
                            </div>
                            <div class="text-center">
                                <button type="submit" class="btn" id="pay-button">Daftar Reservasi</button>
                            </div>

                        </div>
                    </section>
                </form>

            </div>
        </section>

    </main>

    @if (session('success'))
        <script>
            Swal.fire({
                icon: 'success',
                title: 'Success',
                text: '{{ session('success') }}'
            });
        </script>
    @endif
    @if ($errors->any())
        <script>
            Swal.fire({
                icon: 'error',
                title: 'Oopss...',
                text: '{{ $errors->first() }}'
            });
        </script>
    @endif

@endsection
