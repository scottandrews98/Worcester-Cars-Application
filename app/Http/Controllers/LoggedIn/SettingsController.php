<?php

namespace App\Http\Controllers\LoggedIn;

use Illuminate\Http\Request;
use App\Http\Controllers\Controller;
use Analytics;
use Spatie\Analytics\Period;

class SettingsController extends Controller
{
    public function __construct()
    {
        $this->middleware('auth');
        $this->middleware('checkUserLevel');
    }

    public function index()
    {
        //retrieve visitors and pageview data for the current day and the last seven days
        $totalVisitorsAndPageViews = Analytics::fetchTotalVisitorsAndPageViews(Period::days(7));
        $mostVisitedPages = Analytics::fetchMostVisitedPages(Period::days(7), $maxResults = 5);

        $totalPageViews = 0;
        $totalVisitors = 0;

        //echo '<pre>' , var_dump($mostVisitedPages) , '</pre>';

        foreach($totalVisitorsAndPageViews as $eachDay) {
            $totalPageViews += $eachDay['pageViews'];
            $totalVisitors += $eachDay['visitors'];
        }

        return view('loggedInPages.settings', compact('mostVisitedPages'))->withPageViews($totalPageViews)->withVisitors($totalVisitors);
    }
}
