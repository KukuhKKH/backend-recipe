<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\SoftDeletes;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Illuminate\Support\Str;
use Laravel\Sanctum\HasApiTokens;

class User extends Authenticatable
{
    use HasApiTokens, HasFactory, Notifiable, SoftDeletes;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'role_id',
        'name',
        'username',
        'image',
        'email',
        'password',
    ];

    /**
     * The attributes that should be hidden for serialization.
     *
     * @var array<int, string>
     */
    protected $hidden = [
        'password',
        'remember_token',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    protected $appends = ["image_url"];

    public function setUsernameAttribute($value) {
        $this->attributes['username'] = Str::lower(Str::replace(" ", "", $value));
    }

    public function getImageUrlAttribute() {
        if($this->image) {
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
        }
        return null;
    }

    public function post() {
        return $this->hasMany(Post::class);
    }

    public function role() {
        return $this->belongsTo(Role::class);
    }
}
