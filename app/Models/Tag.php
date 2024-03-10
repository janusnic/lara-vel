<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Illuminate\Database\Eloquent\SoftDeletes;

use Cviebrock\EloquentSluggable\Sluggable;

class Tag extends Model
{
    use HasFactory;
    use SoftDeletes;
    use Sluggable;

    protected $fillable = ['name'];

    public function sluggable(): array
    {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }
    

    public function posts() {
        return $this->belongsToMany(Post::class);
    }

}
