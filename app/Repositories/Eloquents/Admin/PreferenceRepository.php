<?php 

namespace App\Repositories\Eloquents\Admin;

use App\Models\Preference;
use App\Repositories\Eloquents\BaseRepository;
use App\Repositories\Interfaces\Admin\PreferenceRepositoryInterface;

class PreferenceRepository extends BaseRepository implements PreferenceRepositoryInterface
{
    public function __construct(Preference $model)
    {
        parent::__construct($model);
    }

    public function load()
    {
        
    }

    
}