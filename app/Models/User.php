<?php

namespace App\Models;

// use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
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

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
        'password' => 'hashed',
    ];

    public function scopeSearch($query, $value){
        $query->where('name','like',"%{$value}%")->orWhere('department','like',"%{$value}%")->orWhere('position','like',"%{$value}%")->orWhere('station','like',"%{$value}%")->orWhere('shift','like',"%{$value}%");
    }


}
