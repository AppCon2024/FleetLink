<?php

// app/Http/Controllers/TrackingController.php
namespace App\Http\Controllers;

use App\Models\Geolocation;
use App\Models\Borrows;


class TrackingController extends Controller
{
    public function index()
    {
        $borrowsData = Borrows::all();
        $geolocationData = Geolocation::all();

        return view('tracking', compact('borrowsData', 'geolocationData'));
    }
}
