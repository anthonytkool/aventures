<div class="card h-100 shadow-sm" style="min-height: 480px;"> {{-- ✅ เพิ่มตรงนี้ --}}
  <img 
    src="{{ asset('storage/outbound/' . $image) }}" 
    class="card-img-top" 
    alt="{{ $title }}" 
    style="height: 360px; object-fit: cover;"
    onerror="this.onerror=null;this.src='https://via.placeholder.com/300x200?text=No+Image';"
  >

  <div class="card-body d-flex flex-column">
    <h5 class="card-title fw-bold">{{ $title }}</h5>
    <p class="card-text text-muted">{{ $desc }}</p>

    @if (!empty($pdf))
      <a href="{{ asset('storage/outbound/' . $pdf) }}" class="btn btn-success mt-auto" download>
        📄 Download PDF
      </a>
    @else
      <button class="btn btn-secondary mt-auto" disabled>
        🚫 Coming Soon
      </button>
    @endif
  </div>
</div>
