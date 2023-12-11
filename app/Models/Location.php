<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    // Define the table name
    protected $table = 'locations';

    // Define the fillable attributes
    protected $fillable = [
        'latitude',
        'longitude',
        // Add any additional fields here
    ];

    // Define any relationships you need (optional)
}
