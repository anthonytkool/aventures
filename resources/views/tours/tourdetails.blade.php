
@extends('layouts.app')

@section('content')
    {{-- Hero Banner --}}
    <div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:clamp(180px, 24vw, 320px);">
    <img src="{{ asset('storage/assets/hlb.jpg') }}" alt="Explore Our Tours"
        style="width:100vw; min-width:100vw; height:100%; object-fit:cover; object-position:center; display:block;">
</div>

    <div class="container py-5">
        <div class="row justify-content-center mb-4">
            <div class="col-lg-8 text-center">
                <h2 class="fw-bold mb-3">Our Tour Packages</h2>
                <p class="fs-5 text-muted">
                    Discover our curated tour packages across Thailand, Cambodia, Vietnam, and Laos.<br>
                    Experience adventure, culture, and relaxation in every journey.
                </p>
            </div>
        </div>

        {{-- ตัวอย่าง: ถ้ามี tours loop --}}
        <div class="row g-4">
            @foreach($tours ?? [] as $tour)
                <div class="col-md-6 col-lg-4">
                    <div class="card shadow-sm h-100">
                        <img src="{{ $tour->image_url ?? asset('images/no-image.png') }}" class="card-img-top" alt="{{ $tour->title }}">
                        <div class="card-body d-flex flex-column">
                            <h5 class="card-title">{{ $tour->title }}</h5>
                            <p class="card-text text-muted small mb-2">{{ $tour->short_description }}</p>
                            <a href="{{ route('tours.show', $tour->id) }}" class="mt-auto btn btn-primary w-100">
                                View Details
                            </a>
                        </div>
                    </div>
                </div>
            @endforeach
            @if(empty($tours) || count($tours) == 0)
                <div class="col-12 text-center">
                    <p class="text-muted">No tours available at the moment.</p>
                </div>
            @endif
        </div>
    </div>
@endsection
