<?php

namespace App\Repositories\Interfaces\User;


interface ReportRepositoryInterface
{
    public function getReportingUsers($userId);
    public function getReportedUsers($userId);
    public function reportUser($userId, $reportedUserId, $reportTypeId, $reportText);
}