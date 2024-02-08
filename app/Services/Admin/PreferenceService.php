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



    public function getUserPreferences()
    {
        $user = auth('sanctum')->user();
        $allOptions = $user->preferenceOptions;

        $preferences = $this->indexAllItems();
        foreach($preferences as $key=>$preference){

            $preference->options->map(function($item) use($allOptions){
               
                $item['has'] = $allOptions->contains($item);
            });

            $nonOption = $preference->options->where('has', true)->first() ? false : true;

            $preferences[$key]->options->push([
                'id' => null,
                'text' => 'عدم نمایش',
                'has' => $nonOption,
               
            ]);
        }

        return $preferences;
    }





}