<!DOCTYPE html>
<html lang="en">

<head>
  <meta charset="UTF-8">

  <!-- Google Tag Manager -->
  <script>
    (function(w, d, s, l, i) {
      w[l] = w[l] || [];
      w[l].push({
        'gtm.start': new Date().getTime(),
        event: 'gtm.js'
      });
      var f = d.getElementsByTagName(s)[0],
        j = d.createElement(s),
        dl = l != 'dataLayer' ? '&l=' + l : '';
      j.async = true;
      j.src =
        'https://www.googletagmanager.com/gtm.js?id=' + i + dl;
      f.parentNode.insertBefore(j, f);
    })(window, document, 'script', 'dataLayer', 'GTM-M4GBMXLL');
  </script>
  <!-- End Google Tag Manager -->

  <meta name="viewport" content="width=device-width, initial-scale=1.0">
  <title>AventureTrip</title>

  {{-- Bootstrap CSS --}}
  <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.2/dist/css/bootstrap.min.css" rel="stylesheet">
  <link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css">
  <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/flag-icon-css/6.6.6/css/flag-icons.min.css">
  <link href="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/css/lightbox.min.css" rel="stylesheet">
  <link href="https://cdn.jsdelivr.net/npm/bootstrap-icons@1.10.5/font/bootstrap-icons.css" rel="stylesheet">

  <link rel="stylesheet" href="{{ asset('css/custom.css') }}">
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

    .tour-card {
      height: 100%;
      display: flex;
      flex-direction: column;
    }

    .tour-card .card-body {
      flex: 1;
      display: flex;
      flex-direction: column;
      justify-content: space-between;
      min-height: 450px;
      /* ✅ ปรับตามความสูงที่คุณต้องการให้ทุกกล่องเท่ากัน */
    }

      .footerRight {
    padding-left: 10px;
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
      color: #0056b3;
      text-decoration: none;
      font-weight: 600;
    }

    .footer-with-bg a:hover {
      color: #ff6f00;
      text-decoration: underline;
    }
  </style>
</head>
 


