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
                <input type="email" class="form-control @error('email') is-invalid @enderror"
                name="email"  value="{{ old('email') }}" />


                @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

              </div>
            </div>

            <div class="row mb-3">
              <label for="inputPassword" class="col-sm-2 col-form-label"
                >Password</label
              >
              <div class="col-sm-10">

                <input
                  type="password"
                  class="form-control @error('password') is-invalid @enderror"
                   name="password"
                  value="{{ old ('password') }}"
                />




                @error('password')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror




              </div>
            </div>

            <br />
            <button type="submit" class="btn btn-primary">Login</button
            ><br /><br />
            <p>Don't have an account? <a href="{{url ('register')}}">Click here!</a></p>
          </form>
        </div>
      </div>

      @endsection
