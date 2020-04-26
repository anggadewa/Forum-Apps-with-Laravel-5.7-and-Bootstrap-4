@extends('layouts.app')
@section('title', 'ForCode')
@section('content')
<div class="container">
    <div class="row justify-content-center mb-3">
        <div class="col-8">
            <div class="h1Panel">
                <h3>Choose Based on Tags</h3>
            </div>
        </div>
    </div>

    <div class="row mt-2">
        <div class="col-lg-7">
            <div class="show">
                <div class="showTitle">
                    @foreach($tags as $tag)
                    <a href="{{route('tag.show', $tag->slug)}}"
                        class="badge badge-pill badge-info badgeContent mt-2">{{$tag->name}} (
                        {{ $tag->forums->count() }}
                        <small><b>Question</b></small>) &nbsp;</a>
                    @endforeach
                </div>
            </div>
        </div>

        <div class="col-lg-5">
            @include('layouts.popular')
        </div>
    </div>
</div>
<br><br>
@endsection