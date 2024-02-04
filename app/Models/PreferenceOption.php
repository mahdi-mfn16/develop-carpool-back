<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class PreferenceOption extends Model
{

    protected $table = 'preference_options';

    protected $fillable = [
        'preference_id',
        'text',
    ];


    public function users()
    {
        return $this->belongsToMany(User::class, 'user_preferences', 'preference_option_id', 'user_id');
        
    }


    public function preference()
    {
        return $this->belongsTo(Preference::class, 'preference_id', 'id');
    }

}
