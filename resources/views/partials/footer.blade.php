<footer class="footer-with-bg text-muted py-5" style="background: url({{ asset('storage/assets/footer-bg.png') }}) no-repeat center bottom; background-size: cover;">
  <div class="container">
    <div class="row">
      <!-- Column 1: AdventureTrip -->
      <div class="col-md-3 mb-4 mb-md-0">
        <h5 class="fw-bold">AdventureTrip</h5>
        <ul class="list-unstyled">
          <li><a href="{{ route('tours.index', ['country' => 'Thailand']) }}">Thailand Tours</a></li>
          <li><a href="{{ route('tours.index', ['country' => 'Vietnam']) }}">Vietnam Tours</a></li>
          <li><a href="{{ route('tours.index', ['country' => 'Laos']) }}">Laos Tours</a></li>
        </ul>
      </div>
      <!-- Column 2: Support -->
      <div class="col-md-3 mb-4 mb-md-0">
        <h5 class="fw-bold">Support</h5>
        <ul class="list-unstyled">
          <li><a href="{{ route('contact') }}">Contact Us</a></li>
          <li><a href="{{ route('about') }}">About Us</a></li>
          <li><a href="{{ route('faq') }}">FAQs</a></li>
        </ul>
      </div>
      <!-- Column 3: Social -->
      <div class="col-md-3 mb-4 mb-md-0 text-center text-md-start">
        <h5 class="fw-bold mb-2">Stay Connected with Us</h5>
        <div class="mb-3">
          <a href="https://facebook.com/" target="_blank" class="me-2 text-primary"><i class="bi bi-facebook fs-3"></i></a>
          <a href="https://instagram.com/" target="_blank" class="me-2 text-danger"><i class="bi bi-instagram fs-3"></i></a>
          <a href="https://tiktok.com/" target="_blank" class="me-2 text-dark"><i class="bi bi-tiktok fs-3"></i></a>
          <a href="https://youtube.com/" target="_blank" class="text-danger"><i class="bi bi-youtube fs-3"></i></a>
        </div>
       <a href="{{ route('overseas.index') }}" class="text-primary d-block mb-2">
    🌐 ทัวร์ต่างประเทศ
</a>
       {{-- Column: Social + TAT + DBD --}}
<div class="col-md-3">
    <h5 class="fw-bold mb-3">Stay Connected with Us</h5>

    {{-- social icons เดิมของคุณ (มีอยู่แล้วก็เก็บไว้) --}}
    <div class="d-flex align-items-center gap-3 mb-2">
        <a href="#" aria-label="Facebook" class="text-white fs-5"><i class="bi bi-facebook"></i></a>
        <a href="#" aria-label="Instagram" class="text-white fs-5"><i class="bi bi-instagram"></i></a>
        <a href="#" aria-label="YouTube" class="text-white fs-5"><i class="bi bi-youtube"></i></a>
        <a href="#" aria-label="TikTok" class="text-white fs-5"><i class="bi bi-tiktok"></i></a>
    </div>

    <div class="mt-3" style="font-size:1.05rem;">
        <i class="bi bi-globe-americas me-1"></i> ทัวร์ต่างประเทศ
    </div>
    <div class="fw-semibold" style="font-size:1.05rem;">
        TAT License No. 11/12659
    </div>

    {{-- DBD ใต้ TAT ชัด ๆ จัดกลาง และบังคับขึ้นบรรทัดใหม่ --}}
    <img
      src="{{ asset('storage/assets/dbd.png') }}"
      alt="DBD Certified"
      style="display:block; margin:8px auto 0; width:170px; height:auto;"
    >

    {{-- ถ้าต้องโชว์เลข DBD ใต้โลโก้ ให้เปิดคอมเมนต์นี้ --}}
    {{-- <div class="small mt-1">DBD Registration No. 0135567027671</div> --}}
</div>

      <!-- Column 4: Spacer or future content -->
      <div class="col-md-3"></div>
    </div>
    <hr class="my-4">
    <div class="text-center text-white">
      <small>&copy; {{ date('Y') }} AventureTrip.com. All rights reserved.</small>
    </div>
  </div>
</footer>