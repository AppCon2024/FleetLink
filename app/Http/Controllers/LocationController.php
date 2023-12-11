<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function updateLocation(Request $request)
    {
        // Validate and store the GPS coordinates
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');

        return response()->json(['message' => 'Location updated successfully']);
}
}