<?php

namespace App\Repositories;

use App\Models\Category;
use App\Traits\CollectionTrait;
use App\Traits\ImageHandlerTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class CategoryRepository {
    use CollectionTrait, ImageHandlerTrait;
    private $imagePath = "upload/image/categories";

    private $model;

    public function __construct() {
        $this->model = new Category();
    }

    public function all($request, $limit = null, $offset = null) {
        try {
            $sort = $request['sort'] ?? 'id';
            $sortBy = $request['sort_by'] ?? 'desc';
            $column = ["name", "recomendation"];

            $query = $this->model->query();
            $query = $this->pagination($query, $column, '', $sort, $sortBy);
            if($limit && $offset == null) return $query->paginate($limit);
            elseif($limit > 0 && $offset) $query->skip($offset)->take($limit);
            return $query->get();
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function store($request) {
        try {
            $image = $this->uploadImage($request['image'], $this->imagePath);
            $request['image'] = $image;
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
            $category = $this->model->find($id);
            if($request['image']) {
                $this->unlinkImage("", $category->image);
                $image = $this->uploadImage($request['image'], $this->imagePath);
                $request['image'] = $image;
            } else {
                unset($request['image']);
            }
            return $category->update($request);
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function destroy($id) {
        try {
            $category = $this->model->find($id);
            $this->unlinkImage("", $category->image);
            return $category->delete();
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function changeRecomendation($id) {
        try {
            $category = $this->model->find($id);
            if($category->recomendation) {
                $recomendation = 0;
            } else {
                $recomendation = 1;
            }
            return $category->update([
                "recomendation" => $recomendation
            ]);
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
