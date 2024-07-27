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
            @if ($errors->any())
            <div class="alert alert-danger">
                <ul>
                    @foreach ($errors->all() as $error)
                        <li>{{ $error }}</li>
                    @endforeach
                </ul>
            </div>
        @endif
            <form method="POST" action="{{ route('update-item' , $item->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Item's name:</label>
                    <input type="text" id="title" name="title" value="{{ $item->title}}"required class="form-control">
                </div>
                <div class="mb-3">
                    <select class="form-select" aria-label="category" name="category">
                        <option selected value="{{ $item->category }}">{{ $item->category }}</option>
                        <option value="Home & Living" {{ $item->category == 'Home & Living' ? 'hidden' : '' }}>Home & Living</option>
                        <option value="Fashion" {{ $item->category == 'Fashion' ? 'hidden' : '' }}>Fashion</option>
                        <option value="Lifestyle" {{ $item->category == 'Lifestyle' ? 'hidden' : '' }}>Lifestyle</option>
                        <option value="Electronics" {{ $item->category == 'Electronics' ? 'hidden' : '' }}>Electronics</option>
                        <option value="Health & Beauty" {{ $item->category == 'Health & Beauty' ? 'hidden' : '' }}>Health & Beauty</option>
                        <option value="Baby & Toys" {{ $item->category == 'Baby & Toys' ? 'hidden' : '' }}>Baby & Toys</option>
                    </select>
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
                    <label for="image" class="form-label">Upload Image :</label>
                    <label style="font-size: 12px">if dont need to change the image leave empty</label>
                    <input type="file" id="image" name="image" accept="image/*" class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Save</button>
            </form>
        </div>
    </div>
@endsection
