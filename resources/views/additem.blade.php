@extends('applayout')

@section('content')
<link rel="stylesheet" href="{{asset('css/profile.css')}}" />
<div class="container-sm">
    <!-- Centering the container and making it smaller -->
    <div>
      <!-- Centering the row horizontally -->
      <form method="POST" action="{{ route('store-item') }}" >
        @csrf

        <label for="title">Auction Title:</label>
        <input type="text" id="title" name="title" required>

        <label for="description">Description:</label>
        <textarea id="description" name="description" required></textarea>

        <label for="duration">Duration (in hours):</label>
        <input type="datetime-local" id="countdown_date" name="countdown_date" value="{{ old('countdown_date') }}" required>

        <label for="image">Upload Image:</label>
        <input type="file" id="image" name="image" accept="image/*" required>
        <button type="submit">Create Auction</button>

    </form>>
    </div>
  </div>


@endsection
