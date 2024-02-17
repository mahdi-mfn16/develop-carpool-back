<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationType\IndexNotificationTypeRequest;
use App\Http\Requests\NotificationType\StoreNotificationTypeRequest;
use App\Http\Requests\NotificationType\UpdateNotificationTypeRequest;
use App\Http\Resources\NotificationType\NotificationTypeCollection;
use App\Http\Resources\NotificationType\NotificationTypeResource;
use App\Models\NotificationType;
use App\Services\Admin\NotificationTypeService;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{
    /**
     * @OA\Tag( name="Admin - Notification Type", @OA\ExternalDocumentation( description="", url="" ) )
     */

    public function __construct(
        private NotificationTypeService $notificationTypeService
    ){}


    /**
     * @OA\Get(
     *      path="/api/admin/notifications/types",
     *      operationId="getAdminNotificationTypes",
     *      tags={"Admin - Notification Type"},
     *      summary="get list of notification types",
     *      description="get list of notification types",
     *      security={{"bearer_token":{}}},  
     *      @OA\Parameter( name="page", description="page", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="limit", description="limit", in = "query", @OA\Schema(type="integer") ),
     *      @OA\Parameter( name="filters[search]", in="query", description="search", @OA\Schema( type="string", example="" ) ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function index(IndexNotificationTypeRequest $request)
    {
        $types = $this->notificationTypeService->getNotificationTypes($request);
        return $this->successPaginateResponse(new NotificationTypeCollection($types));
    }


     /**
     * @OA\Post(
     *      path="/api/admin/notifications/types",
     *      operationId="storeAdminNotificationTypes",
     *      tags={"Admin - Notification Types"},
     *      summary="create one notification type",
     *      description="create one notification type",
     *      security={{"bearer_token":{}}},
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function store(StoreNotificationTypeRequest $request)
    {
        $type = $this->notificationTypeService->createItem($request->all());
        return $this->successJsonResponse(NotificationTypeResource::make($type));
    }

    /**
     * @OA\Get(
     *      path="/api/admin/notifications/types/{notificationTypeId}",
     *      operationId="showAdminNotificationTypes",
     *      tags={"Admin - Notification Types"},
     *      summary="show one notification type",
     *      description="show one notification type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="notificationTypeId", description="notification type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function show(NotificationType $notificationType)
    {
        $type = $this->notificationTypeService->showItem($notificationType['id']);
        return $this->successJsonResponse(NotificationTypeResource::make($type));
    }



    /**
     * @OA\Post(
     *      path="/api/admin/notifications/types/{notificationTypeId}",
     *      operationId="updateAdminNotificationTypes",
     *      tags={"Admin - Notification Types"},
     *      summary="update one notification type",
     *      description="update one notification type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="notificationTypeId", description="notification type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\RequestBody(@OA\JsonContent(
     *       @OA\Property(property="name", description="name", example="test", @OA\Schema(type="string") ),
     *       @OA\Property(property="text", description="text", example="test", @OA\Schema(type="string") ),
     *      ),),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function update(UpdateNotificationTypeRequest $request, NotificationType $notificationType)
    {
        $type = $this->notificationTypeService->updateItem($notificationType['id'], $request->all());
        return $this->successJsonResponse(NotificationTypeResource::make($type));
    }

     /**
     * @OA\Delete(
     *      path="/api/admin/notifications/types/{notificationTypeId}",
     *      operationId="destroyAdminNotificationTypes",
     *      tags={"Admin - Notification Types"},
     *      summary="destroy one notification type",
     *      description="destroy one notification type",
     *      security={{"bearer_token":{}}},
     *      @OA\Parameter( name="notificationTypeId", description="notification type id", in = "path", @OA\Schema(type="integer") ),
     *      @OA\Response( response=200, description="successful operation", @OA\MediaType( mediaType="application/json", ) ),
     *      @OA\Response(response=400, description="Bad request"),
     *      @OA\Response(response=404, description="Resource Not Found"),
     *      @OA\Response(response=401, description="Unauthorized"),
     *     )
     * @param Request $request
     * @return \Illuminate\Http\JsonResponse
     */
    public function destroy(NotificationType $notificationType)
    {
        $this->notificationTypeService->deleteItem($notificationType['id']);
        return $this->successJsonResponse();

    }
}
