<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\CollectionTrait;

class CategoryRepository {
    use CollectionTrait;

    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    public function all($request, $limit = null) {
        try {
            $sort = $request['sort'] ?? 'id';
            $sortBy = $request['sort_by'] ?? 'desc';
            $column = ["name", "recomendation"];

            $query = $this->model->query();
            $query = $this->pagination($query, $column, '', $sort, $sortBy);
            if($limit) return $query->paginate($limit);
            return $query->get();
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
