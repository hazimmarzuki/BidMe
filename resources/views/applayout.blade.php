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
    <!-- custom css file  -->
    <link rel="stylesheet" href="{{asset('css/navbar.css')}}" />
  </head>

  <body>
    <header>
      <!-- nav -->
      <nav class="navbar navbar-expand-lg navbar-light bg-light">
        <div class="container-fluid">
          <a class="navbar-brand" href="#">
            <img
              src="{{URL::asset('/images/bid.png')}}"
              alt=""
              width="30"
              height="24"
              class="d-inline-block align-text-top"
            />
            <strong> Bid Me</strong>
          </a>
          <div class="collapseNavBar navbar-collapse" id="navbarNav">
            <ul class="navbar-nav">
                <li class="nav-item">
                    <a class="nav-link @if (Request::is('register')) active @endif" href="{{ route('register') }}">BID</a>
                  </li>
                  <li class="nav-item">
                    <a class="nav-link @if (Request::is('profile')) active @endif" href="{{ route('profile') }}">PROFILE</a>
                  </li>
                  <li class="nav-item">

                    <form  action="{{ route('logout') }}"  method="post" >
                        @csrf

                        <button type="submit" class="btn nav-link">LOGOUT</button>
                     </form>                  </li>
            </ul>
          </div>
        </div>
      </nav>
    </header>

    <main>

        @yield('content')

    </main>
  </body>
</html>
