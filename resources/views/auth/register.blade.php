@extends('auth.layout')

@section('content')

<title>Register BidMe</title>


<link rel="stylesheet" href="{{asset('css/login.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
          <!-- Centering the row horizontally -->
          <h4> Register Account</h4>


          <form action="{{ route('register-store')}}" method="POST">
            @csrf


            @if ($errors -> any())
            <p class="alert alert-danger">Please check your input</p>
            @endif

            <div class="row mb-3">
                <label for="inputName" class="col-sm-2 col-form-label"
                  >Name</label
                >
                <div class="col-sm-10">
                  <input type="text" class="form-control @error('name') is-invalid @enderror"
                  name="name"  value="{{ old('name') }}" />


                  @error('name')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror

                </div>
              </div>

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
            <div class="row mb-3">
                <label for="inputPasswordConfirmation" class="col-sm-2 col-form-label"
                  >Password Confirmation</label
                >
                <div class="col-sm-10">
                  <input
                    type="password"
                    class="form-control @error('password_confirmation') is-invalid @enderror"
                    name="password_confirmation"
                    value="{{ old ('password_confirmation') }}"
                  />

                @error('password_confirmation')
                <div class="invalid-feedback">{{$message}}</div>
                @enderror

                </div>
              </div>
            <br />
            <button type="submit" class="btn btn-primary">Register</button
            ><br /><br />
            <p>Already have an account? <a href="{{url ('login')}}">Click here!</a></p>
          </form>
        </div>
      </div>

      @endsection
