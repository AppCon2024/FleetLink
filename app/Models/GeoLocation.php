<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class GeoLocation extends Model
{
    use HasFactory;

    protected $fillable = [
        'accuracy',
        'latitude',
        'longitude',
        'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
    }
    public function borrow()
    {
        return $this->belongsTo(Borrows::class, 'employee_id', 'employee_id');
    }
    /**
     * Update the geolocation data.
     *
     * @param array $data
     * @return bool
     */
    public function updateGeolocation(array $data)
    {
        return $this->update([
            'latitude' => $data['latitude'],
            'longitude' => $data['longitude'],
            'accuracy' => $data['accuracy'],
        ]);
    }
}
