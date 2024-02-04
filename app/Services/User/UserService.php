<?php

namespace App\Services\User;

use App\Classes\SmsSender;
use App\Helpers\Helper;
use App\Repositories\Interfaces\User\UserRepositoryInterface;
use App\Services\BaseService;

class UserService extends BaseService
{
    public function __construct(
        UserRepositoryInterface $userRepo
    )
    {
        parent::__construct($userRepo);
    }

    public function getUserList($request)
    { 
        $withAdmin = $request['with_admin'];
        $users = $this->repository->getUserList($withAdmin);
        return $users;
    }



    public function getHomeUsers($user, $request)
    {
        $opositeGender = ! $user['gender'];
        $page = $request->input('page');
        $limit = $request->input('limit');
        return $this->repository->getHomeUsers($opositeGender, $page, $limit);
    }


    public function searchUsers($user, $request)
    {
        $opositeGender = ! $user['gender'];
        $filters['city_id'] = $request->input('city_id');
        $filters['province_id'] = $request->input('province_id');
        $filters['min_age'] = $request->input('min_age');
        $filters['max_age'] = $request->input('max_age');
        $filters['has_profile'] = $request->input('has_profile');
        $filters['is_online'] = $request->input('is_online');


        return $this->repository->searchUsers($opositeGender, $filters);
    }




    public function registerUser($mobile)
    {
        // $isMobileUnique = $this->repository->isMobileUnique($mobile);
        // if(! $isMobileUnique){
        //     return false;
        // }
        $user = $this->repository->registerUser($mobile);

        $code = Helper::generateSmsCode();
        SmsSender::sendSms($mobile, $code, 'register_user');

        return $user;
    }



    public function sendCode($mobile)
    {
        
        $code = Helper::generateSmsCode();
        SmsSender::sendSms($mobile, $code, 'register_user');
        
        $this->repository->updateUserCode($mobile, $code);

        return true;
        
    }



    public function checkUserCode($mobile, $code)
    {
        return $this->repository->checkUserCode($mobile, $code);
            
    }


    public function createUserData($userId, $request)
    {
        // $this->userTempRepo->createUserData($userId, $request);
        return $this->repository->createUserData($userId, $request);
        
    }



    public function updateUserData($userId, $request)
    {
        // $this->userTempRepo->createUserData($userId, $request);
        return $this->repository->updateUserData($userId, $request);
    }



    public function forgetPassword($mobile)
    {
        $user = $this->repository->getUserWithMobile($mobile);
        if(! $user){
            return false;
        }
        $code = Helper::generateSmsCode();
        SmsSender::sendSms($mobile, $code, 'forget_password');

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


    
}