<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geolocation;

class GeolocationController extends Controller
{
    public function saveGeolocation(Request $request)
    {
        // Validate the request if necessary
        $request->validate([
            'accuracy' => 'required',
            'latitude' => 'required',
            'longitude' => 'required',
            // Add other fields as needed
        ]);

        // Create a new Geolocation record
        Geolocation::create($request->all());

        return response()->json(['message' => 'Geolocation saved successfully']);
    }
}