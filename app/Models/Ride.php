<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class Ride
 extends Model
{
    use HasFactory;

    protected $fillable = [
        'user_id',
        'origin_city_id',
        'destination_city_id',
        'user_vehicle_id',
        'capacity',
        'booked',
        'origin_address',
        'destination_address',
        'origin_lng',
        'origin_lat',
        'destination_lng',
        'destination_lat',
        'distance',
        'date',
        'type',
        'description',
        'start_time',
        'end_time',
        'price',
        'fee',
        'status', // pending => 0, active => 1, canceled => 2
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function applies()
    {
        return $this->hasMany(RideApply::class, 'ride_id', 'id');
    }

    public function origin()
    {
        return $this->belongsTo(City::class, 'origin_city_id', 'id');
    }

    public function destination()
    {
        return $this->belongsTo(City::class, 'destination_city_id', 'id');
    }


    public function userVehicle()
    {
        return $this->belongsTo(UserVehicle::class, 'user_vehicle_id', 'id');
    }


    public function reviews()
    {
        return $this->belongsTo(Review::class, 'ride_id', 'id');
    }

    public function direction()
    {
        return $this->hasOne(Direction::class, 'ride_id', 'id');
    }
}
