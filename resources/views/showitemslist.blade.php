@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />



<div class="container-lg">
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if ($items->count() > 0)
    <div class="d-flex flex-wrap justify-content-between align-items-center mt-1">
        <h2 class="p-2 rounded" style="color:  rgb(236, 232, 232);">
            All Items
        </h2>
        <div>
            {{-- showitems list --}}
            <a href="{{ route('show-items-list') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; color:rgb(255, 243, 243); ">
                    list
                </span>
            </a>
            {{-- showitems square --}}
            <a href="{{ route('show-items-square') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; padding-right:1%; color:rgba(255, 255, 255, 0.568);">
                    capture
                </span>
            </a>
        </div>
        <div class="w-100"></div> <!-- Add this empty div to create a new line -->
        <div class="w-100">
            <form class="d-flex" action="{{ route('search-item') }}" method="get" style="margin: 20px 20px 20px 0; padding: 0;">
                @csrf
                <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search" style="height: 38px; font-size: 16px; width: 100%;"><!-- Adjust the width here -->
                <button class="btn btn-primary" type="submit" style="height: 38px; font-size: 16px;">Search</button>
            </form>
        </div>
    </div>





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
    <div class="container-sm text-center mt-5">
        <h2>No items available for bidding right now :(</h2>
    </div>
    @endif
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
                    $this.html('SOLD/EXPIRED');
                }
            });
        @endforeach
    });
</script>
@endsection