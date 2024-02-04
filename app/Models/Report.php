<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class Report extends Model
{

    protected $fillable = [
        'user_id',
        'reported_user_id',
        'report_type_id',
        'text',
    ];


    public function reportedUser()
    {
        return $this->belongsTo(User::class, 'reported_user_id', 'id');
    }


    public function user()
    {
        return $this->belongsTo(User::class, 'user_id', 'id');
    }


    public function reportType()
    {
        return $this->belongsTo(ReportType::class, 'report_type_id', 'id');
    }


}
