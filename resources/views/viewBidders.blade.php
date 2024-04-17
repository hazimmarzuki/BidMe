@extends('applayout')

@section('content')

@foreach ($bidders as $bidder)
    <li>{{$bidder->name}}</li>
@endforeach

@endsection
