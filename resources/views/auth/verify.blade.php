@extends('layouts.home.guest')

@section('title', 'Verify')

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
                                        <img src="{{ asset('assets/images/logo/logo.jpg') }}" alt="logo">
                                    </div>

                                    <div class="alert alert-success alert-dismissible fade show" role="alert">
                                        Enter your email for verification
                                        <button type="button" class="btn-close" data-bs-dismiss="alert"
                                            aria-label="Close"></button>
                                    </div>
                                    {!! session('msg') !!}
                                    <form action="{{ route('verify.process') }}" method="POST"
                                        class="row g-3 needs-validation pt-4" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control " id="email"
                                                    placeholder="Email" required>
                                                <div class="invalid-feedback">Please enter your email!</div>
                                            </div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button class="btn btn-success w-100" type="submit">Send Email</button>
                                        </div>
                                    </form>

                                </div>
                            </div>
                        </div>
                    </div>
                </div>
            </section>
        </div>
    </main>
@endsection
