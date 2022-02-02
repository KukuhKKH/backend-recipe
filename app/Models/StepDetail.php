<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

class StepDetail extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["step_id", "number", "content"];

    public function step() {
        return $this->belongsTo(Step::class);
    }
}
