{{-- resources/views/contact.blade.php --}}
@extends('layouts.app')

@section('content')
<div class="container py-5">
    <h1 class="mb-4">Contact Us</h1>

    {{-- แสดงผลสำเร็จจาก session --}}
    @if (session('success'))
        <div class="alert alert-success">
            {{ session('success') }}
        </div>
    @endif

    {{-- ฟอร์มส่งข้อความ --}}
    <form action="{{ route('contact.send') }}" method="POST">
        @csrf

        <div class="mb-3">
            <label for="name" class="form-label">ชื่อของคุณ</label>
            <input type="text"
                   name="name"
                   id="name"
                   class="form-control @error('name') is-invalid @enderror"
                   value="{{ old('name') }}"
                   required>
            @error('name')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="email" class="form-label">อีเมล</label>
            <input type="email"
                   name="email"
                   id="email"
                   class="form-control @error('email') is-invalid @enderror"
                   value="{{ old('email') }}"
                   required>
            @error('email')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <div class="mb-3">
            <label for="message" class="form-label">ข้อความ</label>
            <textarea name="message"
                      id="message"
                      rows="5"
                      class="form-control @error('message') is-invalid @enderror"
                      required>{{ old('message') }}</textarea>
            @error('message')
                <div class="invalid-feedback">{{ $message }}</div>
            @enderror
        </div>

        <button type="submit" class="btn btn-primary">ส่งข้อความ</button>
    </form>
</div>
@endsection
