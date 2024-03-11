<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Geolocation;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeolocationController extends Controller
{
 
public function saveGeolocation(Request $request)
{
 
    $request->validate([
        'accuracy' => 'required', // Add any other validation rules as needed
        // Other validation rules...
    ]);

    // Get latitude, longitude, employee_id from the request
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');
    $employeeId = $request->input('employee_id');
    $accuracy = $request->input('accuracy'); // Make sure 'accuracy' is provided in the request

    // Create a new geolocation instance
    $geolocation = new Geolocation([
        'accuracy' => $accuracy,
        'latitude' => $latitude,
        'longitude' => $longitude,
        'employee_id' => $employeeId,
    ]);

    // Save the geolocation
    $geolocation->save();

    // Additional logic or response...

    return response()->json(['message' => 'Geolocation saved successfully']);
}

}





