@extends('applayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
            <!-- Centering the row horizontally -->
            @if (session('success'))
            <p class="alert alert-success">{{session('success')}}</p>
            @endif
            <form method="POST" action="{{ route('update-item' , $item->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Auction Title:</label>
                    <input type="text" id="title" name="title" value="{{ $item->title}}"required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea id="description" name="description"  required class="form-control">{{ $item->description}}</textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Starting Price RM:</label>
                    <input type="text" id="price" name="price" value="{{ $item->price}}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="countdown_date" class="form-label">Last time for bid:</label>
                    <input type="datetime-local" id="countdown_date" name="countdown_date" value="{{ $item->countdown_date }}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
