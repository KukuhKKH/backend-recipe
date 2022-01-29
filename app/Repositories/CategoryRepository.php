<?php

namespace App\Repositories;

use App\Models\Category;

class CategoryRepository {

    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    public function all() {
        return $this->model->all();
    }
}
