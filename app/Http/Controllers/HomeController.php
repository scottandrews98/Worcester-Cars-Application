<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;

class HomeController extends Controller
{

    public function index()
    {
        // Get the top six most popular car creators that are currently for sale from the database
        $allManufacturers = DB::select('SELECT manufacturerName FROM manufacturer');
        $topSixManufacturers = DB::select('SELECT manufacturer.manufacturerName FROM cars INNER JOIN manufacturer ON cars.manufacturer_id = manufacturer.id GROUP BY cars.manufacturer_id ORDER BY COUNT(cars.manufacturer_id) LIMIT 6');

        $homePageMeta = DB::select('SELECT homePageMeta FROM siteSettings');

        return view('home', compact('allManufacturers', 'topSixManufacturers', 'homePageMeta'));
    }
}
