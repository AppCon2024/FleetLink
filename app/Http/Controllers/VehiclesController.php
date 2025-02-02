<?php

namespace App\Http\Controllers;


use App\Models\Borrows;
use App\Models\GeoLocation;
use App\Models\Locations;
use App\Models\User;
use App\Models\UserData;
use App\Models\UserLocation;
use App\Models\Vehicles;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\DB;
use Milon\Barcode\Facades\DNS1DFacade as DNS2D;

class VehiclesController extends Controller
{
    //
    public function index() {
        $vehicles = Vehicles::all();


        return view('pages.vehicles',
        ['vehicles' => $vehicles]);
    }

    public function scan(Request $request){
        $data = Vehicles::where('plate')->get();

        return view('scanner',
        ['data' => $data]);
    }

    public function destroy(Vehicles $vehicle){
        $vehicle->delete();

        return redirect('vehicles')->with('message', 'Data was deleted successfully.');
    }

    public function update(Request $request, $id)
    {
        $data = Vehicles::find($id);

        if (!$data) {
            return redirect()->route('vehicles')->with('error', 'User not found');
        }

        // Validate the request
        $request->validate([
            'plate' => 'string',
            'brand' => 'string',
            'model' => 'string',
            'vin' => 'string',
            // 'emergency_phone' => 'required|int',

        ]);

        // Update user information
        $data->update([
            'plate' => $request->input('plate'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'vin' => $request->input('vin'),

            // 'emergency_phone' => $request->input('emergency_phone'),
        ]);

        return redirect()->route('vehicles')->with('message', 'User updated successfully');
    }

    public function status($vehicleId){
        $vehicle = Vehicles::find($vehicleId);

        if($vehicle){
            if($vehicle->status){
                $vehicle->status = 0;
            }
            else{
                $vehicle->status = 1;
            }
            $vehicle->save();
        }
        return back();
    }

    public function create_vehicle(Request $request){

        $uniqueIdentifier = uniqid();

        $request->validate([
            'plate' => 'required|string',
            'brand' => 'string',
            'model' => 'required|string',
            'vin' => 'required|string',
            // 'username' => 'required|string',
            // 'email' => 'required', 'email', Rule::unique('accounts', 'email'),
            // 'phone' => 'required',
            // 'role' => 'string',
            // 'password' => 'string',
        ]);
        // Vehicles::create($request->all());
        $vehicle = Vehicles::create([
            'plate' => $request->input('plate'),
            'brand' => $request->input('brand'),
            'model' => $request->input('model'),
            'vin' => $request->input('vin'),
            // 'phone' => $request->input('phone'),
            // 'emergency_phone' => $request->input('emergency_phone'),
            // 'password' => '12345',
            'role' => 'vehicle',
            'name' => 'vehicle',
            'status' => '1',
            'unique_identifier' => $uniqueIdentifier,

        ]);

        return redirect()->route('vehicles')->with('message', 'Vehicle Added Successfully.');
    }

    public function vehicleCodeExists($number){

        return Vehicles::whereVehicleCode($number)->exists();
    }

    public function downloadQR($number){

        $QrCode = DNS2D::getBarcodePNG($number, 'QRCODE');

        $headers = [
            'Content-Type' => 'image/png',
            'Content-Disposition' => 'attachment; filename=qrcode.png',
        ];

        return response(base64_decode($QrCode))->withHeaders($headers);
    }

    public function borrow(Request $request){

        $plate = $request->input('plate');
        $existingBorrow = Borrows::where('plate', $plate)
        ->where('time_out','- - -')
        ->first();// Check if the plate is already in use
        $using = Auth::user()->id;
        $existingUser = Borrows::where('userId',$using)->where('time_out','- - -')->first();

        //problem if user done using vehicle then he scan again

        if ($existingBorrow)
        {
            $finish = Auth::user()->id;
            $update = Borrows::where('userId', $finish);

            if($update)
            {
                $update->update([
                            'time_out' => now(),
                        ]);

                Vehicles::where('plate', $plate)->update([
                            'status' => 1,
                         ]);

                UserData::where('plate',$plate)->update([
                            'time_out' => now(),
                        ]);

                return redirect()->route('dashboard')->with('message', 'You are now disconnected from the vehicle.');
            }
            else
            {
                return redirect()->route('dashboard')->with('message', 'This vehicle is currently in use.');
            }
        }
        else if($existingUser){
            return redirect()->route('dashboard')->with('message', 'Error! Invalid.');
        }
        else
        {
            $userId = Auth::user()->id;
            $userLoc = Locations::where('userId',$userId)->first();
            $latitude = $userLoc->latitude;
            $longitude = $userLoc->longitude;
            $accuracy = $userLoc->accuracy;
            Borrows::create([
                'userId' => $userId,
                'vin' => $request->input('vin'),
                'plate' => $plate,
                'brand' => $request->input('brand'),
                'model' => $request->input('model'),
                'latitude' => $latitude,
                'longitude' => $longitude,
                'accuracy' => $accuracy,
                'time_in' => now(),
                'time_out' => '- - -',
            ]);

            // $id = Auth::user()->employee_id;
            // $Geo = GeoLocation::where('employee_id',$id)->first();
            // $accuracy = $Geo->accuracy ;
            // $latitude = $Geo->latitude;
            // $longitude = $Geo->longitude;

            // UserData::Create([
            //     'last_name' => $request->input('last_name'),
            //     'first_name' => $request->input('first_name'),
            //     'employee_id' => $request->input('employee_id'),
            //     'position' => $request->input('position'),
            //     'shift' => $shift,
            //     'vin' => $request->input('vin'),
            //     'department' => $request->input('department'),
            //     'plate' => $plate,
            //     'brand' => $request->input('brand'),
            //     'model' => $request->input('model'),
            //     'time_in' => now(),
            //     'time_out' => '- - -',
            //     'accuracy' => $accuracy,
            //     'latitude' => $latitude,
            //     'longitude' => $longitude,
            // ]);

            Vehicles::where('plate', $plate)->update([
                'status' => 0,
             ]);

            return redirect()->route('dashboard')->with('message', 'You are now connected to the vehicle.');
        }
    }
}
