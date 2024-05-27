<header>
    <div class="main-nav">
        <div class="logo">
            <img src="{{ asset('assets/images/logo/logo1.png') }}">
        </div>
        <div class="menu-toggle">
            <i class="fal fa-bars"></i>
        </div>
        <div class="menu">
            <ul>
                <li><a href="{{ route('home') }}">Home</a></li>
                <li><a href="{{ route('about') }}">About Us</a></li>
                <li><a href="{{ route('service') }}">Services</a></li>
                <li><a href="{{ route('contact') }}">Contact Us</a></li>

                <li class="login"><a href="{{ route('login') }}">Login</a></li>
            </ul>
        </div>
    </div>
</header>
