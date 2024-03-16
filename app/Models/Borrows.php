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
        'department',
        'plate',
        'brand',
        'model',
        'vin',
        'time_in',
        'time_out',
    ];
   
    public function geoLocations()
    {
        return $this->hasMany(GeoLocation::class, 'employee_id', 'employee_id');
    }

    public function scopeSearch($query, $value){
        $query->where('last_name','like',"%{$value}%")->orWhere('department','like',"%{$value}%");
    }
}
