@extends('layouts.app')
@section('title', 'Login to ForCode')
@section('content')
<div class="container">
    <div class="row justify-content-center" style="margin-top: 100px;">
        <div class="col-lg-6">
            <div class="register">
                <form action="{{ route('login') }}" method="POST">
                    @csrf
                    <div class="form-group">
                        <label class="registerLabel" for="email">E-Mail</label> <br>
                        <input id="email" type="email"
                            class="form-control{{ $errors->has('email') ? ' is-invalid' : '' }} registerInput"
                            name="email"
                            value="{{ old('email') }}" required autofocus>
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

                    <div class="form-group tengah">
                        <input type="submit" class="registerButton" value="Login">
                        <br><br>
                        @if (Route::has('password.request'))
                        <a href="{{ route('password.request') }}" style="margin-left: 25px;">Forgot Your Password?</a>
                        @endif
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
@endsection
