<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Message extends Model
{

    protected $fillable = [
        'chat_id',
        'from_user_id',
        'to_user_id',
        'message',
        'is_read'
    ];

    public function chat()
    {
        return $this->belongsTo(Chat::class, 'chat_id', 'id');
    }


    public function fromUser()
    {
        return $this->belongsTo(User::class, 'from_user_id', 'id');
    }

    public function toUser()
    {
        return $this->belongsTo(User::class, 'to_user_id', 'id');
    }
}
