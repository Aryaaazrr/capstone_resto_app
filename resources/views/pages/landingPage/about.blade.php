@extends('layouts.home.app')

@section('title', 'About')

@section('content')
    <main>
        <section class="abt">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper">
                            <h2>About Us</h2>
                            <ol>
                                <li>Home<i class="fal fa-long-arrow-right"></i></li>
                                <li>About Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-01">
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="wrapper">
                            <div class="content">
                                <ol>
                                    <li><img src="assets/images/abt/1.jpg"></li>
                                    <li><img src="assets/images/abt/2.jpg"></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="wrapper">
                            <div class="content">
                                <h5>Selamat Datang Di</h5>
                                <h1>Raminten Resto</h1>
                                <p>Di Raminten Resto, pengunjung dapat menikmati berbagai hidangan khas Indonesia seperti
                                    gudeg, nasi kucing, sate, dan aneka sambal, semua disajikan dengan presentasi yang
                                    estetis dan modern. Selain makanan, restoran ini juga menawarkan hiburan berupa
                                    pertunjukan musik tradisional dan modern yang menambah daya tariknya.</p>
                                <p>Restoran ini juga dikenal dengan pelayanannya yang ramah dan profesional, mencerminkan
                                    keramahan khas Yogyakarta. Dengan konsep yang unik dan beragam, Raminten Resto tidak
                                    hanya menawarkan kelezatan kuliner, tetapi juga pengalaman budaya yang kaya,
                                    menjadikannya destinasi yang wajib dikunjungi saat berada di Yogyakarta.</p>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="offer-01">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading">
                            <h2>Menu<span>Favorite</span></h2>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="wrapper">
                            <div class="image">
                                <img src="assets/images/abt/600-400.jpg">
                                <div class="inner-content">
                                    <ol>
                                        <li>
                                            <h1>Makan Di Raminten Resto</h1>
                                            <!-- <h3>20% <span>off</span></h3> -->
                                            <p>Dijamin Pasti enak dan Mantap</p>
                                            <a>Pesan Sekarang</a>
                                        </li>
                                    </ol>
                                </div>
                            </div>
                        </div>
                    </div>
                    <div class="col-xl-6 col-lg-6 col-md-6 col-sm-12 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ol>
                                    <li>
                                        <img src="assets/images/abt/6.jpg">
                                        <h4>Songgo Langit<span>$30</span></h4>
                                        <p>Tumpeng Khas Yogyakarta Dengan Style Modern</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/abt/4.jpg">
                                        <h4>Nasi Tenong<span>$45</span></h4>
                                        <p>Nasi Yang Di Kukus Dengan Varian Lauk Yang Berbeda Beda</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/abt/5.jpg">
                                        <h4>Sekul Pangkon<span>$20</span></h4>
                                        <p>Nasi Ayam Kremes Ala Ala Tradisional</p>
                                    </li>
                                </ol>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
