@extends('layouts.app')

@section('content')
<div class="container">
{{-- Full Width Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:clamp(180px, 24vw, 320px);">
    <img src="{{ asset('storage/assets/hero.png') }}" alt="Explore Our Tours"
        style="width:100vw; min-width:100vw; height:100%; object-fit:cover; object-position:center; display:block;">
</div>


    <!-- Heading -->
    <div class="text-center mb-4">
        <h1 class="fw-bold">Popular Tours</h1>
        <p class="text-muted fs-3">Explore our most popular tours across Thailand, Cambodia, Vietnam, and Laos.<br>
            Don’t miss our best-selling tours!</p>
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


    <!-- Why Travel with Us -->
<section class="bg-light py-5">
    <div class="container">
        <div class="text-center mb-4">
            <h2 class="fw-bold">Why travel with AventureTrip?</h2>
            <p class="fs-5 text-muted">As Southeast Asia travel experts, we design every tour with safety, comfort, and authentic experiences in mind.</p>
        </div>

        <div class="row g-4">
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-people-fill fs-1 text-primary"></i></div>
                    <h5 class="fw-bold">Small Groups</h5>
                    <p class="text-muted">Join like-minded travelers and enjoy personalized experiences in every destination.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-shield-check fs-1 text-success"></i></div>
                    <h5 class="fw-bold">Guaranteed Departures</h5>
                    <p class="text-muted">Book with confidence — our tours run as scheduled with full support throughout.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-person-lines-fill fs-1 text-warning"></i></div>
                    <h5 class="fw-bold">Local Guides</h5>
                    <p class="text-muted">Our local guides bring unmatched knowledge, ensuring immersive cultural experiences.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-house-heart fs-1 text-danger"></i></div>
                    <h5 class="fw-bold">Community Support</h5>
                    <p class="text-muted">We partner with local communities to ensure your travel gives back to the places you visit.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-airplane fs-1 text-info"></i></div>
                    <h5 class="fw-bold">Flexible Itineraries</h5>
                    <p class="text-muted">Our itineraries balance adventure and leisure — perfect for your pace and style.</p>
                </div>
            </div>
            <div class="col-md-4">
                <div class="bg-white p-4 rounded shadow-sm h-100">
                    <div class="mb-3"><i class="bi bi-globe fs-1 text-secondary"></i></div>
                    <h5 class="fw-bold">Sustainable Travel</h5>
                    <p class="text-muted">We prioritize eco-friendly practices and carbon-conscious experiences on every tour.</p>
                </div>
            </div>
        </div>
    </div>
</section>


    <!-- Feature Section with Images and Text -->
<section class="py-5">
    <div class="container">
        <div class="row align-items-center mb-5">
            <div class="col-md-6 text-center">
        <img src="{{ asset('storage/assets/feature1.jpg') }}" alt="Feature 1"
             class="img-fluid rounded shadow-sm"
             style="max-width: 85%; height: auto;">
    </div>
            <div class="col-md-6">
                <h4 class="fw-bold">Think of us as your people on the ground</h4>
                <p class="text-muted">We combine all the elements necessary to produce a product and service that perfectly reflects your brand.</p>
            </div>
        </div>

        <div class="row align-items-center mb-5 flex-md-row-reverse">
             <div class="col-md-6 text-center">
        <img src="{{ asset('storage/assets/feature3.jpg') }}" alt="Feature 2"
             class="img-fluid rounded shadow-sm"
             style="max-width: 80%; height: auto;">
    </div>
            <div class="col-md-6">
                <h4 class="fw-bold">We’re here to represent you</h4>
                <p class="text-muted">Our product creators build itineraries that your passengers love — and our guides generate customer reviews you’ll be proud of.</p>
            </div>
        </div>

        <div class="row align-items-center">
    <div class="col-md-6 text-center">
        <img src="{{ asset('storage/assets/feature2.jpg') }}" alt="Feature 3"
             class="img-fluid rounded shadow-sm"
             style="max-width: 80%; height: auto;">
    </div>
    <div class="col-md-6">
        <h4 class="fw-bold">With innovative, seamless travel experiences</h4>
        <p class="text-muted">We have the infrastructure, expert know-how and local insight to make every aspect of travel inspiring and easy.</p>
    </div>
</div>

    </div>
</section>

<!-- Explore by Destination -->
<section class="container my-5 text-center">
    <h2 class="fw-bold">Explore by Destination</h2>
    <p class="text-muted fs-5">Choose a country to discover amazing tours</p>
    
    <div class="row justify-content-center g-4 mt-4">
        <!-- Thailand -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/assets/thailand.png') }}" 
                     alt="Thailand" 
                     style="height: 250px; object-fit: cover; width: 100%;"
                     class="rounded-top">
                <div class="bg-dark text-white py-2 fw-bold">Thailand</div>
            </div>
        </div>

        <!-- Cambodia -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/assets/cambodia.jpg') }}" 
                     alt="Cambodia" 
                     style="height: 250px; object-fit: cover; width: 100%;"
                     class="rounded-top">
                <div class="bg-dark text-white py-2 fw-bold">Cambodia</div>
            </div>
        </div>

        <!-- Vietnam -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/assets/vietnam.jpg') }}" 
                     alt="Vietnam" 
                     style="height: 250px; object-fit: cover; width: 100%;"
                     class="rounded-top">
                <div class="bg-dark text-white py-2 fw-bold">Vietnam</div>
            </div>
        </div>

        <!-- Laos -->
        <div class="col-md-3">
            <div class="card shadow-sm">
                <img src="{{ asset('storage/assets/laos.jpg') }}" 
                     alt="Laos" 
                     style="height: 250px; object-fit: cover; width: 100%;"
                     class="rounded-top">
                <div class="bg-dark text-white py-2 fw-bold">Laos</div>
            </div>
        </div>
    </div>
</section>


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
