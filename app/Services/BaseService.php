<?php

namespace App\Services;

use App\Repositories\Interfaces\BaseRepositoryInterface;

class BaseService
{
    protected $repository;
    
    public function __construct(
         $repository
    ){
        $this->repository = $repository;
    }

    public function indexAllItems()
    {
        return $this->repository->getAll();
    }

    public function indexAllPaginated($limit)
    {
        return $this->repository->getAllPaginated($limit);
    }

    public function showItem($id)
    {
        return $this->repository->find($id);
    }

    public function createItem($params)
    {
        return $this->repository->create($params);
    }

    public function updateItem($id, $params)
    {
        return $this->repository->update($id, $params);
    }

    public function deleteItem($id)
    {
        return $this->repository->delete($id);
    }

    public function toggleStatus($item)
    {
        return $item->repository->toggleStatus($item);
    }
}