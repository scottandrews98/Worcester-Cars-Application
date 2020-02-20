<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use \Mailjet\Resources;
use GuzzleHttp\Client;

class ContactController extends Controller
{

    public function index()
    {
        $contactPageMeta = DB::select('SELECT contactPageMeta FROM siteSettings');

        return view('contact', compact('contactPageMeta'));
    }

    public function store(Request $request)
    {
        // An additional validator which makes sure form values match what is expected
        $validatedData = $request->validate([
            'name' => 'required',
            'email' => 'required',
            'number' => 'required|numeric',
            'message' => 'required'
        ]);

        $now = date('Y-m-d H:i:s');

        $contactTable = array('name' => $request->input('name'), 'email' => $request->input('email'), 'number' => $request->input('number'), 'message' => $request->input('message'), 'formSubmissionTime' => $now);

        // Inserts array into the cars table in the database
        $insert = DB::table('contactFormSubmissions')->insert($contactTable);

        // Send message via email to all site admins
        $allConsentUsers = DB::select('SELECT email, name FROM users WHERE userLevel_id = 1');
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
                'ReplyTo' => [
                    'Email' => $request->input('email'),
                    'Name' => $request->input('name')
                ],
                'Subject' => "New Website Message",
                'HTMLPart' => "Name:  ".$request->input('name')." <br />Email: ".$request->input('email')." <br />Phone Number:  ".$request->input('number')." <br />Message:  ".$request->input('message').""
            ];
        } 

        $mj = new \Mailjet\Client('a513843cbd376e6de6e6c79f2efc51d7','9fe7604278c5c3473fe317a28daff371',true,['version' => 'v3.1']);
        $body = [
            'Messages' => $toMessage,
        ];

        $response = $mj->post(Resources::$Email, ['body' => $body]);
        
        if($insert){
            echo "Message Sent";
        }else{
            echo "Error Sending Message";
        }
    }
}
