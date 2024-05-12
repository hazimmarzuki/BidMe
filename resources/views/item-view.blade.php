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

            @if (session('error'))
            <p class="alert alert-danger">{{session('error')}}</p>
            @endif


                @if ($item->image)
                <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image"
                style="width: 100%; height: 200px; object-fit: contain;">
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Title: {{ $item->title}}</strong></label>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description: <br>
                    </strong> {!! nl2br($item->description) !!}</label>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label"><strong>Price: </strong> RM{{ $item->price}}</label>
                </div>
        </div>
    </div>

@endsection
