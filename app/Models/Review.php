<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Review extends Model
{

    protected $fillable = [
        'user_id',
        'ride_id',
        'rate_id',
        'text',
        'status',
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }

    public function ride()
    {
        return $this->belongsTo(Ride::class, 'ride_id', 'id');
    }

    public function rate()
    {
        return $this->belongsTo(Rate::class, 'rate_id', 'id');
    }
}
