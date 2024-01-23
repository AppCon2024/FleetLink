<?php

namespace App\Http\Controllers;

use App\Models\Accounts;
use App\Models\User;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\DB;
use Illuminate\Validation\Rule;

class AccountsController extends Controller
{
    //

    public function index() {

        $accounts = User::where('role', 'police')->get();

        return view('pages.accounts',
        ['accounts' => $accounts]);
    }

    public function destroy(User $account){
        $account->delete();
        return redirect('accounts')->with('message', 'Data was deleted successfully.');
    }

    public function create_account(Request $request){


        $request->validate([
            'last_name' => 'required',
            'first_name' => 'required',
            'email' => 'required',
            'name'=>'string',
            // 'email' => 'required', 'email', Rule::unique('accounts', 'email'),
            // 'phone' => 'required',
            'role' => 'string',
            'phone' => 'string',
            'photo' => 'image',
            // 'password' => 'string',
        ]);

        $accountsData = $request->all();

        if ($request->hasFile('photo')) {
            $fileName = time().$request->file('photo')->getClientOriginalName();
            $path = $request->file('photo')->storeAs('images', $fileName, 'public');
            $accountsData["photo"] = '/storage/'.$path;
        }



        User::create([
            'photo' => $accountsData["photo"], // Use the modified variable here
            'last_name' => $request->input('last_name'),
            'employee_id' => $request->input('employee_id'),
            'name'=> $request->first_name . ' ' . $request->last_name,
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),
            'phone' => $request->input('phone'),
            'password' => '12345',
            'role' => 'police',
        ]);
        return redirect()->route('accounts')->with('message', 'User Added Successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = User::find($id);

        if (!$data) {
            return redirect()->route('accounts')->with('error', 'User not found');
        }

        // Validate the request
        $request->validate([
            'last_name' => 'string',
            'first_name' => 'string',
            'email' => 'email',
            'phone' => 'string',
            'department' => ['required'],
            'position' => ['required'],

            // 'emergency_phone' => 'required|int',

        ]);

        // Update user information
        $data->update([
            'last_name' => $request->input('last_name'),
            'first_name' => $request->input('first_name'),
            'email' => $request->input('email'),
            'phone' => $request->input('phone'),
            'department' => $request->input('department'),
            'position' => $request->input('position'),

            // 'emergency_phone' => $request->input('emergency_phone'),
        ]);

        return redirect()->route('accounts')->with('message', 'User updated successfully');
    }

    public function mobile(){
        return view('mobile');
    }
}
