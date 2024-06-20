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
        <p>Items that you have sold:</p>
    </div>

    @if ($filteredHistory->isEmpty())
        <div class="alert alert-info text-center">
            You haven't sold any items yet.
        </div>
    @else
        <table class="table table-striped table-hover">
            <thead class="thead-dark">
                <tr>
                    <th scope="col">No.</th>
                    <th scope="col">Item Name</th>
                    <th scope="col">Item Price</th>
                    <th scope="col">Buyer Name</th>
                    <th scope="col">Buyer Address</th>
                    <th scope="col">Payment Date</th>
                </tr>
            </thead>
            <tbody>
                @foreach ($filteredHistory as $index => $info)
                    <tr>
                        <th scope="row">{{ $index + 1 }}</th>
                        <td>
                            <a href="{{ route('item-view', $info->item->id) }}" style="text-decoration: none; color: inherit;">
                                {{ $info->item->title }}
                            </a>
                        </td>
                        <td>RM{{ number_format($info->payment->amount, 2) }}</td>
                        <td>{{ $info->Buyer->name }}</td>
                        <td>{{ $info->Buyer->address }}</td>
                        <td>{{ $info->payment->created_at->format('d M Y, H:i') }}</td>
                    </tr>
                @endforeach
            </tbody>
        </table>
    @endif
</div>
@endsection
