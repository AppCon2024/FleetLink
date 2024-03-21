<?php

namespace App\Http\Controllers;

use App\Models\UserData;
use Illuminate\Http\Request;

class savelocation extends Controller
{

    public function saveGeolocation(Request $request)
    {
        $employeeId = $request->input('employee_id');
        $latitude = $request->input('latitude');
        $longitude = $request->input('longitude');
        $accuracy = $request->input('accuracy');

        // Check if a record with the given employee_id already exists
        $geolocation =UserData::where('employee_id', $employeeId)->first();

        if ($geolocation) {
            // Update the existing record
            $geolocation->latitude = $latitude;
            $geolocation->longitude = $longitude;
            $geolocation->accuracy = $accuracy;
            $geolocation->save();
        } else {
            // Create a new record
            $geolocation = UserData::updateOrCreate(
                ['employee_id' => $employeeId],
                ['latitude' => $latitude, 'longitude' => $longitude, 'accuracy' => $accuracy]
            );
        }

        return response()->json(['message' => 'Geolocation updated successfully']);
    }
}
