<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class UserLocation extends Model
{
    use HasFactory;
    protected $fillable = [
        'accuracy',
        'latitude',
        'longitude',
        'altitude',
        'heading',
        'speed',
    ];
}
