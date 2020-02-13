<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class ContactController extends Controller
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
        return view('contact');
    }

    public function store(Request $request)
    {
        // An additional validator which makes sure form values match what is expected
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required|numeric',
            'message' => 'required'
        ]);

        $now = date('Y-m-d H:i:s');

        $contactTable = array('name' => $request->input('name'), 'email' => $request->input('email'), 'number' => $request->input('number'), 'message' => $request->input('message'), 'formSubmissionTime' => $now);

        // Inserts array into the cars table in the database
        $insert = DB::table('contactFormSubmissions')->insert($contactTable);
        
        if($insert){
            echo "Message Sent";
        }else{
            echo "Error Sending Message";
        }
    }
}
