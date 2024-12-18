<?php

namespace App\Models;

use App\Traits\HasFile;
use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable;
    use HasFile;

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
        'privilege', // privilege  0 => free_user , 1 => vip_user,  10 => admin_user
        'birth_day',
        'gender',
        'about_me',
        'status', // status  0 => not_verified , 1 => verified
        'bio_temp',
        'bio_status', // status 0 => null , 1 => pending , 2 => verified , 3 => rejected 
        'selfie_status', // status 0 => null , 1 => pending , 2 => verified , 3 => rejected 
        'drive_license_status', // status 0 => null , 1 => pending , 2 => verified , 3 => rejected 
      
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



    public function hostChats()
    {
        return $this->hasMany(Chat::class, 'user_id_one', 'id');
    }

    public function guestChats()
    {
        return $this->hasMany(Chat::class, 'user_id_two', 'id');
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
        return $this->hasMany(RideApply::class, 'user_id', 'id');
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
        return $this->hasMany(Review::class, 'reviewed_user_id', 'id');
    }


    public function vehicles()
    {
        return $this->hasMany(UserVehicle::class, 'user_id', 'id');
    }



    
}
