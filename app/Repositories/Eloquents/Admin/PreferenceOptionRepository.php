<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\PreferenceOption;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\PreferenceOptionRepositoryInterface;

class PreferenceOptionRepository extends BaseRepository implements PreferenceOptionRepositoryInterface
{
    public function __construct(PreferenceOption $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }

    
}