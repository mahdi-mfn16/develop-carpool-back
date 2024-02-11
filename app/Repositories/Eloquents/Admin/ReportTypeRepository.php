<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\ReportType;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\ReportTypeRepositoryInterface;

class ReportTypeRepository extends BaseRepository implements ReportTypeRepositoryInterface
{
    public function __construct(ReportType $model)
    {
        parent::__construct($model);
    }


    public function load()
    {
        return ['children'];
    }

    
}