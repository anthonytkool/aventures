{{-- resources/views/about.blade.php --}}
@extends('layouts.app')

@section('content')
{{-- Hero Banner: About --}}
{{-- Hero Banner --}}
<div style="width:100vw; max-width:100vw; margin-left:calc(50% - 50vw); background:#f6fafc; overflow:hidden; height:clamp(180px, 24vw, 320px);">
    <img src="{{ asset('storage/assets/cambodia.jpg') }}" alt="Explore Our Tours"
        style="width:100vw; min-width:100vw; height:100%; object-fit:cover; object-position:center; display:block;">
</div>


<div class="container py-5">
    <h1 class="mb-4">เกี่ยวกับเรา (About Us)</h1>
    <p>นี่คือหน้าข้อมูล “About” ของเว็บคุณ …</p>
</div>
@endsection