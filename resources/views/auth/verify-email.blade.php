@extends('layouts.home.guest')

@section('title', 'Verify Success')

@section('content')
    <main>
        <div class="container">
            <section class="section register min-vh-100 d-flex flex-column align-items-center justify-content-center py-4">
                <div class="container">
                    <div class="row justify-content-center">
                        <div class="col-lg-4 col-md-6 d-flex flex-column align-items-center justify-content-center">
                            <div class="card mb-3">
                                <div class="card-body">
                                    <div class="d-flex justify-content-center py-4">
                                        <img src="{{ asset('home/assets/img/logo/logo.jpg') }}" alt="logo">
                                    </div>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Verify the email was sent successfully
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>

                                    <div class="col-12 mt-2">
                                        <a class="btn btn-light text-success w-100" href="{{ route('login') }}">
                                            Kembali</a>
                                    </div>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
