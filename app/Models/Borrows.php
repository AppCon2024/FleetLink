<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    // use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'employee_id',
        'position',
        'department',
        'plate',
        'brand',
        'model',
        'vin',
        'time_in',
        'time_out',
    ];
}
