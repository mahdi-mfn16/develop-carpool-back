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
        return ['preference'];
    }


    public function getPreferenceOptions($filters, $limit = 10)
    {
        $options = $this->model->query();
        $search = isset($filters['search']) ? $filters['search'] : '';
        $preferenceId = (isset($filters['preference_id']) && $filters['preference_id']) ? $filters['preference_id'] : null;
        if($preferenceId){
            $options = $options->where('preference_id', $preferenceId);
        }

        $options = $options->where('name', 'like', '%'.$search.'%')
        ->with(['preference'])->paginate($limit);

        return $options;
    }

    
}