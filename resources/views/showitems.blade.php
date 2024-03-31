@extends('applayout')

@section('content')

    <link rel="stylesheet" href="{{ asset('css/profile.css') }}" />
    <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
            <!-- Centering the row horizontally -->
            @if (session('success'))
                <div class="alert alert-success">{{ session('success') }}</div>
            @endif

            <h2>All Items</h2>

            @if ($items->count() > 0)
                <ul>
                    @foreach ($items as $item)
                        <li>
                            <strong>Title:</strong> {{ $item->title }}<br>
                            <strong>Description:</strong> {{ $item->description }}<br>
                            <strong>Starting Price:</strong> RM{{ $item->starting_price }}<br>

                            @if ($item->image)
                                <img src="{{ asset($item->image) }}" alt="Item Image"><br>
                            @endif

                            <div class="col-md-4">
                                <div class="countdown-container">
                                    <span id="countdown-{{ $item->id }}"></span>
                                </div>
                            </div>
                        </li>
                    @endforeach
                </ul>
            @else
                <p>No items found.</p>
            @endif
        </div>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>

    <script>
        $(document).ready(function() {
            @foreach ($items as $item)
                $('#countdown-{{ $item->id }}').countdown('{{ $item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
                    var $this = $(this);
                    $this.html(event.strftime('%D days %H:%M:%S'));

                    if (event.elapsed) {
                        $this.html('EXPIRED');
                    }
                });
            @endforeach
        });
        </script>
@endsection


