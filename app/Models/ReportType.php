<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Model;

class ReportType extends Model
{

    protected $table = 'report_types';

    protected $fillable = [
        'name',
        'text',
        'parent_id'
    ];


    public function reports()
    {
        return $this->hasMany(Report::class, 'report_type_id', 'id');
    }


    public function parent()
    {
        return $this->belongsTo(ReportType::class, 'parent_id', 'id');
    }

    public function children()
    {
        return $this->hasMany(ReportType::class, 'parent_id', 'id');
    }
}
