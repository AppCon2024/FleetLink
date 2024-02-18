<?php

namespace App\Http\Controllers;
use App\Models\Location;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function index()
    {
        $locations = Location::all(); // Fetch locations
        return view('pages.tracking',
        ['locations' => $locations]);
    }


}
