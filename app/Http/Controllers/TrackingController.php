<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
use App\Models\Geolocation;
use Illuminate\Http\Request;

class TrackingController extends Controller
{
    public function index()
    {
        $borrowsData = Borrows::all();
        $geolocationData = Geolocation::all();

        return view('tracking', compact('borrowsData', 'geolocationData'));
    }
}
