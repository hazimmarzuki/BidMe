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
            <div class="d-flex flex-wrap justify-content-between align-items-center mt-1">
                <h2 class="p-2 rounded" style="color:  rgb(236, 232, 232);">
                    All Items
                </h2>
                <div>
                    {{-- showitems list --}}
                    <a href="{{ route('show-items-list') }}">
                        <span class="material-symbols-outlined" style="font-size: 36px; color:rgba(255, 255, 255, 0.568); ">
                            list
                        </span>
                    </a>
                    {{-- showitems square --}}
                    <a href="{{ route('show-items-square') }}">
                        <span class="material-symbols-outlined" style="font-size: 36px; padding-right:1%; color:rgb(255, 243, 243);">
                            capture
                        </span>
                    </a>
                </div>
                <div class="w-100"></div> <!-- Add this empty div to create a new line -->
                <div class="w-100">
                    <form class="d-flex" action="{{ route('search-item') }}" method="get" style="margin: 20px 20px 20px 0; padding: 0;">
                        @csrf
                        <div class="input-group" style="width: 100%;">
                            <input class="form-control" type="search" placeholder="Search" aria-label="Search" name="search" value="{{ old('search', request('search')) }}" style="height: 38px; font-size: 16px; width: 70%;">
                            <select class="form-select" aria-label="category" name="category" style="width: 5%; margin-right: 5px;">
                                <option value="All Items" {{ old('category', $category) == 'All Items' ? 'selected' : '' }}>All Items</option>
                                <option value="Home & Living" {{ old('category', $category) == 'Home & Living' ? 'selected' : '' }}>Home & Living</option>
                                <option value="Fashion" {{ old('category', $category) == 'Fashion' ? 'selected' : '' }}>Fashion</option>
                                <option value="Lifestyle" {{ old('category', $category) == 'Lifestyle' ? 'selected' : '' }}>Lifestyle</option>
                                <option value="Electronics" {{ old('category', $category) == 'Electronics' ? 'selected' : '' }}>Electronics</option>
                                <option value="Health & Beauty" {{ old('category', $category) == 'Health & Beauty' ? 'selected' : '' }}>Health & Beauty</option>
                                <option value="Baby & Toys" {{ old('category', $category) == 'Baby & Toys' ? 'selected' : '' }}>Baby & Toys</option>
                            </select>
                            <button class="btn btn-primary" type="submit" style="height: 38px; font-size: 16px;">Search</button>
                        </div>
                    </form>



                </div>

            </div>
                {{ $items->links()}}



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
