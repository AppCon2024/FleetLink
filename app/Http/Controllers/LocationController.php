<?php

namespace App\Http\Controllers;

use App\Models\Locations;
use Illuminate\Http\Request;

class LocationController extends Controller
{
    public function store(Request $request)
    {
        $lat = $request->input('lat');
        $lng = $request->input('lng');
        $accuracy = $request->input('accuracy');
        $userId = auth()->id();

        $updateLoc = Locations::where('userId', $userId)->first();

        if($updateLoc){
            $updateLoc->latitude = $lat;
            $updateLoc->longitude = $lng;
            $updateLoc->accuracy = $accuracy;
            $updateLoc->save();
        } else {
            $newLoc = new Locations();
            $newLoc->userId = $userId;
            $newLoc->latitude = $lat;
            $newLoc->longitude = $lng;
            $newLoc->accuracy = $accuracy;
            $newLoc->save();
        }
        return response()->json(['success' => true]);
    }
}
