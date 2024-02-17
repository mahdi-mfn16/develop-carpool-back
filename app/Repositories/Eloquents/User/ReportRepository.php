<?php 

namespace App\Repositories\Eloquents\User;

use App\Models\Report;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\ReportRepositoryInterface;

class ReportRepository extends BaseRepository implements ReportRepositoryInterface
{
    public function __construct(Report $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return ['reportType', 'user', 'reportedUser'];
    }


    public function getAllReports($filters, $limit = 10)
    {
        $reports = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';
        $reportTypeId = (isset($filters['report_type_id']) && $filters['report_type_id']) ? $filters['report_type_id'] : null;
        $reportedUserId = (isset($filters['reported_user_id']) && $filters['reported_user_id']) ? $filters['reported_user_id'] : null;

        if($reportTypeId){
            $reports = $reports->where('report_type_id', $reportTypeId);
        }
        if($reportedUserId){
            $reports = $reports->where('reported_user_id', $reportedUserId);
        }

        $reports = $reports->where('name', 'like', '%'.$search.'%')
        ->with(['reportType', 'user', 'reportedUser'])->paginate($limit);

        return $reports;
    }




    public function reportUser($userId, $reportedUserId, $reportTypeId, $reportText)
    {
        return $this->model->updateOrCreate(
            [
                'user_id' => $userId, 
                'reported_user_id' => $reportedUserId, 
                'report_type_id' => $reportTypeId, 
            ],
            [
                'user_id' => $userId, 
                'reported_user_id' => $reportedUserId, 
                'report_type_id' => $reportTypeId, 
                'text' => $reportText
            ]
        );
    }

    
}