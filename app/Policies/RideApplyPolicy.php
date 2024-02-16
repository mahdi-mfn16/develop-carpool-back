<?php

namespace App\Policies;

use App\Models\RideApply;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class RideApplyPolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAny(User $user)
    {
        //
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RideApply  $rideApply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, RideApply $rideApply)
    {
        //
    }

    /**
     * Determine whether the user can create models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function create(User $user)
    {
        //
    }

    /**
     * Determine whether the user can update the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RideApply  $rideApply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, RideApply $rideApply, $action)
    {
        $applier = $rideApply->user_id == $rideApply;
        $rider = $rideApply->ride->user_id;
        
        $isAllowed = match($action){
            'canceled' => $user->id == $applier,
            'accepted' => $user->id == $rider,
            'rejected' => $user->id == $rider,
            'accept_closed' => $user->id == $rider,
            'reject_closed' => $user->id == $rider,
        };
    
        return ($isAllowed)
        ? Response::allow()
        : Response::deny('you are not allowed');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RideApply  $rideApply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, RideApply $rideApply)
    {
        //
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RideApply  $rideApply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, RideApply $rideApply)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\RideApply  $rideApply
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, RideApply $rideApply)
    {
        //
    }
}
