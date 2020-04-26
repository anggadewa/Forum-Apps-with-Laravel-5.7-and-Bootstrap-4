@extends('layouts.app')
@section('title', 'Create Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="h1Panel">
                <h3>EDIT TAGS</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="panel">
                <form action="{{route('tag.update', $tags->id)}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    @method('PUT')
                    <div class="form-group">
                        <input type="text" class="form-control createInput" placeholder="Tag" name="tag"
                            value="{{$tags->name}}">
                        @if ($errors->has('tag'))
                        <div class="text-danger registerAlert">
                            {{$errors->first('tag')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group tengah">
                        <button type="submit" class="createButton">EDIT</button>
                    </div>
                </form>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
