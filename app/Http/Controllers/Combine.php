<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
use App\Models\Geolocation;
use Illuminate\Http\Request;

class Combine extends Controller
{
    public function index()
    {
        $borrow = Borrows::all(); // Fetch locations
        return view('pages.tracking',
        ['borrow' => $borrow]);

        $geo = Geolocation::all(); // Fetch locations
        return view('pages.tracking',
        ['geo' => $geo]);
    }

}
