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
    <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
            <!-- Centering the row horizontally -->
            @if ($errors->any())
                <div class="alert alert-danger">
                    <ul>
                        @foreach ($errors->all() as $error)
                            <li>{{ $error }}</li>
                        @endforeach
                    </ul>
                </div>
            @endif


            <form method="POST" action="{{ route('store-item') }}" enctype="multipart/form-data">
                @csrf
                <div class="mb-3">
                    <label for="title" class="form-label">Item's name:</label>
                    <input type="text" id="title" name="title" value="{{ old('title') }}"required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="category" class="form-label">Item's category:</label>
                    <select class="form-select" aria-label="category" name="category" >
                        <option value="Others" >Select the item's category</option>
                        <option value="Home & Living">Home & Living</option>
                        <option value="Fashion">Fashion</option>
                        <option value="Lifestyle">Lifestyle</option>
                        <option value="Electronics">Electronics</option>
                        <option value="Health & Beauty">Health & Beauty</option>
                        <option value="Baby & Toys">Baby & Toys</option>
                    </select>
                </div>
                <div class="mb-3">
                    <label for="description" class="form-label">Description:</label>
                    <textarea id="description" name="description" required class="form-control">{{ old('description') ?? '' }}</textarea>
                </div>
                <div class="mb-3">
                    <label for="price" class="form-label">Starting Price RM:</label>
                    <input type="text" id="price" name="price" value="{{ old('price') }}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="countdown_date" class="form-label">Last time for bid:</label>
                    <input type="datetime-local" id="countdown_date" name="countdown_date" value="{{ old('countdown_date') }}" min="{{  \Carbon\Carbon::now()->addMinute()->format('Y-m-d\TH:i') }}" required class="form-control">
                </div>
                <div class="mb-3">
                    <label for="image" class="form-label">Upload Image:</label>
                    <input type="file" id="image" name="image" accept="image/*" required class="form-control">
                </div>
                <button type="submit" class="btn btn-primary">Add Item</button>
            </form>
        </div>
    </div>
@endsection
