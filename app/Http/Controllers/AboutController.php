<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class AboutController extends Controller
{
    public function index()
    {
        $aboutPageMeta = DB::select('SELECT aboutPageMeta FROM siteSettings');

        return view('about', compact('aboutPageMeta'));
    }
}
