<?php

namespace App\Http\Controllers;

use App\Models\Borrows;
use Illuminate\Http\Request;

class StatusController extends Controller
{
    //
    public function index()
    {
        // $data = User::all(); // Replace YourModel with your actual model name

        // Fetch users based on role (e.g., 'admin' role)
        $status = Borrows::where('time_in','data')->get();

        return view('pages.status', ['status' => $status]);
    }
}
