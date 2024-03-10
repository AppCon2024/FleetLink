<?php

namespace App\Http\Controllers;

use App\Models\Geolocation;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

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

        // Retrieve the authenticated user's employee_id
        $employeeId = Auth::user()->employee_id;

        // Check if a record for the user already exists
        $existingRecord = Geolocation::where('employee_id', $employeeId)->first();

        if ($existingRecord) {
            // If a record exists, update it
            $existingRecord->update($request->all());
        } else {
            // If no record exists, create a new one
            Geolocation::create(array_merge($request->all(), ['employee_id' => $employeeId]));
        }

        return response()->json(['message' => 'Geolocation saved successfully']);
    }
}
