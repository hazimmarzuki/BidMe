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
            <p>Items that you have purchased:</p>
        </div>

        <table class="table table-striped table-hover">
            <thead>
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Item name</th>
                    <th scope="col">Item price</th>
                    <th scope="col">Seller name</th>
                    <th scope="col">Payment date</th>
                </tr>
            </thead>
            <tbody>
                @php $no = 0; @endphp
                @foreach ($filteredHistory as $index => $info)
                    <tr>
                        <th scope="row">{{ ++$no }}</th>
                        <td><a href="{{ route('item-view', $info->item->id) }}" style="text-decoration: none">{{ $info->item ? $info->item->title : '' }}</a></td>
                        <td>RM{{ $info->payment->amount }}</td>
                        <td>{{ $info->seller->name }}</td>
                        <td>{{ $info->payment->created_at }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    </div>
@endsection
