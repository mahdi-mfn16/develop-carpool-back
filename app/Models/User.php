<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
        'family',
        'mobile',
        'password',
        'national_code',
        'code',
        'privilege', 
        'birth_day',
        'gender',
        'about_me',
        'status',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
        'code'
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        // 'email_verified_at' => 'datetime',
    ];


    public function files()
    {
        return $this->morphMany(File::class, 'filable');
    }

    public function profile()
    {
        return $this->morphMany(File::class, 'filable')->where('type', 'profile');
    }


    public function hostChats()
    {
        return $this->hasMany(Chat::class, 'user_id_two', 'id');
    }

    public function guestChats()
    {
        return $this->hasMany(Chat::class, 'filable')->merge($this->hasMany(Chat::class, 'filable'));
    }


    public function chats()
    {
        return ($this->hostChats)->merge($this->guestChats);
    }



    // public function getChatsAttribute($value)
    // {
    //     $hostChats = $this->hostChats;
    //     $guestChats = $this->guestChats;

    //     return $hostChats->merge($guestChats);
    // }


    public function notifications()
    {
        return $this->hasMany(Notification::class, 'user_id', 'id');
    }


    public function notificationTypes()
    {
        return $this->belongsToMany(NotificationType::class, 'user_notifications','user_id', 'notification_type_id');
    }


    public function preferenceOptions()
    {
        return $this->belongsToMany(PreferenceOption::class, 'user_preferences','user_id', 'preference_option_id');
    }


    public function applies()
    {
        return $this->hasMany(PassengerApply::class, 'user_id', 'id');
    }

    public function rides()
    {
        return $this->hasMany(Ride::class, 'user_id', 'id');
    }

    public function reports()
    {
        return $this->hasMany(Report::class, 'user_id', 'id');
    }

    public function complaints()
    {
        return $this->hasMany(Report::class, 'reported_user_id', 'id');
    }


    public function reviews()
    {
        return $this->hasMany(Review::class, 'user_id', 'id');
    }


    public function vehicles()
    {
        return $this->hasMany(UserVehicle::class, 'user_id', 'id');
    }



    
}