<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Providers\RouteServiceProvider;
use Illuminate\Foundation\Auth\AuthenticatesUsers;
use Illuminate\Support\Facades\Auth;
use Socialite;
use App\User;

class GoogleAuthController extends Controller
{
    /*
    |--------------------------------------------------------------------------
    | Login Controller
    |--------------------------------------------------------------------------
    |
    | This controller handles authenticating users for the application and
    | redirecting them to your home screen. The controller uses a trait
    | to conveniently provide its functionality to your applications.
    |
    */

    use AuthenticatesUsers;

    /**
     * Where to redirect users after login.
     *
     * @var string
     */
    //protected $redirectTo = RouteServiceProvider::HOME;
    protected function redirectTo()
    {
        $user = Auth::user();

        if($user->userLevel_id == 1){
            return '/settings';
        }else{
            return '/user';
        }
    }

    public function __construct()
    {
        $this->middleware('guest')->except('logout');
    }

    // Directs users to the Google Sign In Page
    public function redirectToProvider()
    {
        return Socialite::driver('google')->redirect();
    }

    // Deals with oauth response
    public function handleProviderCallback()
    {
        try {
            $user = Socialite::driver('google')->user();
        } catch (Exception $e) {
            return redirect('/login');
        }

        $authUser = $this->findOrCreateUser($user);
        //var_dump($authUser);
        Auth::login($authUser, true);
        return redirect($this->redirectTo());
        //return($this->redirectTo());
    }

    // Checks to see if a users has an account already or if a new one needs to be made
    public function findOrCreateUser($providerUser)
    {
        $account = User::whereGoogleId($providerUser->getId())
                   ->first();

        if ($account) {
            //var_dump($account->user);
            return $account;
        } else {
            $user = User::whereEmail($providerUser->getEmail())->first();

            if (! $user) {
                $user = User::create([
                    'email' => $providerUser->getEmail(),
                    'name'  => $providerUser->getName(),
                    'google_id' => $providerUser->getId(),
                    'userLevel_id' => 2,
                    'consent_form_notifications' => 0
                ]);
            }

            // $user->identities()->create([
            //     'google_id'   => $providerUser->getId()
            // ]);

            return $user;
        }
    }
}