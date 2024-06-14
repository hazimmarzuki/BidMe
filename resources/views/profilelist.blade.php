@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{ asset('css/profile.css') }}" />

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-profile">
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/item/create')) active @endif" href="{{ route('create-item') }}">Add New Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/purchase-history')) active @endif" href="{{ route('purchase-history') }}">Purchase History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/sales-history')) active @endif" href="{{ route('sales-history') }}">Sales History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('profile/edit')) active @endif" href="{{ route('edit-profile') }}">Edit Profile</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/bid/status')) active @endif" href="{{ route('show-bids') }}">Bid Status</a>
          </li>
        </ul>
      </div>
    </div>
</nav>


<div class="container-lg">
    <!-- Check for success message -->
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    <!-- Check if items exist -->
    @if ($items->count() > 0)
    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="p-2 rounded" style="color: rgb(236, 232, 232);">All Items</h2>
        <div>
            <!-- Profile list link -->
            <a href="{{ route('profile-list') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; color:rgb(255, 243, 243);">list</span>
            </a>
            <!-- Profile square link -->
            <a href="{{ route('profile-square') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; padding-right:1%; color:rgba(255, 255, 255, 0.568);">capture</span>
            </a>
        </div>
    </div>

    <div class="container-lg-list">
        <h4>Your items</h4>
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Image</th>
                    <th scope="col" style="text-align: left;">Item Details</th> <!-- Align item details content to the left -->
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
                        <!-- Display item image or placeholder -->
                        @if ($item->image)
                            <img src="{{ asset($item->image) }}" class="img-thumbnail" alt="Item Image" style="width: 100px; height: 100px; object-fit: cover;">
                        @else
                            <span>No Image</span>
                        @endif
                    </td>
                    <td style="text-align: left;"> <!-- Align item details content to the left -->
                        <div>
                            <strong><a href="{{ route('item-view', $item->id) }}" style="text-decoration: none; color:black;">{{ $item->title }}</a></strong>
                        </div>
                        <div>Price: RM{{ $item->price }}</div>
                        <div>
                            Time remaining:
                            <span id="countdown-{{ $item->id }}"></span>
                        </div>
                        <div>
                            @php
                                $timelimit = now()->addMinutes(5);
                            @endphp

                            @if ($item->countdown_date > $timelimit)
                                <!-- Edit item and delete item buttons -->
                                <a href="{{ route('edit-item', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                                <form action="{{ route('delete-item', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure you want to delete item titled {{ $item->title }}?')">
                                    @method('delete')
                                    @csrf
                                    <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                                </form>
                            @else
                                <span>Item's locked!</span>
                            @endif
                        </div>
                        <div>
                            <!-- View bidders link -->
                            <a href="{{ route('view-bidders', $item->id) }}"><em>{{ $item->bids_count }} bids</em></a>
                        </div>
                    </td>
                </tr>
                @endforeach
            </tbody>
        </table>
    </div>
    @else
    <div class="container-sm text-center mt-5">
        <h2>You do not sell any item yet!</h2>
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
