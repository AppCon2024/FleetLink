<?php

namespace App\Http\Controllers\Auth;

use App\Http\Controllers\Controller;
use App\Models\User;
use App\Providers\RouteServiceProvider;
use Illuminate\Auth\Events\Registered;
use Illuminate\Http\RedirectResponse;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Hash;
use Illuminate\Validation\Rules;
use Illuminate\View\View;

class RegisteredUserController extends Controller
{
    /**
     * Display the registration view.
     */
    public function create(): View
    {
        return view('auth.register');
    }

    /**
     * Handle an incoming registration request.
     *
     * @throws \Illuminate\Validation\ValidationException
     */
    public function store(Request $request): RedirectResponse
    {
        $accountsData = $request->all();

        $request->validate([
            'image' => ['image', 'required'], // Use the modified variable here
            'last_name' => ['required', 'alpha', 'max:50'],
            'first_name' => ['required', 'alpha', 'max:50'],
            'email' => ['required', 'string', 'lowercase', 'email', 'max:50', 'unique:'.User::class],
            'employee_id' => ['required', 'numeric', 'digits:6'],
            'password' => ['required', 'confirmed', Rules\Password::defaults()],
            // 'role' => ['required', 'string', 'max: 10'],
            'department' => ['required'],
            'position' => ['required'],
            'station' => ['required'],
            'shift' => ['required'],
        ]);

        if ($request->hasFile('image')) {
            $fileName = 'fleetlink_' . $request->first_name . $request->last_name. '.jpg';
            $path = $request->file('image')->storeAs('images', $fileName, 'public');
            $accountsData["image"] = '/storage/'.$path;
        }

        $user = User::create([
            'role' => 'police',
            'image' => $accountsData["image"], // Use the modified variable here
            'first_name' => $request->first_name,
            'last_name' => $request->last_name,
            'name' =>  $request->first_name . ' ' . $request->last_name,
            'employee_id' => $request->employee_id,
            'email' => $request->email,
            'password' => Hash::make($request->password),
            'department' => $request->department,
            'position' => $request->position,
            'station' => $request->station,
            'shift' => $request->shift,
        ]);

        event(new Registered($user));

        Auth::login($user);

        return redirect(RouteServiceProvider::HOME);
    }
}
