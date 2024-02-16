<?php

namespace App\Http\Controllers\Api\User;

use App\Http\Controllers\Controller;
use App\Http\Requests\Review\IndexReviewRequest;
use App\Http\Requests\Review\StoreReviewRequest;
use App\Http\Resources\Review\ReviewCollection;
use App\Http\Resources\Review\ReviewResource;
use App\Models\Review;
use App\Models\Ride;
use App\Services\User\ReviewService;
use Illuminate\Http\Request;
use Illuminate\Support\Facades\Auth;
use Illuminate\Support\Facades\Gate;

class ReviewController extends Controller
{

      /**
     * @OA\Tag(
     *      name="Review",
     *     @OA\ExternalDocumentation(
     *         description="",
     *         url=""
     *     )
     * )
     */

    public function __construct(
        private ReviewService $reviewService
    )
    {}



    /**
     * @OA\Get(
     *      path="/api/reviews/received",
     *      operationId="getMyReceivedReviews",
     *      tags={"Review"},
     *      summary="get list of my received reviews",
     *      description="get list of my received reviews",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="page",
     *         description="page",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Parameter(
     *         name="limit",
     *         description="limit",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
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
    public function getMyReceivedReviews(IndexReviewRequest $request)
    {
        $reviews = $this->reviewService->getMyReceivedReviews($request);
        return $this->successPaginateResponse(new ReviewCollection($reviews));
    }




    /**
     * @OA\Get(
     *      path="/api/reviews/given",
     *      operationId="getMyGivenReviews",
     *      tags={"Review"},
     *      summary="get list of my given reviews",
     *      description="get list of my given reviews",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="page",
     *         description="page",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
     *      @OA\Parameter(
     *         name="limit",
     *         description="limit",
     *         in = "query",
     *         @OA\Schema(type="integer") 
     *       ),
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
    public function getMyGivenReviews(IndexReviewRequest $request)
    {
        $reviews = $this->reviewService->getMyGivenReviews($request);
        return $this->successPaginateResponse(new ReviewCollection($reviews));
    }




    /**
     * @OA\Post(
     *      path="/api/reviews/{rideId}",
     *      operationId="createReview",
     *      tags={"Review"},
     *      summary="create a review",
     *      description="create a review",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter(
     *         name="rideId",
     *         description="ride id",
     *         in = "path",
     *         @OA\Schema(type="integer") 
     *       ),
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
    public function createReview(StoreReviewRequest $request, Ride $ride)
    {
        Gate::authorize('create', [Review::class, $ride, $request->input('reviewed_user_id')]);
        $review = $this->reviewService->createReview($request, $ride);
        return $this->successJsonResponse(ReviewResource::make($review));
    }


}