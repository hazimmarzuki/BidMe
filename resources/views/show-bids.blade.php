@extends('applayout')

@section('content')
    <link rel="stylesheet" href="{{ asset('css/viewbuyers.css') }}" />

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

  <div class="container-lg mt-4">
        <div class="text-center mb-4">
            <h4>{{ Auth::user()->name }}</h4>
            <p>Items that you already bid:</p>
        </div>
        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Bid amount</th>
                    <th scope="col">Bid time</th>
                    <th scope="col">Bid status</th>
                </tr>
            </thead>
            <tbody>
                @php
                    $no = 0;
                @endphp
                @foreach ($bids as $index => $bid)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td>
                            @if ($bid->item && $bid->item->countdown_date > now())
                                <a style="text-decoration: none" href="{{ route('bid-view', $bid->item->id) }}">{{ $bid->item ? $bid->item->title : '' }}</a>
                            @elseif ($bid->item && $bid->item->countdown_date < now())
                                <a style="text-decoration: none" href="{{ route('item-view', $bid->item->id) }}">{{ $bid->item ? $bid->item->title : '' }}</a>
                            @endif
                        </td>
                        <td>RM{{ $bid->bid_amount }}</td>
                        <td>{{ $bid->bid_time }}</td>
                        <td>
                            @if ($bid->item && $bid->item->countdown_date < now())
                                @if ($bid->bid_amount == $bid->item->price && $bid->payment && $bid->payment->status == 'success')
                                    <span style="background-color: rgb(2, 202, 2);">Won</span>
                                    <span style="background-color: yellow; float: right;">PAID</span>
                                @elseif ($bid->bid_amount == $bid->item->price && !$bid->payment)
                                    <span style="background-color: rgb(2, 202, 2);">Won</span>
                                    <button style="background-color: yellow; float: right;">
                                        <a href="{{ route('payment', $bid->id) }}" class="text-decoration-none">PAY</a>
                                    </button>
                                @elseif ($bid->bid_amount == $bid->item->price && $bid->payment->status == 'fail')
                                    <span style="background-color: red; ">PAYMENT FAILED</span>
                                    <button style="background-color: yellow; float: right; margin-left: 10px;">
                                        <a href="{{ route('payment', $bid->id) }}" class="text-decoration-none">RETRY PAYMENT</a>
                                    </button>
                                @else
                                    <span style="background-color: rgb(216, 2, 2);">Lost</span>
                                @endif
                            @elseif ($bid->item && $bid->item->countdown_date > now())
                                @php
                                    $highestBid = $bid->where('item_id', $bid->item_id)->max('bid_amount');
                                @endphp
                                @if ($bid->bid_amount == $highestBid)
                                    <span style="background-color: rgb(141, 170, 250);">On going (Currently win)
                                        Time remaining:
                                        <span id="countdown-{{ $bid->item>id }}"></span>
                                    </span>
                                @else
                                    <span style="background-color: rgb(141, 170, 250);">On going (Currently lost)
                                        Time remaining:
                                        <span id="countdown-{{ $bid->item>id }}"></span>
                                    </span>
                                    <button style="float: right;"><a style="text-decoration: none" href="{{ route('bid-view', $bid->item_id) }}">Go bid</a></button>
                                @endif
                            @endif
                        </td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>

    <script src="https://code.jquery.com/jquery-3.6.0.min.js"></script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/jquery.countdown/2.2.0/jquery.countdown.min.js"></script>

    <script>
        $(document).ready(function() {
            @foreach ($bids as $bid)
                $('#countdown-{{ $bid->item->id }}').countdown('{{ $bid->item->countdown_date->format('Y/m/d H:i:s') }}', function(event) {
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
