<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Location extends Model
{
    protected $table = 'borrows'; // Define the table name

    protected $fillable = [
        'lastname', 'employee_id', 'brand', 'plate'
        // Add other fields from your locations table as needed
    ];

    // If you have timestamps (created_at, updated_at) in your table, set this to true/false as needed
    public $timestamps = false;
    
}
