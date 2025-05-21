@extends('layouts.app')

@section('content')
<div class="container py-5">
    <div class="text-center mb-5">
        <h1 class="fw-bold">Contact Us</h1>
        <p class="text-muted fs-5">Have a question or want to learn more about our tours? Reach out and we’ll be happy to help.</p>
    </div>

    <div class="row g-5">
        <!-- Contact Form -->
        <div class="col-md-6">
            <form>
                <div class="mb-3">
                    <label for="name" class="form-label fw-semibold">Your Name</label>
                    <input type="text" class="form-control" id="name" placeholder="John Smith">
                </div>
                <div class="mb-3">
                    <label for="email" class="form-label fw-semibold">Email Address</label>
                    <input type="email" class="form-control" id="email" placeholder="you@example.com">
                </div>
                <div class="mb-3">
                    <label for="message" class="form-label fw-semibold">Your Message</label>
                    <textarea class="form-control" id="message" rows="5" placeholder="Tell us how we can help..."></textarea>
                </div>
                <button type="submit" class="btn btn-primary px-4">Send Message</button>
            </form>
        </div>

        @if(session('success'))
        <div class="alert alert-success mt-3">
            {{ session('success') }}
        </div>
        @endif


        <!-- Contact Info -->
        <div class="col-md-6">
            <h5 class="fw-bold mb-3">Our Office</h5>
            <p>Thaismile Adventures Co., Ltd.<br>
                123 Sukhumvit Rd., Bangkok, Thailand 10110</p>

            <h5 class="fw-bold mt-4">Phone</h5>
            <p><a href="tel:+6623456789" class="text-decoration-none text-dark">+66 2 345 6789</a></p>

            <h5 class="fw-bold mt-4">Email</h5>
            <p><a href="mailto:thaismileadventures@hotmail.com" class="text-decoration-none text-dark">thaismileadventures@hotmail.com</a></p>

            <h5 class="fw-bold mt-4">Follow Us</h5>
            <div class="d-flex gap-2">
                <a href="#" class="text-dark fs-5"><i class="bi bi-facebook"></i></a>
                <a href="#" class="text-dark fs-5"><i class="bi bi-instagram"></i></a>
                <a href="#" class="text-dark fs-5"><i class="bi bi-youtube"></i></a>
            </div>
        </div>
    </div>
</div>
@endsection