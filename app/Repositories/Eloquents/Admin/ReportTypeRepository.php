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


    public function getReportTypes($filters, $limit = 10)
    {
        $reportTypes = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';

        if(isset($filters['parent_id'])){
            $reportTypes = $reportTypes->where('parent_id', $filters['parent_id']);
        }

        $reportTypes = $reportTypes->where('name', 'like', '%'.$search.'%')
        ->with(['parent'])
        ->paginate($limit);

        return $reportTypes;
    }

    
}