<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link
      href="https://cdn.jsdelivr.net/npm/bootstrap@5.0.2/dist/css/bootstrap.min.css"
      rel="stylesheet"
      integrity="sha384-EVSTQN3/azprG1Anm3QDgpJLIm9Nao0Yz1ztcQTwFspd3yD65VohhpuuCOmLASjC"
      crossorigin="anonymous"
    />
    <link rel="stylesheet" href="https://fonts.googleapis.com/css2?family=Material+Symbols+Outlined:opsz,wght,FILL,GRAD@24,400,0,0" />
    <link rel="icon" type="image/png" href="{{ URL::asset('/images/b.png') }}">
    <!-- custom css file  -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}" />

  </head>

  <body style="background-image: ">
    <header>
      <!-- nav -->
      @auth
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="{{ route('show-items-square') }}">
            <img
            src="{{URL::asset('/images/bb.png')}}"
            alt=""
            width="30"
            height="27"
            class="d-inline-block align-text-top"
          />
          <strong style="margin-left: -3px">id Me</strong>
          </a>

          <div class="collapseNavBar navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('/')) active @endif" href="{{ route('show-items-square') }}">Bid</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if (Request::is('profile-square')) active @endif" href="{{ route('profile-square') }}">{{Auth::user()->name}}</a>
                  </li>
                  <li class="nav-item">

                    <form  action="{{ route('logout') }}"  method="post" >
                        @csrf

                        <button type="submit" class="btn nav-link">Logout</button>
                     </form>                  </li>
            </ul>
          </div>
        </div>
      </nav>
      @endauth

@guest
<nav class="navbar navbar-expand-lg navbar-light bg-light">
    <div class="container-fluid">
      <a class="navbar-brand" href="#">
        <img
          src="{{URL::asset('/images/bb.png')}}"
          alt=""
          width="30"
          height="27"
          class="d-inline-block align-text-top"
        />
        <strong style="margin-left: -3px">id Me</strong>
      </a>

      <div class="collapseNavBar navbar-collapse" id="navbarNav">
        <ul class="navbar-nav">
            <li class="nav-item">
                <a class="nav-link @if (Request::is('login')) active @endif" href="{{ route('login') }}">Login</a>
              </li>

      </div>
    </div>
  </nav>
@endguest

    </header>

    <main>

        @yield('content')

    </main>
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/5.0.0-beta1/js/bootstrap.bundle.min.js" integrity="sha384-ygbV9kiqUc6oa4msXn9868pTtWMgiQaeYH7/t7LECLbyPA2x65Kgf80OJFdroafW" crossorigin="anonymous"></script>

  </body>
</html>
