<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Archive;
use App\Models\Borrows;
use App\Models\Supervisors;
use App\Models\User;
use App\Models\Vehicles;
use App\Models\Warehouse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;

class DashboardController extends Controller
{
    public function countUsersByRole(){
        $countSupervisor = User::where('role', 'supervisor')->count();
        $enabledSupervisor = User::where('role', 'supervisor')->where('status', '1')->count();

        $countAdmin = User::where('role', 'admin')->count();
        $enabledAdmin = User::where('role', 'admin')->where('status','1')->count();

        $countAccount = User::where('role', 'police')->count();
        $enabledAccount = User::where('role', 'police')->where('status','1')->count();

        $countVehicle = Vehicles::count();
        $countAvailable = Vehicles::where('status', '1')->count();

        $station = Auth::user()->station;
        $available = Vehicles::where('status','1')->where('station',$station)->get();

        $station1 = User::where('station','Station 1')->count();
        $station2 = User::where('station','Station 2')->count();
        $station3 = User::where('station','Station 3')->count();
        $station4 = User::where('station','Station 4')->count();
        $station5 = User::where('station','Station 5')->count();
        $station6 = User::where('station','Station 6')->count();
        $station7 = User::where('station','Station 7')->count();
        $station8 = User::where('station','Station 8')->count();
        $station9 = User::where('station','Station 9')->count();
        $station10 = User::where('station','Station 10')->count();
        $station11 = User::where('station','Station 11')->count();
        $station12 = User::where('station','Station 12')->count();

        $enabled = User::where('status', '1')->count();
        $disabled = User::where('status', '0')->count();
        $deleted = Archive::count();

        $vehicle1 = Vehicles::where('station','Station 1')->count();
        $vehicle2 = Vehicles::where('station','Station 2')->count();
        $vehicle3 = Vehicles::where('station','Station 3')->count();
        $vehicle4 = Vehicles::where('station','Station 4')->count();
        $vehicle5 = Vehicles::where('station','Station 5')->count();
        $vehicle6 = Vehicles::where('station','Station 6')->count();
        $vehicle7 = Vehicles::where('station','Station 7')->count();
        $vehicle8 = Vehicles::where('station','Station 8')->count();
        $vehicle9 = Vehicles::where('station','Station 9')->count();
        $vehicle10 = Vehicles::where('station','Station 10')->count();
        $vehicle11 = Vehicles::where('station','Station 11')->count();
        $vehicle12 = Vehicles::where('station','Station 12')->count();

        $enabledV = Vehicles::where('status', '1')->count();
        $disabledV = Vehicles::where('status', '0')->count();
        $deletedV = Warehouse::count();



        return view('pages.dashboard',
        ['countSupervisor' => $countSupervisor,
        'enabledSupervisor' => $enabledSupervisor,
        'countAdmin' => $countAdmin,
        'enabledAdmin' => $enabledAdmin,
        'countVehicle' => $countVehicle,
        'countAccount' => $countAccount,
        'enabledAccount' => $enabledAccount,
        'countAvailable' => $countAvailable,
        'available' => $available,
        'station1' => $station1,
        'station2' => $station2,
        'station3' => $station3,
        'station4' => $station4,
        'station5' => $station5,
        'station6' => $station6,
        'station7' => $station7,
        'station8' => $station8,
        'station9' => $station9,
        'station10' => $station10,
        'station11' => $station11,
        'station12' => $station12,
        'enabled' => $enabled,
        'disabled' => $disabled,
        'deleted' => $deleted,

        'vehicle1' => $vehicle1,
        'vehicle2' => $vehicle2,
        'vehicle3' => $vehicle3,
        'vehicle4' => $vehicle4,
        'vehicle5' => $vehicle5,
        'vehicle6' => $vehicle6,
        'vehicle7' => $vehicle7,
        'vehicle8' => $vehicle8,
        'vehicle9' => $vehicle9,
        'vehicle10' => $vehicle10,
        'vehicle11' => $vehicle11,
        'vehicle12' => $vehicle12,
        'enabledV' => $enabledV,
        'disabledV' => $disabledV,
        'deletedV' => $deletedV,
       ]
        );
    }

    // public function getLatestUser()
    // {
    //     // Get the latest added users based on timestamps
    //     $latestUsers = Supervisors::orderBy('created_at', 'desc')->take(1)->get();

    //     // return response()->json($latestUsers);
    //     return view('dashboard', compact('latestUsers'));

    // }

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


}
