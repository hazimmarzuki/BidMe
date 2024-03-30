@extends('applayout')

@section('content')

<form method="POST" action="{{ route('store-item') }}" enctype="multipart/form-data">
    @csrf
    <label for="title">Auction Title:</label>
    <input type="text" id="title" name="title" required>
    <label for="description">Description:</label>
    <textarea id="description" name="description" required></textarea>
    <label for="starting_price">Starting Price:</label>
    <input type="number" id="starting_price" name="starting_price" step="0.01" required>
    <label for="duration">Duration (in hours):</label>
    <input type="number" id="duration" name="duration" step="0.01" required>
    <label for="image">Upload Image:</label>
    <input type="file" id="image" name="image" accept="image/*" required>
    <button type="submit">Create Auction</button>
</form>

@endsection
