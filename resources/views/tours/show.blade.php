@extends('layouts.app')

@section('content')
<div class="container py-4">
    <div class="row">
        <div class="col-md-7">
            {{-- รูปภาพหลักของทัวร์ --}}
            @if(isset($tour) && $tour->image)
                <img src="{{ asset('storage/'.$tour->image) }}" class="img-fluid rounded mb-3" alt="{{ $tour->title }}">
            @endif
            {{-- รายละเอียดทัวร์ --}}
            <h2 class="fw-bold">{{ $tour->title ?? 'Tour Title' }}</h2>
            <p class="lead text-muted">{{ $tour->short_description ?? 'Short description of the tour.' }}</p>
            <hr>
            <div>
                {!! $tour->description ?? '<p>Tour details and itinerary will be shown here.</p>' !!}
            </div>
        </div>
        <div class="col-md-5">
            {{-- ข้อมูลเสริม เช่น ราคา วันเดินทาง --}}
            <div class="card mb-3">
                <div class="card-body">
                    <h4 class="fw-bold text-primary mb-3">Quick Info</h4>
                    <p><b>Price:</b> {{ $tour->price ? number_format($tour->price) . ' ฿' : 'N/A' }}</p>
                    <p><b>Duration:</b> {{ $tour->duration ?? 'N/A' }}</p>
                    <p><b>Available Dates:</b> {{ $tour->dates ?? 'N/A' }}</p>
                    {{-- เพิ่มปุ่มจอง หรือสอบถาม --}}
                    <a href="{{ route('bookings.create', $tour->id ?? 0) }}" class="btn btn-primary mt-2 w-100">Book Now</a>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection