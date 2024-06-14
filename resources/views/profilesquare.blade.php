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
    @if (session('success'))
        <div class="alert alert-success mt-3">{{ session('success') }}</div>
    @endif

    @if ($items->count() > 0)

    <div class="d-flex justify-content-between align-items-center mb-3">
        <h2 class="p-2 rounded" style="color:  rgb(236, 232, 232);">
            All Items
        </h2>
        <div>
            {{-- profile list --}}
            <a href="{{ route('profile-list') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; color:rgba(255, 255, 255, 0.568); ">
                    list
                </span>
            </a>
            {{-- profile square --}}
            <a href="{{ route('profile-square') }}">
                <span class="material-symbols-outlined" style="font-size: 36px; padding-right:1%; color:rgb(255, 243, 243);">
                    capture
                </span>
            </a>
        </div>
    </div>

    <div class="row">
        @foreach ($items as $item)
        <div class="col-md-4 mb-4">
            <div class="card h-100">
                @if ($item->image)
                <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image" style="height: 200px; object-fit: cover;">
                @endif
                <div class="card-body d-flex flex-column">
                    <h5 class="card-title">{{ $item->title }}</h5>
                    <p class="card-text">{{ Str::limit($item->description, 100) }}</p>
                    <p class="card-text"><strong>Price:</strong> RM{{ $item->price }}</p>
                    <div class="mt-auto">
                        <div class="countdown-container mb-2" id="countdown-{{ $item->id }}"></div>
                        @php
                            $timelimit = now()->addMinutes(5);
                        @endphp

                        @if ($item->countdown_date > $timelimit)
                        <a href="{{ route('edit-item', $item->id) }}" class="btn btn-primary btn-sm">Edit</a>
                        <form action="{{ route('delete-item', $item->id) }}" method="POST" class="d-inline" onsubmit="return confirm('Are you sure want to delete item titled {{ $item->title }}?')">
                            @method('delete')
                            @csrf
                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>
                        </form>
                        @else
                        <p class="text-danger">Item's locked!</p>
                        @endif
                        <a href="{{ route('view-bidders', $item->id) }}" class="d-block mt-2"><em>{{ $item->bids_count }} bids</em></a>
                    </div>
                </div>
            </div>
        </div>
        @endforeach
    </div>
    @else
    <div class="container-sm text-center mt-5">
        <h2>You do not sell any item yet!</h2>
    </div>
    @endif
    {{ $items->links() }}
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
