


@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<h2>All Items</h2>
@if(count($items) > 0)
    <ul>
        @foreach($items as $item)

            <li>
                <strong>Title:</strong> {{ $item->title }}<br>
                <strong>Description:</strong> {{ $item->description }}<br>
                <strong>Starting Price:</strong> RM{{ $item->starting_price }}<br>
                <strong>Duration:</strong> {{ $item->duration }} seconds<br>
                @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="item Image"><br>
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

@push('scripts')
    <script>
        document.addEventListener('DOMContentLoaded', function() {
            @foreach($items as $item)
                var countdownDate = new Date("{{ $item->countdown_date }}").getTime();

                var x = setInterval(function() {
                    var now = new Date().getTime();
                    var distance = countdownDate - now;

                    var days = Math.floor(distance / (1000 * 60 * 60 * 24));
                    var hours = Math.floor((distance % (1000 * 60 * 60 * 24)) / (1000 * 60 * 60));
                    var minutes = Math.floor((distance % (1000 * 60 * 60)) / (1000 * 60));
                    var seconds = Math.floor((distance % (1000 * 60)) / 1000);

                    document.getElementById("countdown-{{ $item->id }}").innerHTML = days + "d " + hours + "h " + minutes + "m " + seconds + "s ";

                    if (distance < 0) {
                        clearInterval(x);
                        document.getElementById("countdown-{{ $item->id }}").innerHTML = "EXPIRED";
                    }
                }, 1000);
            @endforeach
        });
    </script>
@endpush

