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

            @if (session('error'))
            <div class="col-12">
                <div class="alert alert-danger">{{ session('error') }}</div>
            </div>
            @endif

            @if (isset($success_message))
           <div class="alert alert-success">{{ $success_message }}</div>
            @endif



            @if ($items->count() > 0)
                <h2 class="col-12" style="color : white">All Items</h2>
                {{ $items->links()}}
                <form class="d-flex" action="{{ route('search-item') }}" method="get" style="margin: 20px 20px 20px 0">
                    @csrf
                    <input class="form-control me-2" type="search" placeholder="Search" aria-label="Search" name="search">
                    <button class="btn btn-primary" type="submit">Search</button>
                  </form>
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

            @else
                <div class="container-sm">
                    <h2>There are no items to bid right now :(</h2>
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
                });
            @endforeach
        });
        </script>
@endsection





