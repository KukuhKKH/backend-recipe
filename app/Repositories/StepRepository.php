<?php

namespace App\Repositories;

use App\Models\Step;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;

class StepRepository {

    private $model;

    public function __construct() {
        $this->model = new Step();
    }

    public function createOrUpdate($request, $post_id) {
        try {
            if($request['id']) {
                foreach ($request['id'] as $key => $value) {
                    $step = $this->model->find($value);
                    $step->update([
                        'name' => $request['name'][$key]
                    ]);
                    unset($request['name'][$key]);
                }
            }
            $arrInsert = [];
            foreach ($request['name'] as $key => $value) {
                $temp['post_id'] = $post_id;
                $temp['name'] = $value;
                $temp['created_at'] = Carbon::now();
                $temp['updated_at'] = Carbon::now();
                $arrInsert[] = $temp;
            }
            return $this->model->insert($arrInsert);
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }

    public function destroy($id) {
        try {
            $step = $this->model->find($id);
            return $step->delete();
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
        } catch(\Exception $e) {
            throw $e; report($e); return $e;
        }
    }
}
