@extends('layouts.app')
@section('title', 'Welcome to ForCode')
@section('content')
    <div class="container">
        <div style="margin-top: 100px;">
            <h1 class="mt-5 ml-5 mr-5">Hello Everyone, <br>
                <span style="font-size: 32px; font-weight: lighter;">Welcome to ForCode, this platform for you to Ask,
                    Answer and Sharing Code.
                    Let's go join with us!</span>
            </h1>
        </div>

        <div class="row mt-5 justify-content-center">
            <div class="col-8">
                <div class="tengah">
                    <a href="" class="btn btn-outline-primary btn-lg colorButton">JOIN</a>
                </div>
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top: 100px;">
            <div class="col-lg tengah">
                <img src="{{asset('img/web-development.png')}}" alt="" width="200">
            </div>

            <div class="col-lg tengah">
                <img src="{{asset('img/question.png')}}" alt="" width="300">
            </div>
        </div>

        <div class="row justify-content-center" style="margin-top: 20px; margin-bottom: 100px;">
            <div class="col-lg tengah">
                <div class="profit">
                    <p class="mt-4">You can sharing code with
                        Profesional Programmer
                        In the World</p>
                </div>
            </div>

            <div class="col-lg tengah">
                <div class="profit">
                    <p>You can ask for your
                        error or mistake in your program
                        and you can answer error
                        or mistake program in an other
                        people</p>
                </div>
            </div>
        </div>
    </div>
    <footer class="bagFooter">
        <div class="container">
            <div class="row justify-content-center">
                <div class="col-8">
                    <div class="tengah mb-5">
                        <img src="{{asset('img/logo-putih.png')}}" alt="" width="120">
                    </div>
                </div>
            </div>

            <div class="row">
                <div class="col-lg">
                    <ul class="menuFooter">
                        <li>
                            <a href="" class="menuLink">Question</a>
                        </li>
                        <li>
                            <a href="" class="menuLink">Help</a>
                        </li>
                        <li>
                            <a href="" class="menuLink">Contact</a>
                        </li>
                    </ul>
                </div>

                <div class="col-lg">
                    <h4>ForCode</h4>
                    <p style="text-align: justify;">Lorem ipsum dolor sit amet consectetur adipisicing elit. Iure
                        possimus, porro nulla labore commodi eos ut enim est error consectetur ex repellat doloremque
                        minus rem vitae nostrum facere, quia optio!</p>
                </div>

                <div class="col-lg ml-5">
                    <div class="float-left">
                        <a href="" class="a-socmed">
                            <img src="{{asset('img/telegram.svg')}}" alt="" width="52" height="52">
                            <p class="linkSocmed">ForCode.id</p>
                        </a> <br><br><br>
                        <a href="" class="a-socmed">
                            <img src="{{asset('img/twitter.svg')}}" alt="" width=" 52" height="52">
                            <p class="linkSocmed">ForCode.id</p>
                        </a>
                    </div>
                    <div class="float-right">
                        <a href="" class="a-socmed">
                            <img src="{{asset('img/facebook.svg')}}" alt="" width="52" height="52">
                            <p class="linkSocmed">ForCode.id</p>
                        </a> <br><br><br>
                        <a href="" class="a-socmed">
                            <img src="{{asset('img/instagram.svg')}}" alt="" width="52" height="52">
                            <p class="linkSocmed">ForCode.id</p>
                        </a>
                    </div>
                </div>
            </div>
        </div>
    </footer>
@endsection