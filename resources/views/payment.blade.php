@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-profile">
          <li class="nav-item">
            <a class="nav-link @if (Request::is('item/create')) active @endif" href="{{ route('create-item') }}">Add New Item</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('register')) active @endif" href="{{ route('profile') }}">Purchase History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('profile')) active @endif" href="{{ route('profile') }}">Sales History</a>
          </li>
          <li class="nav-item">
            <a class="nav-link @if (Request::is('profile/edit')) active @endif" href="{{ route('edit-profile') }}">Edit Profile</a>
          </li>
        </ul>
      </div>
    </div>
  </nav>

<div class="container-sm">
    <!-- Centering the container and making it smaller -->
    <div>
      <!-- Centering the row horizontally -->

      @if (session('success'))
      <p class="alert alert-success">{{session('success')}}</p>
      @endif

      <form action="{{ route('payment-process', $bid->id) }}" method="POST">
        @csrf


        @if ($errors -> any())
        <p class="alert alert-danger">Please check your input</p>
        @endif

        @if ($bid->item->image)
        <img src="{{ asset($bid->item->image) }}" class="card-img-top" alt="Item Image"
        style="width: 100%; height: 200px; object-fit: contain;">
        @endif


            <input type="hidden" id="buyer_name" name="buyer_name" value="{{ $bid->buyer->name}}">


        <div class="row mb-3">
            <label for="item_title"><strong>Item name :</strong> {{ $bid->item->title}} </label>
          <div class="col-sm-10">
            <input type="hidden" id="item_title" name="item_title" value="{{ $bid->item->title}}">
          </div>
        </div>


        <div class="row mb-3">
            <label for="amount"><strong>Amount :</strong> RM{{ $bid->bid_amount}} </label>
          <div class="col-sm-10">
            <input type="hidden" id="amount" name="amount" value="{{ $bid->bid_amount}}">
          </div>
        </div>

        <br />
        <button type="submit" class="btn btn-primary">Submit Payment</button
        ><br /><br />
      </form>

    </div>
  </div>
@endsection
