@extends('auth.layout')

@section('content')

<title>Register BidMe</title>


<link rel="stylesheet" href="{{asset('css/login.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
          <!-- Centering the row horizontally -->
          <h4> Sign Up</h4>


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
                    name="name" value="{{ old('name') }}"
                    pattern="[A-Za-z\s]+" title="Only alphabetic characters are allowed" required>


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
                <label for="phone" class="col-sm-2 col-form-label"
                  >No. Phone</label
                >
                <div class="col-sm-10">
                    <input type="number" maxlength="11" oninput="this.value = this.value.replace(/[^0-9]/g, '').slice(0, 11);"
                    class="form-control @error('phone') is-invalid @enderror"
                    name="phone"  value="{{ old('phone') }}" />


                  @error('phone')
                      <div class="invalid-feedback">{{$message}}</div>
                  @enderror

                </div>
              </div>
            <div class="row mb-3">
                <label for="address" class="col-sm-2 col-form-label">Address</label>
               <div class="col-sm-10">

                <textarea id="address" name="address" required
                    class="form-control">{{ old('address') ?? '' }} </textarea>

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
            <div class="text-center">
            <button type="reset" class="btn btn-secondary mx-2">Reset</button>
            <button type="submit" class="btn btn-primary mx-2">Sign Up</button
            ><br /><br />
            </div>
            <p>Already have an account? <a href="{{url ('login')}}">Click here!</a></p>
          </form>
        </div>
      </div>

      @endsection
