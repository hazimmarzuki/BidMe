@extends('applayout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    <div class="container-lg">
        <!-- Centering the container and making it smaller -->
        <div class="row">
            <!-- Centering the row horizontally -->
            @if (session('success'))
                <div class="col-12">
                    <div class="alert alert-success">{{ session('success') }}</div>
                </div>
            @endif

            <h2 class="col-12">All Items</h2>

            @if ($items->count() > 0)
                @foreach ($items as $item)
                    <div class="col-md-4 mb-4">
                        <div class="card">
                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image" style="width: 100%; height: 200px; object-fit: cover;">
                            @endif
                            <div class="card-body">
                                <h5 class="card-title">{{ $item->title }}</h5>
                                <p class="card-text">{{ $item->description }}</p>
                                <p class="card-text">Starting Price: RM{{ $item->starting_price }}</p>
                                <div class="countdown-container">
                                    <span id="countdown-{{ $item->id }}"></span>
                                </div>
                            </div>
                        </div>
                    </div>
                @endforeach
            @else
                <div class="col-12">
                    <p>No items found.</p>
                </div>
            @endif
        </div>
        {{ $items->links()}}

    </div>


    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>

    <script>
        $(document).ready(function() {
            @foreach ($items as $item)
                $('#countdown-{{ $item->id }}').countdown('{{ $item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
                    var $this = $(this);
                    $this.html(event.strftime('%D days %H:%M:%S'));
                });
            @endforeach
        });
        </script>
@endsection


