<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Preference extends Model
{

    protected $fillable = [
        'name',
        'text',
    ];


    public function options()
    {
        return $this->hasMany(PreferenceOption::class, 'preference_id', 'id');
    }
}
