@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-profile">
          <li class="nav-item">
            <a class="nav-link @if (Request::is('/item/create')) active @endif"  href="{{ route('create-item') }}">Add New Item</a>
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
    <!-- Centering the container and making it smaller -->
    <div class="row">
        <!-- Centering the row horizontally -->
        @if (session('success'))
            <div class="col-12">
                <div class="alert alert-success">{{ session('success') }}</div>
            </div>
        @endif

        @if ($items->count() > 0)
        <h2 class="col-12" style="background-color: rgb(236, 232, 232)">All Items

            {{-- profile list --}}
            <a  href="{{ route('profile-list') }}">
            <span class="material-symbols-outlined"
            style="float: right; font-size: 36px; color:black;">
            list
            </span>
            </a>
            {{-- profile square --}}
            <a href="{{ route('profile-square') }}">
            <span class="material-symbols-outlined"
            style="float: right; font-size: 36px; padding-right:1%; color:black;">
                capture
            </span>
            </a>
        </h2>


        <div class="container-lg-list">
            <p>Items that you already sell, </p>
            <h4>{{ Auth::user()->name}}</h4>
        <table class="table">
            <thead>
              <tr>
                <th scope="col">No.</th>
                <th scope="col">Item name</th>
                <th scope="col">Item price</th>
                <th scope="col">Time remaining</th>
                <th scope="col">List of buyer</th>
                <th scope="col">Edit?Delete</th>


              </tr>
            </thead>
            @php
            $no = 0;
            @endphp
            @foreach ($items as $item )
            <tbody>
              <tr>
                <th scope="row">{{ $no = $no +1 }}</th>
                <td><a style="text-decoration: none; color:black;" href= {{route ('item-view', $item->id)}}>{{ $item->title }}</a></td>
                <td>RM{{ $item->price }}</td>
                <td>
                    <div class="countdown-container d-inline">
                        <span id="countdown-{{ $item->id }}"></span>
                    </div>
                </td>
                <td>
                    <a href="{{route('view-bidders' , $item->id)}}"><em> {{ $item->bids_count}} bids</em></a>
                </td>
                <td>
                @php
                    $timelimit = now()->addMinutes(5);
                @endphp

                @if ($item->countdown_date > $timelimit)

                    <a type="submit" class="btn btn-primary btn-sm" href= {{route ('edit-item', $item->id)}}
                        style="margin-right: 10px;"
                        >Edit</a>



                <form action="{{ route('delete-item', $item->id) }}" method="POST" class="d-inline"
                    onsubmit="return confirm('Are you sure want to delete item titled {{$item->title}}?')">
                @method('delete')
                @csrf

                <button type="submit" class="btn btn-danger btn-sm">Delete</button>

                </form>
                @endif
                </td>

              </tr>
            </tbody>
            @endforeach
          </table>
        </div>

        @else
            <div class="container-sm ">
                <h2 class="col-12">You do not sell any item yet!</h2>
            </div>
        @endif
    </div>

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
