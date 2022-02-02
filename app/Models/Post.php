<?php

namespace App\Models;

use App\Traits\SerializeDatabaseTrait;
use Illuminate\Support\Str;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Database\Eloquent\Factories\HasFactory;

class Post extends Model
{
    use HasFactory, SoftDeletes, SerializeDatabaseTrait;
    protected $fillable = ["user_id", "category_id", "title", "sub_title", "slug", "time", "time_unit", "total", "total_unit", "image", "level"];
    protected $appends = ['image_url', 'serialize_level'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'recomendation' => 'integer',
    ];

    public static function boot() {
        parent::boot();
        self::saving(function($model) {
            $model->slug = Str::slug($model->name);
        });

        static::deleting(function($model) {
            $model->step()->delete();
            $model->ingredient()->delete();
        });
    }

    public function getImageUrlAttribute() {
        if($this->image) {
            $image = public_path(Str::replace("/", "\\", $this->image));
            if (file_exists($image)) {
                return asset( $this->image);
            }
            $image = storage_path('app\\public\\' . Str::replace("/", "\\", $this->image));
            if (file_exists($image)) {
                return asset('storage/' . $this->image);
            }
        }
        return null;
    }

    public function getSerializeLevelAttribute() {
        return $this->levelColumn($this->level);
    }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function category() {
        return $this->belongsTo(Category::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
    }

    public function step() {
        return $this->hasMany(Step::class);
    }

    public function ingredient() {
        return $this->hasMany(Ingredient::class);
    }
}
