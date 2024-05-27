@extends('layouts.app')

@section('title', 'Contact')

@section('content')
    <main>
        <section class="abt">
            <div class="container">
                <div class="row">
                    <div class="col-12">
                        <div class="wrapper">
                            <h2>Contact Us</h2>
                            <ol>
                                <li>Home<i class="fal fa-long-arrow-right"></i></li>
                                <li>Contact Us</li>
                            </ol>
                        </div>
                    </div>
                </div>
            </div>
        </section>

        <section class="bg-0-b">
            <div class="container">
                <div class="row">
                    <div class="main-card-contact d-flex">
                        <div class="sup-card-contact">
                            <div class="sup-content">
                                <div class="head-content">
                                    <h2>Tuliskan Pesan Di Sini</h2>
                                    <p>Lorem ipsum dolor, sit amet consectetur adipisicing elit. A, neque ipsam obcaecati
                                        quis vitae odit aliquid libero sapiente possimus. Distinctio, qui voluptatibus </p>
                                </div>

                                <div class="contact-title">
                                    <h2>Detail Contact</h2>
                                    <ol>
                                        <li><i class="flaticon-placeholder"></i>Indonesia</li>
                                        <li><i class="flaticon-call"></i>+62 8123456789 </li>
                                        <li><i class="flaticon-email"></i>Raminten@gmail.com</li>
                                    </ol>
                                </div>
                            </div>
                        </div>

                        <div class="sup-card-contact-0a">
                            <div class="contact-a1">
                                <form>
                                    <div class="dived d-flex">
                                        <div class="form-group">
                                            <div class="form-sup">
                                                <div class="cal-01">
                                                    <input type="name" name="name" id="" class="form-control"
                                                        placeholder="Enter Your Name">

                                                </div>

                                                <div class="cal-01">
                                                    <input type="phone" name="phone" id="" class="form-control"
                                                        placeholder="Phone Number">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="form-group">
                                            <div class="form-sup">
                                                <div class="cal-01">
                                                    <input type="email" name="email" id="" class="form-control"
                                                        placeholder="Enter Your Email">

                                                </div>
                                                <div class="cal-01">
                                                    <input type="text" name="subject" id="" class="form-control"
                                                        placeholder="Enter Your Subject">

                                                </div>
                                            </div>
                                        </div>

                                        <div class="ca-ool">
                                            <textarea name="text" cols="80" rows="6" class="form-control" placeholder="Message"></textarea>
                                        </div>
                                    </div>
                                </form>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </section>
    </main>
@endsection
