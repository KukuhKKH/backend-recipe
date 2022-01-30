<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Support\Facades\Hash;

class Category extends Model
{
    use HasFactory;
    protected $fillable = ["name", "image", "recomendation"];
    protected $appends = ['image_url'];

    public function getImageUrlAttribute() {
        if($this->image) {
            $image = asset('upload/image/categories/' . $this->image);
            if (file_exists($image)) {
                return $image;
            }
            $image = asset('storage/upload/image/categories/' . $this->image);
            if (file_exists($image)) {
                return $image;
            }
        }
        return null;
    }

    public function post() {
        return $this->hasMany(Post::class);
    }
}
