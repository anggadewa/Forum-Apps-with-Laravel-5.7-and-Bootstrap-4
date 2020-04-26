@extends('layouts.app')
@section('title', 'ForCode')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-8">
                <div class="h1Panel">
                    <h3>{{$forums->title}}</h3>
                </div>
            </div>
        </div>

        <div class="row mt-2">
            <div class="col-lg-7">
                <div class="show">
                    <div class="showTitle">
                        <a href="{{route('profile', $forums->user->name )}}"
                            class="badge badge-pill badge-info badgeContent">{{$forums->user->name}}</a> |
                        <small>{{$forums->created_at->diffForHumans()}}</small> |
                        <small>{{$forums->getPageViews()}} Views</small> |
                        <small>{{$forums->comments->count()}} Comments</small> |
                        @foreach($forums->tags as $tag)
                            <div class="badge badge-pill badge-info badgeContent">#{{$tag->name}}</div>
                        @endforeach
                        @if (empty($forums->image))
                        @else
                        <div class="badge badge-pill badge-info badgeContent"><i class="fa fa-image"></i></div>
                        @endif
                        <br><br>
                        <h4>{{$forums->title}}</h4>
                        <hr>
                        @if (empty($forums->image))
                        @else
                        <br>
                        <div class="if_empty">
                            <a data-toggle="collapse" data-target="#open_modal"><i class="fa fa-image" id="zoom_image"></i></a>
                            <div id="open_modal" class="collapse">
                                    <img src="{{asset('img/'.$forums->image)}}" alt="" width="50%">
                                        <a href="#myModal" data-toggle="modal" data-target="#myModal" class="openImage">
                                            <h1 class="fa fa-search-plus"></h1>
                                        </a>
                            </div>
                        </div>
                        @endif
                    </div>

                    <div class="showContent">
                        <div class="card">
                            <div class="card-body">
                                <p>{!!$forums->description!!}</p>
                            </div>
                        </div>
                    </div>
                    <div class="modal fade" id="myModal" tabindex="-1" role="dialog" aria-labelledby="exampleModalLabel"
                        aria-hidden="true">
                        <div class="modal-dialog modal-lg" role="document">
                            <div class="modal-content">
                                <div class="modal-header">
                                    <h5 class="modal-title" id="exampleModalLabel">Image:</h5>
                                    <button type="button" class="close" data-dismiss="modal" aria-label="Close">
                                        <span aria-hidden="true">&times;</span>
                                    </button>
                                </div>
                                <div class="modal-body" id="modal_img">
                                    <img src="{{asset('img/'.$forums->image)}}" alt="" width="100%">
                                </div>
                            </div>
                        </div>
                    </div>

                    @if (Auth::guest())
                    <div class="showComment">
                        <a href="{{route('login')}}" style="text-decoration: none;">Login for add your comment<i class="fa fa-sign-in"></i></a>
                    </div>
                    @else
                    <div class="showComment">
                        <form action="{{route('addComment', $forums->id)}}" method="post">
                            @csrf
                            <div class="form-group">
                                <input type="text" class="form-control commentInput" placeholder="Comment Here..." name="content" id="Your-Answer" required>
                                @if ($errors->has('content'))
                                <div class="text-danger">
                                    {{$errors->first('content')}}
                                </div>
                                @endif
                            </div>
                            <div class="form-group tengah float-right">
                                <input type="submit" class="commentButton" value="Comment">
                                <br>
                            </div>
                        </form>
                    </div>
                    @endif


                    @forelse ($forums->comments as $comment)
                    <div class="showReply">
                        <div class="showReply1">
                            <div class="showAfterComment">
                                <div class="row">
                                    <div class="col-4">
                                        <img src="{{asset('img/'.$forums->user->image)}}" width="65" height="65"
                                            class="rounded-circle float-right">
                                    </div>
                                    <div class="col-6 showContentComment">
                                        <small><b>{{$comment->user->name}}</b></small><br>
                                        <p>{{$comment->content}}</p>
                                        <small> <i>in {{$comment->created_at->diffForHumans()}}</i> </small>
                                    </div>
                                </div>
                                <a class="buttonCollapse float-right" data-toggle="collapse"
                                    href="#tampilReply-{{$comment->id}}"
                                    role="button" aria-expanded="true" aria-controls="collapseExample">
                                    Reply
                                </a>
                            </div>
                            
                            <div class="collapse replyInput" id="tampilReply-{{$comment->id}}">
                                @guest
                                    <div class="showComment">
                                        <a href="{{route('login')}}" style="text-decoration: none;">Login for add your
                                            comment<i class="fa fa-sign-in"></i></a>
                                    </div>
                                @else
                                    <form action="{{route('replyComment', $comment->id)}}" method="post">
                                        @csrf
                                        <div class="form-group">
                                            <input type="text" class="form-control commentInput"
                                                placeholder="Reply Here..." name="content">
                                        </div>
                                        <div class="form-group tengah float-right">
                                            <input type="submit" class="commentButton" value="Reply">
                                            <br>
                                        </div>
                                        <br>
                                    </form>
                                @endguest
                                

                                @forelse ($comment->comments as $reply)
                                    <div class="showReplyComment">
                                        <div class="row">
                                            <div class="col-4">
                                                <img src="{{asset('img/'.$forums->user->image)}}" width="65" height="65"
                                                    class="rounded-circle float-right">
                                            </div>
                                            <div class="col-6 showContntReply">
                                                <small><b>{{$reply->user->name}}</b></small><br>
                                                <p>{{$reply->content}}</p>
                                                <small> <i>in {{$reply->created_at->diffForHumans()}}</i> </small>
                                            </div>
                                        </div>
                                    </div>
                                @empty
                                    <div class="row justify-content-center mt-5">
                                        <p>No Reply</p>
                                    </div>
                                @endforelse
                            </div>
                        </div>
                    </div>
                    @empty
                    <div class="row justify-content-center mt-5">
                        <p>No Comment</p>
                    </div>
                    @endforelse
                    
                </div>
            </div>

            <div class="col-lg-5">
                @include('layouts.popular')
            </div>
        </div>
    </div>


    <br><br>
@endsection