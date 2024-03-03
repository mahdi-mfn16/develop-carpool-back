<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Direction extends Model
{

    protected $table = 'directions';

    protected $fillable = [
        'ride_id',
        'name',
        'coordinates',
        'route_index',
        'time',
        'distance', 
    ];


    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

}
