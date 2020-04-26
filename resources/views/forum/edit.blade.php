@extends('layouts.app')
@section('title', 'Edit Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="h1Panel">
                <h3>EDIT QUESTION</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <div>
                <div class="panel">
                    <form action="{{route('forum.update', $forums->id)}}" method="POST" enctype="multipart/form-data">
                        @csrf
                        @method("PUT")
                        <div class="form-group">
                            <input type="text" class="form-control createInput" placeholder="Title" name="title"
                                value="{{$forums->title}}">
                            @if ($errors->has('title'))
                            <div class="text-danger">
                                {{$errors->first('title')}}
                            </div>
                            @endif
                        </div>
                        <div class="ckEditor">
                            <div class="form-group">
                                <textarea type="text" name="description"
                                    class="form-control createInput">{{$forums->description}}</textarea>
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
                        <div class="imageUpload">
                            <div class="row justify-content-center">
                                <div class="col-1">
                                    <img src="{{asset('img/file-upload.png')}}" alt="">
                                </div>
                                <div class="col-11" style="margin-right: 25px;">
                                    <div class="form-group">
                                        <input type="file" class="form-control createInput" name="image"
                                            placeholder="image">
                                        @if ($errors->has('image'))
                                        <div class="text-danger">
                                            {{$errors->first('image')}}
                                        </div>
                                        @endif
                                    </div>
                                </div>
                            </div>
                        </div>
                        <div class="viewImageEdit tengah">
                            @if (empty($forums->image))
                                <small><i class="fas fa-info-circle"></i> There are No Images in This Post</small>
                            @else
                                <div class="form-group">
                                    <div class="col-md-4 tengah">
                                        <img src="{{asset('img/'.$forums->image)}}" alt="" width="100%">
                                    </div>
                                </div>
                            @endif
                        </div>
                        <div class="form-group tengah">
                            <button type="submit" class="createButton">EDIT QUESTION</button>
                        </div>
                    </form>
                </div>
            </div>
        </div>
    </div>
</div>
@endsection
@section('js')
<script type="text/javascript">
    $(".tags").select2().val({!!json_encode($forums->tags()->allRelatedIds()) !!}).trigger('change');

    CKEDITOR.replace('description', {
        extraPlugins: 'codesnippet',
        codeSnippet_theme: 'dark'
    });

</script>
@endsection