@extends('layouts.app')
@section('title', 'ForCode | ')
@section('content')
    <div class="container">
        <div class="row justify-content-center mb-3">
            <div class="col-10">
                <div class="profile">
                    <div>
                        @if (Auth()->user()->id == $user->id)
                            @if (Auth::user()->email == 'exyatogami@gmail.com')
                            <a href="{{ route('tag.create') }}" class="navTags"><b>Manage Tags</b></a>
                            @endif
                            <a class="navLogout" href="{{ route('logout') }}" onclick="event.preventDefault();
                                                    document.getElementById('logout-form').submit();"><b>LOGOUT</b></a>
                            <form id="logout-form" action="{{ route('logout') }}" method="POST" style="display: none;">
                                @csrf
                            </form>
                        @endif
                    </div>
                    <br>
                    <img src="{{asset('img/'.$user->image)}}" alt="" class="rounded-circle imgProfile"><br>
                    <h5 class="tengah nameProfile">{{$user->name}}
                        @if (Auth()->user()->id == $user->id)
                            <a href="{{ route('profileEdit',Auth::user()->name) }}" class="editIconProfile">
                                <i class="fas fa-edit"></i>
                            </a>
                        @endif
                    </h5>

                    <div class="row justify-content-center bioProfile">
                        <div class="col-3">
                            <p>{{$user->bio}}</p>
                        </div>
                    </div>

                    <div class="row justify-content-center">
                        <div class="col-12">
                            <div class="questionList">
                                <table class="table table-bordered table-dark">
                                    <tbody>
                                        @forelse ($forums as $forum)
                                        <tr>
                                            <td style="text-align: left;">{{$forum->title}}<i
                                                    style="font-size: 10px; color: #999;">
                                                    {{$forum->created_at->diffForHumans()}},
                                                    {{$forum->comments->count()}}
                                                    Comments, {{$forum->getPageViews()}} Views</i>
                                            </td>
                                            @if (Auth()->user()->id == $forum->user_id)
                                            <td width="100"><a href="{{route('forum.edit', $forum->slug)}}"
                                                    class="btn btn-sm btn-success"><i class="fa fa-edit"></i> Edit</a>
                                            </td>
                                            <td width="100">
                                                <form action="{{route('forum.destroy', $forum->id)}}" method="post"
                                                    style="margin: 0;">
                                                    {{csrf_field()}}
                                                    {{method_field('DELETE')}}
                                                    <button type="submit" class="btn btn-sm btn-danger deleted-button"><i
                                                            class="fa fa-trash"></i> Delete</button>
                                                </form>
                                            </td>
                                            @endif
                                            <td width="100"><a href="{{route('forumslug', $forum->slug)}}"
                                                    target="_blank" class="btn btn-sm btn-info"><i
                                                        class="fa fa-eye"></i>
                                                    View</a></td>
                                        </tr>
                                        @empty
                                        <p class="text-center mt-2 mb-2">No Question</p>
                                        @endforelse
                                    </tbody>
                                </table>
                            </div>
                        </div>
                    </div>
                </div>
            </div>
        </div>
    </div>
@endsection