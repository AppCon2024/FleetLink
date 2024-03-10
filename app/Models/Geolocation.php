<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    protected $fillable = ['accuracy', 'latitude', 'longitude', 'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class, 'employee_id');
    }
}