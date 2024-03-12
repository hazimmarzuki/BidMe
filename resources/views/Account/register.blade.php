@extends('Account.navbar')

@section('content')

<title>Register BidMe</title>


<link rel="stylesheet" href="{{asset('css/login.css')}}" />
<link href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/5.15.4/css/all.min.css" rel="stylesheet">

      <div class="container-sm">
        <!-- Centering the container and making it smaller -->
        <div>
          <!-- Centering the row horizontally -->
          <h4> Please enter the following information</h4>

          @if ( $errors->any())

          <p class="alert alert danger">Please check your input</p>

          @endif

          <form action="{{ route('account-store')}}" method="POST">
            @csrf
            <div class="row mb-3">
              <label for="inputEmail3" class="col-sm-2 col-form-label"
                >Email</label
              >
              <div class="col-sm-10">
                <input type="email" class="form-control @error('email') is-invalid @enderror" id="email"
                name="email"  value="{{ old('email') }}" />


                @error('email')
                    <div class="invalid-feedback">{{$message}}</div>
                @enderror

                <div id="emailHelp" class="form-text">
                  We'll never share your email with anyone else.
                </div>
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
                  id="password" name="password"
                  value="{{ old ('password') }}"
                />
                <span >
                    <i class="fas fa-eye" id="togglePassword"></i>
                </span>



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
                    id="password_confirmation" name="password_confirmation"
                    value="{{ old ('password_confirmation') }}"
                  />

                  <span >
                    <i class="fas fa-eye" id="togglePasswordConfirmation"></i>
                </span>

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

      <script>
        const togglePassword = document.querySelector('#togglePassword');
        const password = document.querySelector('#password');

        togglePassword.addEventListener('click', function(e) {
            // toggle the type attribute
            const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
            password.setAttribute('type', type);
            // toggle the eye slash icon
            this.classList.toggle('fa-eye-slash');
        });
    </script>

<script>
    const togglePassword = document.querySelector('#togglePassword');
    const password = document.querySelector('#password');

    togglePassword.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = password.getAttribute('type') === 'password' ? 'text' : 'password';
        password.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>

<script>
    const togglePasswordConfirmation = document.querySelector('#togglePasswordConfirmation');
    const passwordConfirmation = document.querySelector('#password_confirmation');

    togglePasswordConfirmation.addEventListener('click', function(e) {
        // toggle the type attribute
        const type = passwordConfirmation.getAttribute('type') === 'password' ? 'text' : 'password';
        passwordConfirmation.setAttribute('type', type);
        // toggle the eye slash icon
        this.classList.toggle('fa-eye-slash');
    });
</script>



      @endsection
