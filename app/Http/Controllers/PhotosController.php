<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\Storage;
use App\Photos;
use Illuminate\Support\Facades\Auth;

class PhotosController extends Controller
{
    public function create($album_id) {

        if (Auth::check()) {
            return view('photos.create')->with('album_id', $album_id);
        }
        else
            return redirect('login');

    }

    public function store(Request $request) {
        // Form validation

        $this->validate($request, [
            'title' => 'required',
            'photo' => 'image|max:1999',

        ]);

        // Gets the original filename of the uploaded file
        $filenameWithExt = $request->file('photo')->getClientOriginalName();

        // Get just the file name
        $filename = pathinfo($filenameWithExt, PATHINFO_FILENAME);

        // Get the extension of the file
        $extension = $request->file('photo')->getClientOriginalExtension();

        // Create new filename
        $filenameToStore = $filename.'_'.time().'.'.$extension;

        // Upload image
        $path= $request->file('photo')->storeAs('public/photos/'.$request->input('album_id'), $filenameToStore);

        // Create a new photo, album id is passed in as a hidden field in the form
        $photo = new Photos;
        $photo->album_id = $request->input('album_id');
        $photo->title = $request->input('title');
        $photo->description = $request->input('description');
        $photo->size = $request->file('photo')->getSize();
        $photo->photo = $filenameToStore;

        $photo->save();

        return redirect('/albums/'.$request->input('album_id'))->with('success', 'Photo Uploaded');

    }

    public function destroy($id) {
        $photo = Photos::find($id);

        if(Storage::delete('public/photos/'.$photo->album_id.'/'.$photo->photo)){
            $photo->delete();

            return redirect('/')->with('success', 'Photo Deleted');
        }
    }
}
