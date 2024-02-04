<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{

    protected $table = 'user_vehicles';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'color',
        'year_model',
        'plate_number',
        'status',

    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
