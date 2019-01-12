<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shared;


class SharedController extends Controller
{
    public function store(Request $request) {

        // Create a new photo, album id is passed in as a hidden field in the form
        $shared = new Shared;
        $shared->photo_id = $request->photo_id;
        $shared->user_id = $request->user_id;
        $shared->location = $request->location;

        $shared->save();

        return redirect('/albums')->with('success', 'Photo was shared');
    }
}
