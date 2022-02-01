<?php

namespace App\Repositories;

use App\Models\Post;
use App\Traits\CollectionTrait;
use App\Traits\ImageHandlerTrait;
use Illuminate\Support\Facades\Auth;

class PostRepository {
    use CollectionTrait, ImageHandlerTrait;
    private $imagePath = "upload/image/recipe";
    private $model;

    public function __construct() {
        $this->model = new Post();
    }

    public function all($request, $limit = null, $offset = null, $relation = null) {
        try {
            $sort = $request['sort'] ?? 'id';
            $sortBy = $request['sort_by'] ?? 'desc';
            $column = ["name"];
            $search = $request['search'] ?? '';

            $query = $this->model->query();
            $query = $this->pagination($query, $column, $search, $sort, $sortBy);
            if($relation) $query->with($relation);
            if($limit && $offset === null) return $query->paginate($limit);
            elseif($limit > 0 && $offset) $query->skip($offset)->take($limit);
            return $query->get();
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function store($request) {
        try {
            $request['image'] = $this->uploadImage($request['image'], $this->imagePath);
            return Auth::user()->post()->create($request);
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
