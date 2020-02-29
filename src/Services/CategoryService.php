<?php

namespace TeamTeaTime\Forum\Services;

use TeamTeaTime\Forum\Models\Category;

class CategoryService
{
    /** @var Model */
    private $model;

    public function __construct()
    {
        $this->model = new Category;
    }

    public function getAll()
    {
        return $this->model->all();
    }

    public function getTopLevel()
    {
        return $this->model->where('parent_id', 0)->get();
    }

    public function getByID(int $id)
    {
        return $this->model->findOrFail($id);
    }

    public function create($attributes)
    {
        return $this->model->create($attributes);
    }

    public function rebuildTree(array $categories)
    {
        return $this->model->rebuildTree($categories);
    }
}