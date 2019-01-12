<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Shared;
use App\User;

class DashboardController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        $this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        $photos = Shared::all();
        return view('home')->with('photos', $photos);
    }
}
