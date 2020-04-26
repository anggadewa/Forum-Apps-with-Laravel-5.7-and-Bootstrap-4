<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\User;
use App\Forum;
use Auth;
use File;
use Storage;
use DB;

class ProfileController extends Controller
{
    public function __construct()
    {
    $this->middleware('auth');
    }

    public function index(User $user)
    {
        $forums = Forum::where('user_id', $user->id)->get();
        return view('profile.index', compact('user', 'forums'));
    }

    public function edit(User $user)
    {
        return view('profile.edit', compact('user'));
    }

    public function update(Request $request, User $user)
    {
        $request->validate([
            'name' => 'required|min:6|unique:users,name,'.$user->id,
            'email' => 'required|unique:users,email,'.$user->id,
            'image' => 'image|mimes:jpg,jpeg,png|max:2048',
        ]);

        $user->name = $request->name;
        $user->email = $request->email;
        $user->bio = $request->bio;
        if($request->file('image')) {
            $file = $request->file('image');
            $filename = time().'.'.$file->getClientOriginalExtension();
            $location = public_path('/img');
            $file->move($location, $filename);

            $oldImage = $user->image;
            Storage::delete($oldImage);

            $user->image = $filename;
        }
        
        $user->save();

        return redirect()->route('profile', $user->name);
        //->with('info', 'Pertanyaan Anda Berhasil Diubah');
    }
}
