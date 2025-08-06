@extends('layouts.admin')
@section('content')
<h1>Edit Tour</h1>
<form action="{{ route('admin.tours.update', $tour->slug) }}" method="POST">
    @csrf @method('PUT')
    <label>Title: <input type="text" name="title" value="{{ $tour->title }}" required></label><br>
    <label>Country: <input type="text" name="country" value="{{ $tour->country }}" required></label><br>
    <label>Price: <input type="number" name="price" value="{{ $tour->price }}" required></label><br>
    <label>Duration: <input type="text" name="duration" value="{{ $tour->duration }}" required></label><br>
    <button type="submit">Update</button>
</form>
@endsection