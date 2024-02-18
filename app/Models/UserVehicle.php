<?php

namespace App\Models;

use App\Traits\HasFile;
use Illuminate\Database\Eloquent\Model;

class UserVehicle extends Model
{
    use HasFile;

    protected $table = 'user_vehicles';

    protected $fillable = [
        'user_id',
        'vehicle_id',
        'color',
        'year_model',
        'plate_number',
        'status', // pending => 0, verified => 1, rejected => 2

    ];


    public function vehicle()
    {
        return $this->belongsTo(Vehicle::class, 'vehicle_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }
}
