<?php

namespace App\Policies;

use App\Models\Chat;
use App\Models\Message;
use App\Models\User;
use Illuminate\Auth\Access\HandlesAuthorization;
use Illuminate\Auth\Access\Response;

class MessagePolicy
{
    use HandlesAuthorization;

    /**
     * Determine whether the user can view any models.
     *
     * @param  \App\Models\User  $user
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function viewAll(User $user, Chat $chat)
    {
        return $user->id == $chat->user_id_one or $user->id == $chat->user_id_two
        ? Response::allow()
        : Response::deny('you are not allowed');
    }

    /**
     * Determine whether the user can view the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function view(User $user, Message $message)
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
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function update(User $user, Message $message)
    {
        return $user->id == $message->from_user_id or $user->id == $message->to_user_id
        ? Response::allow()
        : Response::deny('you are not allowed');
    }

    /**
     * Determine whether the user can delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function delete(User $user, Message $message)
    {
        return $user->id == $message->from_user_id or $user->id == $message->to_user_id
        ? Response::allow()
        : Response::deny('you are not allowed');
    }

    /**
     * Determine whether the user can restore the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function restore(User $user, Message $message)
    {
        //
    }

    /**
     * Determine whether the user can permanently delete the model.
     *
     * @param  \App\Models\User  $user
     * @param  \App\Models\Message  $message
     * @return \Illuminate\Auth\Access\Response|bool
     */
    public function forceDelete(User $user, Message $message)
    {
        return $user->id == $message->from_user_id or $user->id == $message->to_user_id
        ? Response::allow()
        : Response::deny('you are not allowed');
    }
}
