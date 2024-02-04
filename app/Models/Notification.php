<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Notification extends Model
{

    protected $fillable = [
        'user_id',
        'message',
        'notification_type_id'
    ];


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function notificationType()
    {
        return $this->belongsTo(NotificationType::class, 'notification_type_id', 'id');
    }
    
}
