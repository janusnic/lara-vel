<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use App\Models\Scopes\AncientScope;
use Illuminate\Database\Eloquent\SoftDeletes;
use Cviebrock\EloquentSluggable\Sluggable;
use Carbon\Carbon;
use Illuminate\Support\Facades\Storage;
use Illuminate\Support\Str;
use App\Enums\PostStatus;

class Post extends Model
{
    use HasFactory;
	use Sluggable;
    use SoftDeletes;

   	/**
 	* The "booted" method of the model.
 	*/
	protected static function booted(): void
	{
    	// static::addGlobalScope(new AncientScope);
	}

    public static function boot()
    {
        parent::boot();
        
        static::creating(function ($model) {
            $model->uuid = Str::uuid();
        });
    }

	protected $fillable = ['title', 'content', 'user_id', 'status', 'cover', 'is_published'];

    
    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'title'
            ]
        ];
    }

    protected $casts = [
        'is_published' => 'datetime',
    ];

    public function setIsPublishedAttribute($value)
    {
        $this->attributes['is_published'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    }


	// public function setPublishedAtAttribute($value)
    // {
    //     $this->attributes['is_published'] = Carbon::parse($value)->format('Y-m-d H:i:s');
    // }

    // public function setUuidAttribute()
    // {
    //     $this->attributes['uuid'] =  Str::uuid();
    // }

    // public function author()
    // {
    //     return $this->belongsTo(User::class, 'user_id');
    // }

    public function user() {
        return $this->belongsTo(User::class);
    }

    public function tags() {
        return $this->belongsToMany(Tag::class);
        
    }

    public function comments()
    {
        return $this->hasMany(Comment::class);
    }

    
    public function likes()
    {
        return $this->belongsToMany(User::class, 'post_like')->withTimestamps();
    }

    public function scopePublished($query)
    {
        $query->where('updated_at', '<=', Carbon::now());
    }


    public function scopeWithTag($query, string $tag)
    {
        $query->whereHas('tags', function ($query) use ($tag) {
            $query->where('slug', $tag);
        });
    }


    public function scopeStatus($query)
    {
        $query->where('status', PostStatus::ACTIVE());
    }

    public function scopePopular($query)
    {
        $query->withCount('likes')
            ->orderBy("likes_count", 'desc');
    }

    public function scopeSearch($query, string $search = '')
    {
        $query->where('title', 'like', "%{$search}%");
    }

    public function getExcerpt()
    {
        return Str::limit(strip_tags($this->content), 150);
    }

    public function getReadingTime()
    {
        // return Str::readDuration($this->content);
        $mins = round(str_word_count($this->content) / 250);

        return ($mins < 1) ? 1 : $mins;

    }

    public function getThumbnailUrl()
    {
        $isUrl = str_contains($this->cover, 'http');
        return ($isUrl) ? $this->cover : asset(Storage::url($this->cover));
    }


}
