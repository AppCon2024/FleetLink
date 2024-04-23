<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Archive extends Model
{
    use HasFactory;

    protected $fillable = [
        'status',
        'role',
        'first_name',
        'last_name',
        'name',
        'employee_id',
        'email',
        'department',
        'position',
        'station',
        'shift',
        'password',
        'image',
        'last_seen',
        'region_text',
        'province_text',
        'city_text',
        'barangay_text',
        'street',
        'zip_code',
    ];

    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%")
        ->orWhere('department','like',"%{$value}%")
        ->orWhere('position','like',"%{$value}%")
        ->orWhere('station','like',"%{$value}%")
        ->orWhere('shift','like',"%{$value}%");
    }
}
