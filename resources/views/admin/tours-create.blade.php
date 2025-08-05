@extends('layouts.admin')
@section('content')
<h1>Add Tour</h1>
<form action="{{ route('admin.tours.store') }}" method="POST">
    @csrf
    <label>Title: <input type="text" name="title" required></label><br>
    <label>Country: <input type="text" name="country" required></label><br>
    <label>Price: <input type="number" name="price" required></label><br>
    <label>Duration: <input type="text" name="duration" required></label><br>
    <button type="submit">Save</button>
</form>
@endsection