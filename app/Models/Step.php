<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class Step extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["name", "post_id"];

    public static function boot() {
        parent::boot();

        static::deleting(function($model) {
            $model->detail()->delete();
        });
    }

    public function post() {
        return $this->belongsTo(Post::class);
    }

    public function detail() {
        return $this->hasMany(StepDetail::class);
    }
}
