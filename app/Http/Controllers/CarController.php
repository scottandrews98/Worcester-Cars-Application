<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarController extends Controller
{
    public function index($id)
    {
        if($id){
            $individualCar = DB::select('SELECT * FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN bodyType ON cars.bodyType_id = bodyType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE cars.id = '.$id.'');
            
            $allCarNames = DB::select('SELECT id, name FROM cars WHERE id <> '.$id.'');

            $carImageURL = array();
            $carAltText = array();    

            $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$id.'');
            
            if(count($allCarImages) == 0){
                array_push($carImageURL, "imageNotAvaliable.png");
                array_push($carAltText, "No Image Currently Avaliable");
            }else{
                foreach($allCarImages as $images){
                    array_push($carImageURL, $images->image);
                    array_push($carAltText, $images->altText);
                }
            }
            

            return view('car', compact('individualCar', 'carImageURL', 'carAltText', 'allCarNames'))->withId($id);
        }else{
            redirect('/cars');
        }
    }

    public function like(Request $request)
    {
        // An additional validator which makes sure form values match what is expected
        $validatedData = $request->validate([
            'carID' => 'required'
        ]);

        $userID = auth()->user()->id;
        
        $likedCar = DB::select('SELECT id FROM carsLiked WHERE cars_id = '.$request->input('carID').' AND users_id = '.$userID.'');
        
        if (count($likedCar) == 0){
            // Means that the car has not been liked before
            $likedCarsArray = array('cars_id' => $request->input('carID'), 'users_id' => $userID);
            // Inserts array into the cars table in the database
            $insert = DB::table('carsLiked')->insert($likedCarsArray);

            return "Car Liked";
        }else{
            // Car has been liked by user before so delete row from database
            DB::table('carsLiked')->where('id', $likedCar[0]->id)->delete();

            return "Car Unliked";
        }
    }

    public function getCompareDetails(Request $request)
    {
        $compareDetails = DB::select('SELECT * FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN bodyType ON cars.bodyType_id = bodyType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE cars.id IN ('.$request->input('id').','.$request->input('existingID').') ORDER BY FIELD(cars.id, '.$request->input('existingID').') DESC');
        
        return view('layouts.compare', compact('compareDetails'))->withNewID($request->input('id'));
    }
}
