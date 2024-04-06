@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-profile">
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/item/create')) active @endif" href="{{ route('create-item') }}">Add New Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('register')) active @endif" href="{{ route('profile') }}">Purchase History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('register')) active @endif" href="{{ route('profile') }}">Sales History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('profile/edit')) active @endif" href="{{ route('edit-profile') }}">Edit Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

  <div class="container-lg">
    <!-- Centering the container and making it smaller -->
    <div class="row">
        <!-- Centering the row horizontally -->
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif



        @if ($items->count() > 0)
        <h2 class="col-12">All Items</h2>
            @foreach ($items as $item)
                <div class="col-md-4 mb-4">
                    <div class="card">
                        @if ($item->image)
                            <img src="{{ asset($item->image) }}" class="card-img-top" alt="Item Image"
                            style="width: 100%; height: 200px; object-fit: contain;">
                        @endif
                        <div class="card-body">
                            <h5 class="card-title"><strong>{{ $item->title }}</strong></h5>
                            <p class="card-text">{{ $item->description }}</p>
                            <p class="card-text"><strong>Price:</strong> RM{{ $item->price }}</p>
                            <strong>Time remaining:</strong>
                            <div class="countdown-container d-inline">
                                <span id="countdown-{{ $item->id }}"></span>
                            </div>
                            <br>
                            <a type="submit" class="btn btn-primary btn-sm" href= {{route ('edit-item', $item->id)}}
                            style="margin-right: 10px;"
                            >Edit</a>
                            <form action="{{ route('delete-item', $item->id) }}" method="POST" class="d-inline"
                                onsubmit="return confirm('Are you sure want to delete item titled {{$item->title}}?')">
                            @method('delete')
                            @csrf

                            <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                            </form>

                        </div>
                    </div>
                </div>
            @endforeach
        @else
            <div class="container-sm ">
                <h2 class="col-12">You do not sell any item yet!</h2>
            </div>
        @endif
    </div>
    {{ $items->links()}}

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
