<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta http-equiv="X-UA-Compatible" content="IE=edge">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    <script src="{{ asset('js/app.js') }}" defer></script>
    <script src="{{ asset('js/jquery-3.3.1.min.js') }}" defer></script>
    <script src="{{ asset('js/style.js') }}" defer></script>


    <!-- Fonts -->
    <link rel="dns-prefetch" href="https://fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
    <link href="{{ asset('css/font-awesome.min.css') }}" rel="stylesheet">
</head>
<body>
    <div id="app">
        <nav class="navbar navbar-expand-md navbar-light navbar-laravel">
            <div class="container">
                <a class="navbar-brand" href="{{ url('/') }}">
                    {{ config('app.name', 'Laravel') }}
                </a>
                <button class="navbar-toggler" type="button" data-toggle="collapse" data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false" aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <!-- Left Side Of Navbar -->
                    <ul class="navbar-nav mr-auto">
                    
                    </ul>
                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                            </li>
                        @else
                            @if(Auth::user()->role_id == 1)
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle btn btn-primary btn-sm" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <i class="fa fa-user-secret"></i> Admin<span class="caret"></span>
                                </a>
                                <ul class="dropdown-menu dropdown-menu-right mt-2" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item">
                                        <ul class="list-group list-group-flush">
                                            <li class="list-group-item m-0 p-0">
                                                <a class="nav-link" href="{{ route('companies.index') }}"><i class="fa fa-building"></i> {{ __('All Companies') }}</a>
                                            </li>
                                            <li class="list-group-item m-0 p-0">
                                                <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i> {{ __('All Projects') }}</a>
                                            </li>
                                            <li class="list-group-item m-0 p-0">
                                                <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fa fa-tasks"></i> {{ __('All Tasks') }}</a>
                                            </li>
                                            <li class="list-group-item m-0 p-0">
                                                <a class="nav-link" href="{{ route('users.index') }}"><i class="fa fa-users"></i> {{ __('All Users') }}</a>
                                            </li>
                                            <li class="list-group-item m-0 p-0">
                                                <a class="nav-link" href="{{ route('roles.index') }}"><i class="fa fa-user"></i> {{ __('All Roles') }}</a>
                                            </li>
                                        </ul>
                                    </li>
                                </ul>
                            </li>
                            @endif
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('companies.index') }}"><i class="fa fa-building"></i> {{ __('Companies') }}</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('projects.index') }}"><i class="fa fa-briefcase"></i> {{ __('Projects') }}</a>
                            </li><li class="nav-item">
                                <a class="nav-link" href="{{ route('tasks.index') }}"><i class="fa fa-tasks"></i> {{ __('Tasks') }}</a>
                            </li>
                            
                            <li class="nav-item dropdown">
                                <a id="navbarDropdown" class="nav-link dropdown-toggle" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    <img class="d-inline mr-1 rounded-circle" width="30" height="30" src="{{ asset('img/private-image-icon.jpg') }}" alt=""><span class="caret"></span>
                                </a>

                                <ul class="dropdown-menu dropdown-menu-right" aria-labelledby="navbarDropdown">
                                    <li class="dropdown-item bg-light">
                                        {{ Auth::user()->name }}
                                    </li>
                                    <li class="dropdown-item">
                                        <a class="" href="{{ route('logout') }}" onclick="event.preventDefault(); document.getElementById('logout-form').submit();">
                                            {{ __('Logout') }}
                                        </a>
                                        <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                            @csrf
                                        </form>
                                    </li>
                                </ul>
                            </li>
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main class="py-4">
            @include('partials.success')
            @include('partials.error')
            @yield('content')
        </main>
    </div>
    <script src="{{ asset('js/style.js') }}" defer></script>
</body>
</html>
