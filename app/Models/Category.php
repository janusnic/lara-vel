<?php

namespace App\Models;

use Illuminate\Database\Eloquent\Factories\HasFactory;
use Illuminate\Database\Eloquent\Model;
use Cviebrock\EloquentSluggable\Sluggable;
use Illuminate\Database\Eloquent\SoftDeletes;

use Carbon\Carbon;

class Category extends Model
{
    use HasFactory;
    use Sluggable;
    use SoftDeletes;

    protected $fillable = ['name', 'status', 'cover'];

    public function sluggable(): array {
        return [
            'slug' => [
                'source' => 'name'
            ]
        ];
    }

    // use App\Models\Category;
 
    // foreach (Category::all() as $category) {
    //     echo $category->name;
    // }

    // use App\Models\Product;
    
    // $products = Product::where('status', 1)
    //     ->orderBy('id', 'desc')
    //     ->take(10)
    //     ->get();

    // $product = Product::where('status', 1)->first();
    // $product->price="43.5";
    // $product->fresh();
    // $product->status = 2;
    // $brand->save();
    // $product->refresh();    

    // $products = Product::where('status', 1)->get();

    // $filtered = $products->reject(function (Product $product) {
    //     return $product->brand_id > 10;
    // });
    
    // use Illuminate\Database\Eloquent\Collection;
    // Product::chunk(20, function (Collection $products) {
    //     foreach ($products as $product) {
    //         echo $product;
    //     }
    // });
    
    // Product::chunk(20, function (Collection $products) {
    //     foreach ($products as $product) {
    //         echo $product;
    //     }
    // });

    // foreach (Product::lazy() as $product) {
    //     echo $product;
    // }
    

    // foreach (Product::where('status', 1)->cursor() as $product) {
    //     echo $product;
    // }
    

    // use App\Models\Product;
    // use App\Models\Category;
    
    // return Product::addSelect(['category' => Category::select('name')
	// ->whereColumn('category_id', 'categories.id')
	// ->orderByDesc('created_at')
	// ->limit(1)
    // ])->get();


    // use App\Models\Product;
    // // Retrieve a model by its primary key...
    // $product = Product::find(1);
    
    // // Retrieve the first model matching the query constraints...
    // $product = Product::where('status', 1)->first();
    
    // // Alternative to retrieving the first model matching the query constraints...
    // $product = Product::firstWhere('status', 1);


    // $product = Product::findOr(1, function () {
    //     // ...
    // });
    
    // $product = Product::where('status', '>', 3)->firstOr(function () {
    //     // ...
    // });

    // $brand = Brand::firstOrCreate([
    //     'name' => 'Cats and Dogs'
    // ]);
    // $brand = Brand::firstOrNew([
    //     'name' => 'Cats and Dogs'
    // ]);

    // $category = Category::findOrFail(1);
    // $product = Product::where('status', '>', 3)->firstOrFail();

    // Route::get('/api/products/{id}', function (string $id) {
    //     return Product::findOrFail($id);
    // });
    
    // $count = Product::where('status', 1)->count();
 
    // $max = Product::where('status', 1)->max('price');

//     App\Models\Category::updateOrCreate(['name'=>'cats'], ['status'=>1]);
// = App\Models\Category {#6421
//     id: 42,
//     created_at: "2024-02-22 09:23:21",
//     updated_at: "2024-02-22 09:25:23",
//     deleted_at: null,
//     name: "cats",
//     slug: "cats",
//     status: 1,
//     cover: null,
//   }








}
