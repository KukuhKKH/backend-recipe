<?php

namespace App\Repositories;

use App\Models\Tag;
use App\Traits\CollectionTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class TagRepository {
    use CollectionTrait;
    private $model;

    public function __construct() {
        $this->model = new Tag();
    }

    public function all($request, $limit = null, $offset = null) {
        try {
            $sort = $request['sort'] ?? 'id';
            $sortBy = $request['sort_by'] ?? 'desc';
            $column = ["name"];
            $search = $request['search'] ?? '';

            $query = $this->model->query();
            $query = $this->pagination($query, $column, $search, $sort, $sortBy);
            if($limit && $offset === null) return $query->paginate($limit);
            elseif($limit > 0 && $offset) $query->skip($offset)->take($limit);
            return $query->get();
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function store($request) {
        try {
            return $this->model->create($request);
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function show($id) {
        try {
            return $this->model->find($id);
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function update($request, $id) {
        try {
            $tag = $this->model->find($id);
            return $tag->update($request);
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function destroy($id) {
        try {
            $tag = $this->model->find($id);
            return $tag->delete();
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
