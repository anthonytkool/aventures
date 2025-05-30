<!DOCTYPE html>
<html lang="en">
<head>
  <meta charset="UTF-8">
  <title>AventureTrip</title>
  <meta name="viewport" content="width=device-width, initial-scale=1">

  <!-- Bootstrap CSS -->
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/css/bootstrap.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.11.3/font/bootstrap-icons.css" rel="stylesheet">

  <!-- Lightbox2 CSS -->
  <link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">

  <!-- Glide.js CSS -->
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />

  <!-- ให้ส่วน head ของแต่ละ view มาแทรกได้ -->
  @yield('head')

  <style>
    body { font-family: 'Segoe UI', sans-serif; }
    .navbar-brand img { height: 40px; width: auto; }
  </style>
</head>
<body>

  {{-- ===== NAVBAR ฝังตรงนี้เลย ===== --}}
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
          <a class="nav-link {{ Request::is('/') ? 'active' : '' }}"
             href="{{ route('home') }}">
            Home
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('about') ? 'active' : '' }}"
             href="{{ route('about') }}">
            About
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('tours*') ? 'active' : '' }}"
             href="{{ route('tours.index') }}">
            Tours
          </a>
        </li>
        <li class="nav-item">
          <a class="nav-link {{ Request::is('contact') ? 'active' : '' }}"
             href="{{ route('contact') }}">
            Contact
          </a>
        </li>
      </ul>
    </div>
  </nav>
  {{-- ===== จบ NAVBAR ===== --}}

  <main class="py-4">
    @yield('content')
  </main>
  <footer class="footer-with-bg text-muted py-5"
        style="
          /* ตั้งให้เป็น background image */
          background: url('{{ asset('storage/assets/footer-bg.png') }}') 
                      no-repeat center bottom; 
          /* 100% กว้าง, ปรับขนาดให้เต็มพื้นที่ */
          background-size: cover;
        ">
  <div class="container">
    <div class="row">
      <!-- AdventureTrip column -->
      <div class="col-md-3">
        <h5 class="fw-bold">AdventureTrip</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">About us</a></li>
          <li><a href="#" class="text-decoration-none">Our values</a></li>
          <li><a href="#" class="text-decoration-none">Inclusivity</a></li>
          <li><a href="#" class="text-decoration-none">Careers</a></li>
        </ul>
      </div>
      <!-- Support column -->
      <div class="col-md-3">
        <h5 class="fw-bold">Support</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Contact us</a></li>
          <li><a href="#" class="text-decoration-none">FAQs</a></li>
          <li><a href="#" class="text-decoration-none">Safety updates</a></li>
        </ul>
      </div>
      <!-- Community column -->
      <div class="col-md-3">
        <h5 class="fw-bold">Community</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Blog</a></li>
          <li><a href="#" class="text-decoration-none">Newsletter</a></li>
          <li><a href="#" class="text-decoration-none">Affiliate program</a></li>
        </ul>
      </div>
      <!-- Travel Agents column -->
      <div class="col-md-3">
        <h5 class="fw-bold">Travel Agents</h5>
        <ul class="list-unstyled">
          <li><a href="#" class="text-decoration-none">Agent Login</a></li>
          <li><a href="#" class="text-decoration-none">Find an Agent</a></li>
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

    <div class="text-center">
      © 2025 AdventureTrip. All rights reserved.
    </div>
  </div>
</footer>



  <!-- jQuery (ต้องโหลดก่อน Lightbox2 JS) -->
  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <!-- Bootstrap JS -->
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <!-- Lightbox2 JS -->
  <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>
  <!-- Glide.js Script -->
  <script src="https://cdn.jsdelivr.net/npm/@glidejs/glide"></script>
  <script>
    new Glide('.glide', {
      type: 'carousel',
      perView: 4,
      gap: 20,
      autoplay: 4000,
      hoverpause: true,
      breakpoints: {
        1200: { perView: 3 },
        992:  { perView: 2 },
        576:  { perView: 1 },
      }
    }).mount();
  </script>

  <!-- ให้ส่วน scripts ของแต่ละ view มาแทรกได้ -->
  @yield('scripts')
</body>
</html>
