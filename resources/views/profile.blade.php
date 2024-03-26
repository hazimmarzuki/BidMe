@extends('applayout')

@section('content')

<link rel="stylesheet" href="{{asset('css/profile.css')}}" />

<nav class="navbar navbar-expand-lg navbar-light ">
    <div class="container-fluid">
      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav navbar-profile">
          <li class="nav-item">
            <a class="nav-link @if (Request::is('register')) active @endif" href="{{ route('register') }}">Add New Item</a>
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

<div class="container-sm">
    <!-- Centering the container and making it smaller -->
    <div>
      <!-- Centering the row horizontally -->
      <h2>Hello {{Auth::user()->name}} yooooo</h2> <br>
      <h2>with email = {{Auth::user()->email}}</h2>
      <br>
      <h2>with ID = {{Auth::user()->id}}</h2>




    </div>
  </div>
@endsection
