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
        
    }



    public function getReportingUsers($userId)
    {
        $reportingUsers = $this->model->where('reports.reported_user_id', $userId)
        ->leftJoin('users', 'users.id', '=', 'reports.user_id')
        ->selectRaw("
            reports.reported_user_id,
            reports.created_at as report_date,
            users.*
        ")
        ->get();

        return $reportingUsers;
    }



    public function getReportedUsers($userId)
    {
        $reportedUsers = $this->model->where('reports.user_id', $userId)
        ->leftJoin('users', 'users.id', '=', 'reports.reported_user_id')
        ->selectRaw("
            reports.user_id,
            reports.created_at as report_date,
            users.*
        ")
        ->get();

        return $reportedUsers;

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