<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Warehouse extends Model
{
    use HasFactory;
    protected $fillable = [
        'plate',
        'mv',
        'cr',
        'eng',
        'cha',
        'brand',
        'model',
        'vin',
        'station',
        'type',
        'user',
        'status',
        'qrcode',
    ];
}
