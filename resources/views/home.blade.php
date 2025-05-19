@extends('layouts.app')

@section('content')
<div class="container">

    <!-- Hero Banner -->
    <div class="row mb-5">
        <div class="col-12">
            <img src="{{ asset('storage/assets/hero.png') }}" class="img-fluid rounded shadow-sm" alt="Hero Banner">
        </div>
    </div>


    <!-- Heading -->
<div class="text-center mb-4">
    <h1 class="fw-bold">Popular Tours</h1>
    <p class="text-muted fs-3">Explore our most popular tours across Thailand, Cambodia, Vietnam, and Laos.
    <br> Don’t miss our best-selling tours!</p>

</div>


    <!-- Tour Slider with Glide.js -->
    <div class="glide">
        <div class="glide__track" data-glide-el="track">
            <ul class="glide__slides">
                @foreach ($tours as $tour)
                <li class="glide__slide">
                    <div class="card h-100 shadow-sm mx-2" style="min-width: 16rem;">
                        <img src="{{ asset('storage/' . $tour->image) }}" class="card-img-top" alt="{{ $tour->title }}">
                        <div class="card-body d-flex flex-column">
                            <small class="text-muted">{{ $tour->days }} DAY TOUR</small>
                            <h6 class="fw-bold">{{ $tour->title }}</h6>
                            <small class="text-muted">Valid on {{ \Carbon\Carbon::parse($tour->valid_date)->format('M d, Y') }}</small>
                            <p class="fw-bold mt-2">${{ number_format($tour->price, 2) }} <span class="text-muted small">per person</span></p>
                            <a href="{{ route('tours.show', $tour->id) }}" class="btn btn-outline-primary btn-sm mt-auto">View itinerary</a>
                        </div>
                    </div>
                </li>
                @endforeach
            </ul>
        </div>

        <!-- Navigation arrows -->
        <div class="glide__arrows" data-glide-el="controls">
            <button class="glide__arrow glide__arrow--left btn btn-light shadow-sm" data-glide-dir="<">&#8592;</button>
            <button class="glide__arrow glide__arrow--right btn btn-light shadow-sm" data-glide-dir=">">&#8594;</button>
        </div>
    </div>

    <!-- Browse Button -->
    <div class="text-center mt-5">
        <a href="{{ route('tours.index') }}" class="btn btn-primary px-4">Browse Tour Packages</a>
    </div>
</div>

<!-- Glide.js CSS -->
<link rel="stylesheet" href="https://cdn.jsdelivr.net/npm/@glidejs/glide/dist/css/glide.core.min.css" />

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
            992: { perView: 2 },
            576: { perView: 1 }
        }
    }).mount();
</script>
@endsection
