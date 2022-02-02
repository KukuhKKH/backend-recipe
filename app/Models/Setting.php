<?php

namespace App\Models;

use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Setting extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ['param', 'value'];

    public function scopeParam($query, $param) {
        return $query->where('param', $param)->firstOrFail();
    }

    public static function boot() {
        parent::boot();
        self::saving(function($model) {
            $model->param = Str::slug($model->param);
        });
    }
}
