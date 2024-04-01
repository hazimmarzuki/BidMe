@extends('applayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
            <!-- Centering the row horizontally -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif
            <form method="POST" action="{{ route('store-item') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Auction Title:</label>
                    <input type="text" id="title" name="title" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea id="description" name="description" required class="form-control"></textarea>
                </div>
                <div class="mb-3">
                    <label for="starting_price" class="form-label">Starting Price RM:</label>
                    <input type="text" id="starting_price" name="starting_price" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="countdown_date" class="form-label">Last time for bid:</label>
                    <input type="datetime-local" id="countdown_date" name="countdown_date" value="{{ old('countdown_date') }}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Create Auction</button>
            </form>
        </div>
    </div>
@endsection