<body>

  <!-- Google Tag Manager (noscript) -->
  <noscript><iframe src="https://www.googletagmanager.com/ns.html?id=GTM-M4GBMXLL"
      height="0" width="0" style="display:none;visibility:hidden"></iframe></noscript>
  <!-- End Google Tag Manager (noscript) -->
    

  {{-- ===== NAVBAR ===== --}}
  <nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top px-4">
    <div class="container-fluid">
      {{-- ✅ LOGO --}}
      <a class="navbar-brand d-flex align-items-start fw-bold" href="{{ route('home') }}">
        <img src="{{ asset('/assets/logo.png') }}" alt="Logo" style="height: 80px;" class="me-2">

        <div class="d-flex flex-column">
          <span class="fs-3 text-primary">Aventure<span class="text-warning">Trip</span></span>
          <span class="text-muted" style="font-size: 16px; margin-top: -4px;"> <b>TAT License No. 11/12659</b></span>
        </div>
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
            <a class="nav-link fs-5 fw-semibold" href="{{ route('faq') }}">Guest Info</a>
          </li>


          <li class="nav-item border-start border-2 border-dark ps-lg-3 ms-lg-3">
            <a class="nav-link fw-bold text-primary" href="{{ route('overseas.index') }}">
              🌐 ทัวร์ต่างประเทศ
            </a>
          </li>

          <li class="nav-item d-md-none">
            <a class="nav-link text-success" href="https://wa.me/66988361459" target="_blank">
              <i class="bi bi-whatsapp"></i> WhatsApp
            </a>
          </li>


          </li>
          <li class="nav-item d-lg-none">
            <a href="{{ route('contact') }}" class="btn btn-primary mt-2">Contact Us</a>
          </li>
        </ul>

        {{-- ✅ Right on Desktop Only --}}
        <ul class="navbar-nav d-none d-lg-flex ms-auto gap-3 align-items-center">
          <li class="nav-item">
            <a class="nav-link text-success" href="https://wa.me/66988361459" target="_blank" title="Contact via WhatsApp">
              <i class="bi bi-whatsapp" style="font-size: 1.4rem;"></i>
              <small style="font-size: 1rem;">WhatsApp</small>
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
    style="background: url({{ asset('storage/assets/footer-bg.png') }}) no-repeat center bottom; background-size: cover;">
    <div class="container">

      <div class="footerRight row g-4">
        {{-- คอลัมน์ 1: ลิงก์ทัวร์ + โลโก้ DBD อยู่ใต้ Laos Tours --}}
        <div class="col-12 col-md-6 col-lg-4">
          <h5 class="fw-bold mb-3">AdventureTrip</h5>
          <ul class="list-unstyled mb-3">
            <li><a href="{{ route('tours.index', ['country' => 'Thailand']) }}">Thailand Tours</a></li>
            <li><a href="{{ route('tours.index', ['country' => 'Vietnam']) }}">Vietnam Tours</a></li>
            <li><a href="{{ route('tours.index', ['country' => 'Laos']) }}">Laos Tours</a></li>
          </ul>

          {{-- โลโก้ DBD ใต้ Laos Tours (ซ้าย) --}}
          <img
            src="{{ asset('storage/assets/dbd.png') }}"
            alt="DBD Logo"
            style="width:140px; height:auto">
        </div>

        {{-- คอลัมน์ 2: Support --}}
        <div class="col-12 col-md-6 col-lg-4 footer-support">
          <h5 class="fw-bold mb-3 ">Support</h5>
          <ul class="list-unstyled">
            <li><a href="{{ route('contact') }}">Contact Us</a></li>
            <li><a href="{{ route('about') }}">About Us</a></li>
            <li><a href="{{ route('faq') }}">FAQs</a></li>
          </ul>
        </div>

        {{-- คอลัมน์ 3: Social + TAT + DBD (ตัวหนา) --}}
        <div class="col-12 col-md-6 col-lg-4">
          <h5 class="fw-bold mb-3">Stay Connected with Us</h5>
          <div class="mb-3">
            <a href="https://facebook.com/" target="_blank" class="me-3 text-primary"><i class="bi bi-facebook fs-4"></i></a>
            <a href="https://instagram.com/" target="_blank" class="me-3 text-danger"><i class="bi bi-instagram fs-4"></i></a>
            <a href="https://youtube.com/" target="_blank" class="me-3 text-danger"><i class="bi bi-youtube fs-4"></i></a>
            <a href="https://tiktok.com/" target="_blank" class="text-dark"><i class="bi bi-tiktok fs-4"></i></a>
          </div>

          <div class="mb-1"><i class="bi bi-globe2 globe-icon"></i>
            <a class="text-primary" href="{{ route('overseas.index') }}">ทัวร์ต่างประเทศ <i class="bi bi-arrow-left arrow-orange"></i> Click!</a>
          </div>

          {{-- ตัวหนาตามที่ขอ --}}
          <div class="fw-bold text-primary">TAT License No. 11/12659</div>
          <div class="fw-bold text-primary">DBD Registration No. 0135567027671</div>
        </div>
      </div>

      <hr class="my-4">

      {{-- ลิขสิทธิ์: น้ำเงิน + หนาขึ้น --}}
      <div class="text-center">
        <small class="fw-bold" style="color:#0d6efd;">
          © {{ date('Y') }} AdventureTrip. All rights reserved.
        </small>
      </div>
    </div>
  </footer>


  <style>
    /* ลิงก์ในฟุตเตอร์: สี/น้ำหนักแบบเดิม */
    .footer-with-bg .footer-link {
      color: #0d6efd;
      /* bootstrap primary เดิม */
      text-decoration: none;
      font-weight: 400;
      /* ไม่หนามาก */
    }

    .footer-with-bg .footer-link:hover {
      color: #0b5ed7;
      text-decoration: underline;
    }

    .globe-icon {
      color: orange;
      /* สีส้ม */
      font-size: 1.3em;
      /* ขนาดพอดีตา */
      vertical-align: middle;
    }

    .arrow-orange {
      color: orange;
      /* สีส้ม */
      font-size: 1.6em;
      /* ขยายขนาดให้ดูหนาขึ้น */
      font-weight: bold;
      /* ทำให้เส้นดูหนากว่าเดิม */
      vertical-align: middle;
      /* จัดให้ตรงกับข้อความ */
    }

    .footer-support {
      margin-left: -120px;
      /* ปรับค่าตามที่ต้องการ */
    }


    /* ไอคอน Social: สีเดิม */
    .footer-with-bg .footer-social {
      font-size: 1.6rem;
      line-height: 1;
    }

    .footer-with-bg .footer-social.facebook {
      color: #1877F2;
    }

    .footer-with-bg .footer-social.instagram {
      color: #E1306C;
    }

    .footer-with-bg .footer-social.youtube {
      color: #FF0000;
    }

    .footer-with-bg .footer-social.tiktok {
      color: #000;
    }

    /* DBD กล่อง + โลโก้ขนาดเล็กใต้ TAT */
    .footer-with-bg .dbd-box {
      display: block;
    }

    .footer-with-bg .dbd-logo {
      width: 140px;
      height: auto;
      display: block;
      margin: 4px 0 0 0;
      /* ติดใต้ TAT เล็กน้อย */
    }

    /* CSS เฉพาะลิงก์ 6 ตัวนี้ */
    .footer-link {
      color: #000 !important;
      text-decoration: none;
      font-weight: 600;
    }

    .footer-link:hover {
      color: #0d6efd !important;
      /* น้ำเงิน Bootstrap */
      text-decoration: underline;
    }

    /* Responsive: เรียงลง 1 คอลัมน์บนจอเล็ก + จัดกึ่งกลางเฉพาะคอลัมน์ขวา */
    @media (max-width: 767.98px) {

      .footer-with-bg .dbd-box,
      .footer-with-bg .footer-social {
        text-align: left;
      }

      .footer-with-bg .dbd-logo {
        margin: 6px 0 0 0;
      }
    }
  </style>



  <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery/3.6.0/jquery.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/bootstrap@5.3.0/dist/js/bootstrap.bundle.min.js"></script>
  <script src="https://cdn.jsdelivr.net/npm/lightbox2@2/dist/js/lightbox.min.js"></script>

  @yield('scripts')
</body>

</html>