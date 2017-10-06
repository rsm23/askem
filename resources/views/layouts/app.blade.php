<!DOCTYPE html>
<html lang="{{ app()->getLocale() }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ env('APP_NAME', 'Askem') }}</title>

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body>
<div id="app">

    {{-- top bar  --}}
    <nav class="navbar navbar-dark bg-primary navbar-expand-lg">

        <a class="navbar-brand" href="#">{{ env('APP_NAME', 'Askem') }}</a>
        <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent"
                aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="Toggle navigation">
            <span class="navbar-toggler-icon"></span>
        </button>
        <div class="collapse navbar-collapse" id="navbarSupportedContent">
            <ul class="navbar-nav">
                <li class="nav-item"><a href="{{ route('home') }}" class="nav-link">Home</a></li>
                <li class="nav-item"><a href="/questions" class="nav-link">Questions</a></li>
                @auth
                    <li class="nav-item"><a href="/questions/create" class="nav-link btn btn-outline-success">Post a
                            question</a></li>
                @endauth
            </ul>

            <ul class="navbar-nav ml-auto">
                @if (Auth::guest())
                    <li class="nav-item"><a href="{{ route('login') }}" class="nav-link">Login</a></li>
                    <li class="nav-item"><a href="{{ route('register') }}" class="nav-link">Register</a></li>
                @else
                    <li class="nav-item dropdown">
                        <a href="#" class="nav-link dropdown-toggle" id="navbarDropdownMenuLink" data-toggle="dropdown"
                           aria-haspopup="true" aria-expanded="false">{{ Auth::user()->name }}</a>
                        <div class="dropdown-menu" aria-labelledby="navbarDropdownMenuLink">
                            <a href="{{ route('logout') }}" class="dropdown-item"
                               onclick="event.preventDefault();document.getElementById('logout-form').submit();">
                                Logout
                            </a>

                            <form id="logout-form" action="{{ route('logout') }}" method="POST"
                                  style="display: none;">
                                {{ csrf_field() }}
                            </form>
                        </div>
                    </li>
                @endif
            </ul>
        </div>

    </nav>

    @yield('content')

</div>

<!-- Scripts -->
<script src="{{ asset('js/app.js') }}"></script>
@yield('footer')
</body>
</html>