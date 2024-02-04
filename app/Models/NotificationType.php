<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class NotificationType extends Model
{

    protected $table = 'notification_types';

    protected $fillable = [
        'name',
        'text'
    ];


    public function notifications()
    {
        return $this->hasMany(Notification::class, 'notification_type_id', 'id');
    }


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_notifications', 'notification_type_id', 'user_id');
    }
    
}
