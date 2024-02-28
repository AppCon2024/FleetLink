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
    
        // Check if a record for the user already exists
        $existingRecord = Geolocation::first();
    
        if ($existingRecord) {
            // If a record exists, update it
            $existingRecord->update($request->all());
        } else {
            // If no record exists, create a new one
            Geolocation::create($request->all());
        }
    
        return response()->json(['message' => 'Geolocation saved successfully']);
    }
    
}