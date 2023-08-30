<!DOCTYPE html>
<html lang="en">
<head>
    <meta charset="UTF-8">
    <meta name="viewport" content="width=device-width, initial-scale=1.0">
    <meta http-equiv="X-UA-Compatible" content="ie=edge">
    @vite(['resources/css/app.css','resources/css/carousel.css','resources/js/index.js', 
    'resources/js/app.js','resources/js/list.js'])
     <script src="https://cdnjs.cloudflare.com/ajax/libs/Chart.js/3.7.0/chart.min.js"></script>
    <title>Shorten Url</title>
</head>
<body>
    @php
        use Illuminate\Support\Facades\Auth;
    @endphp
    {{-- <header>
        <nav class="navbar navbar-expand-md navbar-light fixed-top bg-light">
            <div class="container-fluid">
                <a class="navbar-brand" href="#">Short Url</a>
                <button class="navbar-toggler" type="button" data-bs-toggle="collapse" data-bs-target="#navbarCollapse" aria-controls="navbarCollapse" aria-expanded="false" aria-label="Toggle navigation">
                    <span class="navbar-toggler-icon"></span>
                </button>
            
                <div class="collapse navbar-collapse" id="navbarCollapse">
                    <ul class="navbar-nav me-auto mb-2 mb-md-0" style="color: #fff">
                        <li class="nav-item">
                            <a class="nav-link active" aria-current="page" href="#">Home</a>
                        </li>
                        <li class="nav-item">
                            <a class="nav-link" href="#">Links</a>
                        </li>
                    </ul>

                    <div class="btn-register">
                        @auth
                            <a href="{{route('logout')}}" class="btn btn-outline-danger">Logout</a>
                        @else
                            <a href="{{route('login')}}" class="btn btn-primary">Log In</a>
                            <a href="{{route('register')}}" class="btn btn-outline-primary">Sign Up</a>
                        @endauth
                    
                    </div>
                </div>
            </div>
        </nav>
    </header> --}}


    {{-- exemple --}}
  
    <header class="navbar nav-expand-lg bg-dark py-3">
        <h2 class="logo">Short Url</h2>
        <nav class="navigation w-75">

            <div class="links">
                <a href="{{ route('home') }}">Home</a>
                @if(Auth::check() and Auth::user()->links->count() > 0)
                    <a href="{{ route('list.url')}}">Links</a>
                @endif
            </div>
            
            <div class="btn-register">
                @auth
                    <a href="{{route('logout')}}" class="btn btn-outline-danger">Logout</a>
                @else
                    <a href="{{route('login')}}" class="btn btn-primary">Log In</a>
                    <a href="{{route('register')}}" class="btn btn-outline-primary">Sign Up</a>
                @endauth
               
            </div>
        </nav>
        <button class="hamburger">
            <span></span>
            <span></span>
            <span></span>
        </button>
    </header>

    @yield('content')
</body>
</html>