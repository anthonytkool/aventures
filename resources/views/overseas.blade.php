@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h2 class="mb-4 text-center">🌏 ทัวร์ต่างประเทศแนะนำ</h2>

    <div class="row">
        @foreach($overseasTours as $tour)
        <div class="col-md-6 mb-4 d-flex justify-content-center">
            <div class="card shadow-sm" style="width: 80%; max-width: 500px;">
                <img src="{{ asset('storage/overseas/' . $tour['image']) }}" class="card-img-top" alt="{{ $tour['title'] }}">
                <div class="card-body d-flex flex-column justify-content-between">
                    <div>
                        <h5 class="card-title">{{ $tour['title'] }}</h5>
                        <p class="card-text text-muted">{{ $tour['desc'] }}</p>
                    </div>
                    @if($tour['pdf'])
                    <a href="{{ asset('storage/overseas/' . $tour['pdf']) }}" class="btn btn-warning mt-3" target="_blank">
                        ดาวน์โหลดโปรแกรม PDF
                    </a>
                    @endif
                </div>
            </div>
        </div>
        @endforeach
    </div>
</div>
@endsection