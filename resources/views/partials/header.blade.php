<nav class="navbar navbar-expand-lg navbar-light bg-white shadow-sm sticky-top px-4">
  <div class="container">
    {{-- LOGO + License --}}
    <a class="navbar-brand d-flex align-items-start fw-bold" href="{{ route('home') }}">
      <img src="{{ asset('storage/assets/logo.png') }}" alt="Logo" style="height: 60px;" class="me-2">
      <div class="d-flex flex-column">
        <span class="fs-3 text-primary">Aventure<span class="text-warning">Trip</span></span>
        <span class="text-muted" style="font-size: 15px; margin-top: -4px;">
          <b>TAT License No. 11/12659</b>
        </span>
      </div>
    </a>
    <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#mainNav">
      <span class="navbar-toggler-icon"></span>
    </button>
    <div class="collapse navbar-collapse" id="mainNav">
      <ul class="navbar-nav ms-auto mb-2 mb-lg-0 align-items-lg-center">
        <li class="nav-item">
          <a class="nav-link fw-semibold fs-5" href="{{ route('home') }}">Home</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold fs-5" href="{{ route('tours.index') }}">Tours</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold fs-5" href="{{ route('about') }}">About Us</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold fs-5" href="{{ route('faq') }}">FAQs</a>
        </li>
        <li class="nav-item">
          <a class="nav-link fw-semibold fs-5" href="{{ route('contact') }}">Contact</a>
        </li>
      </ul>
    </div>
  </div>
</nav>