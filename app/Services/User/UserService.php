<?php

namespace App\Services\User;

use App\Classes\SmsSender;
use App\Events\SendUserNotificationEvent;
use App\Helpers\Helper;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(
        UserRepositoryInterface $userRepo,
        private NotificationService $notificationService
    )
    {
        parent::__construct($userRepo);
    }

    public function getUserList($request)
    { 
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getUserList($filters, $limit);
    }



    public function registerUser($mobile)
    {
        $user = $this->repository->registerUser($mobile);

        $code = Helper::generateSmsCode();
        SmsSender::sendSms('authMessage', $mobile, ['token' => $code]);
        
        $this->repository->updateUserCode($mobile, $code);

        return $user;
    }



    public function sendCode($mobile)
    {
        
        $code = Helper::generateSmsCode();
        SmsSender::sendSms('authMessage', $mobile, ['token' => $code]);
        
        $this->repository->updateUserCode($mobile, $code);

        return true;
        
    }



    public function checkUserCode($mobile, $code)
    {
        return $this->repository->checkUserCode($mobile, $code);
            
    }


    public function createOrUpdateUserData($user, $request)
    {
        $this->repository->createOrUpdateUserData($user, $request);  
        return $this->showItem($user['id']); 
    }



    public function updateUserBio($userId, $request)
    {
        $text = $request->input('text');
        $this->repository->updateUserBio($userId, $text);
        return $this->showItem($userId);
    }




    public function forgetPassword($mobile)
    {
        $user = $this->repository->getUserWithMobile($mobile);
        if(! $user){
            return false;
        }
        $code = Helper::generateSmsCode();
        SmsSender::sendSms('forgetPasswordMessage', $mobile, ['token' => $code]);

        return true;
    }


    public function resetPassword($userId, $password)
    {
        return $this->repository->resetPassword($userId, $password);
    }



    public function changePassword($userId, $oldPassword, $newPassword)
    {
        return $this->repository->changePassword($userId, $oldPassword, $newPassword);
    }


    public function getOneProfile($userId)
    {
        return $this->repository->getOneProfile($userId);
    }



    public function updateUserInfoStatus($user, $request)
    {
        $action = $request->input('action');
        $message = $request->input('message');
        $type = $request->input('type');
        $this->repository->updateUserInfoStatus($user, $action, $type);


        $notif = $this->notificationService->createNotification(
            $userId = $user['id'],
            $typeName = $action.'_user_'.$type.'_status',
            $params = [
                'message'=> $message,
            ],
            
        );

        event(new SendUserNotificationEvent($notif));
    }



    public function getUserFiles($user, $request)
    {
        $filters = $request->input('filters');
        $limit = $request->input('limit') ?: 10;
        return $this->repository->getUserFiles($user, $filters, $limit);
    }


    public function verifyProfile($file)
    {
        $this->repository->verifyProfile($file);   
    }


    
}