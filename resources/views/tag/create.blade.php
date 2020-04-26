@extends('layouts.app')
@section('title', 'Create Question')
@section('content')
<div class="container">
    <div class="row justify-content-center">
        <div class="col-8">
            <div class="h1Panel">
                <h3>CREATE TAGS</h3>
            </div>
        </div>
    </div>

    <div class="row justify-content-center">
        <div class="col-8">
            <div class="panel">
                <form action="{{route('tag.store')}}" method="POST" enctype="multipart/form-data">
                    @csrf
                    <div class="form-group">
                        <input type="text" class="form-control createInput" placeholder="Tag" name="tag"
                            value="{{ old('tag') }}">
                        @if ($errors->has('tag'))
                        <div class="text-danger registerAlert">
                            {{$errors->first('tag')}}
                        </div>
                        @endif
                    </div>
                    <div class="form-group tengah">
                        <button type="submit" class="createButton">CREATE</button>
                    </div>
                </form>
            </div>

            <div class="questionList">
                <table class="table table-bordered table-dark">
                    <tbody>
                        @foreach ($tags as $tag)
                        <tr>
                            <td>{{$tag->name}}</td>
                            <td width="100"><a href="{{route('tag.edit', $tag->id)}}" class="btn btn-sm btn-warning"><i
                                        class="fa fa-edit"></i>
                                    Edit</a></td>
                            <td width="100">
                                <form action="{{route('tag.destroy', $tag->id)}}" method="post" style="margin: 0;">
                                    {{csrf_field()}}
                                    {{method_field('DELETE')}}
                                    <button type="submit" class="btn btn-sm btn-danger tag-deleted-button"><i
                                            class="fa fa-trash"></i>
                                        Delete</button>
                                </form>
                            </td>
                        </tr>
                        @endforeach
                    </tbody>
                </table>
            </div>
        </div>
    </div>
</div>
<br>
@endsection
