<?php

namespace App\Http\Controllers\Api\Admin;

use App\Http\Controllers\Controller;
use App\Http\Requests\NotificationType\StoreNotificationTypeRequest;
use App\Http\Requests\NotificationType\UpdateNotificationTypeRequest;
use App\Models\NotificationType;
use App\Services\Admin\NotificationTypeService;
use Illuminate\Http\Request;

class NotificationTypeController extends Controller
{

    public function __construct(
        private NotificationTypeService $notificationTypeService
    ){}


    /**
     * Display a listing of the notification type.
     *
     */
    public function index()
    {
        $types = $this->notificationTypeService->indexAllItems();
        return $this->successArrayResponse($types);
    }


    /**
     * Store a newly created notification type in storage.
     *
     */
    public function store(StoreNotificationTypeRequest $request)
    {
        $type = $this->notificationTypeService->createItem($request->all());
        return $this->successJsonResponse($type);
    }

    /**
     * Display the specified notification type.
     *
     */
    public function show(NotificationType $notificationType)
    {
        $type = $this->notificationTypeService->showItem($notificationType['id']);
        return $this->successJsonResponse($type);
    }



    /**
     * Update the specified notification type in storage.
     *
     */
    public function update(UpdateNotificationTypeRequest $request, NotificationType $notificationType)
    {
        $type = $this->notificationTypeService->updateItem($notificationType['id'], $request->all());
        return $this->successJsonResponse($type);
    }

    /**
     * Remove the specified notification type from storage.
     *
     */
    public function destroy(NotificationType $notificationType)
    {
        $this->notificationTypeService->deleteItem($notificationType['id']);
        return $this->successJsonResponse();

    }
}
