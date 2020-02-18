<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Illuminate\Support\Facades\DB;
use \Mailjet\Resources;
use GuzzleHttp\Client;
use Illuminate\Support\Facades\File;

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
        $this->middleware('checkUserLevel');
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

    public function store($type, $id, Request $request)
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
        if($type == "store"){
            DB::table('cars')->insert($carsTable);
            $lastCarInsertID = DB::getPdo()->lastInsertId();
        }else if($type == "edit"){
            DB::table('cars')->where('id', $id)->update($carsTable);
            $lastCarInsertID = $id;
        }

        // Updates existing alt text
        if($type == "edit"){
            $index2 = 0;
            $existingCarImages = DB::select('SELECT carImages.id FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$id.'');

            foreach ($existingCarImages as $altTextID) {
                $imageAltText = $request->input('altTextExisting')[$index2];

                $carImagesTable = array('imageAltText' => $imageAltText);

                DB::table('carImages')->where('id', $altTextID->id)->update($carImagesTable);
                $index2++;
            }
        }

        // Image upload
        $index = 0;
        if($request->file('image')){
            foreach ($request->file('image') as $update) {
                // Checks to see if file input is empty
                if($update != ""){
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
        }

        // Send Bulk Email To Registered Users Who Consented
        // Get Users Who Consented From Database

        if($type == "store"){
            $allConsentUsers = DB::select('SELECT email, name FROM users WHERE consent_form_notifications = 1');
            $toMessage = [];

            foreach($allConsentUsers as $consent){
                $toMessage[] = [ 
                    'From' => [
                        'Email' => "ands3_16@uni.worc.ac.uk",
                        'Name' => "Worcester Cars"
                    ],
                    'To' => [
                        [
                            'Email' => $consent->email,  
                            'Name' => $consent->name
                        ]
                    ],
                    'Subject' => "New Car For Sale!",
                    'HTMLPart' => "<h3>Dear ".$consent->name.", We thought we would let you know we have a new ".$request->input('name')." for sale. <br /> <a href='http://127.0.0.1:8000/car/".$lastCarInsertID."'>Go check it out</a></h3><br />Thanks, Worcester Cars <br /> If you wish to unsubscribe from emails <a href='http://127.0.0.1:8000/login'>Please Visit This Link</a>"
                ];
            } 

            $mj = new \Mailjet\Client('a513843cbd376e6de6e6c79f2efc51d7','9fe7604278c5c3473fe317a28daff371',true,['version' => 'v3.1']);
            $body = [
                'Messages' => $toMessage,
            ];

            $response = $mj->post(Resources::$Email, ['body' => $body]);
            return redirect('/admin');
        }else{
            return redirect('/admin');
        }
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

    // function compressImage($image){
    //     $endpoint = "api.tinify.com/shrink";
    //     $client = new \GuzzleHttp\Client();
    //     $imagePath = "/carImages/15805784710.png";


    //     $response = $client->request('POST', $endpoint, ['query' => [
    //         'key2' => $value,
    //     ]]);

    //     // url will be: http://my.domain.com/test.php?key1=5&key2=ABC;

    //     $statusCode = $response->getStatusCode();
    //     $content = $response->getBody();
    // }

    public function loadEdit($id)
    {   
        if($id){
            $selectedCar = DB::select('SELECT * FROM cars INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id INNER JOIN bodyType ON cars.bodyType_id = bodyType.id INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id WHERE cars.id = '.$id.'');
            $selectedCarID = DB::select('SELECT * FROM cars WHERE cars.id = '.$id.'');

            $allMakes = DB::select('SELECT manufacturerName FROM manufacturer');
            $allFuelType = DB::select('SELECT fuelTypeName FROM fuelType');
            $allTransmissionType = DB::select('SELECT transmissionType FROM transmission');
            $allCarShapes = DB::select('SELECT bodyTypeName FROM bodyType');

            $carImages = DB::select('SELECT carImages.id, carImages.imageURL as image, carImages.imageAltText as altText FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE carImagesLink.cars_id = '.$id.'');

            return view('loggedInPages.edit', compact('selectedCar', 'selectedCarID', 'allMakes', 'allFuelType', 'allTransmissionType', 'allCarShapes', 'carImages'));
        }else{
            redirect('/admin');
        }
    }

    public function saveEdit($id, Request $request)
    {
        // Saves the eidited car information

        if($request->input('existingImage')){
            $remainingImages = "";

            foreach ($request->input('existingImage') as $update) {
                $remainingImages .= "AND carImages_id != ".$update." ";
            }

            $existingCarImages = DB::select('SELECT carImages_id, carImages.imageURL FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE cars_id = '.$id.' '.$remainingImages.'');

            foreach ($existingCarImages as $carImageRemoveID) {
                // Loop through car images to be deleted 
                DB::delete('DELETE FROM carImagesLink WHERE carImages_id = '.$carImageRemoveID->carImages_id.'');
                DB::delete('DELETE FROM carImages WHERE id = '.$carImageRemoveID->carImages_id.'');

                File::delete(''.public_path('carImages').'/'.$carImageRemoveID->imageURL.'');
            }
        }else{
            // Remove all images associated with car
            self::deleteAllImages($id);
        }

        // Runs the store method above
        store("edit",$id,$request);
    }

    public function deleteAllImages($id){
        $existingCarImages = DB::select('SELECT carImages_id, carImages.imageURL FROM carImagesLink INNER JOIN carImages ON carImages_id = carImages.id WHERE cars_id = '.$id.'');

        foreach ($existingCarImages as $carImageRemoveID) {
            // Loop through car images to be deleted 
            DB::delete('DELETE FROM carImagesLink WHERE carImages_id = '.$carImageRemoveID->carImages_id.'');
            DB::delete('DELETE FROM carImages WHERE id = '.$carImageRemoveID->carImages_id.'');

            File::delete(''.public_path('carImages').'/'.$carImageRemoveID->imageURL.'');
        }
    }

    // Deals with deleting cars and subsequent information from the database
    public function deleteCar(Request $request){
        $validatedData = $request->validate([
            'carID' => 'required'
        ]);

        $getID = DB::select('SELECT fuelType_id, bodyType_id, manufacturer_id, transmission_id FROM cars WHERE id = '.$request->input('carID').'');

        // Delete car link from carsLiked first
        DB::delete('DELETE FROM carsLiked WHERE cars_id = '.$request->input('carID').'');
        // Then delete all car images
        self::deleteAllImages($request->input('carID'));
        // Delete car with posted id 
        DB::delete('DELETE FROM cars WHERE id = '.$request->input('carID').'');

        // Check to make sure that this car was not the only car to support this type
        self::reverseElementCheck($request->input('carID'), "fuelType", "fuelType_id", $getID);
        self::reverseElementCheck($request->input('carID'), "bodyType", "bodyType_id", $getID);
        self::reverseElementCheck($request->input('carID'), "manufacturer", "manufacturer_id", $getID);
        self::reverseElementCheck($request->input('carID'), "transmission", "transmission_id", $getID);

        return "Car Deleted";
    }

    public function reverseElementCheck($carID, $tableName, $typeName, $getID){
        $typeTest = DB::select('SELECT '.$typeName.' FROM cars WHERE '.$typeName.' = "'.$getID[0]->$typeName.'"');

        if(count($typeTest) < 1){
            // Delete element from main table
            DB::delete('DELETE FROM '.$tableName.' WHERE id = '.$getID[0]->$typeName.'');
        }
    }
}
