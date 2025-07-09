<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AventureTrip</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  @yield('head')

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand img {
      height: 40px;
      width: auto;
    }

    .navbar-nav .nav-link {
      font-weight: 600;
      font-size: 1.25rem;
      padding: 0.5rem 0.75rem;
      color: #0d6efd;
    }

    .navbar-nav .nav-link:hover {
      color: #0d6efd;
      text-decoration: underline;
    }

    .navbar .btn {
      padding: 0.45rem 0.95rem;
      font-weight: 600;
      font-size: 0.95rem;
    }

    .nav-item.border-end {
      border-right: 2px solid #000;
    }

    @media (max-width: 991.98px) {
      .navbar-nav {
        align-items: flex-start !important;
        text-align: left !important;
        padding-left: 1.5rem;
      }

      .navbar-nav .nav-item {
        width: 100%;
        border-right: none !important;
        border-bottom: 1px solid #ddd;
        padding: 0.75rem 0;
      }

      .navbar-nav .nav-link {
        font-size: 1.1rem;
        padding: 0;
      }

      .dropdown-menu {
        text-align: left;
      }
    }

    .footer-with-bg {
      color: #212529;
      font-weight: 500;
      font-size: 1.05rem;
    }

    .footer-with-bg h5 {
      font-weight: 700;
      color: #000;
    }

    .footer-with-bg a {
      color: #ff6f00;
      text-decoration: none;
      font-weight: 600;
    }

    .footer-with-bg a:hover {
      color: #0056b3;
      text-decoration: underline;
    }
  </style>
</head>

<body>
  {{-- ===== NAVBAR ===== --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top px-4">
    <div class="container-fluid">
      {{-- ✅ LOGO --}}
      <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
        <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo" style="height: 40px;" class="me-2">
        <span class="fs-3 text-primary">Aventure<span class="text-warning">Trip</span></span>
      </a>

      {{-- ✅ Hamburger icon --}}
      <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNavbar">
        <span class="navbar-toggler-icon"></span>
      </button>

      {{-- ✅ Navbar content --}}
      <div class="collapse navbar-collapse" id="mainNavbar">
        {{-- ✅ Left menu (centered on desktop, left on mobile) --}}
        <ul class="navbar-nav mx-lg-auto mb-2 mb-lg-0 gap-2">
          <li class="nav-item border-end border-2 border-dark pe-lg-3 me-lg-3">
            <a class="nav-link fs-5 fw-semibold" href="{{ route('home') }}">Home</a>
          </li>
          <li class="nav-item border-end border-2 border-dark pe-lg-3 me-lg-3">
            <a class="nav-link fs-5 fw-semibold" href="{{ route('about') }}">About</a>
          </li>
          <li class="nav-item border-end border-2 border-dark pe-lg-3 me-lg-3">
            <a class="nav-link fs-5 fw-semibold" href="{{ route('tours.index') }}">Tours</a>
          </li>
          <li class="nav-item dropdown">
            <a class="nav-link dropdown-toggle fs-5 fw-semibold" href="#" id="destDropdown" role="button" data-bs-toggle="dropdown">
              Destinations
            </a>
            <ul class="dropdown-menu">
              <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Thailand']) }}">Thailand</a></li>
              <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Vietnam']) }}">Vietnam</a></li>
              <li><a class="dropdown-item" href="{{ route('tours.index', ['country' => 'Laos']) }}">Laos</a></li>
            </ul>
          </li>

          <li class="nav-item border-start border-2 border-dark ps-lg-3 ms-lg-3">
            <a class="nav-link fw-bold text-primary" href="{{ route('outbounds') }}">
              🌐 ทัวร์ต่างประเทศ
            </a>
          </li>





          <li class="nav-item d-lg-none">
            <a href="{{ url('/contact') }}">
              <i class="bi bi-search" style="cursor: pointer;"></i>
            </a>

          </li>
          <li class="nav-item d-lg-none">
            <a href="{{ route('contact') }}" class="btn btn-primary mt-2">Contact Us</a>
          </li>
        </ul>

        {{-- ✅ Right on Desktop Only --}}
        <ul class="navbar-nav d-none d-lg-flex ms-auto gap-3 align-items-center">
          <li class="nav-item">
            <a href="#" class="nav-link">
              <i class="bi bi-search fs-5"></i>
            </a>
          </li>
          <li class="nav-item">
            <a href="{{ route('contact') }}" class="btn btn-primary ms-2">Contact Us</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <main>
    @yield('content')
  </main>

  {{-- ===== FOOTER ===== --}}
  <footer class="footer-with-bg text-muted py-5"
    style="background: url('{{ asset('storage/assets/footer-bg.png') }}') no-repeat center bottom; background-size: cover;">
    <div class="container">
      <div class="row">
        <div class="col-md-3">
          <h5 class="fw-bold">AdventureTrip</h5>
          <ul class="list-unstyled">
            <li><a href="#">About us</a></li>
            <li><a href="#">Our values</a></li>
            <li><a href="#">Inclusivity</a></li>
            <li><a href="#">Careers</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="fw-bold">Support</h5>
          <ul class="list-unstyled">
            <li><a href="#">Contact us</a></li>
            <li><a href="#">Safety</a></li>
            <li><a href="#">FAQs</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="fw-bold">Community</h5>
          <ul class="list-unstyled">
            <li><a href="#">Blog</a></li>
            <li><a href="#">Newsletter</a></li>
            <li><a href="#">Affiliate program</a></li>
          </ul>
        </div>
        <div class="col-md-3">
          <h5 class="fw-bold">Travel Agents</h5>
          <ul class="list-unstyled">
            <li><a href="#">Agent Login</a></li>
            <li><a href="#">Find an Agent</a></li>
          </ul>
          <div class="mt-3">
            <i class="bi bi-instagram me-2"></i>
            <i class="bi bi-facebook me-2"></i>
            <i class="bi bi-youtube me-2"></i>
            <i class="bi bi-linkedin"></i>
          </div>
        </div>
      </div>
      <hr class="my-4">
      <div class="text-center text-white">
        <h4>©2025 AdventureTrip. All rights reserved.</h4>
      </div>
    </div>
  </footer>

  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>

  @yield('scripts')
</body>

</html>