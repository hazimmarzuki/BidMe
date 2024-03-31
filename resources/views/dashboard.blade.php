@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/dashboard.css')}}" />

<div class="container-sm">
    <!-- Centering the container and making it smaller -->
    <div>
      <!-- Centering the row horizontally -->
      <h2>Hello {{Auth::user()->name}}</h2>


    </div>
  </div>


@endsection
