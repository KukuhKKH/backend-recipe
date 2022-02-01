<?php

namespace App\Repositories;

use App\Models\User;
use App\Traits\CollectionTrait;
use App\Traits\ImageHandlerTrait;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\Hash;

class UserRepository {
    use CollectionTrait, ImageHandlerTrait;
    private $imagePath = "upload/image/users";
    private $model;

    public function __construct() {
        $this->model = new User();
    }

    public function all($request, $limit = null, $offset = null) {
        try {
            $sort = $request['sort'] ?? 'id';
            $sortBy = $request['sort_by'] ?? 'desc';
            $column = ["name", "username"];
            $search = $request['search'] ?? '';

            $query = $this->model->query();
            $query = $this->pagination($query, $column, $search, $sort, $sortBy);
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
            $request['password'] = Hash::make($request['password']);
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
            $user = $this->model->find($id);
            if($request['password_old']) {
                if(Hash::check($request['password_old'], $user->password)) {
                    $request['password'] = Hash::make($request['password']);
                } else {
                    throw new \Exception("Password lama tidak sama", 400);
                }
            } else {
                unset($request['password']);
            }
            if($request['image']) {
                $this->unlinkImage("", $user->image);
                $image = $this->uploadImage($request['image'], $this->imagePath);
                $request['image'] = $image;
            } else {
                unset($request['image']);
            }
            return $user->update($request);
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function destroy($id) {
        try {
            $user = $this->model->find($id);
            $this->unlinkImage("", $user->image);
            return $user->delete();
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
