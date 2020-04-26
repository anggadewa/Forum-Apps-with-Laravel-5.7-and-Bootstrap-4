<?php

namespace App\Http\Controllers;

use App\Forum;
use App\Tag;
use Illuminate\Http\Request;
use Auth;
use File;
use Storage;
use DB;

class ForumController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show', 'populars', 'search');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $populars = DB::table('forums')
                    ->join('page-views', 'forums.id', '=', 'page-views.visitable_id')
                    ->select(DB::raw('count(visitable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
                    ->groupBy('id', 'title', 'slug')
                    ->orderBy('count', 'desc')
                    ->take(10)
                    ->get();

        $forums = Forum::paginate(5);
        return view('forum.index', compact('forums', 'populars'));
    }

    // public function populars()
    // {
    //     $populars = DB::table('forums')
    //                 ->join('page-views', 'forums.id', '=', 'page-views.visitable_id')
    //                 ->select(DB::raw('count(visitable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
    //                 ->groupBy('id', 'title', 'slug')
    //                 ->orderBy('count', 'desc')
    //                 ->take(25)
    //                 ->get();
    //     return view('forum.populars', compact('populars'));
    // }

    public function search(Request $request)
    {
        $search = $request->search;

        $populars = DB::table('forums')
                    ->join('page-views', 'forums.id', '=', 'page-views.visitable_id')
                    ->select(DB::raw('count(visitable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
                    ->groupBy('id', 'title', 'slug')
                    ->orderBy('count', 'desc')
                    ->take(10)
                    ->get();

        $forums = Forum::where('title', 'like', "%".$search."%")
                    ->paginate(10);
        // $forums = DB::table('forums')
        //         ->where('title', 'like', "%".$search."%")
        //         ->paginate(10);
        return view('forum.search', compact('forums', 'populars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {   
        // $idUser = Auth::user()->id;
        // $forums = Forum::where('user_id', $idUser)
        // ->orderBy('id', 'desc')->paginate(1);
        $tags = Tag::all()->sortBy("name");;
        return view('forum.create', compact('tags', 'forums'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $forums = New Forum;
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = str_slug($request->title);
        $forums->description = $request->description;
        if($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/img');
            $file->move($location, $filename);
            $forums->image = $filename;
        } else {
            $filename = NULL;
            $forums->image = $filename;
        }
        $forums->save();
        $forums->tags()->sync($request->tags);
        
        return redirect()->route('profile', Auth::user()->name)->with('info', 'Question Successfully Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function show($slug)
    {
        // $forums = Forum::find($id);
        $populars = DB::table('forums')
                    ->join('page-views', 'forums.id', '=', 'page-views.visitable_id')
                    ->select(DB::raw('count(visitable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
                    ->groupBy('id', 'title', 'slug')
                    ->orderBy('count', 'desc')
                    ->take(10)
                    ->get();

        $forums = Forum::where('id', $slug)
                    ->orWhere('slug', $slug)
                    ->firstOrFail();
        $forums->addPageView();
        return view('forum.show', compact('forums', 'populars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function edit($slug)
    {
        $tags = Tag::all()->sortBy("name");;
        $forums = Forum::where('id', $slug)
                    ->orWhere('slug', $slug)
                    ->firstOrFail();
        if (Auth()->user()->id == $forums->user_id) {
            return view('forum.edit', compact('forums', 'tags'));
        } else {
            return redirect()->route('forum.index');
        }
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $request->validate([
            'title' => 'required',
            'description' => 'required',
            'tags' => 'required',
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $forums = Forum::find($id);
        $forums->user_id = Auth::user()->id;
        $forums->title = $request->title;
        $forums->slug = str_slug($request->title);
        $forums->description = $request->description;
        if($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/img');
            $file->move($location, $filename);

            $oldImage = $forums->image;
            Storage::delete($oldImage);

            $forums->image = $filename;
        }
        
        $forums->save();
        $forums->tags()->sync($request->tags);

        return redirect()->route('profile', Auth::user()->name)->with('info', 'Question Successfully Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  \App\Forum  $forum
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $forum = Forum::find($id);
        Storage::delete($forum->image);
        $forum->tags()->detach();
        $forum->comments()->delete();
        $forum->delete();
        return redirect()->route('profile', Auth::user()->name)->with('info', 'Question Successfully Deleted');
        // return redirect()->route('profile', Auth::user()->name)->withInfo('Deleted');
    }
}
