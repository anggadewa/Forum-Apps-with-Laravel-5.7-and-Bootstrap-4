@extends('layouts.app')

@section('content')
<div class="container">
    <div class="row" style="margin-top: 100px;">
        <div class="col-lg-6" style="text-align: center;">
            <div class="row registerInfo">
                <div class="col-lg-6 imgRegisterInfo">
                    <img src="{{asset('img/unstuk.png')}}" alt="">
                </div>
                <div class="col-lg-6 h4RegisterInfo">
                    <h4 class="">Get unstuck - ask a question</h4>
                </div>
            </div>
            <div class="row registerInfo">
                <div class="col-lg-6 imgRegisterInfo">
                    <img src="{{asset('img/answer.png')}}" alt="">
                </div>
                <div class="col-lg-6 h4RegisterInfo">
                    <h4 class="">If you can answer - tell them</h4>
                </div>
            </div>
            <div class="row registerInfo">
                <div class="col-lg-6 imgRegisterInfo">
                    <img src="{{asset('img/programmer.png')}}" alt="">
                </div>
                <div class="col-lg-6 h4RegisterInfo">
                    <h4 class="">Sharing your code</h4>
                </div>
            </div>
        </div>

        <div class="col-lg-6">
            <div class="register">
                <form method="POST" action="{{ route('register') }}">
                    @csrf
                    <div class="form-group">
                        <label class="registerLabel" for="name">Name</label> <br>
                        <input id="name" type="text"
                            class="form-control{{ $errors->has('name') ? ' is-invalid' : '' }} registerInput"
                            name="name" value="{{ old('name') }}" required autofocus>
                            @if ($errors->has('name'))
                            <span class="invalid-feedback registerAlert" role="alert">
                                <strong>{{ $errors->first('name') }}</strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <label class="registerLabel" for="email">E-Mail</label> <br>
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} registerInput"
                            name="email"
                            value="{{ old('email') }}" required>
                            @if ($errors->has('email'))
                            <span class="invalid-feedback registerAlert" role="alert">
                                <strong>{{ $errors->first('email') }}</strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <label class="registerLabel" for="password">Password</label> <br>
                        <input id="password" type="password"
                            class="form-control{{ $errors->has('password') ? ' is-invalid' : '' }} registerInput"
                            name="password"
                            required>
                            @if ($errors->has('password'))
                            <span class="invalid-feedback registerAlert" role="alert">
                                <strong>{{ $errors->first('password') }}</strong>
                            </span>
                            @endif
                    </div>

                    <div class="form-group">
                        <label class="registerLabel" for="password-confirm">Confirm Password</label> <br>
                        <input id="password-confirm" type="password" class="form-control registerInput"
                            name="password_confirmation" required>
                    </div>
                    <div class="form-group tengah">
                        <input type="submit" class="registerButton" value="Register">
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
