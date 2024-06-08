@extends('layouts.home.guest')

@section('title', 'Register')

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

                                    @if ($errors->any())
                                        <div class="font-normal p-2 text-red-950 mt-3 bg-red-300 rounded-md">
                                        </div>
                                        <div class="alert alert-danger alert-dismissible text-white" role="alert">
                                            <ul class="list-disc list-inside">
                                                @foreach ($errors->all() as $error)
                                                    <li>{{ $error }}</li>
                                                @endforeach
                                            </ul>
                                            <button type="button" class="btn-close text-lg py-3 " data-bs-dismiss="alert"
                                                aria-label="Close">
                                            </button>
                                        </div>
                                    @endif

                                    <form action="{{ route('register.process') }}" method="POST"
                                        class="row g-3 needs-validation pt-4" novalidate>
                                        @csrf
                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <input type="text" name="name" class="form-control " id="name"
                                                    placeholder="Name" required>
                                                <div class="invalid-feedback">Please enter your name!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <div class="input-group has-validation">
                                                <input type="email" name="email" class="form-control " id="email"
                                                    placeholder="Email" required>
                                                <div class="invalid-feedback">Please enter your email!</div>
                                            </div>
                                        </div>

                                        <div class="col-12">
                                            <input type="password" name="password" class="form-control" id="yourPassword"
                                                placeholder="Password" required>
                                            <div class="invalid-feedback">Please enter your password!</div>
                                        </div>

                                        <div class="col-12">
                                            <input type="password" name="confirm-password" class="form-control"
                                                id="yourPassword" placeholder="Confirm Password" required>
                                            <div class="invalid-feedback">Please enter your confirm password!</div>
                                        </div>

                                        <div class="col-12 mt-4">
                                            <button class="btn btn-success w-100" type="submit">Register</button>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <a class="btn btn-light text-success w-100"
                                                href="{{ route('google-login') }}"><i class="bi bi-google"></i>
                                                Register With Google</a>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Already have an account? <a
                                                    href="{{ route('login') }}">Login
                                                    Now</a></p>
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
