@extends('layouts.app')
@section('title', 'Create Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="h1Panel">
                <h3>CREATE QUESTION</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="panel">
                <form action="{{route('forum.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control createInput" placeholder="Title" name="title"
                            value="{{ old('title') }}">
                        @if ($errors->has('title'))
                        <div class="text-danger registerAlert">
                            {{$errors->first('title')}}
                        </div>
                        @endif
                    </div>
                    <div class="ckEditor">
                        <div class="form-group">
                            <textarea type="text" name="description"
                                class="form-control createInput">{{ old('description') }}</textarea>
                            @if ($errors->has('description'))
                            <div class="text-danger">
                                {{$errors->first('description')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="select2Tags">
                        <div class="form-group">
                            <select name="tags[]" id="" class="form-control createInput tags" multiple="multiple">
                                @foreach($tags as $tag)
                                <option value="{{$tag->id}}">{{$tag->name}}</option>
                                @endforeach
                            </select>
                            @if ($errors->has('tags'))
                            <div class="text-danger">
                                {{$errors->first('tags')}}
                            </div>
                            @endif
                        </div>
                    </div>
                    <div class="row justify-content-center">
                        <div class="col-1">
                            <img src="{{asset('img/file-upload.png')}}" alt="" style="margin-left: 25px;">
                        </div>
                        <div class="col-11">
                            <div class="form-group">
                                <input type="file" class="form-control createInput" name="image" placeholder="image"
                                    style="margin-left: 30px;">
                                @if ($errors->has('image'))
                                <div class="text-danger">
                                    {{$errors->first('image')}}
                                </div>
                                @endif
                            </div>
                        </div>
                    </div>
                    <div class="form-group tengah">
                        <button type="submit" class="createButton">POST QUESTION</button>
                    </div>
                </form>

                {{-- <div class="latestQuestion">
                    @if (Auth::user()->id == $forums->user_id)
                        @forelse($forums as $forum)
                            <b>Your Latest Question:</b><br>
                            <a href="#" style="color: #444">
                                <h5 style="margin-top: 4px;"><i class="fas fa-newspaper"></i> {{$forum->title}}</h5>
                            </a>
                        @empty
                            <strong>New questions will appear here.</strong><br>
                        @endforelse
                    @endif
                </div> --}}
            </div>
        </div>
    </div>
</div>
<br>
@endsection
@section('js')
<script type="text/javascript">
    $(".tags").select2({
        placeholder: "  Select tags",
        maximumSelectionLength: 5
    });

    CKEDITOR.replace('description', {
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'dark'
    });

</script>
@endsection
