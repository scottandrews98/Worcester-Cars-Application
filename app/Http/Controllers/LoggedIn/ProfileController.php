<?php
namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Facades\Validator;

class ProfileController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
    }

    public function index()
    {
        // Select data from database for the users profile settings
        $user = Auth::user();

        $userProfileData = DB::select('SELECT * FROM users WHERE id = '.$user->id.'');

        return view('loggedInPages.profile', compact('userProfileData'));
    }

    public function updateProfile(Request $request)
    {
        $user = Auth::User();

        // Checks to see if email has changed and if so check to see if that email is unique 
        if($user->email != $request->input('email')){
            $validatedData = $request->validate([
                'email' => ['required', 'string', 'email', 'max:255', 'unique:users'],
            ]);
        }

        if($request->input('password') != ""){
            $validatedData = $request->validate([
                'name' => ['required', 'string', 'max:255'],
                'number' => ['required', 'string', 'min:5'],
                'password' => ['required', 'string', 'min:8', 'confirmed'],
            ]);

            $user->password = Hash::make($request['password']);
        }

        $validatedData = $request->validate([
            'name' => ['required', 'string', 'max:255'],
            'number' => ['required', 'string', 'min:5'],
        ]);

        
        $user->name = $request->input('name');
        $user->email = $request->input('email');
        $user->number = $request->input('number');

        if($request->has('emailConsent')){
            $user->consent_form_notifications = 1;
        }else{
            $user->consent_form_notifications = 0;
        }

        $user->save();
        
        return redirect()->back()->with('message', 'success');
    }

    // Code for deleting a user's profile
    public function deleteProfile(){
        $user = Auth::User();

        DB::delete('DELETE FROM carsLiked WHERE id = '.$user->id.'');
        DB::delete('DELETE FROM users WHERE id = '.$user->id.'');

        return "Deleted";
    }
}
