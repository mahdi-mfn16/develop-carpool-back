<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;

class File extends Model
{
    use HasFactory;


    protected $fillable = [
        'user_id',
        'name',
        'path',
        'type',
        'filable_id',
        'filable_type',
        'status', // 0 or 1
    ];


    public function owner()
    {
        return $this->belongsTo(User::class);
    }

    public function filable()
    {
        return $this->morphTo();
    }

}
