<!doctype html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">
<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>{{ config('app.name', 'Laravel') }}</title>

    <!-- Scripts -->
    {{-- <script src="{{ asset('js/app.js') }}" defer></script> --}}
    {{-- <script src="{{ asset('js/front.js') }}" defer></script> --}}
    @yield('script')

    <!-- Fonts -->
    <link rel="dns-prefetch" href="//fonts.gstatic.com">
    <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet">

    <!-- Styles -->
    <link href="{{ asset('css/app.css') }}" rel="stylesheet">
</head>
<body @auth class="bg-secondary" @endauth>
    {{-- <div id="app"> --}}
        {{-- @dd(str_contains(Route::currentRouteName(), 'admin.categories')) --}}
        <nav class="navbar navbar-expand-md @guest navbar-light bg-white @endguest @auth navbar-dark bg-dark @endauth shadow-sm">
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
                        <li>
                            <div aria-labelledby="navbarDropdown">
                                <a class="dropdown-item bg-light" href="{{ route('logout') }}"
                                   onclick="event.preventDefault();
                                                 document.getElementById('logout-form').submit();">
                                    {{ __('Logout') }}
                                </a>

                                <form id="logout-form" action="{{ route('logout') }}" method="POST" class="d-none">
                                    @csrf
                                </form>
                            </div>
                        </li>
                        
                    </ul>

                    <!-- Right Side Of Navbar -->
                    <ul class="navbar-nav ml-auto d-flex align-items-center">
                        <!-- Authentication Links -->
                        @guest
                            <li class="nav-item">
                                <a class="nav-link" href="{{ route('login') }}">{{ __('Login') }}</a>
                            </li>
                            @if (Route::has('register'))
                                <li class="nav-item">
                                    <a class="nav-link" href="{{ route('register') }}">{{ __('Register') }}</a>
                                </li>
                            @endif
                        @else
                            <li class="nav-item">
                                <a id="navbarDropdown" class="nav-link" href="#" role="button" data-toggle="dropdown" aria-haspopup="true" aria-expanded="false" v-pre>
                                    {{ Auth::user()->name }}
                                </a>
                            </li>
                            
                            @if(Route::currentRouteName() == 'admin.home')  
                                <a class="btn btn-light rounded-end me-2" href="{{route('admin.posts.index')}}" >POSTS</a>
                                <a class="btn btn-light rounded-end" href="{{route('admin.categories.index')}}" >CATEGORIES</a>
                            @elseif(str_contains(Route::currentRouteName(), 'admin.categories'))
                            <li class="nav-item">
                                @if(Auth::user()->roles()->get()->contains(1))
                                    <a class="nav-link bg-primary p-1 me-2 rounded-start" href="{{route('admin.categories.create')}}" style="color:white">ADD CATEGORY</a>
                                @else
                                    <a class="nav-link bg-secondary p-1 me-2 rounded-start" href="" style="color:white">ADD CATEGORY</a>
                                @endif
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-primary p-1 me-2" href="{{route('admin.categories.index')}}" style="color:white">CATEGORY LIST</a>
                            </li>
                            <a class="btn-light bg-light p-2 rounded-end change" href="{{route('admin.posts.index')}}" style="text-decoration: none">POSTS</a>
                            @else
                            <li class="nav-item">
                                <a class="nav-link bg-primary p-1 me-2 rounded-start" href="{{route('admin.posts.create')}}" style="color:white">ADD POST</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-primary p-1 me-2 " href="{{route('admin.posts.index')}}" style="color:white">POST LIST</a>
                            </li>
                            <li class="nav-item">
                                <a class="nav-link bg-primary p-1 me-2 " href="{{route('admin.posts.myPosts')}}" style="color:white">MY POST</a>
                            </li>
                            <a class="btn-light bg-light p-2 rounded-end" href="{{route('admin.categories.index')}}" style="text-decoration: none">CATEGORIES</a>
                            @endif
                            
                            
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        
            <main class="py-4">
                @yield('content')
            </main>
        
    {{-- </div> --}}
</body>
</html>
