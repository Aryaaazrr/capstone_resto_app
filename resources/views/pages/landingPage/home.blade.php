@extends('layouts.app')

@section('title', 'Home')

@section('content')
    <main>
        <section class="slider">
            <div class="shap"></div>
            <div class="container">
                <div class="row">
                    <div class="col-md-6 col-sm-12">
                        <div class="wrapper">
                            <div class="content">
                                <h1>Raminten Resto</h1>
                                <p>Raminten Resto adalah sebuah restoran unik yang menggabungkan kelezatan masakan
                                    tradisional Indonesia dengan sentuhan gaya modern. Terletak di kota Yogyakarta, restoran
                                    ini telah menjadi ikon kuliner yang menarik perhatian wisatawan lokal maupun
                                    mancanegara.
                                    Dengan konsep yang unik ini, Raminten Resto tidak hanya menawarkan pengalaman kuliner,
                                    tetapi juga pengalaman budaya yang kaya, menjadikannya salah satu destinasi yang wajib
                                    dikunjungi saat berada di Yogyakarta.
                                </p>
                                <ol>
                                    <li><a href="/contact">Contact Us</a></li>
                                    <li><a href="/about">Read More</a></li>
                                </ol>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-6 col-sm-12">
                        <div class="wrapper">
                            <div class="image">
                                <img src="assets/images/banner/menu.jpg">
                            </div>
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

        <section class="feature-se">
            <div class="shap-01"></div>
            <div class="shap-02"></div>
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading">
                            <h2>layanan</h2>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ul>
                                    <li>
                                        <div class="image">
                                            <img src="assets/images/icons/ico-1.png">
                                        </div>
                                        <h3>Kualitas Makanan Terjaga</h3>
                                        <p>Lorem Ipsum
                                            available, but the majority have suffered alteration in some
                                            form, by injected humour</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ul>
                                    <li>
                                        <div class="image">
                                            <img src="assets/images/icons/ico-4.png">
                                        </div>
                                        <h3>Pelayanan Terjamin</h3>
                                        <p>Lorem Ipsum
                                            available, but the majority have suffered alteration in some
                                            form, by injected humour</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                    <div class="col-md-4 col-sm-6 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ul>
                                    <li>
                                        <div class="image">
                                            <img src="assets/images/icons/ico-6.png">
                                        </div>
                                        <h3>Pesananan Mudah dan Cepat</h3>
                                        <p>Lorem Ipsum
                                            available, but the majority have suffered alteration in some
                                            form, by injected humour</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="main-menu">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="heading">
                            <h2>Menu Raminten Resto</h2>
                        </div>
                    </div>
                </div>
                <div class="row">
                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ul>
                                    <li>
                                        <img src="assets/images/menu/1.jpg">
                                        <h4><strong>Songgo Langit</strong>
                                            <div class="line"></div><span>$29</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/2.jpg">
                                        <h4><strong>Nasi Tenong</strong>
                                            <div class="line"></div><span>$22</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/3.jpg">
                                        <h4><strong>Sekul Pangkon</strong>
                                            <div class="line"></div><span>$17</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/4.jpg">
                                        <h4><strong>Rantang Hayu</strong>
                                            <div class="line"></div><span>$40</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>

                    <div class="col-md-6 col-sm-12 col-xs-12">
                        <div class="wrapper">
                            <div class="content">
                                <ul>
                                    <li>
                                        <img src="assets/images/menu/5.jpg">
                                        <h4><strong>Nipis Madu</strong>
                                            <div class="line"></div><span>$23</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/6.jpg">
                                        <h4><strong>Lemon Tea</strong>
                                            <div class="line"></div><span>$18</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/7.jpg">
                                        <h4><strong>Teh</strong>
                                            <div class="line"></div><span>$25</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                    <li>
                                        <img src="assets/images/menu/8.jpg">
                                        <h4><strong>Jeruk</strong>
                                            <div class="line"></div><span>$10</span>
                                        </h4>
                                        <p>Lorem ipsum dolor sit amet, consectetur adipisicing elit.</p>
                                    </li>
                                </ul>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
