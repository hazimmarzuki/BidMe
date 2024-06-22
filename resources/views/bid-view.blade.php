@extends('applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

<div class="container-sm my-5">
    <div class="row align-items-start">
        <div class="col-md-6 order-md-1">
            @if ($item->image)
            <div class="image-container">
                <img src="{{ asset($item->image) }}" class="img-fluid rounded" alt="Item Image">
            </div>
            @endif
        </div>

        <div class="col-md-6 order-md-2">
            @if (session('success'))
                <p class="alert alert-success">{{ session('success') }}</p>
            @endif

            @if (session('error'))
                <p class="alert alert-danger">{{ session('error') }}</p>
            @endif

            <div class="d-flex justify-content-between align-items-center mb-3">
                <h3><strong>{{ $item->title }}</strong></h3>
                <div>
                    <strong>Time remaining:</strong>
                    <div class="countdown-container d-inline">
                        <span id="countdown-{{ $item->id }}"></span>
                    </div>
                </div>
            </div>

            <div class="mb-3">
                <label for="description" class="form-label"><h4><strong>Description:</strong></h4></label>
                <h5>{!! nl2br($item->description) !!}</h5>
            </div>

            <div class="mb-3">
                <label for="category" class="form-label"><h4><strong>Category:</strong></h4><h5>{{ $item->category }}</h5></label>
            </div>

            <div class="mb-3">
                <label for="price" class="form-label"><h4><strong>Current Price:</strong></h4> <h5>RM{{ $item->price }}</h5></label>
            </div>

            <form method="POST" action="{{ route('bid-item', $item->id) }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="bid" class="form-label"><strong>Bidding Price:</strong> RM</label>
                    <input type="text" id="bid" name="bid" class="form-control d-inline">
                </div>

                <div class="mb-3">
                    <label for="min-bid" class="form-label" style="font-size: 12px">
                        (<strong>Minimum bid:</strong> RM
                        @if($item->price >= 0 && $item->price < 25)
                            {{ $item->price + 0.5 }}
                        @elseif($item->price >= 25 && $item->price < 100)
                            {{ $item->price + 1 }}
                        @elseif($item->price >= 100 && $item->price < 250)
                            {{ $item->price + 2.5 }}
                        @elseif($item->price >= 250 && $item->price < 500)
                            {{ $item->price + 5 }}
                        @elseif($item->price >= 500 && $item->price < 1000)
                            {{ $item->price + 10 }}
                        @elseif($item->price >= 1000 && $item->price < 2500)
                            {{ $item->price + 25 }}
                        @elseif($item->price >= 2500 && $item->price < 5000)
                            {{ $item->price + 50 }}
                        @elseif($item->price >= 5000)
                            {{ $item->price + 100 }}
                        @endif
                        ) <a href="{{ route('view-bidders', $item->id) }}"><em>{{ $item->bids_count }} people bid(s) this item</em></a>
                    </label>
                </div>

                <button type="submit" class="btn btn-primary">BID</button>
            </form>
        </div>
    </div>
</div>

<style>
    .image-container {
        width: 100%;
        height: 410px; /* Set your desired fixed height */
        overflow: hidden;
        display: flex;
        justify-content: center;
        align-items: center;
    }

    .image-container img {
        width: 100%;
        height: 100%;
        object-fit: cover; /* Ensures the image covers the container while maintaining aspect ratio */
    }
</style>

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>

<script>
    $(document).ready(function() {
        $('#countdown-{{ $item->id }}').countdown('{{ $item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
            var $this = $(this);
            $this.html(event.strftime('%D days %H:%M:%S'));
        });
    });
</script>
@endsection
