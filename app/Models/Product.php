<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;
// use Illuminate\Database\Eloquent\Concerns\HasUuids;
use App\Enums\ProductStatus;
use App\Models\Scopes\{AncientScope, ActiveScope};
use Carbon\Carbon;
use Illuminate\Database\Eloquent\Builder;
use Illuminate\Support\Str;

class Product extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;
    // use HasUuids;

    protected $fillable = ['name', 'description', 'price', 'category_id', 'brand_id', 'status', 'cover'];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    protected $attributes = [
        'status' => 1,
    ];

    protected $casts = [
        'price' => 'float',
    ];

    protected static function boot()
    {
        parent::boot();

        static::creating(function ($model) {
            $model->uuid = (string) Str::uuid();
        });
    }


    /**
 	* The "booted" method of the model.
 	*/
    protected static function booted(): void
	{
    	// static::addGlobalScope(new ActiveScope);

        // static::addGlobalScope('lastyear', function (Builder $builder) {
        //     $builder->where('created_at', '<', now()->subYears(2023));
        // });
        // Product::withoutGlobalScope(AncientScope::class)->get();
	}

    public static function any()
    {
        return self::withoutGlobalScopes();
    }
    
    public function scopeYestoday($query)
    {
        return $query->where('created_at', '<', Carbon::now()->subDays(0));
        // Usage: App\Models\Product::yestoday()->get();
    }
    

    public function scopeSold($query)
    {
	    return $query->where('status', ProductStatus::SOLD());
    }

    public function scopeByCategory($query, $categoryId)
    {
        return $query->where('category_id', $categoryId);
        // Usage:$categoryProducts = Product::byCategory(1)->get();
        // Product::byCategory(1)->orWhere(function (Builder $query) {
        //     $query->sold();
        // })->get();
        // Product::byCategory(1)->orWhere->sold()->get();
    }

    public function scopePriceRange($query, $minPrice, $maxPrice)
    {
        return $query->whereBetween('price', [$minPrice, $maxPrice]);
        // Usage:  $affordableProducts = Product::priceRange(10, 50)->get();
        // App\Models\Product::withoutGlobalScopes()->priceRange(100, 400)->get();

    }

    public function scopeSortBy($query, $column, $direction = 'asc')
    {
        return $query->orderBy($column, $direction);
            // Usage: App\Models\Product::withoutGlobalScopes()->sortBy('created_at', 'desc')->get();
    }

    public function brand()     
    {
        return $this->belongsTo(Brand::class);
    }

    
    public function category()     
    {
        return $this->belongsTo(Category::class);
    }

}
