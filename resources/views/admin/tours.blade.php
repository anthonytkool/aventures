@extends('layouts.admin')
@section('content')
<h1>All Tours</h1>
<a href="{{ route('admin.tours.create') }}">Add New Tour</a>
<table>
    <tr>
        <th>Title</th>
        <th>Country</th>
        <th>Price</th>
        <th>Duration</th>
        <th>Actions</th>
    </tr>
    @foreach($tours as $tour)
    <tr>
        <td>{{ $tour->title }}</td>
        <td>{{ $tour->country }}</td>
        <td>{{ $tour->price }}</td>
        <td>{{ $tour->duration }}</td>
        <td>
            <a href="{{ route('admin.tours.edit', $tour->slug) }}">Edit</a>
            <form action="{{ route('admin.tours.destroy', $tour->slug) }}" method="POST" style="display:inline;">
                @csrf @method('DELETE')
                <button type="submit" onclick="return confirm('Delete?')">Delete</button>
            </form>
        </td>
    </tr>
    @endforeach
</table>
@endsection