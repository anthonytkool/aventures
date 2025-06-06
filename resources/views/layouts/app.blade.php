<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">
  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AventureTrip</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">

  {{-- ✅ Bootstrap Icons --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">




  <!-- Lightbox2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">


  <!-- ส่วน head ของแต่ละ view -->
  @yield('head')

  <style>
    body {
      font-family: 'Segoe UI', sans-serif;
    }

    .navbar-brand img {
      height: 40px;
      width: auto;
    }

    /* ✳️ Footer Styling เพิ่มความเด่นให้ฟอนต์ */
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
      ;
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
  <nav class="navbar navbar-expand-lg navbar-light bg-white sticky-top shadow-sm px-4">
    <a class="navbar-brand d-flex align-items-center fw-bold" href="{{ route('home') }}">
      <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo" class="me-2">
      <span class="fs-3 text-primary">AventureTrip</span>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse justify-content-end" id="navbarNav">
      <ul class="navbar-nav gap-lg-3">
        <li class="nav-item">
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}" href="{{ route('about') }}">About</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('tours*') ? 'active' : '' }}" href="{{ route('tours.index') }}">Tours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}" href="{{ route('contact') }}">Contact</a>
        </li>
      </ul>
    </div>
  </nav>

  <main class="py-4">
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
      <div class="text-center text-white">© 2025 AdventureTrip. All rights reserved.</div>
    </div>
  </footer>

  <!-- JS Libraries -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>
 
  

  @yield('scripts')
</body>

</html>