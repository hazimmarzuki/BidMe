@extends('auth.layout')

@section('content')

<title>Login BidMe</title>


<link rel="stylesheet" href="{{asset('css/login.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
          <!-- Centering the row horizontally -->
          <h4> Login</h4>


          <form action="{{ route('login-store')}}" method="POST">
            @csrf


            @if ( session('error'))
            <p class="alert alert-danger">{{ session( 'error' )}}</p>
            @endif


            <div class="row mb-3">
                <label for="inputEmail3" class="col-sm-2 col-form-label"
                  >Email</label
                >
                <div class="col-sm-10">
                  <input type="email" class="form-control "
                  name="email"  value="" />

                </div>
              </div>


            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label"
                >Password</label
              >
              <div class="col-sm-10">

                <input
                  type="password"
                  class="form-control "
                   name="password"
                  value=""
                />

              </div>
            </div>

            <br />
            <div class="text-center" >
            <button type="reset" class="btn btn-secondary mx-2">Reset</button>
            <button type="submit" class="btn btn-primary mx-2">Login</button
            ><br /><br />
            </div>
            <p>Don't have an account? <a href="{{url ('register')}}">Click here!</a></p>
          </form>
        </div>
      </div>

      @endsection
