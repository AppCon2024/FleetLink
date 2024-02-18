<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    protected $fillable = ['accuracy', 'latitude', 'longitude'];
    protected $table = 'geolocations'; // Set the table name if different from default
}