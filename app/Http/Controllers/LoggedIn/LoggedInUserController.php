<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;

class LoggedInUserController extends Controller
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
        // Select all of the users liked cars and display them on screen
        $user = Auth::user();

        $likedCars = DB::select('SELECT cars_id FROM carsLiked WHERE users_id = '.$user->id.'');

        return view('loggedInPages.user');
    }
}
