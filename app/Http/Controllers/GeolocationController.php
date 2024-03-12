<?php

namespace App\Http\Controllers;

use Illuminate\Http\Request;
use App\Models\Geolocation;
use App\Models\Borrows;
use Illuminate\Support\Facades\Log; // Add this line

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

    public function getCombinedData(Request $request)
    {
        try {
            $employeeId = $request->input('employee_id');
    
            // Use a join to combine data from Geolocation and Borrow tables
            $combinedData = Geolocation::join('borrows', 'geolocations.employee_id', '=', 'borrows.employee_id')
                ->select(
                    'geolocations.latitude',
                    'geolocations.longitude',
                    'geolocations.accuracy',
                    'borrows.first_name',
                    'borrows.last_name',
                    'borrows.plate'
                    // Add other columns as needed
                )
                ->where('geolocations.employee_id', $employeeId)
                ->first();
    
            if (!$combinedData) {
                return response()->json([
                    'success' => false,
                    'message' => 'Data not found.',
                ], 404);
            }
    
            return response()->json([
                'success' => true,
                'data' => $combinedData,
            ]);
        } catch (\Exception $e) {
            // Log the exception
            Log::error('Error in getCombinedData: ' . $e->getMessage());
    
            return response()->json([
                'success' => false,
                'message' => 'Internal Server Error.',
            ], 500);
        }
    }
    
}
