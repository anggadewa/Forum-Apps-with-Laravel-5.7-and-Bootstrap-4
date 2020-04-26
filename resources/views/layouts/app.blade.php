<!DOCTYPE html>
<html lang="{{ str_replace('_', '-', app()->getLocale()) }}">

<head>
    <meta charset="utf-8">
    <meta name="viewport" content="width=device-width, initial-scale=1">

    <!-- CSRF Token -->
    <meta name="csrf-token" content="{{ csrf_token() }}">

    <title>ForCode | @yield('title')</title>
    <!-- Fonts -->
    {{-- <link rel="dns-prefetch" href="//fonts.gstatic.com"> --}}
    {{-- <link href="https://fonts.googleapis.com/css?family=Nunito" rel="stylesheet" type="text/css"> --}}

    <!-- Styles -->
    <!-- Bootstrap CSS -->
    <link rel="stylesheet" href="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/css/bootstrap.min.css"
        integrity="sha384-Vkoo8x4CGsO3+Hhxv8T/Q5PaXtkKtu6ug5TOeNV6gBiFeWPGFN9MuhOf23Q9Ifjh" crossorigin="anonymous">
    <link href="{{ asset('css/style.css') }}" rel="stylesheet">
    <link href="{{ asset('css/select2.min.css') }}" rel="stylesheet">
    <link rel="stylesheet" href="{{asset('icon/css/all.css')}}">
</head>

<body>
    <div id="app">
        <nav class="navbar navbar-expand-lg navbar-light mt-2 mb-5">
            <div class="container">
                <a class="navbar-brand" href="#"><img src="{{asset('img/logo.png')}}" alt="" width="85"></a>
                <button class="navbar-toggler" type="button" data-toggle="collapse"
                    data-target="#navbarSupportedContent" aria-controls="navbarSupportedContent" aria-expanded="false"
                    aria-label="{{ __('Toggle navigation') }}">
                    <span class="navbar-toggler-icon"></span>
                </button>

                <div class="collapse navbar-collapse" id="navbarSupportedContent">
                    <ul class="navbar-nav mr-auto fontNav">
                        @guest
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('beforeLogin')}}">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('forum.index')}}">QUESTION</a>
                        </li>
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('tag.index')}}">TAG</a>
                        </li>
                        <li class="nav-item searchNav" style="margin-right: 20px;">
                            <form action="{{route('forumsearch')}}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control searchNav" placeholder="Search Question"
                                        aria-label="Search Question" aria-describedby="button-addon2" size="80">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit" id="button-addon2"><img
                                                src="{{asset('img/search.svg')}}" alt="" width="20"></button>
                                    </div>
                                </div>
                            </form>
                        </li>
                        <li>
                            <a class="navItemRight text-center" href="{{route('login')}}" style="opacity: 85%;"
                                style="margin-left: 20px;">LOGIN</a>
                        </li>
                        <li>
                            <a class="navItemRight text-center" href="{{route('register')}}">REGISTER</a>
                        </li>
                        @else
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('forum.index')}}">HOME</a>
                        </li>
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('forum.create')}}">QUESTION</a>
                        </li>
                        <li class="nav-item">
                            <a class="navItem text-center" href="{{route('tag.index')}}">TAG</a>
                        </li>
                        <li class="nav-item searchNav" style="margin-right: 20px;">
                            <form action="{{route('forumsearch')}}" method="get">
                                <div class="input-group mb-3">
                                    <input type="text" name="search" class="form-control searchNav" placeholder="Search Question"
                                        aria-label="Search Question" aria-describedby="button-addon2" size="80">
                                    <div class="input-group-append">
                                        <button class="btn btn-secondary" type="submit" id="button-addon2"><img
                                                src="{{asset('img/search.svg')}}" alt="" width="20"></button>
                                    </div>
                                </div>
                            </form>
                        </li>
                        {{-- <li>
                            <a class="navItemRight text-center" href="#portofolio" style="opacity: 85%;"
                                style="margin-left: 20px;">ASK</a>
                        </li> --}}
                        <li class="nav-item dropright">
                            <a class="navItemRight text-center dropdown-toggle"
                                href="{{ route('profile',Auth::user()->name) }}">
                                <img src="{{asset('img/'.Auth::user()->image)}}" width="20" height="20"
                                    class="rounded-circle">
                                {{Auth::user()->name}}
                            </a>
                        </li>
                        {{-- <li class="nav-item dropright">
                            <a class="navItemRight text-center dropdown-toggle" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();">
                                <img src="{{asset('img/user.png')}}" width="20" height="20" class="rounded-circle">
                                MisterX
                            </a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        </li> --}}
                        @endguest
                    </ul>
                </div>
            </div>
        </nav>

        <main>
            <div class="container">
                <div class="flash-data" data-flashdata="{{session('info')}}">
                    @if (session('info'))
                    @endif
                </div>
            </div>
            @yield('content')
        </main>
    </div>

    <!-- Script -->
    <script src="https://code.jquery.com/jquery-3.4.1.slim.min.js"
        integrity="sha384-J6qa4849blE2+poT4WnyKhv5vZF5SrPo0iEjwBvKU7imGFAV0wwj1yYfoRSJoZ+n" crossorigin="anonymous">
    </script>
    {{-- <script src="https://cdn.jsdelivr.net/npm/popper.js@1.16.0/dist/umd/popper.min.js"
        integrity="sha384-Q6E9RHvbIyZFJoft+2mJbHaEWldlvI9IOYy5n3zV9zzTtmI3UksdQRVvoxMfooAo" crossorigin="anonymous">
    </script> --}}
    <script src="https://stackpath.bootstrapcdn.com/bootstrap/4.4.1/js/bootstrap.min.js"
        integrity="sha384-wfSDF2E50Y2D1uUdj0O3uMBJnjuUD4Ih7YwaYd1iqfktj0Uod8GCExl3Og8ifwB6" crossorigin="anonymous">
    </script>
    <script src="https://cdnjs.cloudflare.com/ajax/libs/select2/4.0.6-rc.0/js/select2.min.js"></script>
    <script src="/vendor/unisharp/laravel-ckeditor/ckeditor.js"></script>
    {{-- <script src="{{ asset('js/app.js') }}"></script> --}}
    <script src="{{ asset('js/dist/sweetalert2.all.min.js') }}"></script>
    <script src="{{ asset('js/myscript.js') }}"></script>
    @yield('js')
</body>

</html>
