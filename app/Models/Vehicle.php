<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Vehicle extends Model
{

    protected $fillable = [
        'name',
    ];


    public function users()
    {
        return $this->hasMany(UserVehicle::class, 'vehicle_id', 'id');
    }
}
