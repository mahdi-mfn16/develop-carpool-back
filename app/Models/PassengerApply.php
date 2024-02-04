<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PassengerApply extends Model
{

    protected $table = 'passenger_applies';

    protected $fillable = [
        'ride_id',
        'user_id',
        'capacity',
        'status',
    ];


    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
