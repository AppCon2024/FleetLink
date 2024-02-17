<?php

namespace App\Http\Controllers;

use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Validation\Rule;

class SupvController extends Controller
{
    public function index(){
        $data = User::where('role','supervisor')->paginate(2);
        $title = "Supervisor";
        return view('pages.supv',[
            'data' => $data,
            'title' => $title
        ]);
    }

    public function create(Request $request){
        $request->validate([
            'first_name' => 'required|alpha|min:2|max:50',
            'last_name' => 'required|alpha|min:2|max:50',
            'name' => 'required|alpha|min:2|max:50',
            'email' => 'required', 'email', Rule::unique('supervisor', 'email'),
            'employee_id' => 'required|int|min:6',
            'department' => 'required',
            'position' => 'required',
            'photo' => 'image',
        ]);
        User::create([
            'role' => 'supervisor',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' =>  $request->first_name . ' ' . $request->last_name,
            'employee_id' => $request->employee_id,
            'email' => $request->email,
            'department' => $request->department,
            'position' => $request->position,
            'password' => '12345',
            'photo' => null,
        ]);

        
    }
}
