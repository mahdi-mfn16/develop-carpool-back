<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\Report\IndexReportRequest;
use App\Http\Resources\Report\ReportCollection;
use App\Http\Resources\Report\ReportResource;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Report;
use App\Models\Review;
use App\Services\User\ReportService;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;

class ReviewController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Review", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private ReviewService $reviewService
    )
    {}
    

     /**
     * @OA\Get(
     *      path="/api/admin/reviews",
     *      operationId="getAdminReviews",
     *      tags={"Admin - Review"},
     *      summary="get list of reviews",
     *      description="get list of reviews",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Parameter( name="filters[status]", in="query", description="status", @OA\Schema( type="boolean", example="" ) ),     
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexReportRequest $request)
    {
        $reviews = $this->reviewService->getAllReviews($request);
        return $this->successPaginateResponse(new ReviewCollection($reviews));
    }




    /**
     * @OA\Get(
     *      path="/api/admin/reviews/{reviewId}",
     *      operationId="showAdminReviews",
     *      tags={"Admin - Review"},
     *      summary="show one review",
     *      description="show one review",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reviewId", description="review id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(Review $review)
    {
        $review = $this->reviewService->showItem($review['id']);
        return $this->successJsonResponse(ReviewResource::make($review));
    }




    /**
     * @OA\Delete(
     *      path="/api/admin/reviews/{reviewId}",
     *      operationId="destroyAdminReview",
     *      tags={"Admin - Review"},
     *      summary="destroy one review",
     *      description="destroy one review",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reviewId", description="review id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(Review $review)
    {
        $this->reviewService->deleteItem($review['id']);
        return $this->successJsonResponse();
    }




    /**
     * @OA\Put(
     *      path="/api/admin/reviews/toggle-status/{reviewId}",
     *      operationId="toggleStatusAdminReview",
     *      tags={"Admin - Review"},
     *      summary="toggle status one review",
     *      description="toggle status one review",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="reviewId", description="review id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function toggleStatus(Review $review)
    {
        $this->reviewService->toggleStatus($review);
        return $this->successJsonResponse();
    }




}
