<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\Supervisors;
use App\Models\User;
use App\Models\Vehicles;
use Illuminate\Http\Request;

class DashboardController extends Controller
{
    public function countUsersByRole(){
        $countSupervisor = User::where('role', 'supervisor')->count();
        $countVehicle = Vehicles::where('role', 'vehicle')->count();
        $countAccount = User::where('role', 'police')->count();
        $countAvailable = Vehicles::where('status', '1')->count();


        return view('pages.dashboard',
        ['countSupervisor' => $countSupervisor,
        'countVehicle' => $countVehicle,
        'countAccount' => $countAccount,
        'countAvailable' => $countAvailable,
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



}
