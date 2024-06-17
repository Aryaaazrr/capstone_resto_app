@extends('layouts.home.guest')

@section('title', 'Login')

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

                                    @if (session('success'))
                                        <div class="alert alert-success alert-dismissible text-white" role="alert">
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
                                    @if ($errors->any())
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
                                    {!! session('msg') !!}
                                    <form action="{{ route('login.process') }}" method="POST"
                                        class="row g-3 needs-validation pt-2" novalidate>
                                        @csrf
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

                                        <div class="col-12 my-2">
                                            {{-- <p class="small mb-0 text-end"><a href="" class="text-success">Forgot
                                                    Password
                                                    ?</a>
                                            </p> --}}
                                        </div>

                                        <div class="col-12 mt-2">
                                            <button class="btn btn-success w-100" type="submit">Login</button>
                                        </div>
                                        <div class="col-12 mt-2">
                                            <a class="btn btn-light text-success w-100"
                                                href="{{ route('google-login') }}"><i class="bi bi-google"></i>
                                                Login With Google</a>
                                        </div>
                                        <div class="col-12">
                                            <p class="small mb-0">Don't have account? <a
                                                    href="{{ route('register') }}">Create
                                                    an account</a></p>
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
