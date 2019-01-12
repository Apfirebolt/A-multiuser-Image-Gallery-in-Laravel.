<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Album;
use App\User;
use Illuminate\Support\Facades\Auth;


class AlbumsController extends Controller
{
    public function index() {

        if (Auth::check()) {

            // Getting the user name of the logged in user.
            $user_id = auth()->user()->id;
            $user = User::find($user_id);

            // Getting all the albums with a given user id.

            return view('albums.index')->with('albums', $user->albums);
        }
        else
            return redirect('login');
    }

    public function logout() {
        Auth::logout();
        return redirect('login');
    }

    public function create() {
        if (Auth::check()) {
            return view('albums.create');
        }
        else
            return redirect('login');
    }

    public function store(Request $request) {
        // Form validation

        $this->validate($request, [
            'name' => 'required',
            'cover_image' => 'image|max:1999',

        ]);

        // Gets the original filename of the uploaded file
        $filenameWithExt = $request->file('cover_image')->getClientOriginalName();

        // Get just the file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get the extension of the file
        $extension = $request->file('cover_image')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Upload image
        $path = $request->file('cover_image')->storeAs('public/album_covers', $filenameToStore);

        // Create Album
        $album = new Album;
        $album->name = $request->input('name');
        $album->description = $request->input('description');
        $album->user_id = auth()->user()->id;
        $album->cover_image = $filenameToStore;

        $album->save();

        return redirect('/albums')->with('success', 'Album Created');

    }

    public function show($id) {

        if (Auth::check()) {
            $album = Album::with('Photos')->find($id);
            return view('albums.show')->with('album', $album);
        }
        else
            return redirect('login');

    }
}
