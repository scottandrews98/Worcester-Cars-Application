<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserLevel');
    }

    public function index()
    {
        // Select data from database for site settings
        $siteSettingsData = DB::select('SELECT * FROM siteSettings');

        // Select all the users on the website
        $user = Auth::User();
        $siteUserData = DB::select('SELECT * FROM users WHERE id != '.$user->id.'');

        //retrieve visitors and pageview data for the current day and the last seven days
        $totalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $mostVisitedPages = Analytics::fetchMostVisitedPages(Period::days(7), $maxResults = 5);

        $totalPageViews = 0;
        $totalVisitors = 0;

        foreach($totalVisitorsAndPageViews as $eachDay) {
            $totalPageViews += $eachDay['pageViews'];
            $totalVisitors += $eachDay['visitors'];
        }

        if(count($siteSettingsData) == 0){
            return view('loggedInPages.settings', compact('mostVisitedPages', 'siteUserData'))->withPageViews($totalPageViews)->withVisitors($totalVisitors);
        }else{
            $lastUpdate = "(Last Updated At: " . date('d/m/Y H:i', strtotime($siteSettingsData[0]->{'updated_at'})) . ")";

            return view('loggedInPages.settings', compact('mostVisitedPages', 'siteUserData', 'siteSettingsData'))->withPageViews($totalPageViews)->withVisitors($totalVisitors)->withLastUpdate($lastUpdate);
        }
    }

    // Saved the updated site settings information
    public function saveSettings(Request $request)
    {
        $validatedData = $request->validate([
            'siteTitle' => 'required'
        ]);
        
        $siteSettingsTable = array('siteTitle' => $request->input('siteTitle'), 'homePageMeta' => $request->input('homePageMeta'), 'aboutPageMeta' => $request->input('aboutPageMeta'), 'carsPageMeta' => $request->input('carsPageMeta'), 'contactPageMeta' => $request->input('contactPageMeta'));
        
        $firstPostTest = DB::select('SELECT * FROM siteSettings');

        if(count($firstPostTest) == 0){
            DB::table('siteSettings')->insert($siteSettingsTable);
        }else{
            DB::table('siteSettings')->where('id', 1)->update($siteSettingsTable);
        }

        return redirect('/settings');
    }

    public function makeAndRemoveAdmins(Request $request){
        // Deal with making users admins and removing them depending on type
        $userID = $request->input('userID');
        $type = $request->input('type');

        if($type == "make"){
            $updateUserLevel = array('userLevel_id' => 1);
        }else if($type == "remove"){
            $updateUserLevel = array('userLevel_id' => 2);
        }

        DB::table('users')->where('id', $userID)->update($updateUserLevel);

        return "updated";
    }

    // Load selected user's stared cars
    public function loadStaredUser($id){
        $likedCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM carsLiked INNER JOIN cars ON carsLiked.cars_id = cars.id INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id WHERE carsLiked.users_id = '.$id.'');
        $userInformation = DB::select('SELECT name from users WHERE id = '.$id.'');

        $carImageURL = array();
        $carAltText = array();    
        foreach($likedCars as $car){
            $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$car->id.' GROUP BY carImagesLink.cars_id');
            
            if(count($allCarImages) == 0){
                array_push($carImageURL, "imageNotAvaliable.png");
                array_push($carAltText, "No Image Currently Avaliable");
            }else{
                array_push($carImageURL, $allCarImages[0]->image);
                array_push($carAltText, $allCarImages[0]->altText);
            }
        }

        return view('loggedInPages.staredUserCars', compact('likedCars', 'carImageURL', 'carAltText', 'userInformation'));
    }

}
