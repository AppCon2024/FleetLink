<?php

namespace App\Http\Controllers;

use App\Models\Supervisors;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class SupervisorsController extends Controller
{
    public function index()
    {
        $data = User::where('role', 'supervisor')->get();
        $title = 'Supervisor';
        return view('pages.supervisors',[
            'data' => $data,
            'title' => $title,
        ]);
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);

        if (!$data) {
            return redirect()->route('supervisors')->with('error', 'User not found');
        }

        // Validate the request
        $request->validate([
            'first_name' => 'string',
            'last_name' => 'string',
            'email' => 'email',
            'phone' => 'string',
            'password' => 'nullable|string|min:6',
            'department' => ['required', 'string'],
            'position' => ['required', 'string'],
            // 'role' => 'string',
        ]);

        // Update user information
        $data->update([
            'first_name' => $request->input('first_name'),
            'last_name' => $request->input('last_name'),
            'name' =>  $request->first_name . ' ' . $request->last_name,
            'email' => $request->input('email'),
            'department' =>$request->input('department'),
            'position' => $request->input('position'),
            'phone' => $request->input('phone'),
            'password' => $request->has('password') ? bcrypt($request->input('password')) : $data->password,
            // 'role' => $request->input('role'),
        ]);

        return redirect()->route('supervisors')->with('message', 'User updated successfully');
    }
    //    return back()->with('message', 'User Account was successfully updated');

    public function supervisor_delete(User $supervisor){
        $supervisor->delete();

         return redirect('supervisors')->with('message', 'Supervisor was deleted successfully.');
     }


    public function create_supervisor(Request $request){
        $request->validate([
            'first_name' => 'required|string|min:2',
            'last_name' => 'required|string',
            'name' => 'string',
            'email' => 'required', 'email', Rule::unique('supervisor', 'email'),
            'department' => 'required',
            'position' => 'required',
            'password' => 'nullable|string|min:6',
            'photo' => 'image',

        ]);

        $accountsData = $request->all();

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $accountsData["photo"] = '/storage/'.$path;
        }

        User::create([
            // Use the modified variable here
            'role' => 'supervisor',
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'employee_id' => $request->employee_id,
            'name' =>  $request->first_name . ' ' . $request->last_name,
            'email' => $request->email,
            'department' => $request->department,
            'position' => $request->position,
            'password' => '12345',
            'photo' => $accountsData["photo"],

        ]);

        return redirect()->route('supervisors')->with('message', 'User Added Successfully.');
    }

    public function messenger(){
        return view ('messenger');
    }
}


