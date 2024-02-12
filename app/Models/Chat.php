<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Chat extends Model
{

    protected $fillable = [
        'user_id_one',
        'user_id_two',
        'ride_apply_id'
    ];


    public function messages()
    {
        return $this->hasMany(Message::class, 'chat_id', 'id');
    }

    public function userOne()
    {
        return $this->belongsTo(User::class, 'user_id_one', 'id');
    }

    public function userTwo()
    {
        return $this->belongsTo(User::class, 'user_id_two', 'id');
    }
}
