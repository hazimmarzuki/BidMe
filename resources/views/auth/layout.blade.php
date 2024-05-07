<!DOCTYPE html>
<html lang="en">
  <head>
    <meta charset="UTF-8" />
    <meta name="viewport" content="width=device-width, initial-scale=1.0" />
    <link href="https://cdn.jsdelivr.net/npm/bootstrap@5.3.3/dist/css/bootstrap.min.css" rel="stylesheet" integrity="sha384-QWTKZyjpPEjISv5WaRU9OFeRpok6YctnYmDr5pNlyT2bRjXh0JMhjY6hW+ALEwIH" crossorigin="anonymous">
    <!-- custom css file  -->
    <link rel="icon" type="image/png" href="{{ URL::asset('/images/bid.png') }}">
    <link rel="stylesheet"
    href="{{asset('css/welcome.css')}}" />
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
        </div>
      </nav>
    </header>

    <main>

        @yield('content')

    </main>
  </body>
</html>
