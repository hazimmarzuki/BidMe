@extends('applayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

    <div class="container-sm my-5">
        <div class="row align-items-start">
            <div class="col-md-6 order-md-1">
                @if ($item->image)
                    <img src="{{ asset($item->image) }}" class="img-fluid rounded" alt="Item Image">
                @endif
            </div>

            <div class="col-md-6 order-md-2">
                @if (session('success'))
                    <p class="alert alert-success">{{ session('success') }}</p>
                @endif

                @if (session('error'))
                    <p class="alert alert-danger">{{ session('error') }}</p>
                @endif

                <h3 class="mb-3"><strong>{{ $item->title }}</strong></h3>

                <div class="mb-3">
                    <label for="description" class="form-label"><h4><strong>Description:</strong></h4></label>
                    <h5>{!! nl2br($item->description) !!}</h5>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label"><h4><strong>Price:</strong></h4> <h5>RM{{ $item->price }}</h5></label>
                </div>
            </div>
        </div>
    </div>
@endsection
