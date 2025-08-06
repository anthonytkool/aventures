@extends('layouts.app')

@section('content')
<div class="container py-4">
  <h2 class="mb-4">🧭 จัดการทัวร์</h2>

  <a href="{{ route('admin.tours.create') }}" class="btn btn-primary mb-3">
    + เพิ่มทัวร์ใหม่
  </a>

  @if(session('success'))
    <div class="alert alert-success">{{ session('success') }}</div>
  @endif

  <table class="table table-bordered">
    <thead>
      <tr>
        <th>ชื่อทัวร์</th>
        <th>ประเทศ</th>
        <th>ราคา</th>
        <th>จำนวนวัน</th>
        <th>แก้ไข</th>
        <th>ลบ</th>
      </tr>
    </thead>
    <tbody>
      @foreach($tours as $tour)
      <tr>
        <td>{{ $tour->title }}</td>
        <td>{{ $tour->country }}</td>
        <td>{{ number_format($tour->price) }} ฿</td>
        <td>{{ $tour->days }}</td>
        <td><a href="{{ route('admin.tours.edit', $tour) }}" class="btn btn-sm btn-warning">แก้ไข</a></td>
        <td>
          <form method="POST" action="{{ route('admin.tours.destroy', $tour) }}" onsubmit="return confirm('ยืนยันการลบ?')">
            @csrf @method('DELETE')
            <button type="submit" class="btn btn-sm btn-danger">ลบ</button>
          </form>
        </td>
      </tr>
      @endforeach
    </tbody>
  </table>

  {{ $tours->links() }}
</div>
@endsection
