<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Rate extends Model
{

    protected $fillable = [
        'rate',
        'text',
    ];


    public function reviews()
    {
        return $this->hasMany(Review::class, 'rate_id', 'id');
    }
}
