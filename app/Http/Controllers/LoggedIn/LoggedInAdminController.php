<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;

class LoggedInAdminController extends Controller
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

        $allMakes = DB::select('SELECT manufacturerName FROM manufacturer');
        $allFuelType = DB::select('SELECT fuelTypeName FROM fuelType');
        $allTransmissionType = DB::select('SELECT transmissionType FROM transmission');
        $allCarShapes = DB::select('SELECT bodyTypeName FROM bodyType');

        $allCars = DB::select('SELECT * FROM cars');

        return view('loggedInPages.admin', compact('allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes', 'allCars'));
    }

    public function store(Request $request)
    {

        // An additional validator which makes sure form values match what is expected
        $validatedData = $request->validate([
            'name' => 'required',
            'description' => 'required',
            'cost' => 'required|numeric',
            'miles' => 'required|numeric',
            'engineSize' => 'required|numeric',
            'topSpeed' => 'required|numeric',
            'taxCost' => 'required',
            'mpg' => 'required',
            'doors' => 'required|numeric',
            'seats' => 'required|numeric',
            'engineSize' => 'required|numeric',
            'fuelType' => 'required',
            'make' => 'required',
            'gearbox' => 'required',
            'bodyType' => 'required',
        ]);

        // Grab id's of fueltypes and if not insert them and grab there id's
        $fuelTypeID = self::elementCheck("fuelType", "fuelTypeName", $request->input('fuelType'));
        $manufacturerID = self::elementCheck("manufacturer", "manufacturerName", $request->input('make'));
        $transmissionID = self::elementCheck("transmission", "transmissionType", $request->input('gearbox'));
        $bodyID = self::elementCheck("bodyType", "bodyTypeName", $request->input('bodyType'));
        
        // Creates and array with all the request values in ready to be inserted into the database
        $carsTable = array('name' => $request->input('name'), 'description' => $request->input('description'), 'price' => $request->input('cost'), 'mileage' => $request->input('miles'), 'engineSize' => $request->input('engineSize'), 'topSpeed' => $request->input('topSpeed'), 'tax' => $request->input('taxCost'), 'mpg' => $request->input('mpg'), 'totalDoors' => $request->input('doors'), 'totalSeats' => $request->input('seats'), 'engineSize' => $request->input('engineSize'), 'fuelType_id' => $fuelTypeID, 'bodyType_id' => $bodyID, 'manufacturer_id' => $manufacturerID, 'transmission_id' => $transmissionID);

        // Inserts array into the cars table in the database
        DB::table('cars')->insert($carsTable);

        $lastCarInsertID = DB::getPdo()->lastInsertId();

        // Image upload
        $index = 0;
        if($request->file('image')){
            foreach ($request->file('image') as $update) {
                $photoName = time().$index.'.'.$update->getClientOriginalExtension();
    
                $update->move(public_path('carImages'), $photoName);

                $imageAltText = $request->input('altText')[$index];

                $carImagesTable = array('imageURL' => $photoName, 'imageAltText' => $imageAltText);
                DB::table('carImages')->insert($carImagesTable);

                $lastCarImageID = DB::getPdo()->lastInsertId();
                $carImagesLinkTable = array('cars_id' => $lastCarInsertID, 'carImages_id' => $lastCarImageID);
                DB::table('carImagesLink')->insert($carImagesLinkTable);

                $index++;
            }
        }
        
        return redirect('/admin');
    }

    public function elementCheck($tableName, $typeName, $typeValue){
        $typeTest = DB::select('SELECT '.$typeName.' FROM '.$tableName.' WHERE '.$typeName.' = "'.$typeValue.'"');

        if(count($typeTest) == 0){
            DB::insert('INSERT INTO '.$tableName.' ('.$typeName.') VALUES ("'.$typeValue.'")');
            return DB::getPdo()->lastInsertId();
        }else{
            $newReturn = DB::select('SELECT id FROM '.$tableName.' WHERE '.$typeName.' = "'.$typeValue.'"');
            $resultArray = json_decode(json_encode($newReturn), true);
            return $resultArray[0]["id"];
        }
    }

}
