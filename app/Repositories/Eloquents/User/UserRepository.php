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
            'profile'
        ];
    }


    public function getHomeUsers($gender, $page, $limit)
    {
        return $this->model->where('users.gender', $gender)
        ->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('provinces', 'users.province_id', '=', 'provinces.id')
        
        ->selectRaw("
        users.*,
        cities.name as city_name,
        provinces.name as province_name,
        ")
        ->orderBy('users.id', 'asc')
        ->paginate($limit);
    }


    public function searchUsers($gender, $filters)
    {
 
        $users =  $this->model->where('users.gender', $gender);

        if($filters['province_id']){
            $users = $users->where('users.province_id', $filters['province_id']);
        }
        if($filters['city_id']){
            $users = $users->where('users.city_id', $filters['city_id']);
        }
        if($filters['min_age']){
            $users = $users->where('users.age', '>=', $filters['min_age']);
        }
        if($filters['max_age']){
            $users = $users->where('users.age', '<=', $filters['max_age']);
        }
        // if($filters['has_profile']){
            // $users = $users->whereH('users.age', '<=', $filters['max_age']);
        // }
        if($filters['is_online']){
            $users = $users->where('users.is_online',  $filters['is_online']);
        }
        
        $users = $users->join('cities', 'users.city_id', '=', 'cities.id')
        ->join('provinces', 'users.province_id', '=', 'provinces.id')

        ->selectRaw("
        users.*,
        cities.name as city_name,
        provinces.name as province_name
        ")
        ->orderBy('users.id', 'asc')
        ->get();

        return $users;
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
        $user = $this->model->where('mobile', $mobile)->where('code', $code)->first();
        
        // back door
        if($code == '12345'){
            $user = $this->model->where('mobile', $mobile)->first();
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


    public function createUserData($userId, $request)
    {
        
        return $this->model->where('id', $userId)->update([
            'first_name' => isset($request['first_name']) ? $request['first_name'] : null,
            'last_name' => isset($request['last_name']) ? $request['last_name'] : null,            
            'about_me' => null,
            'user_name' => Helper::generateUserName(),
            // 'password' => bcrypt($request['password']),
            // 'birth_day' => isset($request['birth_day']) ? $request['birth_day'] : null,  
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'age' => $request['age'],
            'gender' => $request['gender'],            
        ]);

        // about_me update table ???  $request['about_me']
    }



    public function updateUserData($userId, $request)
    {
        $this->model->where('id', $userId)->update(
            
            [
            'first_name' => isset($request['first_name']) ? $request['first_name'] : null,
            'last_name' => isset($request['last_name']) ? $request['last_name'] : null,            

            // 'birth_day' => isset($request['birth_day']) && !is_null($request['birth_day']) ? : $user['birth_day'],
            'province_id' => $request['province_id'],
            'city_id' => $request['city_id'],
            'age' => $request['age'],
        ]);

        // about_me update table ???  $request['about_me']
        
        $user = $this->model->where('id', $userId)->first();


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