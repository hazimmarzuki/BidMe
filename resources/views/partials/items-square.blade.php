@if ($items->count() > 0)
    <div class="row">
        @foreach ($items as $item)
            <div class="col-md-4 mb-4">
                <div class="card h-100">
                    @if ($item->image)
                        <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image" style="height: 200px; object-fit: cover;">
                    @endif
                    <div class="card-body d-flex flex-column">
                        <h5 class="card-title">{{ $item->title }}</h5>
                        <p class="card-text"><strong>Current Price:</strong> RM{{ $item->price }}</p>
                        <strong>Time remaining:</strong>
                        <div class="countdown-container d-inline">
                            <span id="countdown-{{ $item->id }}"></span>
                        </div>
                        <br>
                        <em>{{ $item->bids_count }} bids</em>
                        <br>
                        <div class="text-center mt-auto">
                            <a href="{{ route('bid-view', $item->id) }}" class="btn btn-primary btn-sm" style="margin-top: auto;">BID</a>
                        </div>
                    </div>
                </div>
            </div>
        @endforeach
    </div>
    {{ $items->links() }}
@else
    <div class="container-sm text-center">
        <h2>No items available for bidding right now :(</h2>
    </div>
@endif

<script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
<script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>
<script>
    $(document).ready(function() {
        @foreach ($items as $item)
            $('#countdown-{{ $item->id }}').countdown('{{ $item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
                var $this = $(this);
                $this.html(event.strftime('%D days %H:%M:%S'));

                if (event.elapsed) {
                    $this.html('SOLD/EXPIRED');
                }
            });
        @endforeach

    });
</script>
