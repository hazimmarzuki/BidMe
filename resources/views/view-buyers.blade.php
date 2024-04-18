@extends('applayout')

@section('content')
<link rel="stylesheet" href="{{ asset('css/viewbuyers.css') }}" />

{{-- <p>Buyers that has been placed their bid for
<h2>{{ $buyers[0]->item->title}}</h2> --}}
<div class="container-lg">
    <p>Buyers that has been placed their bid for
    <h4>{{ $buyers[0]->item->title}}</h4>
<table class="table">
    <thead>
      <tr>
        <th scope="col">No.</th>
        <th scope="col">Buyer name</th>
        <th scope="col">Bid amount</th>
        <th scope="col">Bid time</th>
      </tr>
    </thead>
    @foreach ($buyers as $index => $buyer)
    <tbody>
      <tr>
        <th scope="row">{{ $index +1 }}</th>
        @if (Auth::id() == $buyer->item->seller_id)
        <td>{{ $buyer->buyer->name }}</td>
        @else
        <td>{{ substr($buyer->buyer->name, 0, 1) . str_repeat('*', strlen($buyer->buyer->name) - 2) . substr($buyer->buyer->name, -1) }}</td>        {{-- <td>{{ $buyer->buyer->name }}</td> --}}
        @endif
        <td>RM{{ $buyer->bid_amount }}</td>
        <td>{{ $buyer->bid_time }}</td>
      </tr>
    </tbody>
    @endforeach
  </table>
</div>


@endsection
