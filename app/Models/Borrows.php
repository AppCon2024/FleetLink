<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Borrows extends Model
{
    use HasFactory;

    protected $fillable = [
        'userId',
        'plate',
        'brand',
        'model',
        'vin',
        'time_in',
        'time_out',
        'latitude',
        'longitude',
        'accuracy'
    ];

    public function scopeSearch($query, $value){
        $query->where('vin','like',"%{$value}%")
        ->orWhere('plate','like',"%{$value}%")
        ->orWhere('model','like',"%{$value}%")
        ->orWhereHas('user', function($query) use ($value) {
            $query->where('name', 'like', "%{$value}%")
            ->orWhere('shift', 'like', "%{$value}%");
        });

    }

    public function user(){
        return $this->belongsTo(User::class, 'userId');
    }
}
