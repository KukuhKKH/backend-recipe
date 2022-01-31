<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Support\Facades\Hash;
use Illuminate\Support\Str;

class Category extends Model
{
    use HasFactory, SoftDeletes;
    protected $fillable = ["name", "image", "recomendation"];
    protected $appends = ['image_url'];

    /**
     * The attributes that should be cast.
     *
     * @var array
     */
    protected $casts = [
        'recomendation' => 'boolean',
    ];

    /**
     * Set the recomendation.
     *
     * @param  Boolean $value
     * @return void
     */
    public function setRecomendationAttribute($value) {
        if($value == true) $this->attributes['recomendation'] = "1";
        else $this->attributes['recomendation'] = "0";
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

    public function post() {
        return $this->hasMany(Post::class);
    }
}
