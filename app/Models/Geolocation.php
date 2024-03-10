<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\User;


class Geolocation extends Model
{
    use HasFactory;

    protected $fillable = ['employee_id', 'accuracy', 'latitude', 'longitude'];
    protected $table = 'geolocations'; // Set the table name if different from default

    // If you want to explicitly define the relationship with the User model
    public function employee()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}
