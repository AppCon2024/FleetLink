<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $request->validate([
            'userId' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            'accuracy' => 'required',
        ]);

        // Assuming you have a Location model set up
        Locations::create([
            'user_id' => $request->userId,
            'latitude' => $request->latitude,
            'longitude' => $request->longitude,
            'accuracy' => $request->accuracy,
        ]);

        return response()->json(['status' => 'Success', 'message' => 'Location saved']);
    }
}
