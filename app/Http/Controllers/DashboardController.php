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
        $enabledSupervisor = User::where('role', 'supervisor')->where('status', '1')->count();

        $countAdmin = User::where('role', 'admin')->count();
        $enabledAdmin = User::where('role', 'admin')->where('status','1')->count();

        $countAccount = User::where('role', 'police')->count();
        $enabledAccount = User::where('role', 'police')->where('status','1')->count();

        $countVehicle = Vehicles::where('role', 'vehicle')->count();
        $countAvailable = Vehicles::where('status', '1')->count();


        return view('pages.dashboard',
        ['countSupervisor' => $countSupervisor,
        'enabledSupervisor' => $enabledSupervisor,
        'countAdmin' => $countAdmin,
        'enabledAdmin' => $enabledAdmin,
        'countVehicle' => $countVehicle,
        'countAccount' => $countAccount,
        'enabledAccount' => $enabledAccount,
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
