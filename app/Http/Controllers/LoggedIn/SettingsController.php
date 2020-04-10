<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;
use Illuminate\Support\Facades\Auth;
use \Mailjet\Resources;

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

        // Select All Form Submissions
        $formSubmissionData = DB::select('SELECT * FROM contactFormSubmissions ORDER BY formSubmissionTime DESC');

        $totalPageViews = 0;
        $totalVisitors = 0;

        foreach($totalVisitorsAndPageViews as $eachDay) {
            $totalPageViews += $eachDay['pageViews'];
            $totalVisitors += $eachDay['visitors'];
        }

        if(count($siteSettingsData) == 0){
            return view('loggedInPages.settings', compact('mostVisitedPages', 'siteUserData', 'formSubmissionData'))->withPageViews($totalPageViews)->withVisitors($totalVisitors);
        }else{
            $lastUpdate = "(Last Updated At: " . date('d/m/Y H:i', strtotime($siteSettingsData[0]->{'updated_at'})) . ")";

            return view('loggedInPages.settings', compact('mostVisitedPages', 'siteUserData', 'siteSettingsData', 'formSubmissionData'))->withPageViews($totalPageViews)->withVisitors($totalVisitors)->withLastUpdate($lastUpdate);
        }
    }

    // Saved the updated site settings information
    public function saveSettings(Request $request)
    {
        $validatedData = $request->validate([
            'siteTitle' => 'required'
        ]);
        
        $siteSettingsTable = array('siteTitle' => $request->input('siteTitle'), 'homePageMeta' => $request->input('homePageMeta'), 'aboutPageMeta' => $request->input('aboutPageMeta'), 'carsPageMeta' => $request->input('carsPageMeta'), 'contactPageMeta' => $request->input('contactPageMeta'), 'interestRate' => $request->input('interestRate'));
        
        $firstPostTest = DB::select('SELECT * FROM siteSettings');

        if(count($firstPostTest) == 0){
            DB::table('siteSettings')->insert($siteSettingsTable);
        }else{
            DB::table('siteSettings')->where('id', 1)->update($siteSettingsTable);
        }

        return redirect('/settings')->with('message', 'success');
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
        $likedCars = DB::select('SELECT cars.id, cars.name, cars.price, cars.mileage, transmission.transmissionType, cars.engineSize, fuelType.fuelTypeName, cars.topSpeed, cars.tax FROM carsLiked INNER JOIN cars ON carsLiked.cars_id = cars.id INNER JOIN transmission ON cars.transmission_id = transmission.id INNER JOIN fuelType ON cars.fuelType_id = fuelType.id WHERE carsLiked.users_id = '.$id.'');
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

    public function loadUserProfile($id){
        $userInformation = DB::select('SELECT * from users WHERE id = '.$id.'');

        return view('loggedInPages.viewUserProfile', compact('userInformation'));
    }

    // Load selected message
    public function loadMessage($id){
        $messageInformation = DB::select('SELECT * from contactFormSubmissions WHERE id = '.$id.'');
        $messageReplies = DB::select('SELECT * from message_reply INNER JOIN users ON message_reply.users_id = users.id WHERE contactFormSubmissions_id = '.$id.'');

        $messageSent = "Message Sent At: " . date('d/m/Y H:i', strtotime($messageInformation[0]->{'formSubmissionTime'}));

        return view('loggedInPages.message', compact('messageInformation', 'messageReplies'))->withMessageTime($messageSent);
    }

    // Sends a new message from an admin to a user
    public function sendMessage(Request $request){
        $user = auth()->user();
        $contactTable = array('messageReply' => $request->input('message'), 'contactFormSubmissions_id' => $request->input('messageID'), 'users_id' => $user->id);

        // Inserts array into the message_reply table in the database
        $insert = DB::table('message_reply')->insert($contactTable);

        // Send message via email to customer who sent message
        $sentUserInfo = DB::select('SELECT * FROM contactFormSubmissions WHERE id = '.$request->input('messageID').'');
        $adminInfo = DB::select('SELECT * FROM users WHERE id = '.$user->id.'');
        $toMessage = [];

        foreach($sentUserInfo as $userInfo){
            $toMessage[] = [ 
                'From' => [
                    'Email' => $adminInfo[0]->email,
                    'Name' => "Worcester Cars"
                ],
                'To' => [
                    [
                        'Email' => $userInfo->email,  
                        'Name' => $userInfo->name
                    ]
                ],
                'ReplyTo' => [
                    'Email' => $adminInfo[0]->email,
                    'Name' => $adminInfo[0]->name
                ],
                'Subject' => "Replying To Enquiry",
                'HTMLPart' => $request->input('message')
            ];
        } 

        $mj = new \Mailjet\Client('a513843cbd376e6de6e6c79f2efc51d7','9fe7604278c5c3473fe317a28daff371',true,['version' => 'v3.1']);
        $body = [
            'Messages' => $toMessage,
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);

        return redirect('/viewMessage/'.$request->input('messageID').'');
    }

    // Deletes selected message
    public function deleteMessage(Request $request){
        DB::delete('DELETE FROM message_reply WHERE contactFormSubmissions_id = '.$request->input('messageID').'');
        DB::delete('DELETE FROM contactFormSubmissions WHERE id = '.$request->input('messageID').'');

        return "Message Deleted";
    }
}
