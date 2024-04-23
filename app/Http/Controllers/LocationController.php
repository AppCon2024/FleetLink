<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
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
        $updateLoc2 = Borrows::where('userId', $userId)->first();


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

        if($updateLoc2){
            $updateLoc2->latitude = $lat;
            $updateLoc2->longitude = $lng;
            $updateLoc2->accuracy = $accuracy;
            $updateLoc2->save();
        }



        return response()->json(['success' => true]);
    }

    public function getUserLocation(){
        $userLocs = Borrows::all();
        $userLocations = [];

        foreach($userLocs as $user){
            $location = [
                'userId' => $userLocs->userId,
                'lat' => $userLocs->latitude,
                'lng' => $userLocs->longitude,
                'accuracy' => $userLocs->accuracy,
            ];
            $userLocations[] = $location;
        }

        return response()->json($userLocations);
    }

    public function fetchMap(){
        $userLocs = Borrows::where('time_out','- - -')
                ->with('user')
                ->get();
        foreach($userLocs as $user){
            $location = [
                'userId' => $user->userId,
                'lat' => $user->latitude,
                'lng' => $user->longitude,
                'accuracy' => $user->accuracy,
                'plate' => $user->plate,
                'name' => $user->user->name,
                'station' => $user->user->station,
                'brand' => $user->brand,
                'model' => $user->model
            ];
            $userLocations[] = $location;
        }
        return response()->json($userLocations);
    }

    public function index(){

        $userLocs = Borrows::where('time_out','- - -')
                ->with('user')
                ->with('location')
                ->get();

        return view('pages.tracking',[
            'userLocs' => $userLocs,
        ]);
    }
}
