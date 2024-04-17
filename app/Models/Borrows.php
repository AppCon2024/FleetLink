<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
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
    ];

    public function scopeSearch($query, $value){
        $query->where('last_name','like',"%{$value}%")
        ->orWhere('department','like',"%{$value}%")
        ->orWhere('plate','like',"%{$value}%")
        ->orWhere('first_name','like',"%{$value}%")
        ->orWhere('model','like',"%{$value}%")
        ->orWhere('employee_id','like',"%{$value}%")
        ->orWhere('shift','like',"%{$value}%");
    }
}
