<?php

namespace App\Repositories\Interfaces;


interface BaseRepositoryInterface
{

    public function find($id);
    public function getAll();
    public function create($params);
    public function update($id, $params);
    public function delete($id);
    public function updateOrCreate($conditions, $params);
    public function getModel();
    public function getModelName();
    public function findWithConditions($conditions);
}