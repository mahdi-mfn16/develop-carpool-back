<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class RideApply extends Model
{

    protected $table = 'ride_applies';

    protected $fillable = [
        'ride_id',
        'user_id',
        'price',
        'fee',
        'capacity',
        'status', // 0 => pending, 1 => accepted, 2 => rejected, 3 => closed
    ];


    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function chat()
    {
        return $this->hasOne(Chat::class, 'ride_apply_id', 'id');
    }
}
