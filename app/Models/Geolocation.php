<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Geolocation extends Model
{
    use HasFactory;

    protected $fillable = ['accuracy', 'latitude', 'longitude', 'employee_id'];

    public function user()
    {
        return $this->belongsTo(User::class);
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
            // Add other fields as needed
        ]);
    }
    // In Geolocation.php model
  
}
