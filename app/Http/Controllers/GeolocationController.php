<?php

namespace App\Http\Controllers;


use Illuminate\Http\Request;
use App\Models\Geolocation;
use App\Events\GeolocationUpdated;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class GeolocationController extends Controller
{
 
public function saveGeolocation(Request $request)
{
 
    $employeeId = $request->input('employee_id');
    $latitude = $request->input('latitude');
    $longitude = $request->input('longitude');
    $accuracy = $request->input('accuracy');

    // Check if a record with the given employee_id already exists
    $geolocation = Geolocation::where('employee_id', $employeeId)->first();

    if ($geolocation) {
        // Update the existing record
        $geolocation->latitude = $latitude;
        $geolocation->longitude = $longitude;
        $geolocation->accuracy = $accuracy;
        $geolocation->save();
    } else {
        // Create a new record
        $geolocation = Geolocation::updateOrCreate(
            ['employee_id' => $employeeId],
            ['latitude' => $latitude, 'longitude' => $longitude, 'accuracy' => $accuracy]
        );


    }

    return response()->json(['message' => 'Geolocation updated successfully']);
}

}





