<?php 

namespace App\Repositories\Eloquents;

use App\Repositories\Interfaces\BaseRepositoryInterface;
use Illuminate\Database\Eloquent\Model;

abstract class BaseRepository implements BaseRepositoryInterface
{
    protected $model;

    public function __construct(Model $model)
    {
        $this->model = $model;
    }

    abstract public function load();

    public function find($id)
    {
        return $this->model->with($this->load())->find($id);
    }

    public function getAll()
    {
        return $this->model->with($this->load())->get();
    }

    public function create($params)
    {
        return $this->model->create($params);
    }

    public function update($id, $params)
    {
        $this->model->where('id', $id)->update($params);
        return $this->find($id);
    }

    public function updateOrCreate($conditions, $params)
    {
        return $this->model->updateOrCreate($conditions, $params);
    }

    public function delete($id)
    {
        return $this->model->destroy($id);
    }

    public function getModel()
    {
        return $this->model;
    }

    public function getModelName()
    {
        return get_class($this->model);
    }

    public function findWithConditions($conditions)
    {
        return $this->model->where($conditions)->get();
    }
}