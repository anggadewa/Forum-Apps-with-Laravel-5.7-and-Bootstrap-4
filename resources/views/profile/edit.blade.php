@extends('layouts.app')
@section('title', 'ForCode | ')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-10">
            <div class="profile">
                <img src="{{asset('img/'.$user->image)}}" alt="" class="rounded-circle imgProfile"><br>
                <h5 class="tengah nameProfile">{{$user->name}}
                </h5>

                <div class="row justify-content-center bioProfile">
                    <div class="col-lg-12">
                        <div class="panel">
                            <form action="{{ route('profileUpdate',Auth::user()->name) }}" method="post"
                                enctype="multipart/form-data">
                                @csrf
                                @method("PUT")
                                <div class="form-group">
                                    <label style="float:left; margin-left: 25px;">Username</label>
                                    <input type="text" class="form-control createInput" placeholder="Name" name="name"
                                        value="{{$user->name}}">
                                    @if ($errors->has('name'))
                                    <div class="text-danger">
                                        {{$errors->first('name')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group"><label style="float:left; margin-left: 25px;">Email</label>
                                    <input type="email" class="form-control createInput" placeholder="Email" name="email"
                                        value="{{$user->email}}">
                                    @if ($errors->has('email'))
                                    <div class="text-danger">
                                        {{$errors->first('email')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label style="float:left; margin-left: 25px;">Bio</label>
                                    <input type="text" class="form-control createInput" placeholder="Bio" name="bio"
                                        value="{{$user->bio}}">
                                    @if ($errors->has('bio'))
                                    <div class="text-danger">
                                        {{$errors->first('nambioe')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group">
                                    <label style="float:left; margin-left: 25px;">Profile Image</label>
                                    <input type="file" class="form-control createInput" name="image"
                                        placeholder="image">
                                    @if ($errors->has('image'))
                                    <div class="text-danger">
                                        {{$errors->first('image')}}
                                    </div>
                                    @endif
                                </div>

                                <div class="form-group tengah">
                                    <button type="submit" class="createButton">SAVE</button>
                                </div>
                            </form>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection