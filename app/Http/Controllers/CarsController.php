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
            $allCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fuelType.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE manufacturer.manufacturerName = "'.$request['brand'].'"');
            $carBrandName = ": Made By ".$request['brand']."";
        }else{
            $allCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fuelType.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id ORDER BY price ASC LIMIT 3');
            $carBrandName = "";
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

        return view('cars', compact('allCars', 'carImageURL', 'carAltText', 'carsPageMeta', 'allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes'))->withBrand($carBrandName);
    }

    public function searchCars(Request $request){
        $totalQueries = 0;
        $searchQueryString = "SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fuelType.fuelTypeName, cars.topSpeed, cars.tax FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id ";

        // If statements to not check for values if user has selected an any dropdown
        if($request['manufacturers'] != "All Makes"){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE manufacturer.manufacturerName = '".$request['manufacturers']."'";
            }
            $totalQueries++;
        }

        if($request['fuel'] != "Any Fuel Type"){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE fuelType.fuelTypeName = '".$request['fuel']."'";
            }else{
                $searchQueryString .= " AND fuelType.fuelTypeName = '".$request['fuel']."'";
            }
            $totalQueries++;
        }

        if($request['gearbox'] != "All Transmission Types"){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE transmission.transmissionType = '".$request['gearbox']."'";
            }else{
                $searchQueryString .= " AND transmission.transmissionType = '".$request['gearbox']."'";
            }
            $totalQueries++;
        }

        // If statements to filter out null values
        if($request['miles'] != null){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE mileage >= ".$request['miles']."";
            }else{
                $searchQueryString .= " AND mileage >= ".$request['miles']."";
            }
            $totalQueries++;
        }

        if($request['mpg'] != null){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE mpg >= ".$request['mpg']."";
            }else{
                $searchQueryString .= " AND mpg >= ".$request['mpg']."";
            }
            $totalQueries++;
        }

        if($request['tax'] != null){
            if($totalQueries == 0){
                $searchQueryString .= "WHERE tax <= ".$request['tax']."";
            }else{
                $searchQueryString .= " AND tax <= ".$request['tax']."";
            }
            $totalQueries++;
        }

        // Code to deal with the currently set order type
        if($request['chosenValue'] == "Lowest Price"){
            $searchQueryString .= " ORDER BY price ASC";
        }else if($request['chosenValue'] == "Highest Price"){
            $searchQueryString .= " ORDER BY price DESC";
        }else if($request['chosenValue'] == "Lowest Miles"){
            $searchQueryString .= " ORDER BY mileage ASC";
        }
        
        // Code to deal with next and previous pages
        if($request['pageNumber'] == 1){
            $offset = 3;
            $newPageNumber = $request['pageNumber'];
        }else{
            if($request['pagingDirection'] == true){
                $offset = 3 * $request['pageNumber'];
                $newPageNumber = $request['pageNumber'];
            }else if($request['pagingDirection'] == false){
                $offset = 3 * $request['pageNumber'];
                $newPageNumber = $request['pageNumber'];
            }else{
                $offset = 0;
            }
        }

        $carsCount = count(DB::select($searchQueryString));

        if($offset + 4 > $carsCount){
            $hideNext = true;
        }else{
            $hideNext = false;
        }

        $searchQueryString .= " LIMIT 3 OFFSET ".$offset."";
        
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
        
        return view('layouts.carsSearch', compact('carsSearch', 'carImageURL', 'carAltText'))->withPageNumber($newPageNumber)->withHideNext($hideNext);
    }
}
