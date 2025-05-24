@extends('layouts.app')

@section('content')

    {{-- Hero Banner --}}
    <div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:320px;">
        <img src="{{ asset('storage/assets/cambodia.jpg') }}" alt="About Us Banner"
            style="width:100vw; min-width:100vw; height:320px; object-fit:cover; object-position:center; display:block;">
    </div>

    <div class="container py-5">
        {{-- Title --}}
        <div class="text-center mb-5">
            <h1 class="fw-bold display-5 mb-2">About Us</h1>
            <p class="lead text-muted">AventureTrip: Connecting Cultures, Inspiring Adventure</p>
        </div>

        {{-- Section 1: Who We Are --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('storage/assets/about.jpg') }}" alt="Who we are" class="w-100 rounded-4 shadow-sm" style="max-height:350px; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-semibold mb-3">Who We Are</h2>
                <p class="fs-5 text-muted">
                    We are passionate travel experts, committed to helping you discover the most amazing destinations in Southeast Asia.<br>
                    Our team consists of local guides, cultural explorers, and hospitality professionals who believe every trip can be truly life-changing.
                </p>
            </div>
        </div>

        {{-- Section 2: Our Purpose --}}
        <div class="row flex-md-row-reverse align-items-center mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('storage/assets/purpose.png') }}" alt="Our Purpose" class="w-100 rounded-4 shadow-sm" style="max-height:350px; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-semibold mb-3">Our Purpose</h2>
                <p class="fs-5 text-muted">
                    Our mission is to create travel experiences that connect people, cultures, and stories.<br>
                    Since our founding, we’ve helped thousands of travelers discover new perspectives, friendships, and unforgettable moments.
                </p>
            </div>
        </div>

        {{-- Section 3: Why Travel With Us --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('storage/assets/why.png') }}" alt="Why travel with us" class="w-100 rounded-4 shadow-sm" style="max-height:350px; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-semibold mb-3">Why Travel With Us</h2>
                <ul class="fs-5 text-muted">
                    <li>Authentic local experiences & cultural immersion</li>
                    <li>Small group adventures led by expert guides</li>
                    <li>Flexible itineraries – travel your way</li>
                    <li>Commitment to sustainability & local communities</li>
                </ul>
            </div>
        </div>

        {{-- Section 4: Support Local --}}
        <div class="row flex-md-row-reverse align-items-center mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('storage/assets/support.png') }}" alt="Our Impact" class="w-100 rounded-4 shadow-sm" style="max-height:350px; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-semibold mb-3">Our supporting</h2>
                <p class="fs-5 text-muted">
                    We believe in giving back to the places we love by supporting local communities, eco-projects, and responsible tourism.<br>
                    Every trip with us helps make travel a force for good.
                </p>
            </div>
        </div>

        {{-- Section 5: Explore with Us --}}
        <div class="row align-items-center mb-5">
            <div class="col-md-6 mb-3 mb-md-0">
                <img src="{{ asset('storage/assets/xplore.png') }}" alt="Explore with us" class="w-100 rounded-4 shadow-sm" style="max-height:350px; object-fit:cover;">
            </div>
            <div class="col-md-6">
                <h2 class="fw-semibold mb-3">Explore With Us</h2>
                <p class="fs-5 text-muted">
                    Your next adventure starts here.<br>
                    Join AventureTrip and discover journeys that inspire, challenge, and transform you.
                </p>
                <a href="{{ route('tours.index') }}" class="btn btn-primary btn-lg mt-3 px-4">View Our Tours</a>
            </div>
        </div>
    </div>

@endsection
