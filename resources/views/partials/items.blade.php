@if ($items->count() > 0)
<div class="container-lg-list">
    <table class="table table-striped table-hover">
        <thead class="thead-dark">
            <tr>
                <th scope="col">No.</th>
                <th scope="col">Image</th>
                <th scope="col">Item Details</th>
            </tr>
        </thead>
        <tbody>
            @php
            $no = 0;
            @endphp
            @foreach ($items as $item)
            <tr>
                <th scope="row">{{ ++$no }}</th>
                <td>
                    @if ($item->image)
                        <img src="{{ asset($item->image) }}" class="img-thumbnail" alt="Item Image" style="width: 100px; height: 100px; object-fit: cover;">
                    @else
                        <span>No Image</span>
                    @endif
                </td>
                <td>
                    <div>
                        <strong><a href="{{ route('bid-view', $item->id) }}" style="text-decoration: none; color:black;">{{ $item->title }}</a></strong>
                    </div>
                    <div>Current Price: RM{{ $item->price }}</div>
                    <div>
                        Time remaining:
                        <span id="countdown-{{ $item->id }}"></span>
                    </div>
                    <div>
                        <a href="{{ route('view-bidders', $item->id) }}"><em>{{ $item->bids_count }} bids</em></a>
                    </div>
                    <div class=" mt-2">
                        <a href="{{ route('bid-view', $item->id) }}" class="btn btn-primary btn-sm">BID</a>
                    </div>
                </td>
            </tr>
            @endforeach
        </tbody>
    </table>
    </div>
@else
    <div class="container-sm text-center ">
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
