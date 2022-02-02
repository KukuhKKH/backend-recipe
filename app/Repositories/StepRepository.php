<?php

namespace App\Repositories;

use App\Models\Step;
use App\Models\StepDetail;
use Illuminate\Support\Carbon;
use Illuminate\Database\Eloquent\ModelNotFoundException;
use Illuminate\Support\Facades\DB;

class StepRepository {

    private $model, $modelDetail;

    public function __construct() {
        $this->model = new Step();
        $this->modelDetail = new StepDetail();
    }

    public function createOrUpdate($request, $post_id) {
        DB::beginTransaction();
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
            $this->model->insert($arrInsert);
            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e; report($e); return $e;
        }
    }

    public function show($id, $relation = null) {
        try {
            $query = $this->model->where('id', $id);
            if($relation) {
                $query->with($relation);
            }
            return $query->first();
        } catch(ModelNotFoundException $e) {
            throw $e; report($e); return $e;
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

    public function createOrUpdateDetail($request, $step_id) {
        DB::beginTransaction();
        try {
            $number = 1;
            if($request['id']) {
                foreach ($request['id'] as $key => $value) {
                    $stepDetail = $this->modelDetail->find($value);
                    $stepDetail->update([
                        'step_id' => $step_id,
                        'number' => $number++,
                        'content' => $request['content'][$key]
                    ]);
                    unset($request['content'][$key]);
                }
            }

            $arrInsert = [];
            foreach ($request['content'] as $key => $value) {
                $temp['step_id'] = $step_id;
                $temp['number'] = $number++;
                $temp['content'] = $value;
                $temp['created_at'] = Carbon::now();
                $temp['updated_at'] = Carbon::now();
                $arrInsert[] = $temp;
            }
            $this->modelDetail->insert($arrInsert);

            DB::commit();
            return true;
        } catch(\Exception $e) {
            DB::rollBack();
            throw $e; report($e); return $e;
        }
    }
}
