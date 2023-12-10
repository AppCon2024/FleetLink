<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Accounts extends Model
{
    use HasFactory;

    protected $fillable = [
        'last_name',
        'first_name',
        'name',
        'email',
        'role',
        'phone',
        'photo',
        // 'emergency_phone',
        // 'password',
    ];
}
