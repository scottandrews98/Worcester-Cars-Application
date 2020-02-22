<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;

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

        //$likedCars = DB::select('SELECT cars_id FROM carsLiked WHERE users_id = '.$user->id.'');

        $likedCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM carsLiked INNER JOIN cars ON carsLiked.cars_id = cars.id INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id WHERE carsLiked.users_id = '.$user->id.'');

        $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id GROUP BY carImagesLink.cars_id LIMIT 1');

        return view('loggedInPages.user', compact('likedCars', 'allCarImages'));
    }
}
