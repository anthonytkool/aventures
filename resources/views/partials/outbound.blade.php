<section class="container my-5">
    <h2 class="text-center fw-bold mb-4">Outbound Tours</h2>
    <div class="row justify-content-center">
        {{-- CARD 1: Vietnam --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('storage/outbound/vietnam-tour.png') }}" class="card-img-top" alt="Vietnam Tour">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Vietnam 3 Days 2 Nights</h5>
                    <p class="card-text text-muted">Includes Danang, Hoi An, Ba Na Hills</p>
                    <a href="{{ asset('storage/outbound/vietnam-tour.pdf') }}" target="_blank" class="btn btn-success">
                        <i class="bi bi-file-earmark-pdf-fill"></i> Download PDF
                    </a>
                </div>
            </div>
        </div>

        {{-- CARD 2: Hongkong --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('storage/outbound/hongkong.png') }}" class="card-img-top" alt="Hongkong Tour">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Hongkong 5 Days 4 Nights</h5>
                    <p class="card-text text-muted">Includes Tokyo, Osaka, Mt. Fuji</p>
                    <a href="{{ asset('storage/outbound/hongkong.pdf') }}" class="btn btn-success" download>
    Download PDF
</a>

                </div>
            </div>
        </div>

        {{-- CARD 3: Hongkong --}}
        <div class="col-md-4 mb-4">
            <div class="card shadow-sm border-0">
                <img src="{{ asset('storage/outbound/hongkongJuly.png') }}" class="card-img-top" alt="Hongkong Tour">
                <div class="card-body text-center">
                    <h5 class="card-title fw-bold">Singapore 3 Days 2 Nights</h5>
                    <p class="card-text text-muted">Includes Marina Bay, Sentosa</p>
                    <a href="#" class="btn btn-success disabled">
                        Coming Soon
                    </a>
                </div>
            </div>
        </div>
    </div>
</section>
