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

            <form method="POST"             action="{{ route('bid-item' , $item->id) }}"
                enctype="multipart/form-data">
                @csrf
                @if ($item->image)
                <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image"
                style="width: 100%; height: 200px; object-fit: contain;">
                @endif
                <div class="mb-3">
                    <label for="title" class="form-label"><strong>Title: {{ $item->title}}</strong></label>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label"><strong>Description:</strong> {{ $item->description}}</label>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label"><strong>Current Price: </strong> RM{{ $item->price}}</label>
                </div>
                <div class="mb-3">
                    <strong>Time remaining:</strong>
                                <div class="countdown-container d-inline">
                                    <span id="countdown-{{ $item->id }}"></span>
                                </div> <br>
                </div>

                <div class="mb-3">
                    <label for="price" class="form-label"><strong>Bidding Price: </strong> RM</label>
                    <input type="text" id="bid" name="bid" class="form d-inline">
                </div>

                <div class="mb-3">
                  <label for="price" class="form-label" style="font-size: 12px">(<strong>Minimum bid: </strong> RM

                    @if($item->price >= 0 && $item->price < 25)
                         {{$item->price + 0.5 }}

                    @elseif($item->price >= 25 && $item->price < 100)
                        {{$item->price + 1 }}

                    @elseif($item->price >= 100 && $item->price < 250)
                        {{$item->price + 2.5}}

                    @elseif($item->price >= 250 && $item->price < 500)
                        {{$item->price + 5}}

                    @elseif($item->price >= 500 && $item->price < 1000)
                        {{$item->price + 10}}

                    @elseif($item->price >= 1000 && $item->price < 2500)
                        {{$item->price + 25}}

                    @elseif($item->price >= 2500 && $item->price < 5000)
                        {{$item->price + 50}}

                    @elseif($item->price >= 5000)
                        {{$item->price + 100}}
                    @endif
                  )</label>
                </div>

                <button type="submit" class="btn btn-primary">BID</button>
            </form>
        </div>
    </div>

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
