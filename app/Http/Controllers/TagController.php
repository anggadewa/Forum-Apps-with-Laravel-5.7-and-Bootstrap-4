<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Tag;
use Auth;
use DB;

class TagController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth')->except('index', 'show');
    }
    /**
     * Display a listing of the resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function index()
    {
        $tags = Tag::all();
        $populars = DB::table('forums')
                    ->join('page-views', 'forums.id', '=', 'page-views.visitable_id')
                    ->select(DB::raw('count(visitable_id) as count'), 'forums.id', 'forums.title', 'forums.slug')
                    ->groupBy('id', 'title', 'slug')
                    ->orderBy('count', 'desc')
                    ->take(5)
                    ->get();
        return view('tag.index', compact('tags', 'populars'));
    }

    /**
     * Show the form for creating a new resource.
     *
     * @return \Illuminate\Http\Response
     */
    public function create()
    {
        $tags = Tag::all();
        return view('tag.create', compact('tags'));
    }

    /**
     * Store a newly created resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @return \Illuminate\Http\Response
     */
    public function store(Request $request)
    {
        $tag = new Tag;
        $tag->name = $request->tag;
        $tag->slug = str_slug($request->tag);
        $tag->save();

        return redirect()->route('tag.create');
        // ->with('info', 'Created');
    }

    /**
     * Display the specified resource.
     *
     * @param  int  $id
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
                    ->take(5)
                    ->get();

        $tags = Tag::where('id', $slug)
                    ->orWhere('slug', $slug)
                    ->firstOrFail();
        return view('tag.show', compact('tags', 'populars'));
    }

    /**
     * Show the form for editing the specified resource.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function edit($id)
    {
        $tags = Tag::find($id);
        return view('tag.edit', compact('tags'));
    }

    /**
     * Update the specified resource in storage.
     *
     * @param  \Illuminate\Http\Request  $request
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function update(Request $request, $id)
    {
        $tag = Tag::find($id);
        $tag->name = $request->tag;
        $tag->slug = str_slug($request->tag);
        $tag->save();

        return redirect()->route('tag.create');
        // ->with('info', 'Edited');
    }

    /**
     * Remove the specified resource from storage.
     *
     * @param  int  $id
     * @return \Illuminate\Http\Response
     */
    public function destroy($id)
    {
        $tag = Tag::find($id);
        $tag->delete();
        return redirect()->route('tag.create');
        // ->with('info', 'Deleted');
    }
}
