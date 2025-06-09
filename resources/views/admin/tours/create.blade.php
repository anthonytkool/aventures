@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">➕ เพิ่มทัวร์ใหม่</h2>

  <form method="POST" action="{{ route('admin.tours.store') }}">
    @csrf

    <div class="mb-3">
      <label for="title" class="form-label">ชื่อทัวร์</label>
      <input type="text" name="title" id="title" class="form-control" required>
    </div>

    <div class="row">
      <div class="col-md-4 mb-3">
        <label class="form-label">ประเทศ</label>
        <input type="text" name="country" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label">จุดเริ่มต้น</label>
        <input type="text" name="start_location" class="form-control" required>
      </div>
      <div class="col-md-4 mb-3">
        <label class="form-label">ราคา</label>
        <input type="number" name="price" class="form-control" required>
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">จำนวนวัน</label>
      <input type="number" name="days" class="form-control" required>
    </div>

    <div class="mb-3">
      <label class="form-label">Overview</label>
      <textarea name="overview" class="form-control"></textarea>
    </div>



    <div class="row mb-3">
      <div class="col">
        <label>Start Date</label>
        <input type="date" name="start_date" class="form-control">
      </div>
      <div class="col">
        <label>End Date</label>
        <input type="date" name="end_date" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <label>Start Country</label>
        <input type="text" name="start_country" class="form-control">
      </div>
      <div class="col">
        <label>End Country</label>
        <input type="text" name="end_country" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <label>Trip Style</label>
        <input type="text" name="trip_style" class="form-control">
      </div>
      <div class="col">
        <label>Difficulty</label>
        <input type="text" name="difficulty" class="form-control">
      </div>
    </div>

    <div class="row mb-3">
      <div class="col">
        <label>Minimum Age</label>
        <input type="number" name="min_age" class="form-control">
      </div>
      <div class="col">
        <label>Group Size</label>
        <input type="number" name="group_size" class="form-control">
      </div>
    </div>

    <div class="mb-3">
      <label class="form-label">รายละเอียดเต็ม</label>
      <textarea name="full_description" class="form-control" rows="5"></textarea>
    </div>

    <button type="submit" class="btn btn-success">💾 บันทึกทัวร์</button>
    <a href="{{ route('admin.tours.index') }}" class="btn btn-secondary">ย้อนกลับ</a>
  </form>
</div>
@endsection