@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<!-- resources/views/items/index.blade.php -->

@if(session('success'))
    <div>{{ session('success') }}</div>
@endif

<h2>All Items</h2>
@if(count($itemsWithTimeRemaining) > 0)
    <ul>
        @foreach($itemsWithTimeRemaining as $itemData)
            @php
                $item = $itemData['item'];
                $timeRemaining = $itemData['time_remaining'];
            @endphp
            <li>
                <strong>Title:</strong> {{ $item->title }}<br>
                <strong>Description:</strong> {{ $item->description }}<br>
                <strong>Starting Price:</strong> RM{{ $item->starting_price }}<br>
                <strong>Duration:</strong> {{ $item->duration }} seconds<br>
                @if($item->image)
                    <img src="{{ asset($item->image) }}" alt="item Image"><br>
                @endif
                <strong>End Time:</strong> {{ $item->end_time }}<br>
                <strong>Time Remaining:</strong> <span id="time-remaining-{{ $item->id }}">{{ gmdate("H:i:s", $timeRemaining) }}</span><br>
            </li>
        @endforeach
    </ul>
@else
    <p>No items found.</p>
@endif

<script>
    setInterval(function() {
        @foreach($itemsWithTimeRemaining as $itemData)
            @php
                $item = $itemData['item'];
                $timeRemaining = $itemData['time_remaining'];
            @endphp
            var timeRemaining = {{ $timeRemaining }};
            var countdownElement = document.getElementById('time-remaining-{{ $item->id }}');
            if (timeRemaining > 0) {
                var hours = Math.floor(timeRemaining / 3600);
                var minutes = Math.floor((timeRemaining % 3600) / 60);
                var seconds = timeRemaining % 60;
                countdownElement.textContent = hours + ':' + minutes + ':' + seconds;
                timeRemaining--;
            } else {
                countdownElement.textContent = 'item Ended';
            }
        @endforeach
    }, 1000);
</script>

