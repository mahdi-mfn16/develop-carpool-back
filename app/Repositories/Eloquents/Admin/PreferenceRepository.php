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
        return ['options'];
    }


    public function getPreferences($filters, $limit = 10)
    {
        $preferences = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';

        $preferences = $preferences->where('name', 'like', '%'.$search.'%')
        ->paginate($limit);

        return $preferences;
    }

    
}