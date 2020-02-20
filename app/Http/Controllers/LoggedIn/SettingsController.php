<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;
use Illuminate\Support\Facades\DB;

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
            return view('loggedInPages.settings', compact('mostVisitedPages'))->withPageViews($totalPageViews)->withVisitors($totalVisitors);
        }else{
            $lastUpdate = "(Last Updated At: " . date('d/m/Y H:i', strtotime($siteSettingsData[0]->{'updated_at'})) . ")";
            //var_dump($lastUpdate);

            return view('loggedInPages.settings', compact('mostVisitedPages', 'siteSettingsData'))->withPageViews($totalPageViews)->withVisitors($totalVisitors)->withLastUpdate($lastUpdate);
        }
    }

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
}
