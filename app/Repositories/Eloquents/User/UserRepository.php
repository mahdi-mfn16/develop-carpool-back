<?php 

namespace App\Repositories\Eloquents\User;

use App\Helpers\Helper;
use App\Models\User;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\User\UserRepositoryInterface;

class UserRepository extends BaseRepository implements UserRepositoryInterface
{
    public function __construct(User $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        return [
            'files',
            'preferenceOptions' => function($q) {
                $q->with(['preference']);
            },
            'vehicles' => function($q) {
                $q->with(['vehicle']);
            }
        ];
    }



    public function registerUser($mobile)
    {
        return $this->model->updateOrCreate([
            'mobile' => $mobile
        ]);
    }



    public function updateUserCode($mobile, $code)
    {
        return $this->model->where('mobile', $mobile)->update([
            'code' => $code
        ]);
    }



    public function checkUserCode($mobile, $code)
    {
        
        
        // back door
        if($code == '12345'){
            $user = $this->model->where('mobile', $mobile)->first();
        }else{
            $user = $this->model->where('mobile', $mobile)->where('code', $code)->first();
        }

        $token = null;
        if($user){
            $token = $user->createToken('token-name')->plainTextToken;
            $user->update([
                'code' => null
            ]);
        }
       

        return ['user' => $user, 'token' => $token];
    }


    public function createOrUpdateUserData($user, $request)
    {
        
        return $user->update([
            'name' => isset($request['name']) ? $request['name'] : $user['name'],
            'family' => isset($request['family']) ? $request['family'] : $user['family'],            
            'birth_day' => isset($request['birth_day']) ? $request['birth_day'] : $user['birth_day'],  
            'gender' => isset($request['gender']) ? $request['gender'] : $user['gender'],  
            'national_code' => isset($request['national_code']) ? $request['national_code'] : $user['national_code'],  
            'about_me' => null,    
            'privilege' => 0, 
            'status' => 0,    
        ]);
        
    }


    public function updateUserBio($userId, $text)
    {
        return $this->model->where('id', $userId)->update(
            [
                'bio_temp' => $text,
                'bio_status' => 1,
            ]
        );

    }





    public function getUserWithMobile($mobile)
    {
        return $this->model->where('mobile', $mobile)->first();
    }


    public function isMobileUnique($mobile)
    {
       $user = $this->getUserWithMobile($mobile);
       return $user ? false : true;
    }



    public function resetPassword($userId, $password)
    { 
        return $this->model->where('id', $userId)->update([
            'password' => bcrypt($password),
            'code' => null,
        ]);
    }


    public function changePassword($userId, $oldPassword, $newPassword)
    {
        $authUser = $this->model->where('id', $userId)->first();
        if(!password_verify($oldPassword, $authUser['password'])){
            return false;
        }

        $authUser->update([
            'password' => bcrypt($newPassword)
        ]);

        return true;
    }



    public function assignUserAccess($userId, $privilege)
    {
        $user = $this->model->where('id', $userId)->update([
            'privilege' => $privilege
        ]);
        
        return $user;
    }



    public function getUserList($withAdmin)
    {
        $users = $this->model->query();
        if($withAdmin){
            $users = $users->where('privilege', '!=', config('setting.privilege.admin_user'));
        }
        
        $users = $users->selectRaw("
        *
        ")
        ->orderBy('created_at', 'desc')
        ->get();
        
        return $users;
    }



    public function getUserChatInfo($userId, $otherUserId)
    {
        return $this->model->where('users.id', $otherUserId)
        ->leftJoin('images', function($q1){
            $q1->on('images.user_id', '=', 'users.id');
            $q1->where('images.is_profile', 1);
        })
        ->leftJoin('chats', function($q) use($userId, $otherUserId){
            $q->whereRaw(
                '(chats.user_id_one = '.$userId.' and chats.user_id_two = '.$otherUserId.') 
                 or  
                (chats.user_id_one = '.$otherUserId.' and chats.user_id_two = '.$userId.')'
            );
        })
        
        ->selectRaw("
        users.id as user_id,
        users.first_name,
        users.last_name,
        images.name,
        images.url,
        images.is_profile,
        chats.chat_unique_id
        ")   
        ->first();
    }




    


    
}