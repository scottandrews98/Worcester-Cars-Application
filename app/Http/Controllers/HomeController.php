<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

// Get rid of these after testing
use Illuminate\Support\Facades\DB;
use \Mailjet\Resources;

class HomeController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
        //$this->middleware('auth');
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index()
    {
        return view('home');
    }
}
