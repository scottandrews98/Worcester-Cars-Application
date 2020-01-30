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

        return view('loggedInPages.admin', compact('allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes'));
    }

    public function store(Request $request)
    {

        // $validatedData = $request->validate([
        //     'code' => 'required',
        //     'description' => 'required',
        //     'title' => 'required|max:30',
        // ]);

        // Grab id's of fueltypes and if not insert them and grab there id's
        $fuelTypeID = self::elementCheck("fuelType", "fuelTypeName", $request->input('fuelType'));
        $manufacturerID = self::elementCheck("manufacturer", "manufacturerName", $request->input('make'));
        $transmissionID = self::elementCheck("transmission", "transmissionType", $request->input('gearbox'));
        $bodyID = self::elementCheck("bodyType", "bodyTypeName", $request->input('bodyType'));
        
        // Image upload
        $index = 0;
        foreach ($request->file('image') as $update) {
            echo $update;
            $photoName = time().$index.'.'.$update->getClientOriginalExtension();

            $update->move(public_path('carImages'), $photoName);
            $index ++;
        }
            
        //$carsTable = array('name' => $request->input('name'), 'price' => $request->input('cost'), 'mileage' => $request->input('miles'), 'engineSize' => $request->input('engineSize'), 'topSpeed' => $request->input('topSpeed'), 'tax' => $request->input('taxCost'), 'mpg' => $request->input('mpg'), 'totalDoors' => $request->input('doors'), 'totalSeats' => $request->input('doors'), 'engineSize' => $request->input('engineSize'));
        

        //NewCar::create($request->all());

        //echo $request;

        //return redirect('/home');

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
