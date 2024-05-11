@extends('applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/viewbuyers.css') }}" />

{{-- <p>Buyers that has been placed their bid for
<h2>{{ $buyers[0]->item->title}}</h2> --}}
<div class="container-lg">
    <p>Items that you already bid, </p>
    <h4>{{ Auth::user()->name}}</h4>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Item name</th>
        <th scope="col">Bid amount</th>
        <th scope="col">Bid time</th>
        <th scope="col">Bid status</th>

      </tr>
    </thead>
    @foreach ($bids as $index => $bid)
    <tbody>
      <tr>
        <th scope="row">{{ $index +1 }}</th>
        @php
        $highestBid = $bid->where('item_id', $bid->item_id)->max('bid_amount');
        @endphp

        @if ($bid->item && $bid->item->countdown_date > now())
        <td><a style="text-decoration: none" href="{{route('bid-view', $bid->item->id)}}">{{ $bid->item ? $bid->item->title : '' }}</a></td>
        @elseif ($bid->item && $bid->item->countdown_date < now())
        <td>{{ $bid->item ? $bid->item->title : '' }}</td>
        @endif

        <td>RM{{ $bid->bid_amount }}</td>
        <td>{{ $bid->bid_time }}</td>

        @if ($bid->item && $bid->item->countdown_date < now())
        @if ($bid->bid_amount == $bid->item->price && $bid->payment && $bid->payment->bid_id)
        <td style="background-color: rgb(2, 202, 2); ">Won  <p style="background-color: yellow; float: right;">PAID</p></td>
        @elseif ($bid->bid_amount == $bid->item->price && !$bid->payment)
        <td style="background-color: rgb(2, 202, 2);  ">Won  <button style="background-color: yellow; float: right;"><a href="{{ route('payment', $bid->id) }}" class="text-decoration-none">PAY</a></button></td>
          @else
          <td style="background-color: rgb(216, 2, 2)">Lost</td>
             @endif
        @elseif ($bid->item && $bid->item->countdown_date > now())
        @if ($bid->bid_amount == $highestBid )
        <td style="background-color: rgb(141, 170, 250)">On going (Currently win)
            </td>
        @else
        <td style="background-color: rgb(141, 170, 250)">On going (Currently lost)
            <button style="float: right" ><a style="text-decoration: none" href="{{route ('bid-view', $bid->item_id)}}">go bid</a></button></td>
        @endif
        @endif
      </tr>
    </tbody>
    @endforeach
  </table>
</div>


@endsection
