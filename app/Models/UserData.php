<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserData extends Model
{
    use HasFactory;
    protected $fillable = [
        'last_name',
        'first_name',
        'employee_id',
        'position',
        'shift',
        'department',
        'plate',
        'brand',
        'model',
        'vin',
        'time_in',
        'time_out',
        'accuracy',
        'latitude',
        'longitude',
    ];

 /**
     * Update the geolocation data.
     *
     * @param array $data
     * @return bool
     */
    public function updateGeolocation(array $data)
    {
        return $this->update([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'accuracy' => $data['accuracy'],
            // Add other fields as needed
        ]);
    }
}
