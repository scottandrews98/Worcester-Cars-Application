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

            $individualCarFirstImage = DB::select('SELECT carImagesLink.cars_id, carImages.imageURL as image, carImages.imageAltText as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$id.'');

            $allImages = DB::select('SELECT carImages.imageURL as image, carImages.imageAltText as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$id.'');

            return view('car', compact('individualCar', 'individualCarFirstImage', 'allImages'));
        }else{
            redirect('/cars');
        }
    }
}
