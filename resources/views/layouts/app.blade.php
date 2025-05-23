<!DOCTYPE html>
<html lang="en">

<head>
    <meta charset="UTF-8">
    <title>AventureTrip</title>
    <meta name="viewport" content="width=device-width, initial-scale=1">

    {{-- ✅ CSS --}}
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
    <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

    <style>
        body {
            font-family: 'Segoe UI', sans-serif;
        }

        .navbar-brand img {
            height: 40px;
            width: auto;
            margin-right: 12px;
        }

        .navbar-nav .nav-link {
            font-size: 1.2rem;
            font-weight: 500;
        }

        .navbar-nav .nav-link.active,
        .navbar-nav .nav-link:focus,
        .navbar-nav .nav-link:hover {
            color: #0d6efd !important;
        }

        footer img.footer-illustration {
            position: absolute;
            bottom: 0;
            right: 0;
            max-height: 220px;
            z-index: 0;
            pointer-events: none;
        }
    </style>
</head>

<body>

    <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm px-4" style="min-height:72px;">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="/">
        <img src="{{ asset('storage/assets/logo.png') }}" alt="AventureTrip Logo" style="height: 40px;" class="me-2">
        <span class="fs-3 text-primary ms-1">AventureTrip</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav"
        aria-controls="navbarNav" aria-expanded="false" aria-label="Toggle navigation">
        <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
        <ul class="navbar-nav gap-lg-3">
            <li class="nav-item"><a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('tours*') ? 'active' : '' }}" href="{{ route('tours.index') }}">Tours</a></li>
            <li class="nav-item"><a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a></li>
        </ul>
    </div>
</nav>


    {{-- ✅ Main Section --}}
    <div class="container my-5" style="margin-top: 0 !important;">
        @yield('content')
    </div>

    {{-- ✅ Footer (เดิม) --}}
    <footer class="footer-with-bg mt-5 text-white">
        <div class="container py-5">
            <div class="row row-cols-2 row-cols-md-5 g-4 text-dark">
                <div class="col">
                    <h5 class="fw-bold">AventureTrip</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-dark text-decoration-none fs-6">About us</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Our values</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Inclusivity</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Careers</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 class="fw-bold">Support</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Contact us</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">FAQs</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Safety updates</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 class="fw-bold">Community</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Blog</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Newsletter</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Affiliate program</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 class="fw-bold">Travel Agents</h5>
                    <ul class="list-unstyled small">
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Agent Login</a></li>
                        <li><a href="#" class="text-dark text-decoration-none fs-6">Find an Agent</a></li>
                    </ul>
                </div>
                <div class="col">
                    <h5 class="fw-bold">Follow Us</h5>
                    <div class="d-flex gap-2">
                        <a href="#" class="text-dark fs-5"><i class="bi bi-instagram"></i></a>
                        <a href="#" class="text-dark fs-5"><i class="bi bi-facebook"></i></a>
                        <a href="#" class="text-dark fs-5"><i class="bi bi-youtube"></i></a>
                        <a href="#" class="text-dark fs-5"><i class="bi bi-linkedin"></i></a>
                    </div>
                </div>
            </div>
            <div class="d-flex justify-content-between align-items-center mt-4 pt-4 border-top border-light">
                <p class="small mb-0 text-dark">&copy; {{ date('Y') }} <b>AventureTrip. All rights reserved.</b></p>
                <ul class="nav small">
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-dark"><b>Terms</b></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-dark"><b>Privacy</b></a></li>
                    <li class="nav-item"><a href="#" class="nav-link px-2 text-dark"><b>Cookies</b></a></li>
                </ul>
            </div>
        </div>
    </footer>
    <style>
        .footer-with-bg {
            background-image: url('{{ asset("storage/assets/footer.png") }}');
            background-repeat: no-repeat;
            background-size: cover;
            background-position: bottom center;
            background-color: #0b1d2e;
            color: white;
        }
        .footer-with-bg a {
            color: white;
        }
        .footer-with-bg a:hover {
            text-decoration: underline;
        }
    </style>

    {{-- ✅ Bootstrap JS --}}
    <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
</body>
</html>
