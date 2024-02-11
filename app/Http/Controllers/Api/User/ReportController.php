<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\UserReportRequest;
use App\Services\User\ReportService;
use Illuminate\Http\Request;

class ReportController extends Controller
{
    /**
     * @OA\Tag(
     *      name="Report",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private ReportService $reportService
    )
    {}
    


 
    /**
     * @OA\Post(
     *      path="/api/reports",
     *      operationId="reportUser",
     *      tags={"Report"},
     *      summary="report one user",
     *      description="report one user",
     *      security={{"bearer_token":{}}},
     *    @OA\RequestBody(
     *    @OA\JsonContent(
     *      @OA\Property(
     *          property="reported_user_id",
     *          description="reported user id",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="report_type_id",
     *          description="report type id",
     *          example="1",
     *          @OA\Schema(type="integer")
     *          ),
     *      @OA\Property(
     *          property="text",
     *          description="text",
     *          example="test",
     *          @OA\Schema(type="string")
     *          ),
     *     ),
     *     ),
     *      @OA\Response(
     *          response=200,
     *          description="successful operation",
     *          @OA\MediaType(
     *               mediaType="application/json",
     *          )
     *
     *       ),
     *       @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function reportUser(UserReportRequest $request)
    {
        $userId = auth('sanctum')->id();
        $reported = $this->reportService->reportUser($userId, $request);
        return $this->successJsonResponse();
    }


}
