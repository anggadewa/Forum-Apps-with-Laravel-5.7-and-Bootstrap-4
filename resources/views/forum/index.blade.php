@extends('layouts.app')
@section('title', 'ForCode | ')
@section('content')
    <div class="container">
        <div class="row mt-3">
            <div class="col-lg-12">
                @guest
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <h1>Hello, <br>Coders!!</h1>
                    </li>
                    <li class="list-inline-item"><img src="{{asset('img/flower.png')}}" class="img-fluid float-left">
                    </li>
                </ul>
                @else
                <ul class="list-inline">
                    <li class="list-inline-item">
                        <h1>Hello, <br>{{Auth::user()->name}}</h1>
                    </li>
                    <li class="list-inline-item"><img src="{{asset('img/flower.png')}}" class="img-fluid float-left">
                    </li>
                </ul>
                @endguest
                
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-7">
                <div class="thelatest">
                    <h2 class="mb-4">The Latest Question</h2>
                    @foreach ($forums as $forum)
                    <div class="question">
                        <a href="{{route('forumslug', $forum->slug)}}" class="noLink">
                            <h4>{{str_limit($forum->title, 40)}}</h4>
                        </a>
                        @foreach ($forum->tags as $tag)
                        <a href="{{route('tag.show', $tag->slug)}}"
                            class="badge badge-pill badge-info badgeContent">#{{$tag->name}}</a>
                        @endforeach
                        <br><br>
                        <p class="jam float-right">{{$forum->created_at->diffForHumans()}}</p>
                        <a href="{{route('forumslug', $forum->slug)}}"><img src="{{asset('img/chevron.png')}}"
                                class="float-right chevron"></a>
                        <img src="{{asset('img/'.$forum->user->image)}}" width="50" height="50"
                            class="rounded-circle thumb">
                        <h6 class="name"><a href="{{ route('profile',$forum->user->name) }}"
                                class="nameProfile">{{$forum->user->name}}</a></h6>
                        <img src="{{asset('img/comment.svg')}}" class="comment" width="35" height="35">
                        <p class="commentText">{{$forum->comments->count()}} Comments</p>
                        <img src="{{asset('img/view.svg')}}" class="view" width="35" height="35">
                        <p class="viewText">{{$forum->getPageViews()}}</p>
                    </div>
                    @endforeach
                    <div class="row justify-content-center">
                        {!!$forums->links()!!}
                    </div>
                </div>
            </div>

            <div class="col-lg-5">
                <div class="row">
                    <div class="col-lg-12">
                        <div class="createQuestion">
                            <a href="{{route('forum.create')}}" class="createQuestImgA">
                                <img src="{{asset('img/create.svg')}}" width="65" height="65" class="createQuestImg">
                                <h3 class="createText">Create Question</h3>
                            </a>
                        </div>
                    </div>
                </div>
                @include('layouts.popular')
            </div>
        </div>
    </div>
<br>
@endsection