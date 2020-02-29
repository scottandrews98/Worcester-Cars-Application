<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class CarsController extends Controller
{
    /**
     * Create a new controller instance.
     *
     * @return void
     */
    public function __construct()
    {
    }

    /**
     * Show the application dashboard.
     *
     * @return \Illuminate\Contracts\Support\Renderable
     */
    public function index(Request $request)
    {
        if(isset($request['brand'])){
            $allCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE manufacturer.manufacturerName = "'.$request['brand'].'"');
        }else{
            $allCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id LIMIT 8');
        }
 
        $carImageURL = array();
        $carAltText = array();    
        foreach($allCars as $car){
            $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$car->id.' GROUP BY carImagesLink.cars_id');
            
            if(count($allCarImages) == 0){
                array_push($carImageURL, "imageNotAvaliable.png");
                array_push($carAltText, "No Image Currently Avaliable");
            }else{
                array_push($carImageURL, $allCarImages[0]->image);
                array_push($carAltText, $allCarImages[0]->altText);
            }
        }
        
        $carsPageMeta = DB::select('SELECT carsPageMeta FROM siteSettings');

        $allMakes = DB::select('SELECT manufacturerName FROM manufacturer');
        $allFuelType = DB::select('SELECT fuelTypeName FROM fuelType');
        $allTransmissionType = DB::select('SELECT transmissionType FROM transmission');
        $allCarShapes = DB::select('SELECT bodyTypeName FROM bodyType');

        return view('cars', compact('allCars', 'carImageURL', 'carAltText', 'carsPageMeta', 'allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes'));
    }

    public function searchCars(Request $request){
        $searchQueryString = "SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE ";

        $searchQueryString .= "manufacturer.manufacturerName = '".$request['manufacturers']."' AND fuelType.fuelTypeName = '".$request['fuel']."' AND transmission.transmissionType = '".$request['gearbox']."'";

        // Insert if statements to filter out null values
        if($request['miles'] != null){
            $searchQueryString .= "AND mileage >= ".$request['miles']." ";
        }

        if($request['mpg'] != null){
            $searchQueryString .= "AND mpg >= ".$request['mpg']." ";
        }

        if($request['tax'] != null){
            $searchQueryString .= "AND tax <= ".$request['tax']." ";
        }

        $carsSearch = DB::select($searchQueryString);
        $carImageURL = array();
        $carAltText = array();

        foreach($carsSearch as $car){
            $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$car->id.' GROUP BY carImagesLink.cars_id');
            
            if(count($allCarImages) == 0){
                array_push($carImageURL, "imageNotAvaliable.png");
                array_push($carAltText, "No Image Currently Avaliable");
            }else{
                array_push($carImageURL, $allCarImages[0]->image);
                array_push($carAltText, $allCarImages[0]->altText);
            }
        }

        return view('layouts.carsSearch', compact('carsSearch', 'carImageURL', 'carAltText'));
    }

    public function nextPage($pageCount){
        // Function that loads the next 8 cars 

        // Calculate starting limit number
        $finishingNumber = 8 * $pageCount;
        // https://www.w3schools.com/php/php_mysql_select_limit.asp

        $allCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fueltype.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id LIMIT 8 OFFSET '.$finishingNumber.'');

        $allCarImages = DB::select('SELECT carImagesLink.cars_id, ANY_VALUE(carImages.imageURL) as image, ANY_VALUE(carImages.imageAltText) as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id GROUP BY carImagesLink.cars_id LIMIT 8 OFFSET '.$finishingNumber.'');

        $carsPageMeta = DB::select('SELECT carsPageMeta FROM siteSettings');

        $allMakes = DB::select('SELECT manufacturerName FROM manufacturer');
        $allFuelType = DB::select('SELECT fuelTypeName FROM fuelType');
        $allTransmissionType = DB::select('SELECT transmissionType FROM transmission');
        $allCarShapes = DB::select('SELECT bodyTypeName FROM bodyType');

        return view('cars', compact('allCars', 'allCarImages', 'carsPageMeta', 'allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes'));
    }
}
