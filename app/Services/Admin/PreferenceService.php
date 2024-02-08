<?php

namespace App\Services\Admin;

use App\Repositories\Interfaces\Admin\PreferenceRepositoryInterface;
use App\Services\BaseService;

class PreferenceService extends BaseService
{
    public function __construct(
        PreferenceRepositoryInterface $preferenceRepo
    )
    {
        parent::__construct($preferenceRepo);
    }


    public function updateUserPreference($user, $preference, $request)
    {
        $preferenceOptionId = $request->input('preference_option_id');
        $allOptionIds = $preference->options->pluck('id');
        $user->preferenceOptions()->detach($allOptionIds);

        if($preferenceOptionId){
            $user->preferenceOptions()->sync($preferenceOptionId);
        }

        return true;
    }



}