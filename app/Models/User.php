<?php

namespace App\Models;

use Illuminate\Contracts\Auth\MustVerifyEmail;
use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Foundation\Auth\User as Authenticatable;
use Illuminate\Notifications\Notifiable;
use Laravel\Fortify\TwoFactorAuthenticatable;
use Laravel\Jetstream\HasProfilePhoto;
use Laravel\Sanctum\HasApiTokens;
use Illuminate\Support\Facades\Storage;
use Spatie\Permission\Traits\HasRoles;

class User extends Authenticatable implements MustVerifyEmail
{
    use HasApiTokens;
    use HasFactory;
    use HasProfilePhoto;
    use Notifiable;
    use TwoFactorAuthenticatable;
    use HasRoles;

    /**
     * The attributes that are mass assignable.
     *
     * @var array<int, string>
     */
    protected $fillable = [
        'name',
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
        'two_factor_recovery_codes',
        'two_factor_secret',
    ];

    /**
     * The attributes that should be cast.
     *
     * @var array<string, string>
     */
    protected $casts = [
        'email_verified_at' => 'datetime',
    ];

    /**
     * The accessors to append to the model's array form.
     *
     * @var array<int, string>
     */
    protected $appends = [
        'profile_photo_url',
    ];

    public function scopeNotActive($query)
    {
        return $query->whereNull('email_verified_at');
        // App\Models\User::notActive()->get();
    }
    

    // public function getProfilePhotoUrlAttribute()
    // {
    //     return $this->profile_photo_path
    //         ? Storage::disk($this->profilePhotoDisk())->url($this->profile_photo_path)
    //         : $this->defaultProfilePhotoUrl();
    // }

    public function likes()
    {
        return $this->belongsToMany(Post::class, 'post_like')->withTimestamps();
    }

    public function hasLiked(Post $post)
    {
        return $this->likes()->where('post_id', $post->id)->exists();
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    public function profile() {
        return $this->hasOne(Profile::class);
    }
    
    public function orders()
    {
        return $this->hasMany(Order::class);
    }
    // hasOne працює так:
    // $this->hasOne(Profile::class,
    //   'user_id' // foreignKey By Default Parent Model + Promary Key
    //   'id' // localKey => Primary Key In Parent Table By Default is Id
    // );

    public function isAdmin(){
        return $this->hasRole('admin');
    }
    
}
